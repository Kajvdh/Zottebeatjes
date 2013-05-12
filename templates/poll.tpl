
             
{foreach from=$polls item=poll} 
    <form name="webpoll" class="webpoll" method="post" action="vote.php">
    <h2>{$poll['question']}</h2>
    <fieldset>
    <input type="hidden" name="newvote" value="1" />
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
    
    <input type="image" src="images/button_stem.gif" alt="Stem" onmouseover="this.src='images/button_stem_hover.gif'" onmouseout="this.src='images/button_stem.gif'">
    </fieldset>
    </form> 
{/foreach}