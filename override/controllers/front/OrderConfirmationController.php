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

class OrderConfirmationController extends FrontController
{
	public $ssl = true;
	public $php_self = 'order-confirmation';
	public $id_cart;
	public $id_module;
	public $id_order;
	public $reference;
	public $secure_key;

	/**
	 * Initialize order confirmation controller
	 * @see FrontController::init()
	 */
	public function init()
	{
		parent::init();

		$this->id_cart = (int)(Tools::getValue('id_cart', 0));
		$is_guest = false;

		/* check if the cart has been made by a Guest customer, for redirect link */
		if (Cart::isGuestCartByCartId($this->id_cart))
		{
			$is_guest = true;
			$redirectLink = 'index.php?controller=guest-tracking';
		}
		else
			$redirectLink = 'index.php?controller=history';

		$this->id_module = (int)(Tools::getValue('id_module', 0));
		$this->id_order = Order::getOrderByCartId((int)($this->id_cart));
		$this->secure_key = Tools::getValue('key', false);
		$order = new Order((int)($this->id_order));
		if ($is_guest)
		{
			$customer = new Customer((int)$order->id_customer);
			$redirectLink .= '&id_order='.$order->reference.'&email='.urlencode($customer->email);
		}
		if (!$this->id_order || !$this->id_module || !$this->secure_key || empty($this->secure_key))
			Tools::redirect($redirectLink.(Tools::isSubmit('slowvalidation') ? '&slowvalidation' : ''));
		$this->reference = $order->reference;
		if (!Validate::isLoadedObject($order) || $order->id_customer != $this->context->customer->id || $this->secure_key != $order->secure_key)
			Tools::redirect($redirectLink);
		$module = Module::getInstanceById((int)($this->id_module));
		if ($order->module != $module->name)
			Tools::redirect($redirectLink);
	}

	/**
	 * Assign template vars related to page content
	 * @see FrontController::initContent()
	 */
	public function initContent()
	{
		parent::initContent();

		$this->context->smarty->assign(array(
                    'is_guest' => $this->context->customer->is_guest,
                    'HOOK_ORDER_CONFIRMATION' => $this->displayOrderConfirmation(),
                    'HOOK_PAYMENT_RETURN' => $this->displayPaymentReturn(),
                    'HOOK_WEBSERVICE_ORCHESTRA' => $this->displayWebServiceOrchestra() 
                ));

		if ($this->context->customer->is_guest)
		{
			$this->context->smarty->assign(array(
				'id_order' => $this->id_order,
				'reference_order' => $this->reference,
				'id_order_formatted' => sprintf('#%06d', $this->id_order),
				'email' => $this->context->customer->email
			));
			/* If guest we clear the cookie for security reason */
			$this->context->customer->mylogout();
		}

		$this->setTemplate(_PS_OVERRIDE_DIR_.'order-confirmation.tpl');
	}

	/**
	 * Execute the hook displayPaymentReturn
	 */
	public function displayPaymentReturn()
	{
		if (Validate::isUnsignedId($this->id_order) && Validate::isUnsignedId($this->id_module))
		{
			$params = array();
			$order = new Order($this->id_order);
			$currency = new Currency($order->id_currency);

			if (Validate::isLoadedObject($order))
			{
				$params['total_to_pay'] = $order->getOrdersTotalPaid();
				$params['currency'] = $currency->sign;
				$params['objOrder'] = $order;
				$params['currencyObj'] = $currency;

				return Hook::exec('displayPaymentReturn', $params, $this->id_module);
			}
		}
		return false;
	}

	/**
	 * Execute the hook displayOrderConfirmation
	 */
	public function displayOrderConfirmation()
	{
		if (Validate::isUnsignedId($this->id_order))
		{
			$params = array();
			$order = new Order($this->id_order);
			$currency = new Currency($order->id_currency);

			if (Validate::isLoadedObject($order))
			{
                                $params['total_to_pay'] = $order->getOrdersTotalPaid();
				$params['currency'] = $currency->sign;
				$params['objOrder'] = $order;
				$params['currencyObj'] = $currency;

				return Hook::exec('displayOrderConfirmation', $params);
			}
		}
		return false;
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
        
        public function sendOrderToOrchestra($order){
            $client = new SoapClient("http://www.orchestra-cloud.com:20000/WEBSERVICE_WEB/awws/WebService.awws?wsdl",  array(
                //’proxy_host’=>’http://monproxy.net’, // si vous utilisez un proxy…
                //’proxy_port’=>8080, // si vous utilisez un proxy…  
                "trace"=> 1,
                "soap_version"=> SOAP_1_1
               ) 
             );
            
//            $dom = new DomDocument();
//            
//            $xml = $dom->saveXML();
              $xml = '<?xml version="1.0" encoding="UTF-8" ?>';
              $xml .='  <commande>';
              $xml .='      <entete>';
              $xml .='          <code_commande>'.$this->id_order.'</code_commande>';
              $xml .='          <date_heure_creation_commande>2015-06-09T11:26:44</date_heure_creation_commande>';
              $xml .='          <date_livraison_desiree>2015-06-09T11:26:44</date_livraison_desiree>';
              $xml .='          <date_heure_livraison_desiree>2015-06-09T11:26:44</date_heure_livraison_desiree>';
              $xml .='          <systeme_emetteur_commande>TAOMA</systeme_emetteur_commande>';
              $xml .='          <systeme_recepteur_commande>TRINQUE FOUGASSE</systeme_recepteur_commande>';
              $xml .='          <observation>Bonjour ceci est ma première commande passée sur votre site :)</observation>';
              $xml .='      </entete>';
              $xml .='      <client>';
              $xml .='          <civilite_client></civilite_client>';
              $xml .='          <prenom_client>David</prenom_client>';
              $xml .='          <nom_client>Coumans</nom_client>';
              $xml .='          <telephone_client>0466531589</telephone_client>';
              $xml .='      </client>';
              $xml .='      <adresse_livraison>';
              $xml .='          <nom_societe></nom_societe>';
              $xml .='          <adresse1>147 rue du Cantonnat</adresse1>';
              $xml .='          <adresse2></adresse2>';
              $xml .='          <adresse3></adresse3>';
              $xml .='          <code_postal>30670</code_postal>';
              $xml .='          <ville>Aigues-Vives</ville>';
              $xml .='          <pays>France</pays>';
              $xml .='      </adresse_livraison>';
              $xml .='      <panier>';
              $products = $order->getProducts();
                foreach ($products as &$product)
        	{
                  $xml .='          <ligne_panier>';
                  $xml .='              <quantite>'.$product['product_quantity'].'</quantite>';
                  $xml .='              <code_plat>'.$product['reference'].'</code_plat>';
                  $xml .='              <nom_plat>'.$product['description_short'].'</prix_plat>';  
                  $xml .='              <nom_plat>'.$product['product_price'].'</prix_plat>';
                  $xml .='              <nom_plat>'.$product['product_price'].'</prix_plat>';
                  $xml .='          </ligne_panier>';
                }
              $xml .='   </commande>';
             try {

                 // Appel de la fonction getHelloWorld sans paramètres
                $retour_ws =  $client->CmdeAjouter(array('psFlux'=>$xml));    
//                echo retour_ws;
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

