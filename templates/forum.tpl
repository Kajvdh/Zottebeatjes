<a href="post.php?f={$forumId}">Topic aanmaken</a><br />

<ul>
{foreach from=$topics item=topic}
    <li><a href="topic.php?t={$topic['id']}">{$topic['title']}</a></li><br />
{/foreach}
</ul>