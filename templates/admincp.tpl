<style>
  .connectedSortable li { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; width: 120px; }
  </style>
<script>
$(document).ready(function() {
        $( ".connectedSortable" ).sortable().disableSelection();
        var $tabs = $( "#tabs" ).tabs();
        $tabs.find("ul").sortable({
                update : function(e, ui) {
                    var csv = "";
                    var categoryOrder = new Array();
                    $("#tabs > ul > li > a").each(function(i) {
                        var cId = this.id.replace("a-","");
                        categoryOrder.push(cId)
                    });
                    $.ajax({
                        type: 'POST',
                        url: "ajax/updateboardorder.php",
                        dataType: 'json',
                        data: {
                            "categories":categoryOrder
                        },

                        success: function(data) {
                        }
                    });
                }
        });
        var $tab_items = $( "ul:first li", $tabs ).droppable({
            accept: ".connectedSortable li",
            hoverClass: "ui-state-hover",
            drop: function( event, ui ) {
                var $item = $( this );
                var $list = $( $item.find( "a" ).attr( "href" ) )
                .find( ".connectedSortable" );
 
                ui.draggable.hide( "slow", function() {
                    $tabs.tabs( "option", "active", $tab_items.index( $item ) );
                $( this ).appendTo( $list ).show( "slow" );
                });
            }
        });
        $( "#saveordering" ).button().click(function( event ) {
            event.preventDefault();
            
            var data = document.getElementById('tabs');
            var categories = data.getElementsByTagName("div");
            var categoryArray = new Array();
            
            
            for (var i=0; i < categories.length; i++) { //Loop door de categoriëen
                var category = categories[i];
                var categoryId = category.getAttribute('id');
                
                categoryArray[i] = {
                    "id" : categoryId,
                    "forums" : {ldelim}{rdelim}
                };
                
                
                var forums = category.getElementsByTagName("li");
                for (var j=0; j < forums.length; j++) { //Loop door de forums
                    var forum = forums[j];
                    var forumId = forum.getAttribute('id');
                    
                    categoryArray[i]['forums'][j] = {
                        "id" : forumId
                    }
                }
            }
             
            var senddata = window.JSON.stringify(categoryArray);
            $.ajax({
                type: 'POST',
                url: "ajax/updateboardorder.php",
                dataType: 'json',
                data: {
                    "forums":senddata
                },
                
                success: function(data) {
                }
            });
            
        });
  });
</script>



<div id="tabs">
<ul>
{foreach from=$categories item=category}
        <li><a id="a-{$category['id']}" href="#{$category['id']}">{$category['name']}</a></li>
{/foreach}    
</ul>

{foreach from=$categories item=category}
    <div id="{$category['id']}">
        <ul contenteditable="true" id="sortable-{$category['name']}" class="connectedSortable ui-helper-reset">
            {foreach from=$category['forums'] item=forum}
                <li contenteditable="true" id="{$forum['id']}" class="ui-state-default">{$forum['name']}</li>
            {/foreach}
        </ul>
    </div>
{/foreach}   

</div>
<br />




<button id="saveordering">Opslaan</button>