<?php /* Smarty version Smarty-3.1.13, created on 2013-04-16 17:37:57
         compiled from "templates\newpost.tpl" */ ?>
<?php /*%%SmartyHeaderCode:32074516d66b6465071-13361546%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a220fa7e23f9f74e88748a9ae6458ea952835a12' => 
    array (
      0 => 'templates\\newpost.tpl',
      1 => 1366125952,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '32074516d66b6465071-13361546',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_516d66b64adbe3_99209654',
  'variables' => 
  array (
    'topicId' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_516d66b64adbe3_99209654')) {function content_516d66b64adbe3_99209654($_smarty_tpl) {?><script src="js/jquery/jquery-1.9.1.js"></script>
<script src="js/jquery/jquery.validate.js"></script>
<script src="js/jquery/jquery-ui.1.10.2.custom.js"></script>
<script>
    $(document).ready(function() {
        $("#postform").validate({
            rules: {
                post: {
                    required: true
                }
            },
            messages: {
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
       <input type="hidden" name="newpost" value="true" />
       <input type="hidden" name="topicid" value="<?php echo $_smarty_tpl->tpl_vars['topicId']->value;?>
" />

       <textarea id="post" name="post" rows="10" cols="60"></textarea>
       <br /><br />

       <input id="postbutton" type="submit" value="Post!" />
   </fieldset>
</form><?php }} ?>