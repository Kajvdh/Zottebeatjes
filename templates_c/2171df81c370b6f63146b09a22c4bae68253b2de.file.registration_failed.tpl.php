<?php /* Smarty version Smarty-3.1.13, created on 2013-04-16 18:28:16
         compiled from "templates\registration_failed.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5307516d7c0f9d5fa6-30705766%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2171df81c370b6f63146b09a22c4bae68253b2de' => 
    array (
      0 => 'templates\\registration_failed.tpl',
      1 => 1366129693,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5307516d7c0f9d5fa6-30705766',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_516d7c0faf4183_72980413',
  'variables' => 
  array (
    'errors' => 0,
    'error' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_516d7c0faf4183_72980413')) {function content_516d7c0faf4183_72980413($_smarty_tpl) {?><p>Het account kon niet worden geregistreerd:</p><br />

<ul>
    <?php  $_smarty_tpl->tpl_vars['error'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['error']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['errors']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['error']->key => $_smarty_tpl->tpl_vars['error']->value){
$_smarty_tpl->tpl_vars['error']->_loop = true;
?>
        <li><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</li>
    <?php } ?>
</ul>
<br />
<a href="#" onClick="history.back(-1);">Vorige</a><?php }} ?>