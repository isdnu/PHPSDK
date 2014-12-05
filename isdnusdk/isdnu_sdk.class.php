<?php

/**
 * PHP SDK for i.sdnu.edu.cn
 * 
 * @author SDNU Mobile Development Team
 */

include_once('oauth_lib.class.php');

/**
 * 协议版本不支持
 */
define( "ISDNU_PROTOCOL_VERSION_NOT_SUPPORTED", '10001' );

/**
 * 时间戳无效
 */
define( "ISDNU_TIMESTAMP_INVALID", '10002' );

/**
 * 单次值无效
 */
define( "ISDNU_NONCE_INVALID", '10003' );

/**
 * 单次值重复
 */
define( "ISDNU_NONCE_REPEATED", '10004' );

/**
 * 签名方法不支持
 */
define( "ISDNU_SIGNATURE_METHOD_NOT_SUPPORTED", '10005' );

/**
 * 签名无效
 */
define( "ISDNU_SIGNATURE_INVALID", '10006' );

/**
 * 回调地址为空
 */
define( "ISDNU_CALLBACK_URL_EMPTY", '10007' );

/**
 * HTTP方法错误
 */
define( "ISDNU_HTTP_METHOD_INVALID", '10008' );

/**
 * 参数重复
 */
define( "ISDNU_DUPLICATED_PARAMETER", '10009' );

/**
 * 应用KEY无效
 */
define( "ISDNU_CONSUMER_KEY_INVALID", '10101' );

/**
 * 该应用不允许用户登陆（只支持公共内容）
 */
define( "ISDNU_CONSUMER_NOT_ALLOW_USER_AUTH", '10102' );

/**
 * 该应用无指定权限
 */
define( "ISDNU_CONSUMER_NO_PERMISSION", '10103' );

/**
 * 该应用暂未启用
 */
define( "ISDNU_CONSUMER_NOT_ENABLED", '10104' );

/**
 * 该应用无XAUTH认证权限
 */
define( "ISDNU_CONSUMER_NO_XAUTH_PERMISSION", '10201' );

/**
 * 请求令牌所有者非法
 */
define( "ISDNU_REQUEST_TOKEN_OWNER_INVALID", '11001' );

/**
 * 请求令牌为空
 */
define( "ISDNU_REQUEST_TOKEN_EMPTY", '11002' );

/**
 * 请求令牌非法
 */
define( "ISDNU_REQUEST_TOKEN_INVALID", '11003' );

/**
 * 请求令牌未被授权
 */
define( "ISDNU_REQUEST_TOKEN_NOT_AUTHORIZED", '11004' );

/**
 * 请求令牌验证码为空
 */
define( "ISDNU_REQUEST_TOKEN_VERIFIER_EMPTY", '11005' );

/**
 * 请求令牌验证码无效
 */
define( "ISDNU_REQUEST_TOKEN_VERIFIER_INVALID", '11006' );

/**
 * 用户未授权该应用
 */
define( "ISDNU_USER_NOT_AUTHORIZED", '11011' );

/**
 * 访问令牌所有者非法
 */
define( "ISDNU_ACCESS_TOKEN_OWNER_INVALID", '11101' );

/**
 * 访问令牌为空
 */
define( "ISDNU_ACCESS_TOKEN_EMPTY", '11102' );

/**
 * 访问令牌非法
 */
define( "ISDNU_ACCESS_TOKEN_INVALID", '11103' );

/**
 * 用户未授权该权限
 */
define( "ISDNU_PERMISSION_NOT_AUTHORIZED", '11104' );

/**
 * XAUTH认证模式不支持
 */
define( "ISDNU_AUTH_MODE_NOT_SUPPORTED", '12001' );

/**
 * XAUTH认证用户名为空
 */
define( "ISDNU_USERNAME_EMPTY", '12101' );

/**
 * XAUTH认证密码为空
 */
define( "ISDNU_PASSWORD_EMPTY", '12102' );

