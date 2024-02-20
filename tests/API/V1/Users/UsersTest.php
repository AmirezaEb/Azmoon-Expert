<?php
namespace Tests\API\V1\Users;

class UsersTest extends \Tests\TestCase
{
    public function test_should_create_user()
    {
        $response = $this->call('POST','api/v1/users',[
            'fullName' => 'Amirreza Ebrahimi',
            'email' => 'aabrahimi1718@gmail.com',
            'mobile' => '09358919279',
            'password' => '123456',
        ]);

        $this->assertEquals(201,$response->status());
        $this->seeJsonStructure([
            'success',
            'message',
            'data' => [
                'fullName',
                'email',
                'mobile',
                'password',
            ]
        ]);
    }
}

?>
