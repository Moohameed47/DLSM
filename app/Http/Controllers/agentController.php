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
    public function show($id){
        $agent = agents::all()->where('id',$id)->first();
        return $agent == null ? "Not Found" : $agent;
    }
    public function delete($id){
        $agent = agents::where('id',$id)->delete();
        return `$id is Deleted`;    
    }
    public function store(){
        $newAgent = request()->all();
        agents::create($newAgent);
        return `New user has been created`;
    }
}
