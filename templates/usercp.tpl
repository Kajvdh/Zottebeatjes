<h2>Avatar</h2>

{if isset($avatar)}
    Huidige avatar:<br />
    <img src="{$avatar}" alt="avatar" />
{/if}



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
        <textarea id="post" name="signature" rows="4" cols="30">{if isset($signature)}{$signature}{/if}</textarea><br />
        <input name="Submit" type="submit" id="Submit" value="Signature veranderen" />
    </fieldset>    
</form>
