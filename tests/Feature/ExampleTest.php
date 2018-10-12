<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        /*
        $response = $this->get('/');

        $response->assertStatus(200);
        */

        $response = $this->login();

        $this->assertEquals($response->status, 'APPROVED');
        dd($response->token);

    }

    public function login(){
        $post = [
            'email' => 'demo@bumin.com.tr',
            'password' => 'cjaiU8CV',
        ];

        $ch = curl_init('https://sandbox-reporting.rpdpymnt.com/api/v3/merchant/user/login');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response);

    }

    public function testTransactionTest(){

        $post = [
            'fromDate' => '2015-07-01',
            'toDate' => '2015-10-01',
            'merchant' => 1,
            'acquirer' => 1,
        ];

        $headers = array(
            'Authorization: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJtZXJjaGFudFVzZXJJZCI6NTMsInJvbGUiOiJ1c2VyIiwibWVyY2hhbnRJZCI6Mywic3ViTWVyY2hhbnRJZHMiOlszLDc0LDkzLDExOTEsMTI5NSwxMTEsMTM3LDEzOCwxNDIsMTQ1LDE0NiwxNTMsMzM0LDE3NSwxODQsMjIwLDIyMSwyMjIsMjIzLDI5NCwzMjIsMzIzLDMyNywzMjksMzMwLDM0OSwzOTAsMzkxLDQ1NSw0NTYsNDc5LDQ4OCw1NjMsMTE0OSw1NzAsMTEzOCwxMTU2LDExNTcsMTE1OCwxMTc5LDEyOTMsMTI5NF0sInRpbWVzdGFtcCI6MTUzOTI0ODE1Mn0.tMLjF_ET1CVsQxBdpGOUr1Br59N7QX4K_7CykGnVpKo'
        );


        $ch = curl_init('https://sandbox-reporting.rpdpymnt.com/api/v3/transactions/report');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response);

        $this->assertEquals($result->status, 'APPROVED');


    }




    public function testTransactionQueryTest(){

        $post = [
            'fromDate' => '2015-07-01',
            'toDate' => '2015-10-01',
           /* 'status' => 'APPROVED',
            'operation' => 'DIRECT',
            'merchantId' => 2,
            'acquirerId' => 1,
            'paymentMethod' => 'CREDITCARD',
            'errorCode' => 'APPROVED',
            'filterField' => 'Reference No',
            'filterValue' => '1-1568845-56',
            'page' => 1, */
        ];

        $headers = array(
            'Authorization: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJtZXJjaGFudFVzZXJJZCI6NTMsInJvbGUiOiJ1c2VyIiwibWVyY2hhbnRJZCI6Mywic3ViTWVyY2hhbnRJZHMiOlszLDc0LDkzLDExOTEsMTI5NSwxMTEsMTM3LDEzOCwxNDIsMTQ1LDE0NiwxNTMsMzM0LDE3NSwxODQsMjIwLDIyMSwyMjIsMjIzLDI5NCwzMjIsMzIzLDMyNywzMjksMzMwLDM0OSwzOTAsMzkxLDQ1NSw0NTYsNDc5LDQ4OCw1NjMsMTE0OSw1NzAsMTEzOCwxMTU2LDExNTcsMTE1OCwxMTc5LDEyOTMsMTI5NF0sInRpbWVzdGFtcCI6MTUzOTI1MDIxM30.3euop2D9qYOCDmSa6PdB8ZoBolvxHhnwon-lVLzcO6I'
        );


        $ch = curl_init('https://sandbox-reporting.rpdpymnt.com/api/v3/transaction/list');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response);

        var_dump($result);

        ///$this->assertEquals($result->status, 'APPROVED');


    }


    public function testGetTransactionTest(){

        $post = [
            'transactionId' => '529-1438673740-2',
        ];

        $headers = array(
            'Authorization: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJtZXJjaGFudFVzZXJJZCI6NTMsInJvbGUiOiJ1c2VyIiwibWVyY2hhbnRJZCI6Mywic3ViTWVyY2hhbnRJZHMiOlszLDc0LDkzLDExOTEsMTI5NSwxMTEsMTM3LDEzOCwxNDIsMTQ1LDE0NiwxNTMsMzM0LDE3NSwxODQsMjIwLDIyMSwyMjIsMjIzLDI5NCwzMjIsMzIzLDMyNywzMjksMzMwLDM0OSwzOTAsMzkxLDQ1NSw0NTYsNDc5LDQ4OCw1NjMsMTE0OSw1NzAsMTEzOCwxMTU2LDExNTcsMTE1OCwxMTc5LDEyOTMsMTI5NF0sInRpbWVzdGFtcCI6MTUzOTI1NzQ3M30.axRuCJNUm8p4z7I4BZDF5YxTBgZVfTDEEIZT2cvzRSE'
        );


        $ch = curl_init('https://sandbox-reporting.rpdpymnt.com/api/v3/transaction');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response);

        var_dump($result);

        ///$this->assertEquals($result->status, 'APPROVED');


    }


    public function testGetClientTest(){

        $post = [
            'transactionId' => '529-1438673740-2',
        ];
        

        $headers = array(
            'Authorization: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJtZXJjaGFudFVzZXJJZCI6NTMsInJvbGUiOiJ1c2VyIiwibWVyY2hhbnRJZCI6Mywic3ViTWVyY2hhbnRJZHMiOlszLDc0LDkzLDExOTEsMTI5NSwxMTEsMTM3LDEzOCwxNDIsMTQ1LDE0NiwxNTMsMzM0LDE3NSwxODQsMjIwLDIyMSwyMjIsMjIzLDI5NCwzMjIsMzIzLDMyNywzMjksMzMwLDM0OSwzOTAsMzkxLDQ1NSw0NTYsNDc5LDQ4OCw1NjMsMTE0OSw1NzAsMTEzOCwxMTU2LDExNTcsMTE1OCwxMTc5LDEyOTMsMTI5NF0sInRpbWVzdGFtcCI6MTUzOTI1NzQ3M30.axRuCJNUm8p4z7I4BZDF5YxTBgZVfTDEEIZT2cvzRSE'
        );


        $ch = curl_init('https://sandbox-reporting.rpdpymnt.com/api/v3/client');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response);

        var_dump($result);

        ///$this->assertEquals($result->status, 'APPROVED');


    }




}
