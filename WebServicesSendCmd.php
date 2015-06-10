<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
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
              $xml = '<?xml version="1.0" encoding="UTF-8" ?>';
              $xml .='  <commande>';
              $xml .='      <entete>';
              $xml .='          <code_commande>393</code_commande>';
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
              $xml .='          <ligne_panier>';
              $xml .='              <quantite>1</quantite>';
              $xml .='              <code_plat>71</code_plat>';
              $xml .='              <nom_plat>Coca Cola</nom_plat>';
              $xml .='              <prix_plat>2.50</prix_plat>';
              $xml .='              <niveau>1</niveau>';
              $xml .='          </ligne_panier>';
              $xml .='      </panier>';
              $xml .='  </commande>';
    // Appel de la fonction getHelloWorld sans paramètres
    $retour_ws =  $client->CmdeAjouter(array('psFlux' => $xml));
 // Affichage des requêtes et réponses SOAP (pour debug)
 echo "<br />Requete SOAP : ".htmlspecialchars($client->__getLastRequest())."<br />";
 echo "<br />Reponse SOAP : ".htmlspecialchars($client->__getLastResponse())."<br />";    
    // Affichage du résultat
    print_r($retour_ws);
}
catch (Exception $e) {
    //TODO  Traitement en cas d’exception, pour l’instant on l’affiche tel quel…
    echo $e;
}       
        ?>
    </body>
</html>
