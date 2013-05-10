<?php /* Smarty version Smarty-3.1.13, created on 2013-05-10 11:48:17
         compiled from "templates\admincp.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21298518ba1dc174156-42134564%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '822ff6db1e8a264fc31d241c0ae5450785b79bd9' => 
    array (
      0 => 'templates\\admincp.tpl',
      1 => 1368179288,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21298518ba1dc174156-42134564',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_518ba1dc1b1409_98170666',
  'variables' => 
  array (
    'categories' => 0,
    'category' => 0,
    'forum' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_518ba1dc1b1409_98170666')) {function content_518ba1dc1b1409_98170666($_smarty_tpl) {?><style>
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
                    "forums" : {}
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
        }
        
        
        
  });
</script>



<div id="tabs">
<ul class="tab">
<?php  $_smarty_tpl->tpl_vars['category'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['category']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['categories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['category']->key => $_smarty_tpl->tpl_vars['category']->value){
$_smarty_tpl->tpl_vars['category']->_loop = true;
?>
        <li><a id="a-<?php echo $_smarty_tpl->tpl_vars['category']->value['id'];?>
" href="#<?php echo $_smarty_tpl->tpl_vars['category']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['category']->value['name'];?>
</a></li>
<?php } ?>    
</ul>

<?php  $_smarty_tpl->tpl_vars['category'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['category']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['categories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['category']->key => $_smarty_tpl->tpl_vars['category']->value){
$_smarty_tpl->tpl_vars['category']->_loop = true;
?>
    <div id="<?php echo $_smarty_tpl->tpl_vars['category']->value['id'];?>
">
        <ul id="sortable-<?php echo $_smarty_tpl->tpl_vars['category']->value['id'];?>
" class="connectedSortable ui-helper-reset">
            <?php  $_smarty_tpl->tpl_vars['forum'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['forum']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['category']->value['forums']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['forum']->key => $_smarty_tpl->tpl_vars['forum']->value){
$_smarty_tpl->tpl_vars['forum']->_loop = true;
?>
                <li id="<?php echo $_smarty_tpl->tpl_vars['forum']->value['id'];?>
" class="ui-state-default"><?php echo $_smarty_tpl->tpl_vars['forum']->value['name'];?>
</li>
            <?php } ?>
        </ul>
    </div>
<?php } ?>   
<button id="saveordering">Opslaan</button>
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
    <?php  $_smarty_tpl->tpl_vars['category'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['category']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['categories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['category']->key => $_smarty_tpl->tpl_vars['category']->value){
$_smarty_tpl->tpl_vars['category']->_loop = true;
?>
        <option value="<?php echo $_smarty_tpl->tpl_vars['category']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['category']->value['name'];?>
</option>
    <?php } ?>
</select>
</div>
<label for="newname">Titel:</label>
<input type="text" name="newname" id="newname"></input>
<br />
<button id="addnew">Toevoegen</button>
</div><?php }} ?>