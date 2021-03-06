<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-cn">
<title>创建新的在线共享幻灯片</title>
<style type="text/css">
body{
font-size: 0.75em;
}
.wrapper{
display: block;
width: 100%;
text-align: center;
}
#create_box{
display: block;
border: 1px solid #ccc;
width: 400px;
height: 200px;
margin-left: auto;
margin-right: auto;
text-align: center;
background: url("bg.gif") no-repeat right bottom;
}
#create_box table.form{
padding: 0;
margin: 0;
border: 0;
text-align: left;
margin-left: auto;
margin-right: auto;
}
#create_box .title{
font-size: 13px;
font-weight: bold;
display:block;
background-color: #ddd;
padding: 5px 5px;
}
#create_box .note{
padding: 5px 5px;
display: block;
}
#create_box .upload{
padding-top: 25px;
}
#create_box #result a{
padding: 5px 5px;
margin-top: 15px;
margin-left: auto;
margin-right: auto;
color: #333;
width: 75px;
font-size: 13px;
display: block;
border: 1px solid #33aa33;
background-color: #88cc88;
text-decoration: none;
}
#create_box #result a:hover{
background-color: #aaddaa;
}
#create_box .error{
color: red;
}
</style>
<script type="text/javascript">
function validate_required(field,alerttxt)
{
with (field)
  {
  if (value==null||value=="")
    {
    alert(alerttxt);return false;
    }
  else
    {
    return true;
    }
  }
}

function validate_filetype(field,alerttxt)
{
    with(field)
{
    echo value.substring(-3);
    if( value.substring(-3)=="ppt")
    {  
        return true;
    }
    else
    {
        alert(alerttxt);
        return false;
    }
}
}

function validate_form(thisform)
{
    with (thisform)
    {
        if (validate_required(slideshow_title,"名称不能为空!")==false)
        {slideshow_title.focus();return false;}
        if (validate_required(srcfile,"文件不能为空!")==false)
        {srcfile.focus();return false;}
        if (validate_filetype(srcfile,"仅支持powerpoint文件!")==false)
        {srcfile.focus();return false;}

    }
}
</script>
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
    $slideshow_title = $_POST["slideshow_title"];
    //$slideshow_srcfile = "@" . $_POST["srcfile"];
    $file_name = $_FILES["srcfile"]["tmp_name"];
    $temp_file_name = 'uploads/' . time() . ".ppt";
    //upload file
    
    if(move_uploaded_file($file_name, $temp_file_name))
    {
        //echo "upload ok<br/>";
    }
    else
    {
        //echo "upload failed<br>";
        $is_uploaded = false;
    }

    //upload to slideshare
    $result = $apiobj->upload_slide(
        $username,$password,$slideshow_title,$temp_file_name,
        "zealion","autotimes",false,false,false,true,false
        );

    if( isset( $result["SLIDESHOWID"] ))
    {
        $slideid =  $result["SLIDESHOWID"];
        unlink($temp_file_name);
    }
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
<div class="wrapper">
<div id="create_box">
    <div class="title">上传您的幻灯片</div>
<div class="note">选择ppt文件，点击上传，成功后点击预览连接获得嵌入代码。</div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="post" class="upload" onsubmit="return validate_form(this)">
<table class="form">
<tr><td>标题：</td><td><input name="slideshow_title" /></td></tr>
<tr><td>文件：</td><td><input name="srcfile" type="file" /></td></tr>
<tr><td></td><td><input type="submit" value="Upload" /></td></tr>
<input type="hidden" name="_submit_check" value="1"/>
</table>
</form>
<div class="error">
<?php if(!empty($error_msg)) echo $error_msg; ?>
</div>
<div id="result">
<?php if(isset($slideid)) echo sprintf('<a href="view.php?SLIDEID=%d">预览</a><br/>', $slideid); ?>
</div>
</div>
</div>
</body>
</html>
