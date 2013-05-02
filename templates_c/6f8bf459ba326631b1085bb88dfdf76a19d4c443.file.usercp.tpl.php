<?php /* Smarty version Smarty-3.1.13, created on 2013-05-02 20:07:12
         compiled from "templates\usercp.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3016451829c0bd47a04-15819573%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6f8bf459ba326631b1085bb88dfdf76a19d4c443' => 
    array (
      0 => 'templates\\usercp.tpl',
      1 => 1367518030,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3016451829c0bd47a04-15819573',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51829c0bd7b106_94425474',
  'variables' => 
  array (
    'avatar' => 0,
    'signature' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51829c0bd7b106_94425474')) {function content_51829c0bd7b106_94425474($_smarty_tpl) {?><h2>Avatar</h2>

<h3>Huidige avatar</h3>
<?php if (isset($_smarty_tpl->tpl_vars['avatar']->value)){?>
    Huidige avatar:<br />
    <img src="<?php echo $_smarty_tpl->tpl_vars['avatar']->value;?>
" alt="avatar" />
<?php }?>



<form action="usercp.php" method="post" enctype="multipart/form-data" name="avatarform" id="avatarform">
    <fieldset>
        <legend>Nieuwe avatar uploaden</legend>
        <input type="file" name="avatar" /><br />
        <input name="Submit" type="submit" id="Submit" value="Upload" />
    </fieldset>
</form> 

<h2>Onderschrift</h2>
<form action="usercp.php" method="post" name="signatureform" id="signatureform">
    <fieldset>
        <legend>Onderschrift instellen</legend>
        <textarea id="post" name="signature" rows="4" cols="30"><?php if (isset($_smarty_tpl->tpl_vars['signature']->value)){?><?php echo $_smarty_tpl->tpl_vars['signature']->value;?>
<?php }?></textarea><br />
        <input name="Submit" type="submit" id="Submit" value="Signature veranderen" />
    </fieldset>    
</form>
<?php }} ?>