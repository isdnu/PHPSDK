<?php
session_start();
include_once('config.php');
include_once('../isdnusdk/isdnu_sdk.class.php');

$client = new OAuthClient(ISDNU_CONSUMER_KEY, ISDNU_CONSUMER_SECRET);
$request_token = $client->getRequestToken(ISDNU_CALLBACK_URL);

if (!empty($request_token['oauth_token'])) {
    $authroize_url = $client->getAuthorizeURL($request_token['oauth_token'], ISDNU_CALLBACK_URL, true);
    $_SESSION['request_token'] = $request_token;
    header('Location: '.$authroize_url);
}
else {
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
    if (!empty($request_token['error_code'])) {
        echo "Error Code: ".$request_token['error_code'];
        echo "Error Type: ".$request_token['error_type'];
        echo "Error Description: ".$request_token['error_description'];
    }
    else {
        echo $request_token;
    }
}
?>
</body>
</html>
