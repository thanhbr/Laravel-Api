<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use Session;
use \Throwable;

class Api extends Model
{
    protected $access_token;

    public function __construct(){
        $this->access_token = $this->get_access_token();
    }

    public function get_access_token() {
        try {
            $client = new \GuzzleHttp\Client();
            $admin_account = [
                'username' => config('api.admin_account.username'),
                'password' => config('api.admin_account.password'),
            ];
            $link = config('api.main_url') . config('api.login.link');

            $res = $client->request('POST', $link, [
                'json'    => $admin_account
            ]);
            $res->getStatusCode();
            $res->getHeader('content-type')[0];
            $result = json_decode($res->getBody());
            session()->put('api_access_token', $result->data->access_token);
            return $result->data->access_token;            
        } catch (Throwable $e) {}
        return null;
    }

    public function get_info_user() {
        $client = new \GuzzleHttp\Client();
        $link = config('api.main_url') . config('api.user.link');

        $res = $client->request('GET', $link, [
            'headers'    => [
                'Authorization' => 'Bearer '. $this->access_token,
            ],
        ]);
        $res->getStatusCode();
        $res->getHeader('content-type')[0];
        $result = json_decode($res->getBody());
        return $result;
    }

    // get order list
    public function order_list($params) {
        $client = new \GuzzleHttp\Client();
        $link = config('api.main_url') . config('api.order_delivery.link');

        $res = $client->request('GET', $link, [
            'headers'    => [
                'Authorization' => 'Bearer '. $this->access_token,
            ],
            'query' => $params,
        ]);
        $res->getStatusCode();
        $res->getHeader('content-type')[0];
        $result = json_decode($res->getBody());
        return $result;
    }

    public function order_list_internal($params) {
        $client = new \GuzzleHttp\Client();
        $link = config('api.main_url') . config('api.order_delivery_internal.link');

        $res = $client->request('GET', $link, [
            'headers'    => [
                'Authorization' => 'Bearer '. $this->access_token,
            ],
            'query' => $params,
        ]);
        $res->getStatusCode();
        $res->getHeader('content-type')[0];
        $result = json_decode($res->getBody());
        return $result;
    }

    public function area_list() {
        try {
            $client = new \GuzzleHttp\Client();
            $link = config('api.main_url') . config('api.area.link');

            $res = $client->request('GET', $link, [
                'headers'    => [
                    'Authorization' => 'Bearer '. $this->access_token,
                ]
            ]);
            $res->getStatusCode();
            $res->getHeader('content-type')[0];
            $result = json_decode($res->getBody());
            return $result;            
        } catch (Throwable $e) {}
        return null;
    }

    public function province_list() {
        try{
            $client = new \GuzzleHttp\Client();
            $link = config('api.main_url') . config('api.province.link');

            $res = $client->request('GET', $link, [
                'headers'    => [
                    'Authorization' => 'Bearer '. $this->access_token,
                ],
            ]);
            $res->getStatusCode();
            $res->getHeader('content-type')[0];
            $result = json_decode($res->getBody());
            return $result;
        } catch (Throwable $e) {logger($e);}
        return null;
    }

    public function province_array():array
    {
        $result = [];
        try {
            foreach ($this->province_list()->data ?? [] as $key => $std) {
                $result[($std->city_id ?? 0)] = ($std->city_name ?? '');
            }
            return $result;
        } catch (Exception $e) {
            logger($e);
        }
        return [];
    }
    public function district_list($params) {
        try{
            $client = new \GuzzleHttp\Client();
            $link = config('api.main_url') . config('api.district.link');

            $res = $client->request('GET', $link, [
                'headers'    => [
                    'Authorization' => 'Bearer '. $this->access_token,
                ],
                'query' => $params,
            ]);
            $res->getStatusCode();
            $res->getHeader('content-type')[0];
            $result = json_decode($res->getBody());
            return $result;
        } catch (Throwable $e) {}
        return null;
    }

    public function ward_list($params) {
        try{
            $client = new \GuzzleHttp\Client();
            $link = config('api.main_url') . config('api.ward.link');

            $res = $client->request('GET', $link, [
                'headers'    => [
                    'Authorization' => 'Bearer '. $this->access_token,
                ],
                'query' => $params,
            ]);
            $res->getStatusCode();
            $res->getHeader('content-type')[0];
            $result = json_decode($res->getBody());
            return $result;
        } catch (Throwable $e) {}
        return null;
    }

