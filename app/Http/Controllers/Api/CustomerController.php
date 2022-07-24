<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function allUser()
    {
        $user = Customers::with(['active_profile.media'])->where('id','!=',Auth::id())->paginate(10);
        return response()->json($user);
    }
}
