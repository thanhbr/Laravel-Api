<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Customer, Shop};
use Illuminate\Support\Str;

class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*Customer/ Khách hàng*/
        $role = config('roles.models.role')::where('name', '=', 'customer')->first();
        $codeList = [
            'Shop Hồng', 'Shop Cúc', 'Shop Trúc', 'Shop Mai', 'Shop Đào', 'Shop Liễu',
            'Cửa hàng Đồ chơi thế kỷ', 'Cửa hàng Kỷ Băng Hà', 'Cửa hàng Thời trang', 'Cửa hàng đồ chơi thông minh', 'Cửa hàng Mẹ và bé',
            'Anh Lương', 'Anh Lộc', 'Anh Linh', 'Anh Long', 'Anh Lâm',
            'Chị Đào', 'Chị Mai', 'Chị Cúc', 'Chị Trúc', 'Chị Liễu',
            'Đoàn Văn Hậu', 'Nguyễn Tiến Linh', 'Phan Nhật Cường', 'Nguyễn Bá Hào','Đặng Văn Mách', 'Lê Văn Sĩ Lẻ',
            'Vũ Khắc Tiệp', 'Trương Mạnh Quỳnh','Đào Bá Lộc', 'Kỳ Anh', 'Hùng Bá',
        ];
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
                'created_at' => '2021-11-01 09:00:00',
            ]);
            /*fake shop*/
            Shop::create([
                'code'      => $customer->code,
                'name'      => $customer->name,
                'customer_id'   => $customer->id,
                'created_at' => '2021-11-01 09:00:00',
            ]);
        }
    }
}
