<p>Het account kon niet worden geregistreerd:</p><br />

<ul>
    {foreach from=$errors item=error}
        <li>{$error}</li>
    {/foreach}
</ul>
<br />
<a href="#" onClick="history.back(-1);">Vorige</a>