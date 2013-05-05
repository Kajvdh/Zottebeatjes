<?php /* Smarty version Smarty-3.1.13, created on 2013-05-05 03:10:06
         compiled from "templates\registration_failed.tpl" */ ?>
<?php /*%%SmartyHeaderCode:67505185b16e93c223-75539278%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
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
  'nocache_hash' => '67505185b16e93c223-75539278',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'errors' => 0,
    'error' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5185b16e9ba347_79292232',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5185b16e9ba347_79292232')) {function content_5185b16e9ba347_79292232($_smarty_tpl) {?><p>Het account kon niet worden geregistreerd:</p><br />

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