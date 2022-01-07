<?php

use Illuminate\Database\Seeder;
use App\Models\{Customer, CustomerType};

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*Customer/ Khách hàng*/
        s('ok men 2');
        // $role = config('roles.models.role')::where('name', '=', 'customer')->first();
        // $codeList = ['Shop Hồng', 'Shop Cúc', 'Shop Trúc', 'Shop Mai', 'Shop Đào', 'Shop Liễu'];
        // // for ($i=0; $i < $element ; $i++) {
        // foreach ($codeList as $key => $code) {
        //     // $code = $codeList[array_rand($codeList)];// .' '. str_pad(random_int(1, 9), 2, 0, STR_PAD_LEFT);
        //     $codeSlugSpace = Str::slug($code, '');
        //     $customer = config('roles.models.defaultUser')::create([
        //         'code' => Str::slug($code),
        //         'name' => $codeSlugSpace,
        //         'email'=> $codeSlugSpace.'@gmail.com',
        //         'password' => bcrypt($codeSlugSpace.'@123'),
        //     ]);
        //     $customer->attachRole($role);
        // }
    }
}
