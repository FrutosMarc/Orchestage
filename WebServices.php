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
    // Appel de la fonction getHelloWorld sans paramètres
    $retour_ws =  $client -> __call("CmdeExportCarte",array(""));    
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
