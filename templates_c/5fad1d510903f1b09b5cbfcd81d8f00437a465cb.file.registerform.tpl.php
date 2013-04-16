<?php /* Smarty version Smarty-3.1.13, created on 2013-04-16 08:54:17
         compiled from "templates\registerform.tpl" */ ?>
<?php /*%%SmartyHeaderCode:25323516cf5994304b9-29854263%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5fad1d510903f1b09b5cbfcd81d8f00437a465cb' => 
    array (
      0 => 'templates\\registerform.tpl',
      1 => 1366095171,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '25323516cf5994304b9-29854263',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'recaptcha' => 1,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_516cf5994ce3d5_97906825',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_516cf5994ce3d5_97906825')) {function content_516cf5994ce3d5_97906825($_smarty_tpl) {?><script src="js/jquery/jquery-1.9.1.js"></script>
<script src="js/jquery/jquery.validate.js"></script>
<script>
    $(document).ready(function() {
        $("#regform").validate({
            rules: {
                username: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                password1: {
                    required: true,
                    minlength: 8
                },
                password2: {
                    required: true,
                    minlength: 8,
                    equalTo: "#password1"
                }
            },
            messages: {
                username: {
                    required: "Gelieve een gebruikersnaam in te vullen.",
                    minlength: "Een gebruikersnaam moet minstens 3 tekens bevatten."
                },
                email: "Gelieve een geldig e-mailadres in te vullen.",
                password1: {
                    required: "Gelieve een wachtwoord in te vullen.",
                    minlength: "Een wachtwoord moet minstens 8 tekens bevatten.",
                },
                password2: {
                    required: "Gelieve een wachtwoord in te vullen.",
                    minlength: "Een wachtwoord moet minstens 8 tekens bevatten.",
                    equalTo: "De twee opgegeven wachtwoorden komen niet overeen."
                }
            }

        });
    });
</script>

<form name="register" id="regform" method="post" action="register.php" >
    <fieldset>
        <legend>Registreren</legend>
        <input type="hidden" name="regform" value="true" />

        <label for="username">Gebruikersnaam:</label>
        <input type="text" id="username" name="username" id="username" />
        <br />
        <label for="email">Emailadres:</label>
        <input type="text" id="email" name="email" id="email" />
        <br />
        <label for="password1">Wachtwoord:</label>
        <input type="password" id="password1" name="password1" id="password1" />
        <br />
        <label for="password2">Wachtwoord (nogmaals):</label>
        <input type="password" id="password2" name="password2" id="password2" />
        <br />
        
        
            <?php echo $_smarty_tpl->tpl_vars['recaptcha']->value;?>

        
        
        <input id="submitbutton" type="submit" value="Registreer!" />
    </fieldset>
</form><?php }} ?>