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
    <script type="text/javascript">
        if (location.href.indexOf('#') >= 0) {
            location.href = location.href.replace('#', '?'); 
        }
    </script>
</head>
<body>
<?php
$request_token = $_SESSION['request_token'];
$client = new OAuthClient(ISDNU_CONSUMER_KEY, ISDNU_CONSUMER_SECRET, $request_token['oauth_token'], $request_token['oauth_token_secret']);
$access_token = $client->getAccessToken($_REQUEST['oauth_verifier'], $_REQUEST['oauth_token']);

if (!empty($access_token['oauth_token'])) {
    $_SESSION['access_token'] = $access_token;
    echo "<script>location.href='index.php';</script>";
}
else if (!empty($access_token['error_code'])) {
    echo "Error Code: ".$request_token['error_code'];
    echo "Error Type: ".$request_token['error_type'];
    echo "Error Description: ".$request_token['error_description'];
}
?>
</body>
</html>
