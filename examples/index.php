<?php
session_start();
include_once('config.php');
include_once('../isdnusdk/isdnu_sdk.class.php');
?>

<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>智慧山师 PHP SDK Demo</title>
</head>
<body>
<?php
if (empty($_SESSION['access_token'])) {
?>
    <a href="authorize.php">使用智慧山师账号登录</a>
<?php
}
else {
    $request_token = $_SESSION['access_token'];
    $client = new RestClient(ISDNU_CONSUMER_KEY, ISDNU_CONSUMER_SECRET, $request_token['oauth_token'], $request_token['oauth_token_secret']);
    $userinfo = $client->user_get();
    
    if ($userinfo['errorCode']) {
        echo "获取失败，错误代码 ".$userinfo['errorCode']."<br/>";
    }
    else {
        foreach ($userinfo as $k => $v) {
            echo $k."=".$v."<br/>";
        }
    }
?>
    <a href="logout.php">注销</a>
<?php
}
?>
</body>
</html>
