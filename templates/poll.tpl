
             
{foreach from=$polls item=poll}
    <form class="webpoll" method="post">
    <h2>{$poll['question']}</h2>
    <fieldset>
    <ul>
    {foreach from=$poll['answers'] item=answer}
        <li class='poll_results'>
            <div class='result' style='width:40px;'>&nbsp;</div>
            <label>{$answer['content']}</label>
        </li>
    {/foreach}
    </ul>
    </fieldset>
    </form> 
{/foreach}