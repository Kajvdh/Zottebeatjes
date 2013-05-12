
             
{foreach from=$polls item=poll} 
    <form class="webpoll" method="post">
    <h2>{$poll['question']}</h2>
    <fieldset>
    <input type="hidden" name="pollid" value="{$poll['id']}" />
    <ul>
    {foreach from=$poll['answers'] item=answer}
        <li class='poll_results'>
            <div class='result' style='width:{$answer['width']}px;'>&nbsp;{$answer['percent']}%</div>
            <label class='poll_active'>
            <input type='radio' name=answerid value="{$answer['id']}"/> 
                {$answer['content']}
            </label>
        </li>
    {/foreach}
    </ul>
    <p> Het aantal stemmen voor deze poll is: {$poll['votes']}</p>
    <a href="vote.php?newvote"><img src="images/button_stem.gif" alt="Stem" onmouseover="this.src='images/button_stem_hover.gif'" onmouseout="this.src='images/button_stem.gif'" /></a>
    </fieldset>
    </form> 
{/foreach}