<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\{Warehouse, Status, Type, WarehouseType, SupplierType, GoodsNote, GoodsNoteType};
use App\Models\{Package, PackageMaterialStandard, PackageDimensionStandard};
use App\Models\{Category, Item, Brand};
use App\Models\{Customer, CustomerOrigin, CustomerType};

class InitialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->roles();
        $this->users();

        $this->statuses();
        $this->customer_origins();
        // $this->types();
        // $this->categories();
        

        // /**/

    }
    /**
     * @todo only for the first initial and setup. To create some accounts by role
     * 
     * */
    public function users($element = 20)
    {
        $adminRole = config('roles.models.role')::where('name', '=', 'admin')->first();
        // admin
        if (config('roles.models.defaultUser')::where('email', '=', 'ghunter.dev@gmail.com')->first() === null) {
            $newUser = config('roles.models.defaultUser')::create([
                'code'      => 'admin',
                'name'      => 'admin',
                'email'     => 'ghunter.dev@gmail.com',
                'password'  => bcrypt('admin@123'),
            ]);
            
            $newUser->attachRole($adminRole);
            // foreach ($permissions as $permission) {
            //     $newUser->attachPermission($permission);
            // }
        }
        /*Operation Manager*/
        $operationManager = config('roles.models.defaultUser')::create([
            'code'      => 'hangnguyen',
            'name'      => 'hangnguyen',
            'email'     => 'hang.nguyen@upos.vn',
            'password'  => bcrypt('hangnguyen@123'),
        ]);
        $operationManager->attachRole(config('roles.models.role')::where('name', '=', 'operationmanager')->first());
        $operationManager->attachRole(config('roles.models.role')::where('name', '=', 'sale')->first());
    }
    public function customers($value='')
    {        
        /*Customer/ Khách hàng*/
        (new CustomersSeeder)->run();
    }
    public function roles()
    {
        /*
         * Role Types
         *
         */
        $RoleItems = [
            [
                'name'       => 'admin',
                'slug'       => 'admin',
                'description' => 'Admin Role',
                'level'      => 9,
            ],[
                'name'       => 'operationmanager',
                'slug'       => 'operation.manager',
                'description' => 'Operation Manager',
                'level'      => 8,
            ],
            [
                'name'       => 'accountant',
                'slug'       => 'accountant',
                'description' => 'Accountant',
                'level'      => 3,
            ],
            [
                'name'       => 'sale',
                'slug'       => 'sale',
                'description' => 'Sale Role',
                'level'      => 1,
            ]
        ];

        /*
         * Add Role Items
         *
         */
        foreach ($RoleItems as $RoleItem) {
            $newRoleItem = config('roles.models.role')::where('slug', '=', $RoleItem['slug'])->first();
            if ($newRoleItem === null) {
                $newRoleItem = config('roles.models.role')::create([
                    'name'         => $RoleItem['name'],
                    'slug'         => $RoleItem['slug'],
                    'description'  => $RoleItem['description'],
                    'level'        => $RoleItem['level'],
                ]);
            }
        }
    }
    /**
     * @author toannguyen
     * @todo
     * 
     * */
    public function statuses()
    {
        /*for warehouse*/
        $prefix = 'customer';
        Status::create()->fill(['code' => 'new', 'name' =>'KH mới', 'prefix' =>$prefix])->save();
        Status::create()->fill(['code' => 'contracted', 'name' =>'Đã liên hệ', 'prefix' =>$prefix])->save();
        Status::create()->fill(['code' => 'consulting', 'name' =>'Đang tư vấn', 'prefix' =>$prefix])->save();
        Status::create()->fill(['code' => 'lossed', 'name' =>'Không liên hệ được', 'prefix' =>$prefix])->save();
        Status::create()->fill(['code' => 'refuse', 'name' =>'Từ chối', 'prefix' =>$prefix])->save();
        Status::create()->fill(['code' => 'trial', 'name' =>'Đang dùng thử', 'prefix' =>$prefix])->save();
        Status::create()->fill(['code' => 'tried', 'name' =>'Hết hạn dùng thử', 'prefix' =>$prefix])->save();
    }

    /**
     * @author toannguyen
     * @todo
     * 
     * */
    public function types()
    {
        /*for warehouse*/
        WarehouseType::create()->fill(['code' => 'eco-std','name' =>'Kho thương mại chuẩn'])->save();
        WarehouseType::create()->fill(['code' => 'eco-vip','name' =>'Kho thương mại VIP'])->save();
        WarehouseType::create()->fill(['code' => 'agr-std','name' =>'Kho Nông sản chuẩn'])->save();
        WarehouseType::create()->fill(['code' => 'agr-vip','name' =>'Kho Nông sản VIP'])->save();
        /*for warehouse*/
        SupplierType::create()->fill(['code' => 'eco-std','name' =>'Nhà cung cấp 1'])->save();
        SupplierType::create()->fill(['code' => 'eco-vip','name' =>'Nhà cung cấp 2'])->save();
        SupplierType::create()->fill(['code' => 'agr-std','name' =>'Nhà cung cấp 3'])->save();
        SupplierType::create()->fill(['code' => 'agr-vip','name' =>'Nhà cung cấp 4'])->save();
        /*for CustomerType*/
        CustomerType::create()->fill(['code' => 'shop-online','name' =>'Shop Online'])->save();
        CustomerType::create()->fill(['code' => 'shop-private','name' =>'Cửa hàng tư nhân'])->save();
        CustomerType::create()->fill(['code' => 'company-tiny','name' =>'Doanh nghiệp nhỏ'])->save();
        CustomerType::create()->fill(['code' => 'company-medium','name' =>'Doanh nghiệp vừa'])->save();
        /*for GoodsNoteType*/
        GoodsNoteType::create()->fill(['code' => 'import','name' =>'Phiếu nhập hàng'])->save();
        GoodsNoteType::create()->fill(['code' => 'export','name' =>'Phiếu xuất hàng'])->save();
        GoodsNoteType::create()->fill(['code' => 'exchange','name' =>'Phiếu điều chuyển'])->save();
        GoodsNoteType::create()->fill(['code' => 'destroy','name' =>'Phiếu hủy hàng hóa'])->save();

        /*for GoodsNoteType*/
        $prefix = 'material';
        Type::create()->fill(['code' => 'carton','name' =>'Thùng Carton', 'prefix' => $prefix])->save();
        Type::create()->fill(['code' => 'paper','name' =>'Giấy', 'prefix' => $prefix])->save();
        Type::create()->fill(['code' => 'nylonbag','name' =>'Túi Nilon', 'prefix' => $prefix])->save();

        /*for order*/
        $prefix = 'order';
        Type::create()->fill(['code' => 'import','name' =>'Đơn nhập', 'prefix' => $prefix])->save();
        Type::create()->fill(['code' => 'export','name' =>'Đơn xuất', 'prefix' => $prefix])->save();
        // Type::create()->fill(['code' => 'interchange','name' =>'Điều chuyển', 'prefix' => $prefix])->save();
    }
    /**
     * @author toannguyen
     * @todo
     * 
     * */
    public function categories($element = 20)
    {
        /*for production::default*/
        Category::create()->fill(['code' => 'cat-1','name' =>'Điện tử, có giá trị cao', 'description'=>"Bọc bằng những vật liệu chống va đập, dùng băng bình cố định, dùng thùng carton 3 hoặc 5 lớp có kích thước phù hợp"])->save();
        Category::create()->fill(['code' => 'cat-2','name' =>'Thủy tinh gốm sứ', 'description'=>"Dùng túi bóng bọc các cạnh sản phẩm 3-5 lớp, đóng trong thùng carton 5 lớp, chèn xốp, mút kình các bờ mặt"])->save();
        Category::create()->fill(['code' => 'cat-3','name' =>'Mỹ phẩm', 'description'=>"Đảm bảo bao bọc kỹ, kín, chèn vật liệu chống va đập và thấm nước để lấp đầy không gian hộp"])->save();
        Category::create()->fill(['code' => 'cat-4','name' =>'Sách, văn phòng phẩm', 'description'=>'Bọc nilon để tránh không bị xước và đặt trong hộp giấy carton.'])->save();
        Category::create()->fill(['code' => 'cat-5','name' =>'Thực phẩm khô', 'description'=>"Bao bì kín: bao bọc toàn bộ tránh mọi yếu tố thời tiết và bên ngoài gây hư hỏng thực phẩm Bao bì hở: sử dụng cho các sản phẩm sử dụng ngay, không cần bảo quản lâu"])->save();
        Category::create()->fill(['code' => 'cat-6','name' =>'Quần áo', 'description'=>'Bọc bên ngoài bằng túi nilong và sử dụng băng keo để dán kín túi.'])->save();
        Category::create()->fill(['code' => 'cat-7','name' =>'Đồ gia dụng', 'description'=>"Sử dụng các vật liệu xốp hoặc giấy bóng khí chèn 6 mặt của hàng hóa trước khi đặt vào thùng carton.Sử dụng thùng carton 3 lớp"])->save();
        /*for etc*/;
    }
    /**
     * 
     * 
     */
    public function customer_origins()
    {
        CustomerOrigin::create(['code'  => 'website','name'  => 'Website','description'   => 'Nguồn từ GG Ads, SEO...',]);
        CustomerOrigin::create(['code'  => 'landingpage','name'  => 'Landing page','description'   => '',]);
        CustomerOrigin::create(['code'  => 'telesales','name'  => 'Telesales','description'   => 'công ty cung cấp danh sách khách hàng và nhân viên chủ động gọi mời khách',]);
        CustomerOrigin::create(['code'  => 'email_mkt','name'  => 'Email marketing','description'   => '',]);
        CustomerOrigin::create(['code'  => 'sms_mkt','name'  => 'SMS marketing','description'   => '',]);
        CustomerOrigin::create(['code'  => 'social','name'  => 'Social media','description'   => 'Zalo, facebook, Youtube',]);
        CustomerOrigin::create(['code'  => 'direct','name'  => 'Direct sales','description'   => 'khách hàng do chính nhân viên kinh doanh tìm về',]);
        CustomerOrigin::create(['code'  => 'referral','name'  => 'Referral','description'   => 'Khách hàng do bưu cục giới thiệu',]);
        CustomerOrigin::create(['code'  => 'offline','name'  => 'Sự kiện offline','description'   => 'khách hàng từ hoạt động marketing ở hội chợ, triển lãm...',]);
        CustomerOrigin::create(['code'  => 'convert','name'  => 'Đồng bộ','description'   => 'khách hàng được đồng bộ từ khách hàng đang sử dụng trên hệ thống khachhang.upos.vn',]);
    }

}
