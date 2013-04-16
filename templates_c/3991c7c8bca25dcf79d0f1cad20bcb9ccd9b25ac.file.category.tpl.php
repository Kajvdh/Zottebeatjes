<?php /* Smarty version Smarty-3.1.13, created on 2013-04-16 08:18:25
         compiled from "templates\category.tpl" */ ?>
<?php /*%%SmartyHeaderCode:604516ced1e668c80-04753214%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3991c7c8bca25dcf79d0f1cad20bcb9ccd9b25ac' => 
    array (
      0 => 'templates\\category.tpl',
      1 => 1366093101,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '604516ced1e668c80-04753214',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_516ced1e6ddea1_86708856',
  'variables' => 
  array (
    'forums' => 0,
    'forum' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_516ced1e6ddea1_86708856')) {function content_516ced1e6ddea1_86708856($_smarty_tpl) {?><ul>
    <?php  $_smarty_tpl->tpl_vars['forum'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['forum']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['forums']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['forum']->key => $_smarty_tpl->tpl_vars['forum']->value){
$_smarty_tpl->tpl_vars['forum']->_loop = true;
?>
        <li><a href="?f=<?php echo $_smarty_tpl->tpl_vars['forum']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['forum']->value['name'];?>
</a></li>
    <?php } ?>
</ul><?php }} ?>