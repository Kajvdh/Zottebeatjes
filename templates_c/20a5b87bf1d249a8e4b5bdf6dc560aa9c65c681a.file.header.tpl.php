<?php /* Smarty version Smarty-3.1.13, created on 2013-05-05 03:25:47
         compiled from "templates\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:21842516ffd63ded1b6-84947669%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '20a5b87bf1d249a8e4b5bdf6dc560aa9c65c681a' => 
    array (
      0 => 'templates\\header.tpl',
      1 => 1367717145,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21842516ffd63ded1b6-84947669',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_516ffd64036163_16081471',
  'variables' => 
  array (
    'login' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_516ffd64036163_16081471')) {function content_516ffd64036163_16081471($_smarty_tpl) {?><!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Zottebeatjes</title>
        <script src="js/jquery/jquery-1.9.1.js"></script>
        <script src="js/jquery/jquery.validate.js"></script>
        <script src="js/jquery/jquery.marquee.js"></script>
        <link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
        <script>
            var streaminfo;
            function getStreamData() {
                var stream_message = "";
                $.ajax({
                    type: 'POST',
                    url: '../ajax/streaminfo.php',
                    async: true,
                    dataType: 'json',
                    cache: false,
                    success: function(data) {

                        var stream_online = data['online'];
                        if (stream_online == true) {
                            var stream_currentlisteners = data['currentlisteners'][0];
                            var stream_peaklisteners = data['peaklisteners'][0];
                            var stream_songtitle = data['songtitle'][0];
                            var stream_dj = data['dj'][0];
                            var stream_streamstatus = data['streamstatus'][0];
                            
                            if (stream_streamstatus == false) {
                                stream_message = "De radio is offline.";
                                $("#streaminfo").html(stream_message);
                            }
                            else {
                                stream_message = stream_dj + " draait nu " + stream_songtitle;
                                stream_message += " " + stream_currentlisteners + " (" + stream_peaklisteners + ") luisteraars.";
                            }
                        }
                        else {
                            stream_message = "De radio is offline.";
                        }
                        streaminfo = stream_message;
                    },
                });
            }
            $(document).ready( function() {
                setInterval(function() {
                    getStreamData();
                },15000)
                $('marquee').marquee()
                .bind('stop', function() {
                    $("#streaminfo").html(streaminfo);
                })
                .mouseover(function() {
                    $(this).trigger('pause');
                })
                .mouseout(function() {
                    $(this).trigger('unpause');
                })
                //Uncomment onderstaande => message balk kan verschoven worden
                //.mousemove(function (event) {
                //    if ($(this).data('drag') == true) {
                //        this.scrollLeft = $(this).data('scrollX') + ($(this).data('x') - event.clientX);
                //    }
                //})
                //.mousedown(function (event) {
                //    $(this).data('drag', true).data('x', event.clientX).data('scrollX', this.scrollLeft);
                //})
                //.mouseup(function () {
                //    $(this).data('drag', false);
                //});
            });
        </script>
        
    </head>
    <body>
    <div id="wrapper">
    <div id="header">
        <pre>
 ______     _   _       _                _   _             _          
|___  /    | | | |     | |              | | (_)           | |         
   / / ___ | |_| |_ ___| |__   ___  __ _| |_ _  ___  ___  | |__   ___ 
  / / / _ \| __| __/ _ \ '_ \ / _ \/ _` | __| |/ _ \/ __| | '_ \ / _ \
 / /_| (_) | |_| ||  __/ |_) |  __/ (_| | |_| |  __/\__ \_| |_) |  __/
/_____\___/ \__|\__\___|_.__/ \___|\__,_|\__| |\___||___(_)_.__/ \___|
                                           _/ |                       
                                          |__/                        
        </pre>
    </div>
    <div id="radioplayer">
        <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="467" height="26">
        <param name="movie" value="http://www.museter.com/ffmp3-config.swf" />
        <param name="flashvars" value="url=http://sunbow.be:8080/;&lang=nl&codec=mp3&volume=65&introurl=&autoplay=false&traking=true&jsevents=false&buffering=5&skin=http://www.museter.com/skins/eastanbul/ffmp3-eastanbul.xml&title=Zottebeatjes&welcome=Welkom" />
        <param name="wmode" value="transparent" />
        <param name="allowscriptaccess" value="always" />
        <param name="scale" value="noscale" />
        <embed src="http://www.museter.com/ffmp3-config.swf" flashvars="url=http://sunbow.be:8080/;&lang=nl&codec=mp3&volume=65&introurl=&autoplay=false&traking=true&jsevents=false&buffering=5&skin=http://www.museter.com/skins/eastanbul/ffmp3-eastanbul.xml&title=Zottebeatjes&welcome=Welkom" width="467" scale="noscale" height="26" wmode="transparent" allowscriptaccess="always" type="application/x-shockwave-flash" />
        </object>
    </div>
    <div id="streaminfobar">
        <marquee behavior="scroll" scrollamount="2" direction="left" ><div id="streaminfo">Welkom op Zottebeatjes.be!</div></marquee>
    </div>
        
        
    
        
    <div id="menubar">
    <a href="index.php"><img src="images/button_home.jpg" alt="Home" onmouseover="this.src='images/button_home_hover.jpg'" onmouseout="this.src='images/button_home.jpg'" /></a>
    <a href="board.php"><img src="images/button_board.jpg" alt="Board" onmouseover="this.src='images/button_board_hover.jpg'" onmouseout="this.src='images/button_board.jpg'" /></a>
    <a href="chat.php"><img src="images/button_chat.gif" alt="Chat" onmouseover="this.src='images/button_chat_hover.gif'" onmouseout="this.src='images/button_chat.gif'" /></a>
    
    <?php if (isset($_smarty_tpl->tpl_vars['login']->value)){?>
        <a href="usercp.php"><img src="images/button_usercp.gif" alt="User CP" onmouseover="this.src='images/button_usercp_hover.gif'" onmouseout="this.src='images/button_usercp.gif'" /></a>
        <a href="logout.php"><img src="images/button_loguit.jpg" alt="Log uit" onmouseover="this.src='images/button_loguit_hover.jpg'" onmouseout="this.src='images/button_loguit.jpg'" /></a>
        (ingelogd als <?php echo $_smarty_tpl->tpl_vars['login']->value;?>
)
    <?php }else{ ?>
        <a href="login.php"><img src="images/button_login.jpg" alt="Login" onmouseover="this.src='images/button_login_hover.jpg'" onmouseout="this.src='images/button_login.jpg'" /></a>
    <?php }?>
    
    
    </div>
    <div id="content">
        <div id="contentwrapper"><?php }} ?>