<?php /* Smarty version Smarty-3.1.13, created on 2013-05-12 11:03:25
         compiled from "templates\poll.tpl" */ ?>
<?php /*%%SmartyHeaderCode:32104518ba13def1880-20834182%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f37fcefe93581944deb18121e532081cbd0a6da5' => 
    array (
      0 => 'templates\\poll.tpl',
      1 => 1368349175,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '32104518ba13def1880-20834182',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_518ba13e095364_18798649',
  'variables' => 
  array (
    'polls' => 0,
    'poll' => 0,
    'answer' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_518ba13e095364_18798649')) {function content_518ba13e095364_18798649($_smarty_tpl) {?>
             
<?php  $_smarty_tpl->tpl_vars['poll'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['poll']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['polls']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['poll']->key => $_smarty_tpl->tpl_vars['poll']->value){
$_smarty_tpl->tpl_vars['poll']->_loop = true;
?> 
    <form name="webpoll" class="webpoll" method="post" action="vote.php">
    <h2><?php echo $_smarty_tpl->tpl_vars['poll']->value['question'];?>
</h2>
    <fieldset>
    <input type="hidden" name="pollid" value="<?php echo $_smarty_tpl->tpl_vars['poll']->value['id'];?>
" />
    <ul>
    <?php  $_smarty_tpl->tpl_vars['answer'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['answer']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['poll']->value['answers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['answer']->key => $_smarty_tpl->tpl_vars['answer']->value){
$_smarty_tpl->tpl_vars['answer']->_loop = true;
?>
        <li class='poll_results'>
            <div class='result' style='width:<?php echo $_smarty_tpl->tpl_vars['answer']->value['width'];?>
px;'>&nbsp;<?php echo $_smarty_tpl->tpl_vars['answer']->value['percent'];?>
%</div>
            <label class='poll_active'>
            <input type='radio' name=answerid value="<?php echo $_smarty_tpl->tpl_vars['answer']->value['id'];?>
"/> 
                <?php echo $_smarty_tpl->tpl_vars['answer']->value['content'];?>

            </label>
        </li>
    <?php } ?>
    </ul>
    <p> Het aantal stemmen voor deze poll is: <?php echo $_smarty_tpl->tpl_vars['poll']->value['votes'];?>
</p>
    
    <input type="image" src="images/button_stem.gif" alt="Stem" onmouseover="this.src='images/button_stem_hover.gif'" onmouseout="this.src='images/button_stem.gif'">
    </fieldset>
    </form> 
<?php } ?><?php }} ?>