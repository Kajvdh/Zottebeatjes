
             
{foreach from=$polls item=poll}
    <form class="webpoll" method="post">
    <h2>{$poll['question']}</h2>
    <fieldset>
    <ul>
    {foreach from=$poll['answers'] item=answer}
        <li class='poll_results'>
            <div class='result' style='width:{$answer['width']}px;'>&nbsp;</div>{$answer['percent']}%
            <label>{$answer['content']}</label>
        </li>
    {/foreach}
    </ul>
    <p> Het aantal stemmen voor deze poll is: {$poll['votes']}</p>
    </fieldset>
    </form> 
{/foreach}