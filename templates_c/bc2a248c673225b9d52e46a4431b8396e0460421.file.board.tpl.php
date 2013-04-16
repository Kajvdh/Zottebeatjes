<?php /* Smarty version Smarty-3.1.13, created on 2013-04-16 08:10:39
         compiled from "templates\board.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18612516ce8dfe87953-75330724%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bc2a248c673225b9d52e46a4431b8396e0460421' => 
    array (
      0 => 'templates\\board.tpl',
      1 => 1366092637,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18612516ce8dfe87953-75330724',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_516ce8dfe893f5_42146179',
  'variables' => 
  array (
    'categories' => 0,
    'category' => 0,
    'forum' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_516ce8dfe893f5_42146179')) {function content_516ce8dfe893f5_42146179($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['category'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['category']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['categories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['category']->key => $_smarty_tpl->tpl_vars['category']->value){
$_smarty_tpl->tpl_vars['category']->_loop = true;
?>
    <hr />
    <center><b><a href="?c=<?php echo $_smarty_tpl->tpl_vars['category']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['category']->value['name'];?>
</a></b></center>
    
    <ul>
    <?php  $_smarty_tpl->tpl_vars['forum'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['forum']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['category']->value['forums']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['forum']->key => $_smarty_tpl->tpl_vars['forum']->value){
$_smarty_tpl->tpl_vars['forum']->_loop = true;
?>
        <li><a href="?f=<?php echo $_smarty_tpl->tpl_vars['forum']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['forum']->value['name'];?>
</a></li><br />
    <?php } ?>
    </ul>
    
    <hr />
<?php } ?><?php }} ?>