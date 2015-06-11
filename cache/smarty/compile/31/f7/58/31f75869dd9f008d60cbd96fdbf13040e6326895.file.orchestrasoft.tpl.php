<?php /* Smarty version Smarty-3.1.19, created on 2015-06-11 11:40:18
         compiled from "D:\Site\www\presta\modules\orchestrasoft\orchestrasoft.tpl" */ ?>
<?php /*%%SmartyHeaderCode:25334557949cf5e16f8-84358739%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '31f75869dd9f008d60cbd96fdbf13040e6326895' => 
    array (
      0 => 'D:\\Site\\www\\presta\\modules\\orchestrasoft\\orchestrasoft.tpl',
      1 => 1434015583,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '25334557949cf5e16f8-84358739',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_557949cf650192_02637300',
  'variables' => 
  array (
    'base_dir' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_557949cf650192_02637300')) {function content_557949cf650192_02637300($_smarty_tpl) {?><!-- Block mymodule -->
<div id="mymodule_block_left" class="block">
  <h4><?php echo smartyTranslate(array('s'=>'Welcome!','mod'=>'orchestrasoft'),$_smarty_tpl);?>
</h4>
  <div class="block_content">
    <ul>
      <li><a href="<?php echo $_smarty_tpl->tpl_vars['base_dir']->value;?>
modules/orchestrasoft/orchestrasoft_page.php" title="<?php echo smartyTranslate(array('s'=>'Click this link','mod'=>'orchestrasoft'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Click me!','mod'=>'orchestrasoft'),$_smarty_tpl);?>
</a></li>
    </ul>
  </div>
</div>
<!-- /Block mymodule --><?php }} ?>
