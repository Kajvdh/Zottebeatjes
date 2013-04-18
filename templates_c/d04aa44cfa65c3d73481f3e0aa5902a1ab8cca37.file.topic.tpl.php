<?php /* Smarty version Smarty-3.1.13, created on 2013-04-18 16:48:50
         compiled from "templates\topic.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19962517005536b5c85-36726887%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd04aa44cfa65c3d73481f3e0aa5902a1ab8cca37' => 
    array (
      0 => 'templates\\topic.tpl',
      1 => 1366296529,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19962517005536b5c85-36726887',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51700553780802_05938094',
  'variables' => 
  array (
    'topicId' => 0,
    'posts' => 0,
    'post' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51700553780802_05938094')) {function content_51700553780802_05938094($_smarty_tpl) {?><a href="post.php?t=<?php echo $_smarty_tpl->tpl_vars['topicId']->value;?>
"><img src="images/button_reageer.gif" alt="Reageer" onmouseover="this.src='images/button_reageer_hover.gif'" onmouseout="this.src='images/button_reageer.gif'" /></a>
<br /><br />   


<?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['post']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['posts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['post']->key => $_smarty_tpl->tpl_vars['post']->value){
$_smarty_tpl->tpl_vars['post']->_loop = true;
?>
    <div id="postwrapper">
        <div class="posterinfo">
        <b><?php echo $_smarty_tpl->tpl_vars['post']->value['author'];?>
</b><br />
        <?php if (isset($_smarty_tpl->tpl_vars['post']->value['author_avatar'])){?>
            
            <img src="<?php echo $_smarty_tpl->tpl_vars['post']->value['author_avatar'];?>
" alt="avatar" />
            
        <?php }?>
        
        <?php if (isset($_smarty_tpl->tpl_vars['post']->value['author_posts'])){?>
            <?php echo $_smarty_tpl->tpl_vars['post']->value['author_posts'];?>

        <?php }?>
        </div>
        
        <div class="postcontent">
            <?php echo $_smarty_tpl->tpl_vars['post']->value['content'];?>

        </div>
        
        
        <?php if (isset($_smarty_tpl->tpl_vars['post']->value['author_signature'])){?>
            <div class="postersignature">
            <i><?php echo $_smarty_tpl->tpl_vars['post']->value['author_signature'];?>
</i>
            </div>
        <?php }?>
        
    </div>
    <hr />
<?php } ?><?php }} ?>