<p>Het account kon niet worden geregistreerd:</p><br />

<ul>
    {foreach from=$errors post=error}
        <li>{$error}</li>
    {/foreach}
</ul>
<br />
<a href="#" onClick="history.back();">Vorige</a>