<html>
<head>
</head>
<body>

<?php
include_once("kit/SSUtil.php");
if(isset($_GET["SLIDEID"]))
{
    $id = $_GET["SLIDEID"];
    $util = new SSUtil();
    $info = $util->get_slideInfo($id);

    $embed = $info["EMBEDCODE"];
    //$embed = '<div style="width:425px;text-align:left"><a style="font:14px Helvetica,Arial,Sans-serif;display:block;margin:12px 0 3px 0;text-decoration:underline;" href="http://www.slideshare.net/zealion/title-1930318" title="title">title</a><object style="margin:0px" width="425" height="355"><param name="movie" value="http://static.slidesharecdn.com/swf/ssplayer2.swf?doc=title4485&stripped_title=title-1930318" /><param name="allowFullScreen" value="true"/><param name="allowScriptAccess" value="always"/><embed src="http://static.slidesharecdn.com/swf/ssplayer2.swf?doc=title4485&stripped_title=title-1930318" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="425" height="355"></embed></object><div style="font-size:11px;font-family:tahoma,arial;height:26px;padding-top:2px;">View more presentations from <a style="text-decoration:underline;" href="http://www.slideshare.net/zealion">zealion</a>.</div></div>';
    print $embed . "<br/>";
}
?>
</div>
</body>
</html>
