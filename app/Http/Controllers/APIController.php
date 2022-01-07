<?php

namespace App\Http\Controllers;
use Auth;
use \Exception;
use \Throwable;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
// use Maatwebsite\Excel\Facades\Excel;

use App\Http\Controllers\Controller;
use App\Models\Api;
use App\Models\{CustomerLog, Customer, CustomerOrigin};


class APIController extends Controller
{
    public $status = 200;
    public $msg = 'OK';
    public $contentType = 'text/html; charset=UTF-8';
    private const CRM_TOKEN = 'LuX5J8FK94H^@5w?4#H58gpYkzgsnryh#AmzN7+$h4*693grkKFLbeWCcZD&bcJgtB';

    public function __construct()
    {
    }
    public function index(Request $request) {
       
    }
    /**
     * @author toannguyen.dev
     *
     * 
     */
    public function api(Request $request, string $object, ?string $action, $option = null)
    {
        try {
            if($request->header('CRM-TOKEN') !== self::CRM_TOKEN) return $this->response('Unauthenticated', 403);
            if (method_exists($this, $object)) {
                call_user_func([$this, $object], $request, $action, $option);
            }
        } catch (Exception $e) {
            
        }
        return $this->response();
    }
    public function get(Request $request, string $object, $option = null)
    {
        try {
            $object = 'get_'.$object;
            if (method_exists($this, $object)) {
                call_user_func([$this, $object], $request, $option);
            }
        } catch (Exception $e) {
            
        }
    }
    /**
     * @author toannguyen.dev
     * @return void
     * #2021-08-05
     */
    private function response($msg = null, $status = null, $contentType = null)
    {
        if ($msg) $this->msg = $msg;
        if ($status) $this->status = $status;
        if ($contentType) $this->contentType = $contentType;
        return response($this->msg, $this->status)->header('Content-Type', $this->contentType);
    }
    /**
     * to receive customer's info from website and mobile app system.
     * And store it into the CRM.
     *
     * @return void
     */
    protected function customer(Request $request, string $action, $option = null)
    {
        $result = null;
        try {
            $requiredList = [
                'phone',
                'name',
                'shop_name',
                'shop_id',
                'shop_code',
                'shop_package',
                'shop_expired',
                'address',
                'area',
                'city_id',
                'district_id',
                'ward_id',
                'shipping_partner',
                'origin_id', 
                'business',
                // 'is_ordered',
                'user_id',
                'status'
            ];
            if ($request->method() == 'GET') {
                // echo csrf_token();
                echo '<div class="form-control">Welcome to API CRM:: Customer</div>';
                echo '<div >Những trường thông thông tin bắt buộc</div>';
                echo '<ul>';
                foreach ($requiredList as $key => $_attReqired) {
                    echo '<li>'.$_attReqired.'</li>';
                }
                echo '</ul>';
                $this->msg = 'Hệ thống tài liệu được cập nhật tại:';
            } elseif($request->method() == 'POST') {
                $dataArray = json_decode($request->getContent(), true);
                switch ($action) {
                    case 'import':
                        $customer = new customer;
                        /* checking required*/
                        foreach ($requiredList as $key => $_attReqired) {
                            if (preg_match('/^(user_id)/', $_attReqired)) {
                                $dataArray[$_attReqired] = (int)($dataArray[$_attReqired] ?? 0);
                            }
                            if (!isset($dataArray[$_attReqired]) || $dataArray[$_attReqired] === "") {
                                $result['error'][$_attReqired] = 'required';
                            }
                        }
                        $customer->fill($dataArray);
                        $phone = $customer->__get('phone');
                        $phone = preg_replace('/^(\+840|840|\+84|84)/', '0', $phone);
                        $phone = preg_replace('/(,|\.| |-|_)/', '', $phone);
                        /*check phone existed*/
                        if (!is_numeric($phone)) $result['error']['phone'] = $phone . " => must be numeric !";
                        if(strlen($phone) <10 || strlen($phone) > 11) $result['error']['phone'] = $phone . " => must be bewtween 10 and 11 !";
                        if ($customer->where('phone', $phone)->exists()) {
                            $result['error']['phone'] = $phone . " => was existed !";
                        }
                        if (!empty($result['error'])) throw new Exception();
                        $customer->setAttribute('create_at', date_create());
                        // $customer->setAttribute('user_id', 0);
                        if ($customer->save()) {
                            $result['result'] = 'success';
                            $result['id'] = $customer->id;
                            CustomerController::byActivity($customer, 'import_apiinfo')->setAttribute('staff_id', 0)->save();
                            CustomerController::byActivity($customer, 'open_trial')->setAttribute('staff_id', 0)->save();
                            $this->msg = json_encode($result);
                            $this->status = 201;
                        } else {
                            $result['result'] = 'failed';
                        }
                        break;
                    default:
                        break;
                }
            }
        } catch(Exception $e){
            if (!empty($e->getMessage())) $result['message'] = $e->getMessage();
            $this->msg = json_encode($result);
            $this->status = 302;
        } catch (Throwable $e) {
            $this->msg = json_encode(['error' => $e->getMessage()]);
            $this->status = 500;
        }
    }
    /**
     * get province from API UPOS
     * 
     *
     * @return void
     */
    public function get_province(Request $request, $option = null) {
        try{
            $api = new Api();
            $province_list = $api->province_list()->data;
            return $province_list;
        } catch (Throwable $e) {logger($e->getMessage());}
        return null;
    }
    /**
     * get district from API UPOS
     * 
     *
     * @return void
     */
    protected function get_district(Request $request, ?string $action = '', $option = null) 
    {
        try {
            $params = [
                'city_id' => (int)$request->input('province_id'),
            ];
            $api = new Api();
            $district_list = $api->district_list($params)->data;
            $html = '<option value="">'.trans('site.district').'</option>';
            foreach ($district_list as $item) {
                $html .= '<option value="'.($item->district_id ?? '').'">'.($item->district_name ?? '').'</option>';
            }
            echo $html; 
            
        } catch (Exception $e) {logger($e);}
        exit;
    }
    /**
     * get district from API UPOS
     * 
     *
     * @return void
     */
    protected function get_ward(Request $request) {

        try {
            $params = [
                'city_id' => $request->input('province_id'),
                'district_id' => $request->input('district_id'),
            ];

            $api = new Api();
            $ward_list = $api->ward_list($params)->data;
            $html = '<option value="">'.trans('site.district').'</option>';
            foreach ($ward_list as $item) {
                $html .= '<option value="'.($item->ward_id ?? '').'">'.($item->ward_name ?? '').'</option>';
            }
            echo $html; 
        } catch (Exception $e) {logger($e);}
        exit;
    }
}
