<?php

/*
* 2007-2015 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2015 PrestaShop SA
*  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

class OrderConfirmationController extends OrderConfirmationControllerCore
{

	/**
	 * Assign template vars related to page content
	 * @see FrontController::initContent()
	 */
	public function initContent()
	{
		$this->context->smarty->assign(array(
                     'HOOK_WEBSERVICE_ORCHESTRA' => $this->displayWebServiceOrchestra(), 
		));

                parent::initContent();
	}

        
        public function displayWebServiceOrchestra()
        {
            if (Validate::isUnsignedId($this->id_order))
            {
                $params = array();
                $order = new Order($this->id_order);
                if (Validate::isLoadedObject($order))
                {
                    $params['wso'] = $this->sendOrderToOrchestra($order);
                }
            }
            return Hook::exec('displayOrderWebService', $params);
        }
        
        public function sendOrderToOrchestra($Order){
            $client = new SoapClient("http://www.orchestra-cloud.com:20000/WEBSERVICE_WEB/awws/WebService.awws?wsdl",  array(
                //’proxy_host’=>’http://monproxy.net’, // si vous utilisez un proxy…
                //’proxy_port’=>8080, // si vous utilisez un proxy…  
                "trace"=> 1,
                "soap_version"=> SOAP_1_1
               ) 
             );
             try {

                 // Appel de la fonction getHelloWorld sans paramètres
                $retour_ws =  $client -> __call("CmdeExportCarte",array(""));    
             // Affichage des requêtes et réponses SOAP (pour debug)
                 echo "<br />Requete SOAP : ".htmlspecialchars($client->__getLastRequest())."<br />";
                 echo "<br />Reponse SOAP : ".htmlspecialchars($client->__getLastResponse())."<br />";    
                // Affichage du résultat
                return $retour_ws;
            }
            catch (Exception $e) {
                //TODO  Traitement en cas d’exception, pour l’instant on l’affiche tel quel…
                return $e;
            }
        }
        
        
}

