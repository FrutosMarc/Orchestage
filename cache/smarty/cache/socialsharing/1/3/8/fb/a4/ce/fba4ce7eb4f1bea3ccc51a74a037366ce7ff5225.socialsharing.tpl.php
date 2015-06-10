<?php /*%%SmartyHeaderCode:190535577f0fdd00c49-31499026%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fba4ce7eb4f1bea3ccc51a74a037366ce7ff5225' => 
    array (
      0 => 'D:\\Site\\www\\presta\\modules\\socialsharing\\views\\templates\\hook\\socialsharing.tpl',
      1 => 1433254681,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '190535577f0fdd00c49-31499026',
  'variables' => 
  array (
    'PS_SC_TWITTER' => 0,
    'PS_SC_FACEBOOK' => 0,
    'PS_SC_GOOGLE' => 0,
    'PS_SC_PINTEREST' => 0,
    'module_dir' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5577f0fde3ffa0_92047390',
  'cache_lifetime' => 31536000,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5577f0fde3ffa0_92047390')) {function content_5577f0fde3ffa0_92047390($_smarty_tpl) {?>
	<p class="socialsharing_product list-inline no-print">
					<button data-type="twitter" type="button" class="btn btn-default btn-twitter social-sharing">
				<i class="icon-twitter"></i> Tweet
				<!-- <img src="http://presta.local/modules/socialsharing/img/twitter.gif" alt="Tweet" /> -->
			</button>
							<button data-type="facebook" type="button" class="btn btn-default btn-facebook social-sharing">
				<i class="icon-facebook"></i> Partager
				<!-- <img src="http://presta.local/modules/socialsharing/img/facebook.gif" alt="Facebook Like" /> -->
			</button>
							<button data-type="google-plus" type="button" class="btn btn-default btn-google-plus social-sharing">
				<i class="icon-google-plus"></i> Google+
				<!-- <img src="http://presta.local/modules/socialsharing/img/google.gif" alt="Google Plus" /> -->
			</button>
							<button data-type="pinterest" type="button" class="btn btn-default btn-pinterest social-sharing">
				<i class="icon-pinterest"></i> Pinterest
				<!-- <img src="http://presta.local/modules/socialsharing/img/pinterest.gif" alt="Pinterest" /> -->
			</button>
			</p>
<?php }} ?>
