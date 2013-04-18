<?php /* Smarty version Smarty-3.1.13, created on 2013-04-18 16:04:20
         compiled from "templates\navmenu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:35516ffd640ae6e9-64355776%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f379147ddaa4c442cad183f3597f998d5155f27a' => 
    array (
      0 => 'templates\\navmenu.tpl',
      1 => 1366203246,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '35516ffd640ae6e9-64355776',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'data' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_516ffd64177377_50592250',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_516ffd64177377_50592250')) {function content_516ffd64177377_50592250($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['data']->value['category'])){?>
    <a href="board.php?c=<?php echo $_smarty_tpl->tpl_vars['data']->value['category']['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['data']->value['category']['name'];?>
</a>
    <?php if (isset($_smarty_tpl->tpl_vars['data']->value['forum'])){?>
        -> <a href="board.php?f=<?php echo $_smarty_tpl->tpl_vars['data']->value['forum']['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['data']->value['forum']['name'];?>
</a>
        
        <?php if (isset($_smarty_tpl->tpl_vars['data']->value['topic'])){?>
            -> <a href="board.php?t=<?php echo $_smarty_tpl->tpl_vars['data']->value['topic']['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['data']->value['topic']['name'];?>
</a>
        <?php }?>
    <?php }?>
<?php }?>
<br /><br /><?php }} ?>