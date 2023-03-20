<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DashboardController extends Controller
{
    public function generalReport(){
        $totalSuppliers=Supplier::count();
        $totalCategories=Category::count();
        $totalAdmin=User::count();
        // dd("hi");
        return response(
            [
                'totalSuppliers'=>$totalSuppliers,
                'totalCategories'=>$totalCategories,
                'totalAdmin'=>$totalAdmin,
            ],
            Response::HTTP_OK
        );
    }
}
