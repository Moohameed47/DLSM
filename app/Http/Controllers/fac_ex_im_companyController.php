<?php

namespace App\Http\Controllers;

use App\Models\fac_ex_im_companies;
use Illuminate\Http\Request;

class fac_ex_im_companyController extends Controller
{

    public function index()
    {
        return fac_ex_im_companies::all();
    }}
