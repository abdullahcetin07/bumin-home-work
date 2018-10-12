<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests;

class WorkController extends Controller
{

    public function postApi($post,$url,$header = null){

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        if(!empty($header))
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response);

    }


	public function workLogin(Request $request)
    {

        if(!$request->session()->has('authorization')){


            $post = [
                'email' => 'demo@bumin.com.tr',
                'password' => 'cjaiU8CV',
            ];

            $url = "https://sandbox-reporting.rpdpymnt.com/api/v3/merchant/user/login";

            $response = $this->postApi($post,$url);

            $request->session()->put('authorization', $response->token);
        }



        return view('welcome');
	}

    public function transactionReport(Request $request){

        $post = [
            'fromDate' => '2015-07-01',
            'toDate' => '2015-10-01',
            'merchant' => 1,
            'acquirer' => 1,
        ];
        $token = $request->session()->get('authorization');
      //  print_r($token);

        $headers = array(
            "Authorization: $token"
        );


        $url = "https://sandbox-reporting.rpdpymnt.com/api/v3/transactions/report";

        $response = $this->postApi($post,$url,$headers);

        print_r($response);


    }

    public function transactionQuery(Request $request){

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

        $token = $request->session()->get('authorization');
        $headers = array(
            "Authorization: $token"
        );


        $url = "https://sandbox-reporting.rpdpymnt.com/api/v3/transaction/list";

        $response = $this->postApi($post,$url,$headers);

        print_r($response);


    }


    public function getTransaction(Request $request){

        $post = [
            'transactionId' => '529-1438673740-2',
        ];

        $token = $request->session()->get('authorization');
        $headers = array(
            "Authorization: $token"
        );


        $url = "https://sandbox-reporting.rpdpymnt.com/api/v3/transaction";

        $response = $this->postApi($post,$url,$headers);

        print_r($response);


    }

    public function getClient(Request $request){

        $post = [
            'transactionId' => '529-1438673740-2',
        ];

        $token = $request->session()->get('authorization');
        $headers = array(
            "Authorization: $token"
        );


        $url = "https://sandbox-reporting.rpdpymnt.com/api/v3/client";

        $response = $this->postApi($post,$url,$headers);

        print_r($response);

    }




}
