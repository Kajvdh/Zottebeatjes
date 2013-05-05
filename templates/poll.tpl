{foreach from=$polls item=poll}
    <hr />
    <center><b><a href="?={$poll['id']}">{$poll['content']}</a></b></center>
    {foreach from=$answers item=answer}
                <li><a href="?={ $answer['id']}">{$answer['content']}</a></b></br>
    {/foreach}
{/foreach}
             
        