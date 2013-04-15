<?php /* Smarty version Smarty-3.1.13, created on 2013-04-15 18:10:17
         compiled from "templates\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:25824516c266939f6f7-83538005%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f90be83b235fb03cc225b11607032e9ddd415899' => 
    array (
      0 => 'templates\\index.tpl',
      1 => 1366042135,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '25824516c266939f6f7-83538005',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'paginaTitel' => 0,
    'totaalBedrag' => 0,
    'content' => 0,
    'namen' => 0,
    'naam' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_516c2669403bf0_68984803',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_516c2669403bf0_68984803')) {function content_516c2669403bf0_68984803($_smarty_tpl) {?><p>Dit is de titel van mijn site: <?php echo $_smarty_tpl->tpl_vars['paginaTitel']->value;?>
</p>

<p>Dit is het totaalbedrag: €<?php echo $_smarty_tpl->tpl_vars['totaalBedrag']->value;?>
</p>

<h3>Content</h3>
<p><?php echo $_smarty_tpl->tpl_vars['content']->value;?>
</p>

<h3>Namen</h3>
<p>
  <?php  $_smarty_tpl->tpl_vars['naam'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['naam']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['namen']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['naam']->key => $_smarty_tpl->tpl_vars['naam']->value){
$_smarty_tpl->tpl_vars['naam']->_loop = true;
?>
    <?php echo $_smarty_tpl->tpl_vars['naam']->value;?>

  <?php } ?>
</p><?php }} ?>