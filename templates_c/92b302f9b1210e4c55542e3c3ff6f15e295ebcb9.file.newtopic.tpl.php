<?php /* Smarty version Smarty-3.1.13, created on 2013-04-18 16:20:14
         compiled from "templates\newtopic.tpl" */ ?>
<?php /*%%SmartyHeaderCode:194735170011e48ad71-00637337%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '92b302f9b1210e4c55542e3c3ff6f15e295ebcb9' => 
    array (
      0 => 'templates\\newtopic.tpl',
      1 => 1366125960,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '194735170011e48ad71-00637337',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'forumId' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5170011e52aa48_91239266',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5170011e52aa48_91239266')) {function content_5170011e52aa48_91239266($_smarty_tpl) {?><script src="js/jquery/jquery-1.9.1.js"></script>
<script src="js/jquery/jquery.validate.js"></script>
<script src="js/jquery/jquery-ui.1.10.2.custom.js"></script>
<script>
    $(document).ready(function() {
        $("#postform").validate({
            rules: {
                topicname: {
                    required: true
                },
                post: {
                    required: true
                }
            },
            messages: {
                topicname: {
                    required: "Gelieve een Topic naam in te vullen.",
                },
                post: {
                    required: "Gelieve een eerste post aan te maken in de nieuwe topic, waar u mogelijk informatie geeft over de topic.",
                }
            }

        });
    });
</script>
<script>
    $(function() {
        $( "#post" ).resizable({
                handles: "se"
        });
    });
</script>



<form name="TopicMake" id="postform" method="post" action="post.php" >
   <fieldset>
       <legend>Topic aanmaken</legend>
       <input type="hidden" name="newtopic" value="true" />
       <input type="hidden" name="forumid" value="<?php echo $_smarty_tpl->tpl_vars['forumId']->value;?>
" />

       <label for="topicname">Topic titel:</label>
       <input type="text" id="topicname" name="topicname" />
       <br /><br />

       <textarea id="post" name="post" rows="10" cols="60"></textarea>
       <br /><br />

       <input id="postbutton" type="submit" value="Post!" />
   </fieldset>
</form><?php }} ?>