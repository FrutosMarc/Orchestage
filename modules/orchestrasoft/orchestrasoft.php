<?php

if (!defined('_PS_VERSION_'))
	exit;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of orchestra-soft
 *
 * @author Marc
 */
class orchestrasoft extends Module {
    public function __construct() {
        $this->name = 'orchestrasoft';
        $this->tab = 'administration';
        $this->version = 1.0;
        $this->author = 'Frutos Marc';
        $this->need_instance = 1 ;
        
        parent::__construct();
        
        $this->displayName = $this->l('Orchestra-Software');
        $this->description = $this->l('this is a private module witch it run with Orchestra-Software.');
        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');
 
    }
    /**
     * Permet d'installer le module
     * @return boolean
     */
    public function install() {
        if (Shop::isFeatureActive())
            Shop::setContext(Shop::CONTEXT_ALL);

        // Retourne vrai si l'installation est correcte et que les ancres sont bonnes
            return parent::install() && $this->registerHook('displayBanner') &&
                    $this->registerHook('leftColumn') &&
                    $this->registerHook('header') && Configuration::updateValue('MYMODULE_NAME', 'my friend');
    }
    
    /**
     * Permet de désinstaller le module
     */
    public function uninstall(){
        if (!parent::uninstall())
        Db::getInstance()->Execute('DELETE FROM `'._DB_PREFIX_.'mymodule`');
        parent::uninstall();      
    
    }
    public function hookdisplayBanner($params)
    {
        global $smarty;
        return $this->display(__FILE__, 'orchestrasoft.tpl');
    }
 
    public function hookRightColumn($params)
    {
      return $this->hookdisplayBanner($params);
    } 
    public function getContent()
    {
        $output = null;
  
        if (Tools::isSubmit('Import'))
            $output .=$this->ImportProduct();
        elseif (Tools::isSubmit('submit'.$this->name))
        {
            
                Configuration::updateValue('PS_ORCHESTRASOFT_API_POST_ORDER', (int)Tools::getValue('PS_ORCHESTRASOFT_API_POST_ORDER'));
                Configuration::updateValue('PS_ORCHESTRASOFT_API_GET_PRODUCT', (int)Tools::getValue('PS_ORCHESTRASOFT_API_GET_PRODUCT'));
                
                $output .= $this->displayConfirmation($this->l('Settings updated'));
        }
            
        
        return $output.$this->displayForm();
    } 
    
    public function displayForm()
    {
        // Get default Language
        $default_lang = (int)Configuration::get('PS_LANG_DEFAULT');

        // Init Fields form array
        $fields_form[0]['form'] = array(
            'legend' => array(
                'title' => $this->l('Settings'),
            ),
            'input' => array(
                array(
                        'type' => 'switch',
                        'label' => $this->l('Send order to PDV'),
                        'name' => 'PS_ORCHESTRASOFT_API_POST_ORDER',
                        'class' => 'switch prestashop-switch fixed-width-lg',
                        'desc' => $this->l('Sends orders to your Orchestra-Software POS by web service.'),
                        'values' => array(
                                array(
                                        'id' => 'active_on',
                                        'value' => 1,
                                        'label' => $this->l('Enabled'),
                                ),
                                array(
                                        'id' => 'active_off',
                                        'value' => 0,
                                        'label' => $this->l('Disabled'),
                                )
                        ),
                ),
                array(
                        'type' => 'switch',
                        'label' => $this->l('Get products from  PDV'),
                        'name' => 'PS_ORCHESTRASOFT_API_GET_PRODUCT',
                        'desc' => $this->l('Get products from your Orchestra-Software POS by web service.'),
                        'class' => 'switch prestashop-switch fixed-width-lg',
                        'values' => array(
                                array(
                                        'id' => 'active_on',
                                        'value' => 1,
                                        'label' => $this->l('Enabled'),

                                ),
                                array(
                                        'id' => 'active_off',
                                        'value' => 0,
                                        'label' => $this->l('Disabled')
                                )
                        ),
                ),
            ),
            'submit' => array(
                'title' => $this->l('Save'),
                'class' => 'button'
            )
        );
        
        $fields_form[1]['form'] = array(
            'legend' => array(
                'title' => $this->l('Import products on prestashop database by web services (test) '),
            ),
           'submit' => array(
                'title' => $this->l('ImportProducts'),
                'class' => 'button',
                'name' => 'Import'
            )
        );
        

        $helper = new HelperForm();

        // Module, token and currentIndex
        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;

        // Language
        $helper->default_form_language = $default_lang;
        $helper->allow_employee_form_lang = $default_lang;

        // Title and toolbar
        $helper->title = $this->displayName;
        $helper->show_toolbar = true;        // false -> remove toolbar
        $helper->toolbar_scroll = true;      // yes - > Toolbar is always visible on the top of the screen.
        $helper->submit_action = 'submit'.$this->name;
        $helper->toolbar_btn = array(
            'save' =>
            array(
                'desc' => $this->l('Save'),
                'href' => AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.
                '&token='.Tools::getAdminTokenLite('AdminModules'),
            ),
            'back' => array(
                'href' => AdminController::$currentIndex.'&token='.Tools::getAdminTokenLite('AdminModules'),
                'desc' => $this->l('Back to list')
            ),
            "ImportProducts"=>
            array(
                'desc' => $this->l('Import products'),
                'href' => AdminController::$currentIndex.'&configure='.$this->name.'&ImportProducts'.$this->name.
                '&token='.Tools::getAdminTokenLite('AdminModules').'&ModuleName=',                
            )
        );

        // Load current value
        $helper->fields_value['PS_ORCHESTRASOFT_API_POST_ORDER'] = Configuration::get('PS_ORCHESTRASOFT_API_POST_ORDER');
        $helper->fields_value['PS_ORCHESTRASOFT_API_GET_PRODUCT'] = Configuration::get('PS_ORCHESTRASOFT_API_GET_PRODUCT');

        return $helper->generateForm($fields_form);
    }

