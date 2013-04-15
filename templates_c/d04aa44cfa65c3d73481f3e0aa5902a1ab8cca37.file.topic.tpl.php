<?php /* Smarty version Smarty-3.1.13, created on 2013-04-15 18:41:36
         compiled from "templates\topic.tpl" */ ?>
<?php /*%%SmartyHeaderCode:25497516c2c0d7dcd25-78173348%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd04aa44cfa65c3d73481f3e0aa5902a1ab8cca37' => 
    array (
      0 => 'templates\\topic.tpl',
      1 => 1366044095,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '25497516c2c0d7dcd25-78173348',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_516c2c0d820093_75389565',
  'variables' => 
  array (
    'posts' => 0,
    'post' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_516c2c0d820093_75389565')) {function content_516c2c0d820093_75389565($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['post']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['posts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['post']->key => $_smarty_tpl->tpl_vars['post']->value){
$_smarty_tpl->tpl_vars['post']->_loop = true;
?>
	<hr />
	<p><i>#<?php echo $_smarty_tpl->tpl_vars['post']->value['id'];?>
</i> door <?php echo $_smarty_tpl->tpl_vars['post']->value['author'];?>
 op <?php echo $_smarty_tpl->tpl_vars['post']->value['postdate'];?>
:<br />
	<?php echo $_smarty_tpl->tpl_vars['post']->value['content'];?>

	<hr />
<?php } ?><?php }} ?>