<?php /* Smarty version Smarty-3.1.13, created on 2013-04-18 17:32:11
         compiled from "templates\chat.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16073517010c0321146-92055484%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '59aecfcb0a242cca86122c8d32c226145da2e42b' => 
    array (
      0 => 'templates\\chat.tpl',
      1 => 1366299125,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16073517010c0321146-92055484',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_517010c0355776_14734623',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_517010c0355776_14734623')) {function content_517010c0355776_14734623($_smarty_tpl) {?>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
 <script type="text/javascript" src="lib/lightIRC/config.js"></script>

 <div id="lightIRC" >
  <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p>
 </div>
 
 <script type="text/javascript">
	swfobject.embedSWF("lib/lightIRC/lightIRC.swf", "lightIRC", "100%", "100%", "10.0.0", "lib/lightIRC/expressInstall.swf", params);
 </script><?php }} ?>