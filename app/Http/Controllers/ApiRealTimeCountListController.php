<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ApiRealTimeCountListController extends Controller
{
    public function getTotalCount($list)
    {
        try {
            // Get the total count dynamically from the table
            $count = DB::table($list)->count();

            return response()->json(['total' => $count]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Invalid list name or table does not exist'], 400);
        }
    }
}
