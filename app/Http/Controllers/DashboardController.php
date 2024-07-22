<?php

namespace App\Http\Controllers;

use App\Models\Crops;
use App\Models\FarmPlans;
use App\Models\Livestock;
use App\Models\Procurement;
use App\Models\Research;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            "data" => $this->dashboardData()
        ]);
    }

    public function dashboardData(): array
    {
        return [
            [
                "name" => "Total Crops",
                "value" => Crops::query()->get()->count()
            ], [
                "name" => "Total Livestock's",
                "value" => Livestock::query()->get()->count()
            ], [
                "name" => "Total Farm Plans",
                "value" => FarmPlans::query()->get()->count()
            ], [
                "name" => "Total Procurements",
                "value" => Procurement::query()->get()->count()
            ], [
                "name" => "Total Researches",
                "value" => Research::query()->get()->count()
            ]

        ];
    }


}
