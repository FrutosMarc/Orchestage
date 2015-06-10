<?php /*%%SmartyHeaderCode:202905577f0f3664c18-31625173%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '465d4e8b3bb871ad1950779f92d6c63e2f1939d1' => 
    array (
      0 => 'D:\\Site\\www\\presta\\themes\\default-bootstrap\\modules\\blockstore\\blockstore.tpl',
      1 => 1425636560,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '202905577f0f3664c18-31625173',
  'variables' => 
  array (
    'link' => 0,
    'module_dir' => 0,
    'store_img' => 0,
    'store_text' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5577f0f378dd14_62832480',
  'cache_lifetime' => 31536000,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5577f0f378dd14_62832480')) {function content_5577f0f378dd14_62832480($_smarty_tpl) {?>
<!-- Block stores module -->
<div id="stores_block_left" class="block">
	<p class="title_block">
		<a href="http://presta.local/index.php?controller=stores" title="Nos magasins">
			Nos magasins
		</a>
	</p>
	<div class="block_content blockstore">
		<p class="store_image">
			<a href="http://presta.local/index.php?controller=stores" title="Nos magasins">
				<img class="img-responsive" src="http://presta.local/modules/blockstore/store.jpg" alt="Nos magasins" />
			</a>
		</p>
				<div>
			<a 
			class="btn btn-default button button-small" 
			href="http://presta.local/index.php?controller=stores" 
			title="Nos magasins">
				<span>Découvrez nos magasins<i class="icon-chevron-right right"></i></span>
			</a>
		</div>
	</div>
</div>
<!-- /Block stores module -->
<?php }} ?>
