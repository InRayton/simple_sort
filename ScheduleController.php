<?php

namespace App\Http\Controllers;

use App\Services\ScheduleService;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        return view('schedule.form');
    }

    public function generate(Request $request, ScheduleService $service)
    {
        $startDate = $request->input('start_date', date('Y-m-d'));
        $data = $service->generate_schedule($startDate);
        return view('schedule.page', $data);
    }
}
