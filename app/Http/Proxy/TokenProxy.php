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

    public function proxy($grantType, array $data = [])
    {
        $data = array_merge($data, [
            'client_id' => env('PASSPORT_ClIENT_ID'),
            'client_secret' => env('PERSONAL_ClIENT_SECRET'),
            'grant_type' => $grantType,
            'scope' => '',
        ]);
        $response = $this->http->post('http://www.vueapi.net/oauth/token', [
            'form_params' => $data
        ]);

        $token = json_decode((string)$response->getBody(), true);
        return response()->json([
            'token' => $token['accrss_token'],
            'expirse_in' => $token['expirse_in']
        ])->cookie('refreshToken', $token['refresh_token'], 864000, null, null,false, true);
    }
}