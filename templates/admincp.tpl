<style>
  .connectedSortable li { margin: 0 5px 5px 5px; padding: 5px; font-size: 1.2em; width: 120px; }
  </style>
<script>
$(document).ready(function() {
        function saveOrder() {
            //Category order opslaan
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
            
            //Forum order opslaan
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
        }



        $( ".connectedSortable" ).sortable().disableSelection();
        var $tabs = $( "#tabs" ).tabs();
        $tabs.find("ul").sortable({
            stop : function(e, ui) {
                setTimeout(function() {
                    saveOrder();
                }, 1000);
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
            
            saveOrder();
            
        });
        $("select#new").on('change', function() {
        
            if (this.value == "Forum") {
                $("#choosecategory").show();
            }
            else {
                $("#choosecategory").hide();
            }
        });
        
        $("button#addnew").click(function() {
            if ($("input#newname").val().length < 1) {
                return false;
            }
            
            if ($("select#new").val() == "Forum") {
                cId = $("select#category").val();
                fName = $("input#newname").val();
                createForum(cId,fName);
            }
            else {
                cName = $("input#newname").val();
                createCategory(cName);
            }
        });
        
        function createForum(cId,fName) {
            var data = new Array(fName,cId);
            $.ajax({
                type: 'POST',
                url: "ajax/updateboardorder.php",
                dataType: 'json',
                data: {
                    "newforum":data
                },
                success: function(fId) {
                    insertForum(fName,fId,cId);
                }
            });
            $("#newname").val("");
        }
        function createCategory(cName) {
            var data = new Array(cName);
            $.ajax({
                type: 'POST',
                url: "ajax/updateboardorder.php",
                dataType: 'json',
                data: {
                    "newcategory":data
                },
                success: function(cId) {
                    insertCategory(cName,cId);
                }
            });
            $("#newname").val("");
        }
        function insertForum(fName,fId,cId) {
            var ul = $("#sortable-"+cId);
            $("<li id='"+fId+"' class='ui-state-default'>"+fName+"</li>").appendTo(ul);
        }
        function insertCategory(cName,cId) {
            
            var options = $("#category");
            $("<option value='"+cId+"'>"+cName+"</option>").appendTo(options);
    
    
            var tabs = $("#tabs").tabs();
            var ul = tabs.find("ul.tab");
            $("<div id='"+cId+"'><ul id='sortable-"+cId+"' class='connectedSortable ui-helper-reset'></ul></div>").appendTo(tabs);
            $("<li><a id='a-"+cId+"' href='#"+cId+"'>"+cName+"</a></li>").appendTo(ul);
            tabs.tabs("refresh");
            $( ".connectedSortable" ).sortable().disableSelection();
            var $tabs = $( "#tabs" ).tabs();
            $tabs.find("ul").sortable({
                stop : function(e, ui) {
                    setTimeout(function() {
                        saveOrder();
                    }, 1000);
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
        }
        
        
        
  });
</script>



<div id="tabs">
<ul class="tab">
{foreach from=$categories item=category}
        <li><a id="a-{$category['id']}" href="#{$category['id']}">{$category['name']}</a></li>
{/foreach}    
</ul>

{foreach from=$categories item=category}
    <div id="{$category['id']}">
        <ul id="sortable-{$category['id']}" class="connectedSortable ui-helper-reset">
            {foreach from=$category['forums'] item=forum}
                <li id="{$forum['id']}" class="ui-state-default">{$forum['name']}</li>
            {/foreach}
        </ul>
    </div>
{/foreach}   
</div>
<br />






<div id="rest">

<h2>Nieuw forum/categorie toevoegen:</h2>

<div id="createnew">
<label for="new">Kies:</label>
<select name="new" id="new">
        <option value="Category">Categorie</option>
        <option value="Forum" selected="selected">Forum</option>
</select>
</div>




<div id="choosecategory">
<label for="category">Categorie:</label>
<select name="category" id="category">
    {foreach from=$categories item=category}
        <option value="{$category['id']}">{$category['name']}</option>
    {/foreach}
</select>
</div>
<label for="newname">Titel:</label>
<input type="text" name="newname" id="newname"></input>
<br />
<button id="addnew">Toevoegen</button>
</div>