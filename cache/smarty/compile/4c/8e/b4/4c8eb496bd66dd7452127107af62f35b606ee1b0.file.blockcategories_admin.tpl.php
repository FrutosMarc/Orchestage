<?php /* Smarty version Smarty-3.1.19, created on 2015-06-15 15:02:52
         compiled from "D:\Site\www\presta\modules\blockcategories\views\blockcategories_admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28931557eccfc637d60-09913086%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4c8eb496bd66dd7452127107af62f35b606ee1b0' => 
    array (
      0 => 'D:\\Site\\www\\presta\\modules\\blockcategories\\views\\blockcategories_admin.tpl',
      1 => 1433254669,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28931557eccfc637d60-09913086',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'helper' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_557eccfc663a05_73315019',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_557eccfc663a05_73315019')) {function content_557eccfc663a05_73315019($_smarty_tpl) {?>
<div class="form-group">
	<label class="control-label col-lg-3">
		<span class="label-tooltip" data-toggle="tooltip" data-html="true" title="" data-original-title="<?php echo smartyTranslate(array('s'=>'You can upload a maximum of 3 images.','mod'=>'blockcategories'),$_smarty_tpl);?>
">
			<?php echo smartyTranslate(array('s'=>'Thumbnails','mod'=>'blockcategories'),$_smarty_tpl);?>

		</span>
	</label>
	<div class="col-lg-4">
		<?php echo $_smarty_tpl->tpl_vars['helper']->value;?>

	</div>
</div>
<?php }} ?>
