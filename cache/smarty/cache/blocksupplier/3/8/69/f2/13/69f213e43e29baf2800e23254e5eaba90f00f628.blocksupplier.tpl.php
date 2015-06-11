<?php /*%%SmartyHeaderCode:29358557830b5a21c88-49765785%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '69f213e43e29baf2800e23254e5eaba90f00f628' => 
    array (
      0 => 'D:\\Site\\www\\presta\\themes\\default-bootstrap\\modules\\blocksupplier\\blocksupplier.tpl',
      1 => 1425636560,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '29358557830b5a21c88-49765785',
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_557959b9ad1fc0_42077963',
  'has_nocache_code' => false,
  'cache_lifetime' => 31536000,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_557959b9ad1fc0_42077963')) {function content_557959b9ad1fc0_42077963($_smarty_tpl) {?>
<!-- Block suppliers module -->
<div id="suppliers_block_left" class="block blocksupplier">
	<p class="title_block">
					<a href="http://presta.local/index.php?controller=supplier" title="Fournisseurs">
					Fournisseurs
					</a>
			</p>
	<div class="block_content list-block">
								<ul>
											<li class="last_item">
                					<a 
					href="http://presta.local/index.php?id_supplier=1&amp;controller=supplier" 
					title="En savoir plus sur Fashion Supplier">
				                Fashion Supplier
                					</a>
                				</li>
										</ul>
										<form action="/modules/orchestrasoft/orchestrasoft_page.php" method="get">
					<div class="form-group selector1">
						<select class="form-control" name="supplier_list">
							<option value="0">Tous les fournisseurs</option>
													<option value="http://presta.local/index.php?id_supplier=1&amp;controller=supplier">Fashion Supplier</option>
												</select>
					</div>
				</form>
						</div>
</div>
<!-- /Block suppliers module -->
<?php }} ?>
