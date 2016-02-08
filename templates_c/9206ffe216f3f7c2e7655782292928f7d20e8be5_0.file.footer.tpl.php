<?php /* Smarty version 3.1.27, created on 2016-02-04 14:13:42
         compiled from "templates/footer.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:160443487556b3a2e6a38ff7_07450446%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9206ffe216f3f7c2e7655782292928f7d20e8be5' => 
    array (
      0 => 'templates/footer.tpl',
      1 => 1454613220,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '160443487556b3a2e6a38ff7_07450446',
  'variables' => 
  array (
    'year' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_56b3a2e6a402c4_11330419',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_56b3a2e6a402c4_11330419')) {
function content_56b3a2e6a402c4_11330419 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '160443487556b3a2e6a38ff7_07450446';
?>
			</div>
		</div>
	</div>
</div>


   <!-- FOOTER -->
   <div id="f">
      <div class="container">
         <div class="row centered">

			&copy; <?php echo $_smarty_tpl->tpl_vars['year']->value;?>
 Aggressor Fleet

         </div><!-- row -->
      </div><!-- container -->
   </div><!-- Footer -->

  </body>
</html>
<?php }
}
?>