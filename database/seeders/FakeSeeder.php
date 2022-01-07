<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\{Warehouse, Status, Type, WarehouseType, SupplierType, GoodsNote, GoodsNoteType, Package, PackageItem};
use App\Models\{Category, Item, Brand};
use App\Models\{Customer, CustomerType, Shop, Order};

class FakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->customers();
        // $this->orderByCustomer();
    }
    /**/
    public function customers()
    {
        /*Customer/ Khách hàng*/
        $customerCounter = 0;
        $shopCounter = 0;
        $role = config('roles.models.role')::where('name', '=', 'customer')->first();
        $codeList = [
            'Shop Hồng', 'Shop Cúc', 'Shop Trúc', 'Shop Mai', 'Shop Đào', 'Shop Liễu',
            'Cửa hàng Đồ chơi thế kỷ', 'Cửa hàng Kỷ Băng Hà', 'Cửa hàng Thời trang', 'Cửa hàng đồ chơi thông minh', 'Cửa hàng Mẹ và bé',
            'Anh Lương', 'Anh Lộc', 'Anh Linh', 'Anh Long', 'Anh Lâm',
            'Chị Đào', 'Chị Mai', 'Chị Cúc', 'Chị Trúc', 'Chị Liễu',
            'Đoàn Văn Hậu', 'Nguyễn Tiến Linh', 'Phan Nhật Cường', 'Nguyễn Bá Hào','Đặng Văn Mách', 'Lê Văn Sĩ Lẻ',
            'Vũ Khắc Tiệp', 'Trương Mạnh Quỳnh','Đào Bá Lộc', 'Kỳ Anh', 'Hùng Bá',
        ];
        $statusList = Status::getListKVByPrefix('customer');
        foreach ($codeList as $key => $code) {
            // $code = $code . str_pad(random_int(1, 999), 3, 0, STR_PAD_LEFT);
            $codeSlugSpace = Str::slug($code, '');
            
            $user = config('roles.models.defaultUser')::create([
                'code' => Str::slug($code),
                'name' => $codeSlugSpace,
                'email'=> $codeSlugSpace.'@gmail.com',
                'password' => bcrypt($codeSlugSpace.'@123'),
                'created_at' => '2021-11-01 09:00:00',
            ]);
            $user->attachRole($role);
            /*fake customer*/
            $customer = Customer::create([
                'code' => $codeSlugSpace,
                'name' => $code,
                'user_id' => $user->id,
                'phone' =>  '0708'. random_int(100000, 999999),
                'status_id' => array_rand($statusList),
                'created_at' => '2021-11-01 09:00:00',
            ]);
            $customerCounter ++;
            /*fake shop*/
            $shop = Shop::create([
                'code'      => $customer->code,
                'name'      => $customer->name,
                'customer_id'   => $customer->id,
                'created_at' => '2021-11-01 09:00:00',
            ]);
        }
        echo "---Insert customer:: " . $customerCounter . " -----" . PHP_EOL;
        return true;
    }
    /**
     * 
     * 
     */
    public function orderByCustomer($value='')
    {
        $customerList = Customer::getListKVByPrefix(null, 'code');
        // $warehouseList = Warehouse::getListKVByPrefix(null, 'code');
        $typeImport = Type::where('prefix','order')->where('code', 'import')->first();
        $typeExport = Type::where('prefix','order')->where('code', 'export')->first();
        $statusList = Status::getListKVByPrefix('order', 'name');
        // dd($statusList);
        $totalOrder = 0;

        foreach ($customerList as $customer_id => $customer_code) {
            $firstShopID = Shop::where('customer_id', $customer_id)->first()->id ?? '';
            $itemCollection = Item::where('customer_id', $customer_id)->get();
            $itemList = [];
            foreach ($itemCollection as $key => $_item) {
                $itemList[$_item->id] = $_item->__get('name');
            }
            $goodsIssueNotes  = random_int(10, 20);
            for ($i=0; $i < $goodsIssueNotes ; $i++) {
                $totalOrder ++;
                $order = Order::create([
                    'code' => 'JQK'.$customer_id.random_int(1000,9999),
                    'shop_id'   => $firstShopID,
                    // 'warehouse_id'  => array_rand($warehouseList),
                    'type_id'       => array_rand(array_flip([$typeImport->id, $typeExport->id])),
                    'status_id'     => array_rand($statusList),
                    // 'shipcode'      => '',//array_rand(array_flip(['JNT', 'VTP', 'SEC', 'VNP'])).str_pad(random_int(1000, 999999), 6, 0, STR_PAD_LEFT),
                ]);
                $packagesRandom = random_int(0, 10);
                for ($j=0; $j < $packagesRandom ; $j++) {
                    $package = Package::create([
                        'code' => 'WJNT'.str_pad(random_int(1, 999999), 6, 0, STR_PAD_LEFT).date('Hi'),
                        'order_id' => $order->id,                        
                    ]);
                    /*add item*/
                    $randItem = random_int(0, 10);
                    for ($k=0; $k < $randItem ; $k++) { 
                        // s(array_rand($itemList));
                        PackageItem::create([
                            'item_id' => array_rand($itemList),
                            'package_id' => $package->id,
                            'quantity'   => random_int(1, 20),
                        ]);
                    }
                }
                echo "The order: " . $totalOrder . PHP_EOL;
            }
        }
        echo "Sum: " . ($totalOrder). PHP_EOL;
    }   
}
