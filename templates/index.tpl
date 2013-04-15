<p>Dit is de titel van mijn site: {$paginaTitel}</p>

<p>Dit is het totaalbedrag: €{$totaalBedrag}</p>

<h3>Content</h3>
<p>{$content}</p>

<h3>Namen</h3>
<p>
  {foreach from=$namen item=naam}
    {$naam}
  {/foreach}
</p>