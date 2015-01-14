<?php

use App\Services\Auth\AuthProvider;
use App\Services\Auth\Contracts\Auth;
use Illuminate\Http\Request;

class AuthTest extends TestCase {

    public function testLoginGxAccount()
    {
        $response = $this->call('POST', '/v1/auth/login', [
            'provider' => 'gx',
            'open_id' => '1',
            'access_token' => 'aaaa'
        ]);

        $this->assertEquals(200, $response->getStatusCode(), $response->getContent());

        $this->assertJson($response->getContent(), 'not valid json response');
        $result = json_decode($response->getContent(), true);

        $this->assertArrayHasKey('user', $result);
        $this->assertArrayHasKey('token', $result);

        $uri = '/v1/anything';
        $method = 'POST';
        $parameters = ['token' => $result['token']];

        $req = Request::create($uri, $method, $parameters);
        $auth = new AuthProvider($req);
        $this->assertTrue($auth->isLogin());
        $this->assertEquals('dummy nickname', $auth->user()->nickname);
    }

}
 