/**
 * XAUTH认证用户名密码错误
 */
define( "ISDNU_USERNAME_OR_PASSWORD_WRONG", '12103' );

/**
 * 用户未绑定邮箱
 */
define( "ISDNU_USER_NOT_SET_EMAIL", '12104' );

/**
 * 服务方法无效
 */
define( "ISDNU_REST_METHOD_INVALID", '20001' );

/**
 * 服务特定错误（请参考错误描述）
 */
define( "ISDNU_REST_METHOD_ERROR", '29999' );

class RestClient
{
    /**
     * 构造函数
     *
     * @access public
     * @param mixed $consumer_key 客户端ID
     * @param mixed $consumer_secret 客户端密钥
     * @param mixed $accecss_token 访问令牌
     * @param mixed $accecss_token_secret 访问令牌密钥
     * @return void
     */
    function __construct($consumer_key, $consumer_secret, $access_token, $access_token_secret)
    {
        $this->client = new OAuthClient($consumer_key, $consumer_secret, $access_token, $access_token_secret);
    }
    
    /**
     * 用户信息获取
     *
     * @return array
     */
    function user_get()
    {
        return $this->client->get($this->client->host.'rest/user/get'); 
    }
    
    /**
     * 人员信息获取
     *
     * @return array
     */
    function people_get()
    {
        return $this->client->get($this->client->host.'rest/people/get'); 
    }
    
    /**
     * 一卡通基本信息获取
     *
     * @return array
     */
    function card_get()
    {
        return $this->client->get($this->client->host.'rest/card/get'); 
    }
    
    /**
     * 一卡通流水信息获取
     *
     * @param string $cardid 一卡通号
     * @param string $start 开始日期（格式为yyyy-MM-dd HH:mm:ss）
     * @param string $end 结束日期（格式同上）
     * @param int $count 返回数量（1-50，默认为10）
     * @param int $index 返回页码（默认为1）
     * @return array
     */
    function card_get_journallist($cardid, $start = false, $end = false, $count = false, $index = false)
    {
        $params = array();
        $params['cardid'] = $cardid;
        
        if ($start) {
            $params['start'] = $start;
        }
        
        if ($end) {
            $params['end'] = $end;
        }
        
        if ($count) {
            $params['count'] = intval($count);
        }
        
        if ($index) {
            $params['index'] = intval($index);
        }
        
        return $this->client->get($this->client->host.'rest/card/getjournallist', $params); 
    }
    
    /**
     * 图书馆欠费信息获取
     *
     * @param string $start 开始日期（格式为yyyy-MM-dd HH:mm:ss）
     * @param string $end 结束日期（格式同上）
     * @param int $count 返回数量（1-50，默认为10）
     * @param int $index 返回页码（默认为1）
     * @return array
     */
    function library_get_arrearlist($start = false, $end = false, $count = false, $index = false)
    {
        $params = array();
        
        if ($start) {
            $params['start'] = $start;
        }
        
        if ($end) {
            $params['end'] = $end;
        }
        
        if ($count) {
            $params['count'] = intval($count);
        }
        
        if ($index) {
            $params['index'] = intval($index);
        }
        
        return $this->client->get($this->client->host.'rest/library/getarrearlist', $params); 
    }
    
    /**
     * 图书馆借阅信息获取
     *
     * @param string $start 开始日期（格式为yyyy-MM-dd HH:mm:ss）
     * @param string $end 结束日期（格式同上）
     * @param int $count 返回数量（1-50，默认为10）
     * @param int $index 返回页码（默认为1）
     * @return array
     */
    function library_get_borrowlist($start = false, $end = false, $count = false, $index = false)
    {
        $params = array();
        
        if ($start) {
            $params['start'] = $start;
        }
        
        if ($end) {
            $params['end'] = $end;
        }
        
        if ($count) {
            $params['count'] = intval($count);
        }
        
        if ($index) {
            $params['index'] = intval($index);
        }
        
        return $this->client->get($this->client->host.'rest/library/getborrowlist', $params); 
    }
    
