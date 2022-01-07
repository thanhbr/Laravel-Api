<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\Logger;

class AdminDetailsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listRoutes()
    {
        $routes = Route::getRoutes();
        $data = [
            'routes' => $routes,
        ];
        return view('pages.admin.route-details', $data);
    }

    /**
     * Display active users page.
     *
     * @return \Illuminate\Http\Response
     */
    public function activeUsers()
    {
        $users = User::count();

        return view('pages.admin.active-users', ['users' => $users]);
    }
    /**
     * 
     * 
     * */
    public function dev($case = null)
    {
        $user = \Auth::user();
        echo '<div class="" style="border:1px solid red; border-radius:5px; height:90%; padding:20px; overscroll:scroll">';
            echo "Hi, $user->name";
            echo '<hr>';
            

        echo '</div>';
    }

    private function sendMail(){

        !d(Mail::to('nptoan193@gmail.com')->send((new Logger)->preview()));

    }


}
