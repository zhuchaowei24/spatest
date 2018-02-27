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
        if (auth()->attempt(['email' => $email, 'password' => $password, 'is_active' => 1])) {
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

    public function proxy($grantType, array $data = [])
    {
        $data = array_merge($data, [
            'client_id' => '2',
            'client_secret' => 'ddxd3wZLuVuEQe8k0anRmxDWmjE1pfVFvW4LOJVh',
            'grant_type' => $grantType,
            'scope' => '',
        ]);
        $response = $this->http->post('http://www.vueapi.net/oauth/token', [
            'form_params' => $data
        ]);

        $token = json_decode((string)$response->getBody(), true);
        return response()->json([
            'token' => $token['access_token'],
            'expires_in' => $token['expires_in']
         ])->cookie('refreshToken', $token['refresh_token'], 864000, null, null,false, true);
    }
}