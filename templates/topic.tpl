{if isset($login)}
    <a href="post.php?t={$topicId}"><img src="images/button_reageer.gif" alt="Reageer" onmouseover="this.src='images/button_reageer_hover.gif'" onmouseout="this.src='images/button_reageer.gif'" /></a>
<br /><br />
{/if}


{foreach from=$posts item=post}
    <div id="postwrapper">
        <div class="posterinfo">
        <b>{$post['author']}</b><br />
        {if isset($post['author_avatar'])}
            {nocache}
            <img src="{$post['author_avatar']}" alt="avatar" />
            {/nocache}
        {/if}
        
        {if isset($post['author_posts'])}
            <br />
            {$post['author_posts']}
        {/if}
        </div>
        
        <div class="postcontent">
            {$post['content']}
        </div>
        
        
        {if isset($post['author_signature'])}
            <div class="postersignature">
            <i>{$post['author_signature']}</i>
            </div>
        {/if}
        
    </div>
    <hr />
{/foreach}