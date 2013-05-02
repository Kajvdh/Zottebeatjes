<?php /* Smarty version Smarty-3.1.13, created on 2013-05-02 19:58:34
         compiled from "templates\forum.tpl" */ ?>
<?php /*%%SmartyHeaderCode:26141516ffe5c8fe495-14684507%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9c4144689beb60ceda5eeb548f06e28d06944a3f' => 
    array (
      0 => 'templates\\forum.tpl',
      1 => 1366902821,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '26141516ffe5c8fe495-14684507',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_516ffe5c96b703_34133769',
  'variables' => 
  array (
    'login' => 0,
    'forumId' => 0,
    'topics' => 0,
    'topic' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_516ffe5c96b703_34133769')) {function content_516ffe5c96b703_34133769($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['login']->value)){?>
    <a href="post.php?f=<?php echo $_smarty_tpl->tpl_vars['forumId']->value;?>
"><img src="images/button_nieuw.gif" alt="Nieuw" onmouseover="this.src='images/button_nieuw_hover.gif'" onmouseout="this.src='images/button_nieuw.gif'" /></a>
<br /><br />
<?php }?>
<ul>
<?php  $_smarty_tpl->tpl_vars['topic'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['topic']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['topics']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['topic']->key => $_smarty_tpl->tpl_vars['topic']->value){
$_smarty_tpl->tpl_vars['topic']->_loop = true;
?>
    <li><a href="?t=<?php echo $_smarty_tpl->tpl_vars['topic']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['topic']->value['title'];?>
</a></li><br />
<?php } ?>
</ul><?php }} ?>