    /**
     * 图书馆违章信息获取
     *
     * @param string $start 开始日期（格式为yyyy-MM-dd HH:mm:ss）
     * @param string $end 结束日期（格式同上）
     * @param int $count 返回数量（1-50，默认为10）
     * @param int $index 返回页码（默认为1）
     * @return array
     */
    function library_get_illegallist($start = false, $end = false, $count = false, $index = false)
    {
        $params = array();
        
        if ($start) {
            $params['start'] = $start;
        }
        
        if ($end) {
            $params['end'] = $end;
        }
        
        if ($count) {
            $params['count'] = intval($count);
        }
        
        if ($index) {
            $params['index'] = intval($index);
        }
        
        return $this->client->get($this->client->host.'rest/library/getillegallist', $params); 
    }
    
    /**
     * 公共失物招领列表获取
     *
     * @param int $type 物品类型（见附表，默认为全部类型）
     * @param int $count 返回数量（1-50，默认为10）
     * @param int $index 返回页码（默认为1）
     * @return array
     */
    function found_getlist($type = false, $count = false, $index = 1)
    {
        $params = array();
        
        if ($type) {
            $params['type'] = $type;
        }
        
        if ($count) {
            $params['count'] = intval($count);
        }
        
        if ($index) {
            $params['index'] = intval($index);
        }
        
        return $this->client->get($this->client->host.'rest/found/getlist', $params); 
    }
    
    /**
     * 个人失物招领列表获取
     *
     * @param int $type 物品类型（见附表，默认为全部类型）
     * @param int $count 返回数量（1-50，默认为10）
     * @param int $index 返回页码（默认为1）
     * @return array
     */
    function found_getuserlist($type = false, $count = false, $index = 1)
    {
        $params = array();
        
        if ($type) {
            $params['type'] = $type;
        }
        
        if ($count) {
            $params['count'] = intval($count);
        }
        
        if ($index) {
            $params['index'] = intval($index);
        }
        
        return $this->client->get($this->client->host.'rest/found/getuserlist', $params); 
    }
    
    /**
     * 个人失物招领列表获取
     *
     * @param int $foundid 失物招领ID
     * @return array
     */
    function found_get($foundid)
    {
        $params = array();
        $params['foundid'] = $foundid;
        
        return $this->client->get($this->client->host.'rest/found/get', $params); 
    }
    
    /**
     * 一卡通失物招领添加
     *
     * @param int $owneruserid 物品所有者学号
     * @param bool $ishandedin 是否上交
     * @param string $pickcontact 捡拾者联系方式（已上交时可为空）
     * @param string $pickplace 捡拾地点
     * @param string $picktime 捡拾时间（yyyy-MM-dd HH:mm:ss）
     * @param string $handedinplace 上交地点（未上交时请为空）
     * @return array
     */
    function found_addcardfound($owneruserid, $ishandedin, $pickcontact = false, $pickplace = false, $picktime = false, $handedinplace = false)
    {
        $params = array();
        $params['owneruserid'] = $owneruserid;
        $params['ishandedin'] = $ishandedin;
        
        if ($pickcontact) {
            $params['pickcontact'] = $pickcontact;
        }
        
        if ($pickplace) {
            $params['pickplace'] = $pickplace;
        }
        
        if ($picktime) {
            $params['picktime'] = $picktime;
        }
        
        if ($handedinplace) {
            $params['handedinplace'] = $handedinplace;
        }
        
        return $this->client->post($this->client->host.'rest/found/addcardfound', $params); 
    }
    
    /**
     * 班车信息获取
     *
     * @return array
     */
    function bus_getlist()
    {
        return $this->client->get($this->client->host.'rest/bus/getlist'); 
    }
    
