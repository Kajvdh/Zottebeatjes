<?php /* Smarty version Smarty-3.1.13, created on 2013-04-17 13:39:05
         compiled from "templates\error.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12124516e89b1c64e61-88068300%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cf9f9b9355e452982852be7006ceb40f64668a6a' => 
    array (
      0 => 'templates\\error.tpl',
      1 => 1366198744,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12124516e89b1c64e61-88068300',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_516e89b1c69598_23754253',
  'variables' => 
  array (
    'errors' => 0,
    'error' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_516e89b1c69598_23754253')) {function content_516e89b1c69598_23754253($_smarty_tpl) {?><ul>
<?php  $_smarty_tpl->tpl_vars['error'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['error']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['errors']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['error']->key => $_smarty_tpl->tpl_vars['error']->value){
$_smarty_tpl->tpl_vars['error']->_loop = true;
?>
    <li><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</li>
<?php } ?>
</ul><?php }} ?>