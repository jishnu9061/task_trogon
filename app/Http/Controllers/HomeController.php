<?php

/**
 * Created By: JISHNU T K
 * Date: 2024/06/12
 * Time: 16:18:25
 * Description: HomeController.php
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function showProducts()
    {
        return view('pages.index');
    }
}
