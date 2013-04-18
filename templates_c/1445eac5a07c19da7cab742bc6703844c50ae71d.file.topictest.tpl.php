<?php /* Smarty version Smarty-3.1.13, created on 2013-04-18 16:32:41
         compiled from "templates\topictest.tpl" */ ?>
<?php /*%%SmartyHeaderCode:26912516ffd641c0700-82232716%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1445eac5a07c19da7cab742bc6703844c50ae71d' => 
    array (
      0 => 'templates\\topictest.tpl',
      1 => 1366295558,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '26912516ffd641c0700-82232716',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_516ffd64343288_83207243',
  'variables' => 
  array (
    'topicId' => 0,
    'posts' => 0,
    'post' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_516ffd64343288_83207243')) {function content_516ffd64343288_83207243($_smarty_tpl) {?><a href="post.php?t=<?php echo $_smarty_tpl->tpl_vars['topicId']->value;?>
">Reageren</a>
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