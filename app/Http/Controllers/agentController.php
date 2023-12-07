<?php

namespace App\Http\Controllers;

use App\Models\agents;
use Illuminate\Http\Request;

class agentController extends Controller
{
    public function index()
    {
        $agent = agents::all();
        return $agent;
    }
}
