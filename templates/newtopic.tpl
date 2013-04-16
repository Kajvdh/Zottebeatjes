<script src="js/jquery/jquery-1.9.1.js"></script>
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
       <input type="hidden" name="postform" value="true" />
       <input type="hidden" name="forumid" value="{$forumId}" />

       <label for="topicname">Topic titel:</label>
       <input type="text" id="topicname" name="topicname" />
       <br /><br />

       <textarea id="post" name="post" rows="10" cols="60"></textarea>
       <br /><br />

       <input id="postbutton" type="submit" value="Post!" />
   </fieldset>
</form>