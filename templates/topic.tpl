{foreach from=$posts item=post}
	<hr />
	<p><i>#{$post['id']}</i> door {$post['author']} op {$post['postdate']}:<br />
	{$post['content']}
	<hr />
{/foreach}