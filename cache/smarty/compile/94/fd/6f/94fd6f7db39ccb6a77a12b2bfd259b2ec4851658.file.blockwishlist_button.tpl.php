<?php /* Smarty version Smarty-3.1.19, created on 2015-06-10 10:10:32
         compiled from "D:\Site\www\presta\themes\default-bootstrap\modules\blockwishlist\blockwishlist_button.tpl" */ ?>
<?php /*%%SmartyHeaderCode:311685577f0f862a3d3-95102884%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '94fd6f7db39ccb6a77a12b2bfd259b2ec4851658' => 
    array (
      0 => 'D:\\Site\\www\\presta\\themes\\default-bootstrap\\modules\\blockwishlist\\blockwishlist_button.tpl',
      1 => 1425636560,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '311685577f0f862a3d3-95102884',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'product' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5577f0f867b5e8_82113429',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5577f0f867b5e8_82113429')) {function content_5577f0f867b5e8_82113429($_smarty_tpl) {?>

<div class="wishlist">
	<a class="addToWishlist wishlistProd_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
" href="#" rel="<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
" onclick="WishlistCart('wishlist_block_list', 'add', '<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
', false, 1); return false;">
		<?php echo smartyTranslate(array('s'=>"Add to Wishlist",'mod'=>'blockwishlist'),$_smarty_tpl);?>

	</a>
</div><?php }} ?>
