<?php /* Smarty version Smarty-3.1.13, created on 2013-04-16 11:27:44
         compiled from "templates\navmenu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24300516d184c8c00f4-74405002%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f379147ddaa4c442cad183f3597f998d5155f27a' => 
    array (
      0 => 'templates\\navmenu.tpl',
      1 => 1366104462,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24300516d184c8c00f4-74405002',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_516d184c948bb1_74053386',
  'variables' => 
  array (
    'data' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_516d184c948bb1_74053386')) {function content_516d184c948bb1_74053386($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['data']->value['category'])){?>
    <a href="board.php?c=<?php echo $_smarty_tpl->tpl_vars['data']->value['category']['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['data']->value['category']['name'];?>
</a>
    <?php if (isset($_smarty_tpl->tpl_vars['data']->value['forum'])){?>
        -> <a href="board.php?f=<?php echo $_smarty_tpl->tpl_vars['data']->value['forum']['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['data']->value['forum']['name'];?>
</a>
        
        <?php if (isset($_smarty_tpl->tpl_vars['data']->value['topic'])){?>
            -> <a href="topic.php?t=<?php echo $_smarty_tpl->tpl_vars['data']->value['topic']['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['data']->value['topic']['name'];?>
</a>
        <?php }?>
    <?php }?>
<?php }?>
<br /><br /><?php }} ?>