    public function shop_create($params) {
        $client = new \GuzzleHttp\Client();
        $link = config('api.main_url') . config('api.shop.create.link');

        $res = $client->request('POST', $link, [
            'headers'    => [
                'Authorization' => 'Bearer '. $this->access_token,
            ],
            'form_params' => $params,
        ]);
        $res->getStatusCode();
        $res->getHeader('content-type')[0];
        $result = json_decode($res->getBody());
        return $result;
    }
    public function shop_edit($shop_id, $params) {
        $client = new \GuzzleHttp\Client();
        $link = config('api.main_url') . config('api.shop.edit.link'). $shop_id;

        $res = $client->request('POST', $link, [
            'headers'    => [
                'Authorization' => 'Bearer '. $this->access_token,
            ],
            'form_params' => $params,
        ]);
        $res->getStatusCode();
        $res->getHeader('content-type')[0];
        $result = json_decode($res->getBody());
        return $result;
    }

    public function shop_list($params) {
        try{
            $client = new \GuzzleHttp\Client();
            $link = config('api.main_url') . config('api.shop.list.link');

            $res = $client->request('GET', $link, [
                'headers'    => [
                    'Authorization' => 'Bearer '. $this->access_token,
                ],
                'query' => $params,
            ]);
            $res->getStatusCode();
            $res->getHeader('content-type')[0];
            $result = json_decode($res->getBody());
            return $result;
        } catch (Throwable $e) {}
        return null;
    }

    public function business_majors() {
        try{
            $client = new \GuzzleHttp\Client();
            $link = config('api.main_url') . config('api.majors.link');

            $res = $client->request('GET', $link, [
                'headers'    => [
                    'Authorization' => 'Bearer '. $this->access_token,
                ],
            ]);
            $res->getStatusCode();
            $res->getHeader('content-type')[0];
            $result = json_decode($res->getBody());
            return $result;
        } catch (Throwable $e) {}
        return null;
    }

    public function shipping_partner() {
        try{
            $client = new \GuzzleHttp\Client();
            $link = config('api.main_url') . config('api.shipping_partner.link');

            $res = $client->request('GET', $link, [
                'headers'    => [
                    'Authorization' => 'Bearer '. $this->access_token,
                ],
            ]);
            $res->getStatusCode();
            $res->getHeader('content-type')[0];
            $result = json_decode($res->getBody());
            return $result;
        } catch (Throwable $e) {}
        return null;
    }

    public function delivery_status($params) {
        $client = new \GuzzleHttp\Client();
        $link = config('api.main_url') . config('api.delivery_status.link');

        $res = $client->request('GET', $link, [
            'headers'    => [
                'Authorization' => 'Bearer '. $this->access_token,
            ],
            'query' => $params,
        ]);
        $res->getStatusCode();
        $res->getHeader('content-type')[0];
        $result = json_decode($res->getBody());
        return $result;
    }

