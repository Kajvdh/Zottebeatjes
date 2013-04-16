{foreach from=$categories item=category}
    <hr />
    <center><b><a href="?c={$category['id']}">{$category['name']}</a></b></center>
    
    <ul>
    {foreach from=$category['forums'] item=forum}
        <li><a href="?f={$forum['id']}">{$forum['name']}</a></li><br />
    {/foreach}
    </ul>
    
    <hr />
{/foreach}