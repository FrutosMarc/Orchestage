<?php /* Smarty version Smarty-3.1.19, created on 2015-06-10 17:12:19
         compiled from "D:\Site\www\presta\admin701yqpig2\themes\default\template\helpers\list\list_action_default.tpl" */ ?>
<?php /*%%SmartyHeaderCode:28185557853d3e4b759-77574146%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4f14ca143212c1ec9500c9f50ea5456756e5f54e' => 
    array (
      0 => 'D:\\Site\\www\\presta\\admin701yqpig2\\themes\\default\\template\\helpers\\list\\list_action_default.tpl',
      1 => 1425636560,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28185557853d3e4b759-77574146',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'href' => 0,
    'action' => 0,
    'name' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_557853d3ed6ca7_14005904',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_557853d3ed6ca7_14005904')) {function content_557853d3ed6ca7_14005904($_smarty_tpl) {?>
<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['href']->value, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
"<?php if (isset($_smarty_tpl->tpl_vars['name']->value)) {?> name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['name']->value, ENT_QUOTES, 'UTF-8', true);?>
"<?php }?> class="default">
	<i class="icon-asterisk"></i> <?php echo $_smarty_tpl->tpl_vars['action']->value;?>

</a><?php }} ?>
