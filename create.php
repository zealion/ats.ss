<html>
<head></head>
<body>
<?php

if (array_key_exists('_submit_check', $_POST))
{
    echo $_POST["srcfile"];

    error_reporting(E_ALL);

    $request = 'http://www.slideshare.net/api/2/upload_slideshow';
    $username = 'zealion';
    $password = 'a8765431';
    $slideshow_title = 'title';
    $slideshow_srcfile = "@" . $_POST["srcfile"];
    $api_key = 'nEGnb3DQ';
    $ss = 'jBjhAB5G';
    $ts = time();

    $hash = sha1($ss . $ts);
    //$args = sprintf("username=%s&password=%s&slideshow_title=%s&slideshow_srcfile=%s&api_key=%s&ts=%d&hash=%s", $username, $password, $slideshow_title, $slideshow_srcfile, $api_key, $ts, $hash);
    $args = Array
        (
            'username' => $username,
            'password' => $password,
            'slideshow_title' => $slidshow_title,
            'slideshow_srcfile' => $slidesow_srcfile,
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

    echo htmlspecialchars($xml, ENT_QUOTES);
}
?>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<input name="srcfile" type="file" >
<input type="submit" value="Upload">
<input type="hidden" name="_submit_check" value="1"/>
</form>

</body>
</html>