    /**
     * 学校地理位置信息获取
     *
     * @param string $type 地理坐标类型，bd为BD-09坐标系，gcj为GCJ-02坐标系，默认为BD-09
     * @return array
     */
    function poi_getlist($type)
    {
        $params = array();
        
        if ($type) {
            $params['type'] = $type;
        }
        
        return $this->client->get($this->client->host.'rest/poi/getlist', $params); 
    }
    
    /**
     * 空闲教室信息获取
     *
     * @param string $start 开始日期时间（格式为yyyy-MM-dd HH:mm:ss，默认为当前时间）
     * @param string $building 教学楼（默认为长清全部）
     * @return array
     */
    function classroom_getlist($start = false, $building = false)
    {
        $params = array();
        
        if ($start) {
            $params['start'] = $start;
        }
        
        if ($building) {
            $params['building'] = $building;
        }
        
        return $this->client->get($this->client->host.'rest/classroom/getlist', $params); 
    }
    
    /**
     * 浴室使用状态获取
     *
     * @param int $day 与当日相差天数（-7<天数<=0，默认为当天）
     * @return array
     */
    function bathroom_getstatus($day)
    {
        $params = array();
        
        if ($day) {
            $params['day'] = intval($day);
        }
        
        return $this->client->get($this->client->host.'rest/bathroom/getstatus', $params); 
    }
    
    /**
     * 宿舍电费信息获取
     *
     * @param int $campus 校区类型（校本部为0，长清校区为1）
     * @param int $building 宿舍楼编号（如 11）
     * @param int $room 三位含楼层的宿舍编号（如 501）
     * @return array
     */
    function power_get($campus, $building, $room)
    {
        $params = array();
        $params['campus'] = intval($campus);
        $params['building'] = intval($building);
        $params['room'] = intval($room);
        
        return $this->client->get($this->client->host.'rest/power/get', $params); 
    }
    
    /**
     * 新闻站点列表获取
     *
     * @return array
     */
    function news_getsitelist()
    {
        return $this->client->get($this->client->host.'rest/news/getsitelist'); 
    }
    
    /**
     * 新闻列表获取
     *
     * @param int $site 新闻站点ID
     * @param int $category 新闻分类ID
     * @param int $index 返回页码（默认为1）
     * @return array
     */
    function news_getlist($site, $category, $index = false)
    {
        $params = array();
        $params['site'] = intval($site);
        $params['category'] = intval($category);
        
        if ($index) {
            $params['index'] = intval($index);
        }
        
        return $this->client->get($this->client->host.'rest/news/getlist', $params); 
    }
    
    /**
     * 新闻列表获取
     *
     * @param int $site 新闻站点ID
     * @param int $newsid 新闻ID
     * @return array
     */
    function news_get($site, $newsid)
    {
        $params = array();
        $params['site'] = intval($site);
        $params['newsid'] = intval($newsid);
        
        return $this->client->get($this->client->host.'rest/news/get', $params); 
    }
    
    /**
     * 未来三天天气预报获取
     *
     * @param string $areaid 区域ID（济南为101120101，更多见附表）
     * @return array
     */
    function weather_getforcast($areaid)
    {
        $params = array();
        $params['areaid'] = $areaid;
        
        return $this->client->get($this->client->host.'rest/weather/getforcast', $params); 
    }
    
    /**
     * 天气指数信息获取
     *
     * @param string $areaid 区域ID（济南为101120101，更多见附表）
     * @return array
     */
    function weather_getindexlist($areaid)
    {
        $params = array();
        $params['areaid'] = $areaid;
        
        return $this->client->get($this->client->host.'rest/weather/getindexlist', $params); 
    }
    
    /**
     * 实时天气信息获取
     *
     * @param string $areaid 区域ID（济南为101120101，更多见附表）
     * @return array
     */
    function weather_getrealtime($areaid)
    {
        $params = array();
        $params['areaid'] = $areaid;
        
        return $this->client->get($this->client->host.'rest/weather/getrealtime', $params); 
    }
}

