
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
                password: "Gelieve een wachtwoord in te vullen."
            }

        });
    });
</script>

<a href="register.php"><img src="images/button_registreer.gif" alt="Nieuw" onmouseover="this.src='images/button_registreer_hover.gif'" onmouseout="this.src='images/button_registreer.gif'" /></a>
<br /><br />  

<form name="login" id="loginform" method="post" action="login.php" >
    <fieldset>
        <legend>Inloggen</legend>
        <input type="hidden" id="loginform" name="loginform" value="true" />

        <label for="username">Gebruikersnaam:</label>
        <input type="text" id="username" name="username" id="username" />
        <br />
        <label for="password1">Wachtwoord:</label>
        <input type="password" id="password" name="password" id="password" />
        <br />
        <input id="submitbutton" type="submit" value="Log in!" />
    </fieldset>
</form>