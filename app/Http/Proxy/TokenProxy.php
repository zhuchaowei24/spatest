<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/25
 * Time: 23:08
 */
namespace App\Http\Proxy;
class TokenProxy
{
    protected  $http;
    public function __construct(\GuzzleHttp\Client $http)
    {
        $this->http = $http;
    }

    public function login($email, $password)
    {
        if (auth()->attempt(['email' => $email, 'password' => $password, 'is_active' => 1]))
        {   //验证帐号密码，账号是否激活
            return $this->proxy('password', [
                'username' => request('email'),
                'password' => request('password'),
                'scope' => ''
            ]);
        }
        return response()->json([
           'success' => false,
           'message' => 'no match'
        ],  421);
    }
    public function logout()
    {
        $user = auth()->guard('api')->user; //获取当前登陆者
        $access_token = $user->token(); //获取用户额token
        app('db')->table('oauth_refresh_token') //表里面的revoked字段设置
            ->where('access_token_id', $access_token->id)
            ->update([
               'revoked' => true
            ]);

        app('cookie')->forget('refreshToken'); //删除cookie
        $access_token->revoke(); //标记accesstoken为不可认证的
        return response()->json([
            'message' => 'logout!'
        ],204);
    }
    public function proxy($grantType, array $data = []) //代理保存client_id，避免前端保存这些信息，提高安全性
    {
        $data = array_merge($data, [
            'client_id' => '2',
            'client_secret' => 'ddxd3wZLuVuEQe8k0anRmxDWmjE1pfVFvW4LOJVh',
            'grant_type' => $grantType,
            'scope' => '',
        ]);
        $response = $this->http->post('http://www.vueapi.net/oauth/token', [
            'form_params' => $data
        ]); // 获取token

        $token = json_decode((string)$response->getBody(), true);

        return response()->json([
            'token' => $token['access_token'],
            'expires_in' => $token['expires_in']
         ])->cookie('refreshToken', $token['refresh_token'], 14400, null, null,false, true); //设置cookie以及失效时间
    }
}