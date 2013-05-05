<?php /* Smarty version Smarty-3.1.13, created on 2013-05-05 03:26:10
         compiled from "templates\registerform.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17464517000251bf713-67919233%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5fad1d510903f1b09b5cbfcd81d8f00437a465cb' => 
    array (
      0 => 'templates\\registerform.tpl',
      1 => 1367717169,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17464517000251bf713-67919233',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_51700025255b20_35577761',
  'variables' => 
  array (
    'recaptcha' => 1,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51700025255b20_35577761')) {function content_51700025255b20_35577761($_smarty_tpl) {?><script>
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

    function validateCaptcha() {
        challengeField = $("input#recaptcha_challenge_field").val();
        responseField = $("input#recaptcha_response_field").val();
        var html = $.ajax({
            type: "POST",
            url: "ajax/validaterecaptcha.php",
            data: "recaptcha_challenge_field=" + challengeField + "&recaptcha_response_field=" + responseField,
            async: false
        }).responseText;

        if(html == "success") {
            $("#captchaStatus").html(" ");
            return true;
        }
        else {
            $("#captchaStatus").html("Je hebt de CAPTCHA niet juist ingevuld.");
            Recaptcha.reload();
            return false;
        }
    }  
</script>

<form name="register" id="regform" method="post" action="register.php"  >
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
        <br /><br />
        
        
            <?php echo $_smarty_tpl->tpl_vars['recaptcha']->value;?>

        
        
        <br />
        <input id="submitbutton" type="submit" value="Registreer!" />
    </fieldset>
</form><?php }} ?>