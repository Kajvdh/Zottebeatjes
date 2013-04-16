<ul>
    {foreach from=$forums item=forum}
        <li><a href="?f={$forum['id']}">{$forum['name']}</a></li>
    {/foreach}
</ul>