class OAuthClient
{
    /**
     * Contains the last HTTP status code returned.
     *
     * @ignore
     */
    public $http_code;
    /**
     * Contains the last API call.
     *
     * @ignore
     */
    public $url;
    /**
     * Set up the API root URL.
     *
     * @ignore
     */
    public $host = "http://i.sdnu.edu.cn/oauth/";
    /**
     * Set timeout default.
     *
     * @ignore
     */
    public $timeout = 30;
    /**
     * Set connect timeout.
     *
     * @ignore
     */
    public $connecttimeout = 30;
    /**
     * Verify SSL Cert.
     *
     * @ignore
     */
    public $ssl_verifypeer = false;
    /**
     * Respons format.
     *
     * @ignore
     */
    public $format = 'json';
    /**
     * Decode returned json data.
     *
     * @ignore
     */
    public $decode_json = true;
    /**
     * Contains the last HTTP headers returned.
     *
     * @ignore
     */
    public $http_info;
    /**
     * Set the useragnet.
     *
     * @ignore
     */
    public $useragent = 'i.sdnu.edu.cn OAuth PHPSDK';
    
    /** 
     * Set API URLS 
     */ 
    /** 
     * @ignore 
     */ 
    function requestTokenURL() { return $this->host.'request_token'; }
    /** 
     * @ignore 
     */ 
    function authorizeURL() { return $this->host.'authorize'; }
    /** 
     * @ignore 
     */ 
    function accessTokenURL() { return $this->host.'access_token'; }
    /** 
     * @ignore 
     */ 
    function refreshTokenURL() { return $this->host.'refresh_token'; }
    
    /** 
     * Debug helpers 
     */ 
    /** 
     * @ignore 
     */ 
    function lastStatusCode() { return $this->http_status; }
    /**
     * @ignore
     */
    function lastAPICall() { return $this->last_api_call; }
    
    function __construct($consumer_key, $consumer_secret, $access_token = null, $access_token_secret = null)
    {
        $this->sha1_method = new OAuthSignatureMethod_HMAC_SHA1();
        $this->consumer = new OAuthConsumer($consumer_key, $consumer_secret);
        $this->setAccessToken($access_token, $access_token_secret);
    }
    
    /**
     * Set a request_token
     *
     * @ignore
     */
    function setAccessToken($access_token = null, $access_token_secret = null)
    {
        if (!empty($access_token) && !empty($access_token_secret))
        {
            $this->token = new OAuthToken($access_token, $access_token_secret);
        }else
        {
            $this->token = null;
        }
    }
    
    /**
     * Get a request_token
     *
     * @return array a key/value array containing oauth_token and oauth_token_secret
     */
    function getRequestToken($callback_url)
    {
        $parameters = array("oauth_callback" => $callback_url);
        $request = $this->oauthRequest($this->requestTokenURL(), 'GET', $parameters);
        $token = OAuthUtil::parse_parameters($request);
        $this->token = new OAuthToken($token['oauth_token'], $token['oauth_token_secret']);
        return $token;
    }
    
    /**
     * Get the authorize URL
     *
     * @return string
     */
    function getAuthorizeURL($token, $url=null, $forcelogin=false)
    {
        if (is_array($token))
        {
            $token = $token['oauth_token'];
        }
        
        $url = $this->authorizeURL() . "?oauth_token={$token}";
        
        if (!empty($url))
        {
            $url = $url. "&oauth_callback=". urlencode($url);
        }
        
        if ($forcelogin)
        {
            $url = $url. "&forcelogin=true";
        }
        
        return $url;
    }
    
    /**
     * Exchange the request token and secret for an access token and
     * secret, to sign API calls.
     *
     * @return array array("oauth_token" => the access token,
     *                "oauth_token_secret" => the access secret)
     */
    function getAccessToken($oauth_verifier=false, $oauth_token=false)
    {
        $parameters = array();
        if (!empty($oauth_verifier))
        {
            $parameters['oauth_verifier'] = $oauth_verifier;
        }
        
        $request = $this->oauthRequest($this->accessTokenURL(), 'GET', $parameters);
        $token = OAuthUtil::parse_parameters($request);
        $this->token = new OAuthToken($token['oauth_token'], $token['oauth_token_secret']);
        return $token;
    }
    
