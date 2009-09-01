<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
</head>
<body>
<?php
include_once 'kit/SSUtil.php';

if (array_key_exists('_submit_check', $_POST))
{
    $apiobj=new SSUtil();

    error_reporting(E_ALL);

    $request = 'http://www.slideshare.net/api/2/upload_slideshow';
    $username = 'zealion';
    $password = '8765431';
    $slideshow_title = 'title';
    //$slideshow_srcfile = "@" . $_POST["srcfile"];
    
    $result = $apiobj->upload_slide(
        $username,$password,$slideshow_title,$_POST["srcfile"],
        "description","tags",true,false,false,false,false
        );

    echo sprintf('<a href="view.php?SLIDEID=%d">预览</a><br/>', $result["SLIDESHOWID"]);
    
    //$slideshow_srcfile = "@/Users/lingfei/Code/zealion/ssats/test.ppt";
    /*
    $api_key = 'nEGnb3DQ';
    $ss = 'jBjhAB5G';
    $ts = time();

    $hash = sha1($ss . $ts);
    //$args = sprintf("username=%s&password=%s&slideshow_title=%s&slideshow_srcfile=%s&api_key=%s&ts=%d&hash=%s", $username, $password, $slideshow_title, $slideshow_srcfile, $api_key, $ts, $hash);
    $args = Array
        (
            'username' => $username,
            'password' => $password,
            'slideshow_title' => $slideshow_title,
            'slideshow_srcfile' => $slideshow_srcfile,
            'api_key' => $api_key,
            'ts' => $ts,
            'hash' => $hash,
            );

    $session = curl_init($request);
    curl_setopt ($session, CURLOPT_POST, true);
    curl_setopt ($session, CURLOPT_POSTFIELDS, $args);
    curl_setopt($session, CURLOPT_HEADER, true);
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($session);
    curl_close($session);

    if (!($xml = strstr($response, '<?xml'))) {
        $xml = null;
    }

    echo $response . "<br>";
    print htmlspecialchars($xml, ENT_QUOTES);
     */
}
?>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<input name="srcfile" type="file" />
<input type="submit" value="Upload" />
<input type="hidden" name="_submit_check" value="1"/>
</form>

</body>
</html>
