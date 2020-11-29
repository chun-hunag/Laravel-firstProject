<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\InspiringService;

class InspiringController extends Controller
{   
    private $service;
    function __construct(InspiringService $inspiringService)
    {
        $this->service = $inspiringService;
    }
    public function inspire()
    {
        return $this->service->inspire();
    }
}
    