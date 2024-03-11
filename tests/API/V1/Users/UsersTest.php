<?php
namespace Tests\API\V1\Users;

class UsersTest extends \Tests\TestCase
{
    public function test_create_user()
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

    public function test_send_params_create()
    {
        $response = $this->call('POST','api/v1/users',[]);

        $this->assertEquals(422,$response->status());
    }

    public function test_update_info_user()
    {
        $response = $this->call('PUT','api/v1/users',[
            'id' => '2',
            'fullName' => 'Mahdi Hoshyar',
            'email' => 'mahdi@gmail.com',
            'mobile' => '09362973637',
        ]);

        $this->assertEquals(200, $response->status());
        $this->seeJsonStructure([
            'success',
            'message',
            'data' => [
                'fullName',
                'email',
                'mobile',
            ]
        ]);
    }

    public function test_send_params_update()
    {
        $response = $this->call('PUT','api/v1/users',[]);

        $this->assertEquals(422,$response->status());
    }

    public function test_update_password()
    {
        $response = $this->call('PUT','api/v1/users/change-password',[
            'id' => '1',
            'password' => '123456',
            'password_repeat' => '123456',
        ]);

        $this->assertEquals(200,$response->status());
        $this->seeJsonStructure([
            'success',
            'message',
            'data' => [
                'fullName',
                'email',
                'mobile',
            ]
        ]);
    }

    public function test_send_params_update_password()
    {
        $response = $this->call('PUT','api/v1/users/change-password',[]);

        $this->assertEquals(422,$response->status());
    }

    public function test_delete_user()
    {
        $response = $this->call('DELETE','api/v1/users',[
            'id' => '20',
        ]);

        $this->assertEquals(200,$response->status());
        $this->seeJsonStructure([
            'success',
            'message',
            'data',
        ]);
    }

    public function test_read_user()
    {
        $pageSize = 5;

        $response = $this->call('GET','api/v1/users',[
            'page' => 1,
            'pagesize' => $pageSize,
        ]);

        $data = json_decode($response->getContent(),true);

        $this->assertEquals($pageSize,count($data['data']));
        $this->assertEquals(200,$response->status());
        $this->seeJsonStructure([
            'success',
            'message',
            'data',
        ]);
    }

    public function test_read_search_user()
    {
        $pageSize = 5;
        $userEmail = 'aabrahimi1718@gmail.com';

        $response = $this->call('GET','api/v1/users',[
            'search' => $userEmail,
            'page' => 1,
            'pagesize' => $pageSize,
        ]);

        $data = json_decode($response->getContent(),true);

        $this->assertEquals($data['data']['email'],$userEmail);
        $this->assertEquals(200,$response->status());
        $this->seeJsonStructure([
            'success',
            'message',
            'data',
        ]);
    }
}