    /**
     * Module permettant d'importer les produits
     * @return type
     */
    public function ImportProduct()
	{
           ini_set("soap.wsdl_cache_enabled", 0);
           try {
                // Instanciation du client SOAP
                $client = new SoapClient("http://www.orchestra-cloud.com:20000/WEBSERVICE_WEB/awws/WebService.awws?wsdl",  array(
                   //’proxy_host’=>’http://monproxy.net’, // si vous utilisez un proxy…
                   //’proxy_port’=>8080, // si vous utilisez un proxy…  
                   "trace"=> 1,
                   "soap_version"=> SOAP_1_1
                  ) 
                );
                $retour_ws =  $client->CmdeExportCarte(array());
                $xmlstr = $client->__getLastResponse();
                $xmlstr = utf8_decode ($xmlstr);
//                echo "</br></br></br></br></br>";
                $return =$xmlstr;
//                 $return.="<br />Reponse SOAP : ".$xmlstr."<br />";
                // Affichage des requêtes et réponses SOAP (pour debug)
                $xml = new XmlReader();
                $xml->xml($xmlstr);
                while($xml->read()){
                  // Si l'élément en cours dans la node carte est categ (catégorie) j'implémente
                  if ($xml->nodeType == XMLReader::ELEMENT && $xml->carte = "categ") {
                    // BAM! readOuterXML yanks the xml string out (including the element we matched)
                    // so that we can convert it into a simplexml object for easy iterating
                    $xml_obj[] = new SimpleXMLElement($xml->readOuterXML());
                    $return .= $this->ImportCategories($xml_obj);
                  }
                }
                
                $return = $this->displayConfirmation($return);
                
            }
            catch (Exception $e) {
                //pas bon
                $return = $this->displayError($e);
            };
            return $return;
        }
        private function ImportCategories($xml_obj,$idCateg = 2){
                $max = sizeof($xml_obj);
                // now we can iterate through it hooray!
                for($i = 0; $i < $max;$i++)
                {
                    $xml = simplexml_load_string($xml_obj[$i]);
                    
                    $found = false;
                    // Vérifie que la node du nom de catégori existe sinon on passe au suivant
                      if (isset($xml->carte->categ->nom)){
                            $name = $xml->carte->categ->nom;
                            $link = $xml->carte->categ['nom'];
                            $lvl = 2; // Accueil
                            $categ = Db::getInstance()->getRow('
                            SELECT c.*, cl.*
                            FROM `'._DB_PREFIX_.'category` c
                            LEFT JOIN `'._DB_PREFIX_.'category_lang` cl ON (c.`id_category` = cl.`id_category`)'.
                            'WHERE `name` = \''.$name.'\'');
                            if (isset($categ['name'])){
                                $found = true;
                                $idCateg= $categ["id_category"];
                                $return.= "La catégorie existe déjà. id :".$idCateg;
                            }
                            else {
                                $return.= "</br>La catégorie n'existe pas. On l'ajoute";
                                $categ = new Category(0,1,1);
                                $categ->active=true;
                                $categ->id_parent=$lvl;
                                $categ->is_root_category = 0;
                                $categ->name= $this->l($name);
                                $categ->link_rewrite= $this->l($link);
                                $categ->description= $this->l($name);
                                $categ->add();
                                $idCateg= $categ->id_category;
                                $return.= "</br>".$categ->id_category." enregistré";
                            };
                }
                if (isset($idCateg)){
                    $return.= $this->ImportSsCategories($xml,$idCateg);
                }
                            
            }
            return $return;
        }
        /**
         * Importation des sous-catégories associées à une catégorie
         * @param type $xml
         * @param type $idCateg
         * @return string
         */
        private function ImportSsCategories($xml,$idCateg = 2){
            foreach ($xml->carte->categ->sscateg as $ssCateg) {
                            if (isset($ssCateg->nom)){
                                    $name = $ssCateg->nom;
                                    $link = $ssCateg->nom;
                                    $link = str_replace($link, " ","-");
                                    $lvl = $idCateg; // catégorie
                                    $categ = Db::getInstance()->getRow('
                                    SELECT c.*, cl.*
                                    FROM `'._DB_PREFIX_.'category` c
                                    LEFT JOIN `'._DB_PREFIX_.'category_lang` cl ON (c.`id_category` = cl.`id_category`)'.
                                    'WHERE `name` = \''.$name.'\'');
                                    if (isset($categ['name'])){
                                        $found = true;
                                        $return.= "</br>La sous-catégorie existe déjà id :" . $categ["id_category"];
                                    }
                                    else {
                                        
                                        $return.= "</br>La sous-catégorie n'existe pas. On l'ajoute";
                                        $categ = new Category(0,1,1);
                                        $categ->active=true;
                                        $categ->id_parent=$lvl;
                                        $categ->is_root_category = 0;
                                        $categ->name= $this->l($name);
                                        $categ->link_rewrite= $this->l($link);
                                        $categ->description= $this->l($name);
                                        $categ->add();
                                        $return.= "</br>".$categ->id_category." enregistré";

                                    }
                            }
            }
            return $return;
        }
        
                                        
}
