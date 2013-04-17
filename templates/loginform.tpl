<script src="js/jquery/jquery-1.9.1.js"></script>
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
</form>