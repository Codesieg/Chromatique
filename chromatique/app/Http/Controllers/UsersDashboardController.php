<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersDashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin_browse_mangas');
    }


        /**
     * Show user in database.
     *
     * @return App\Models\User
     */
    public static function read($id)
    {
        // dd(User::find($id));
        return view('usersDashboard/user', [
            'user' => User::find($id)
        ]);
    }

}
