<?php /* Smarty version Smarty-3.1.13, created on 2013-04-16 10:55:33
         compiled from "templates\loginform.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11500516d1205cc2360-35855767%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'df45c854b86928c40517968d1b4d224a126b336c' => 
    array (
      0 => 'templates\\loginform.tpl',
      1 => 1366100639,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11500516d1205cc2360-35855767',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_516d1205d36be7_67322279',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_516d1205d36be7_67322279')) {function content_516d1205d36be7_67322279($_smarty_tpl) {?><script src="js/jquery/jquery-1.9.1.js"></script>
<script src="js/jquery/jquery.validate.js"></script>
<script>
    $(document).ready(function() {
        $("#loginform").validate({
            rules: {
                username: {
                    required: true
                },
                password: {
                    required: true
                }
            },
            messages: {
                username: "Gelieve een gebruikersnaam in te vullen.",
                password1: "Gelieve een wachtwoord in te vullen."
            }

        });
    });
</script>

<form name="login" id="loginform" method="post" action="login.php" >
    <fieldset>
        <legend>Registreren</legend>
        <input type="hidden" name="loginform" value="true" />

        <label for="username">Gebruikersnaam:</label>
        <input type="text" id="username" name="username" id="username" />
        <br />
        <label for="password1">Wachtwoord:</label>
        <input type="password" id="password" name="password" id="password" />
        <br />
        <input id="submitbutton" type="submit" value="Log in!" />
    </fieldset>
</form><?php }} ?>