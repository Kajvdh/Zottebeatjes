<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Home pagina</title>
        <script src="js/jquery/jquery-1.9.1.js"></script>
        <script src="js/jquery/jquery.marquee.js"></script>
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
    <marquee behavior="scroll" scrollamount="2" direction="left" id="streaminfo" ><div id="streaminfo">Welkom op Zottebeatjes.be!</div></marquee>

    <!-- Media player -->
    <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="180" height="60" bgcolor="#FFFFFF">
    <param name="movie" value="http://www.museter.com/ffmp3-config.swf" />
    <param name="flashvars" value="url=http://sunbow.be:8000/;&lang=en&codec=mp3&volume=65&introurl=&autoplay=false&traking=true&jsevents=false&buffering=5&skin=http://www.museter.com/skins/mcclean/ffmp3-mcclean.xml&title=Zottebeatjes&welcome=WELCOME%20TO ZOTTEBEAT" />
    <param name="wmode" value="window" />
    <param name="allowscriptaccess" value="always" />
    <param name="scale" value="noscale" />
    <embed src="http://www.museter.com/ffmp3-config.swf" flashvars="url=http://sunbow.be:8000/;&lang=en&codec=mp3&volume=65&introurl=&autoplay=false&traking=true&jsevents=false&buffering=5&skin=http://www.museter.com/skins/mcclean/ffmp3-mcclean.xml&title=Zottebeatjes&welcome=WELCOME%20TO ZOTTEBEAT" width="180" scale="noscale" height="60" wmode="window" bgcolor="#FFFFFF" allowscriptaccess="always" type="application/x-shockwave-flash" />
    </object>
    <!-- Media player end -->

    <center>
    <h3>Zottebeatjes.be</h3><br />
    </center>
    <a href="index.php">Index</a> | <a href="board.php">Board</a> | <a href="stream.php">Stream</a> <br /><br />
        