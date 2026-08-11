<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ScheduleController extends Controller
{
    public function run(Request $request)
    {
        Artisan::call('optimize:clear');
        Artisan::call('schedule:run');

        return responseJson([], 'Schedule executed successfully', 200);
    }
}