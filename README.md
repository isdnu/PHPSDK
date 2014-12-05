智慧山师 PHP SDK
======

智慧山师官方 PHP SDK，基于MIT开源协议，同时提供一套完整示例代码。

在使用之前可以分别客户端ID、客户端密钥以及回调地址常量如下：

    define( "ISDNU_CONSUMER_KEY" , 'test_consumer_key_00000000000001' );
    define( "ISDNU_CONSUMER_SECRET" , 'test_consumer_secrettest_consumer_secret' );
    define( "ISDNU_CALLBACK_URL" , 'http://fakeurl.com/callback' );

对于OAuth1.0a协议，需要按以下步骤执行

1.  获取请求令牌
2.  使用请求令牌访问授权页面并引导用户登录和授权
3.  从回调地址中获取令牌验证码
4.  使用请求令牌和验证码获取访问令牌
5.  使用访问令牌请求服务方法

1.获取请求令牌

    $client = new OAuthClient(ISDNU_CONSUMER_KEY, ISDNU_CONSUMER_SECRET);
    $request_token = $client->getRequestToken(ISDNU_CALLBACK_URL);
    
    if (!empty($request_token['oauth_token'])) {
        //存储Request Token状态供其他页面使用
        $_SESSION['request_token'] = $request_token;
    }

2.获取授权页面地址，并引导用户登录和授权

    $authroize_url = $client->getAuthorizeURL($request_token['oauth_token'], ISDNU_CALLBACK_URL, true);

3.从回调地址中获取令牌验证码

    <script type="text/javascript">
        //回调页面可以通过JS获取令牌验证码再跳转
        if (location.href.indexOf('#') >= 0) {
            location.href = location.href.replace('#', '?'); 
        }
    </script>

4.使用请求令牌换取访问令牌

    $request_token = $_SESSION['request_token'];//获取之前存储的请求令牌
    $client = new OAuthClient(ISDNU_CONSUMER_KEY, ISDNU_CONSUMER_SECRET, $request_token['oauth_token'], $request_token['oauth_token_secret']);
    $access_token = $client->getAccessToken($_REQUEST['oauth_verifier'], $_REQUEST['oauth_token']);
    
    if (!empty($access_token['oauth_token'])) {
        //存储Access Token状态供其他页面使用
        $_SESSION['access_token'] = $access_token;
    }

5.使用访问令牌请求服务方法

    $request_token = $_SESSION['access_token'];//获取之前存储的访问令牌
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

相关链接
---------
智慧山师 http://i.sdnu.edu.cn 

智慧山师开放平台 http://i.sdnu.edu.cn/open 

人人网公共主页 http://page.renren.com/601879820 

新浪微博 http://weibo.com/smartsdnu 
