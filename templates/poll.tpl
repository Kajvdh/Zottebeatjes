
             
{foreach from=$polls item=poll}
    <h2>{$poll['question']}</h2>
    <ul>
    {foreach from=$poll['answers'] item=answer}
        <li><a href="?pid={$poll['id']}&aid={$answer['id']}">{$answer['content']}</a></li>
    {/foreach}
    </ul>
{/foreach}