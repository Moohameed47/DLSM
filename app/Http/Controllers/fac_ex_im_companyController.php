<?php

namespace App\Http\Controllers;

use App\Models\fac_ex_im_companies;
use Illuminate\Http\Request;

class fac_ex_im_companyController extends Controller
{

    public function index_fac()
    {
        return fac_ex_im_companies::all()->where('TypeOfCompany',2);
    }
    public function index_ex_im() {
        return fac_ex_im_companies::all()->where('TypeOfCompany',1);
    }
}
