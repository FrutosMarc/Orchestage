<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

global $smarty;
 
include('../../config/config.inc.php');
include('../../header.php');
 
$orchestrasoft = new orchestrasoft();
$message = $orchestrasoft->l('Welcome to my shop!');
$smarty->assign('messageSmarty', $message ); // creation of our variable

 
$smarty->display(dirname(__FILE__).'/orchestrasoft_page.tpl');
 
include('../../footer.php');