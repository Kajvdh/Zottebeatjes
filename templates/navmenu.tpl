{if isset($data['category'])}
    <a href="board.php?c={$data['category']['id']}">{$data['category']['name']}</a>
    {if isset($data['forum'])}
        -> <a href="board.php?f={$data['forum']['id']}">{$data['forum']['name']}</a>
        
        {if isset($data['topic'])}
            -> <a href="topic.php?t={$data['topic']['id']}">{$data['topic']['name']}</a>
        {/if}
    {/if}
{/if}
<br /><br />