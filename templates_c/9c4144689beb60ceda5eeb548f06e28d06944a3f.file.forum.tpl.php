<?php /* Smarty version Smarty-3.1.13, created on 2013-04-16 07:37:45
         compiled from "templates\forum.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9981516ce332e63615-66174793%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9c4144689beb60ceda5eeb548f06e28d06944a3f' => 
    array (
      0 => 'templates\\forum.tpl',
      1 => 1366090664,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9981516ce332e63615-66174793',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_516ce3336c0789_86910915',
  'variables' => 
  array (
    'forumId' => 0,
    'topics' => 0,
    'topic' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_516ce3336c0789_86910915')) {function content_516ce3336c0789_86910915($_smarty_tpl) {?><a href="post.php?f=<?php echo $_smarty_tpl->tpl_vars['forumId']->value;?>
">Topic aanmaken</a><br />

<ul>
<?php  $_smarty_tpl->tpl_vars['topic'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['topic']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['topics']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['topic']->key => $_smarty_tpl->tpl_vars['topic']->value){
$_smarty_tpl->tpl_vars['topic']->_loop = true;
?>
    <li><a href="topic.php?t=<?php echo $_smarty_tpl->tpl_vars['topic']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['topic']->value['title'];?>
</a></li><br />
<?php } ?>
</ul><?php }} ?>