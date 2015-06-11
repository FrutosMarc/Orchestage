<?php /* Smarty version Smarty-3.1.19, created on 2015-06-12 10:51:07
         compiled from "D:\Site\www\presta\modules\cronjobs\views\templates\admin\configure.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9387557a9d7b6003b4-74023724%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4bbe4cd849ebab2bd69d14ed38b1c469a2046309' => 
    array (
      0 => 'D:\\Site\\www\\presta\\modules\\cronjobs\\views\\templates\\admin\\configure.tpl',
      1 => 1433252780,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9387557a9d7b6003b4-74023724',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'module_dir' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_557a9d7b6aa067_89427990',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_557a9d7b6aa067_89427990')) {function content_557a9d7b6aa067_89427990($_smarty_tpl) {?>

<div class="panel">
	<h3><?php echo smartyTranslate(array('s'=>'What does this module do?','mod'=>'cronjobs'),$_smarty_tpl);?>
</h3>
	<p>
		<img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['module_dir']->value, ENT_QUOTES, 'UTF-8', true);?>
/logo.png" class="pull-left" id="cronjobs-logo" />
		<?php echo smartyTranslate(array('s'=>'Originally, cron is a Unix system tool that provides time-based job scheduling: you can create many cron jobs, which are then run periodically at fixed times, dates, or intervals.','mod'=>'cronjobs'),$_smarty_tpl);?>

		<br/>
		<?php echo smartyTranslate(array('s'=>'This module provides you with a cron-like tool: you can create jobs which will call a given set of secure URLs to your PrestaShop store, thus triggering updates and other automated tasks.','mod'=>'cronjobs'),$_smarty_tpl);?>

	</p>
</div>
<?php }} ?>
