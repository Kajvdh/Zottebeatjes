<a href="post.php?f={$forumId}"><img src="images/button_nieuw.gif" alt="Nieuw" onmouseover="this.src='images/button_nieuw_hover.gif'" onmouseout="this.src='images/button_nieuw.gif'" /></a>
<br /><br />   

<ul>
{foreach from=$topics item=topic}
    <li><a href="?t={$topic['id']}">{$topic['title']}</a></li><br />
{/foreach}
</ul>