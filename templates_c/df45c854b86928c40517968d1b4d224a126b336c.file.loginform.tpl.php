<?php /* Smarty version Smarty-3.1.13, created on 2013-04-18 16:59:05
         compiled from "templates\loginform.tpl" */ ?>
<?php /*%%SmartyHeaderCode:27235516ffffc477ea6-21101721%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'df45c854b86928c40517968d1b4d224a126b336c' => 
    array (
      0 => 'templates\\loginform.tpl',
      1 => 1366297142,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '27235516ffffc477ea6-21101721',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_516ffffc5029f4_87120392',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_516ffffc5029f4_87120392')) {function content_516ffffc5029f4_87120392($_smarty_tpl) {?><script src="js/jquery/jquery-1.9.1.js"></script>
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

<a href="register.php"><img src="images/button_registreer.gif" alt="Nieuw" onmouseover="this.src='images/button_registreer_hover.gif'" onmouseout="this.src='images/button_registreer.gif'" /></a>
<br /><br />  

<form name="login" id="loginform" method="post" action="login.php" >
    <fieldset>
        <legend>Inloggen</legend>
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