    /**
     * GET wrappwer for oauthRequest.
     *
     * @return mixed
     */
    function get($url, $parameters=array())
    {
        $response = $this->oauthRequest($url, 'GET', $parameters);
        if ($this->format === 'json' && $this->decode_json)
        {
            return json_decode($response, true);
        } 
        return $response;
    }
    
    /**
     * POST wreapper for oauthRequest.
     *
     * @return mixed
     */
    function post($url, $parameters=array(), $multi = false)
    {
        $response = $this->oauthRequest($url, 'POST', $parameters , $multi);
        if ($this->format === 'json' && $this->decode_json)
        {
            return json_decode($response, true);
        }
        return $response;
    }
    
    /**
     * Format and sign an OAuth / API request
     *
     * @return string
     */
    function oauthRequest($url, $method, $parameters, $multi=false)
    {
        if (strrpos($url, 'http://') !== 0 && strrpos($url, 'http://') !== 0)
        {
            $url = "{$this->host}{$url}.{$this->format}";
        }
        
        $request = OAuthRequest::from_consumer_and_token($this->consumer, $this->token, $method, $url, $parameters);
        $request->sign_request($this->sha1_method, $this->consumer, $this->token);
        switch ($method)
        {
            case 'GET':
                return $this->http($request->to_url(), 'GET', null, false, $request->to_header());
            default:
                return $this->http($request->get_normalized_http_url(), $method, $request->to_postdata($multi), $multi, $request->to_header());
        }
    }
    
    /**
     * Make an HTTP request
     *
     * @return string API results
     */
    function http($url, $method, $postfields=null, $multi=false, $headermulti = "")
    {
        $this->http_info = array();
        $ci = curl_init();
        /* Curl settings */
        curl_setopt($ci, CURLOPT_USERAGENT, $this->useragent);
        curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, $this->connecttimeout);
        curl_setopt($ci, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, $this->ssl_verifypeer);
        curl_setopt($ci, CURLOPT_HEADERFUNCTION, array($this, 'getHeader'));
        curl_setopt($ci, CURLOPT_HEADER, false);
        
        switch ($method)
        {
            case 'POST':
                curl_setopt($ci, CURLOPT_POST, true);
                if (!empty($postfields))
                {
                    curl_setopt($ci, CURLOPT_POSTFIELDS, $postfields);
                }
                break; 
            case 'DELETE': 
                curl_setopt($ci, CURLOPT_CUSTOMREQUEST, 'DELETE'); 
                if (!empty($postfields))
                {
                    $url = "{$url}?{$postfields}";
                }
            default:
                break;
        }
        
        $header_array=array();
        if($multi)
            $header_array = array("Content-Type: multipart/form-data; boundary=" . OAuthUtil::$boundary , "Expect: ");
        
        array_push($header_array,$headermulti);
        
        curl_setopt($ci, CURLOPT_HTTPHEADER, $header_array);
        curl_setopt($ci, CURLINFO_HEADER_OUT, true); 
        curl_setopt($ci, CURLOPT_URL, $url);
        
        $response = curl_exec($ci); 
        $this->http_code = curl_getinfo($ci, CURLINFO_HTTP_CODE);
        $this->http_info = array_merge($this->http_info, curl_getinfo($ci));
        $this->url = $url;
        
        curl_close ($ci);
        return $response;
    }
    
    /** 
     * Get the header info to store. 
     * 
     * @return int 
     */ 
    function getHeader($ch, $header)
    {
        $i = strpos($header, ':');
        if (!empty($i))
        {
            $key = str_replace('-', '_', strtolower(substr($header, 0, $i)));
            $value = trim(substr($header, $i + 2));
            $this->http_header[$key] = $value;
        }
        return strlen($header);
    }
}

?>