    //====== call API shop package
    public function shop_package_details($shop_id) {
        $client = new \GuzzleHttp\Client();
        $link = config('api.main_url') . config('api.package.shop_package_detail.link') . $shop_id;

        $res = $client->request('GET', $link, [
            'headers'    => [
                'Authorization' => 'Bearer '. $this->access_token,
            ],
        ]);
        $res->getStatusCode();
        $res->getHeader('content-type')[0];
        $result = json_decode($res->getBody());
        return $result;
    }
    public function service_extra_price() {
        $client = new \GuzzleHttp\Client();
        $link = config('api.main_url') . config('api.package.service_extra_price.link');

        $res = $client->request('GET', $link, [
            'headers'    => [
                'Authorization' => 'Bearer '. $this->access_token,
            ],
        ]);
        $res->getStatusCode();
        $res->getHeader('content-type')[0];
        $result = json_decode($res->getBody());
        return $result;
    }
    public function package_list($params) {
        $client = new \GuzzleHttp\Client();
        $link = config('api.main_url') . config('api.package.package_list.link');

        $res = $client->request('GET', $link, [
            'headers'    => [
                'Authorization' => 'Bearer '. $this->access_token,
            ],
            'query' => $params,
        ]);
        $res->getStatusCode();
        $res->getHeader('content-type')[0];
        $result = json_decode($res->getBody());
        return $result;
    }
    public function payment_detail($payment_id) {
        $client = new \GuzzleHttp\Client();
        $link = config('api.main_url') . config('api.package.payment_detail.link') . $payment_id;

        $res = $client->request('GET', $link, [
            'headers'    => [
                'Authorization' => 'Bearer '. $this->access_token,
            ],
        ]);
        $res->getStatusCode();
        $res->getHeader('content-type')[0];
        $result = json_decode($res->getBody());
        return $result;
    }
    // API change package
    public function change_package($params) {
        $client = new \GuzzleHttp\Client();
        $link = config('api.main_url') . config('api.package.change_package.link');

        $res = $client->request('POST', $link, [
            'headers'    => [
                'Authorization' => 'Bearer '. $this->access_token,
            ],
            'form_params' => $params,
        ]);
        $res->getStatusCode();
        $res->getHeader('content-type')[0];
        $result = json_decode($res->getBody());
        return $result;
    }
    // API updrage package
    public function updrage_package($params) {
        $client = new \GuzzleHttp\Client();
        $link = config('api.main_url') . config('api.package.updrage_package.link');

        $res = $client->request('POST', $link, [
            'headers'    => [
                'Authorization' => 'Bearer '. $this->access_token,
            ],
            'form_params' => $params,
        ]);
        $res->getStatusCode();
        $res->getHeader('content-type')[0];
        $result = json_decode($res->getBody());
        return $result;
    }
    // API renew package
    public function renew_package($params) {
        $client = new \GuzzleHttp\Client();
        $link = config('api.main_url') . config('api.package.renew_package.link');

        $res = $client->request('POST', $link, [
            'headers'    => [
                'Authorization' => 'Bearer '. $this->access_token,
            ],
            'form_params' => $params,
        ]);
        $res->getStatusCode();
        $res->getHeader('content-type')[0];
        $result = json_decode($res->getBody());
        return $result;
    }
    // API renew_trial package
    public function renew_trial($params) {
        $client = new \GuzzleHttp\Client();
        $link = config('api.main_url') . config('api.package.renew_trial.link');

        $res = $client->request('POST', $link, [
            'headers'    => [
                'Authorization' => 'Bearer '. $this->access_token,
            ],
            'form_params' => $params,
        ]);
        $res->getStatusCode();
        $res->getHeader('content-type')[0];
        $result = json_decode($res->getBody());
        return $result;
    }
    // API renew_trial package
    public function payment_package($params) {
        $client = new \GuzzleHttp\Client();
        $link = config('api.main_url') . config('api.package.payment_package.link');

        $res = $client->request('POST', $link, [
            'headers'    => [
                'Authorization' => 'Bearer '. $this->access_token,
            ],
            'form_params' => $params,
        ]);
        $res->getStatusCode();
        $res->getHeader('content-type')[0];
        $result = json_decode($res->getBody());
        return $result;
    }
    
    //===== end call API shop package

    public function shop_details($shop_id) {
        $client = new \GuzzleHttp\Client();
        $link = config('api.main_url') . config('api.shop.details.link') . $shop_id;

        $res = $client->request('GET', $link, [
            'headers'    => [
                'Authorization' => 'Bearer '. $this->access_token,
            ],
        ]);
        $res->getStatusCode();
        $res->getHeader('content-type')[0];
        $result = json_decode($res->getBody());
        return $result;
    }

    public function shipping_status() {
        $client = new \GuzzleHttp\Client();
        $link = config('api.main_url') . config('api.shipping_status.link');

        $res = $client->request('GET', $link, [
            'headers'    => [
                'Authorization' => 'Bearer '. $this->access_token,
            ],
        ]);
        $res->getStatusCode();
        $res->getHeader('content-type')[0];
        $result = json_decode($res->getBody());
        return $result;
    }
    /**
     * @author toannguyen.dev
     * @todo 
     */
    public function detect_address($params) {        
        try {
            $client = new \GuzzleHttp\Client();
            $link = 'https://api-dev.upos.vn/api/v2/area/detect-address';
            $res = $client->request('GET', $link, [
                'headers'    => [
                    'Authorization' => 'Bearer '. $this->access_token,
                ],
                'query' => $params,
            ]);
            $res->getStatusCode();
            $res->getHeader('content-type')[0];
            $result = json_decode($res->getBody());
            return (array) ($result->success ? $result->data : []);
        } catch (Throwable $e) {
            return [];   
        }
    }

}
