<?php

namespace App\Http\Controllers;

use App\Models\admins;
use App\Models\clients;
use App\Models\shipping_companies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class registerController extends Controller
{
    public function register(Request $req)
    {
        $req->validate([
            "table_choice" => "required",
        ]);
        if ($req->table_choice == 1) {
            $req->validate([
                "Name" => "required",
                "Email" => "required|email|unique:agents|unique:admins|unique:clients|unique:shipping_companies|unique:fac_ex_im_companies",
                "Password" => "required|confirmed",
                "SSN" => "required|unique:admins|unique:clients",
                "Photo" => "required",
                "Nationality" => "required",
                "PhoneNumber" => "required|unique:agents|unique:clients|unique:shipping_companies|unique:fac_ex_im_companies"
            ]);
            clients::create([
                "Name" => $req->Name,
                "Email" => $req->Email,
                "Password" => Hash::make($req->Password),
                "SSN" => $req->SSN,
                "Photo" => $req->Photo,
                "Nationality" => $req->Nationality,
                "PhoneNumber" => $req->PhoneNumber,
                "TypeOfClient" => 1, //User
            ]);
            return response()->json([
                "status" => true,
                "message" => "Client Registered Successfully",
            ]);
        } else if ($req->table_choice == 2) {
            $req->validate([
                "Name" => "required",
                "Email" => "required|email|unique:agents|unique:admins|unique:clients|unique:shipping_companies|unique:fac_ex_im_companies",
                "Password" => "required|confirmed",
                "Address" => "required",
                "PhoneNumber" => "required|unique:agents|unique:clients|unique:shipping_companies|unique:fac_ex_im_companies",
                "Website" => "required",
                "BusinessHistory" => "required",
                "BusinessHours" => "required",
            ]);
            shipping_companies::create([
                "Name" => $req->Name,
                "Email" => $req->Email,
                "Password" => Hash::make($req->Password),
                "Address" => $req->Address,
                "Website" => $req->Website,
                "BusinessHistory" => $req->BusinessHistory,
                "BusinessHours" => $req->BusinessHours,
                "PhoneNumber" => $req->PhoneNumber,
            ]);
            return response()->json([
                "status" => true,
                "message" => "Shipping_Company Registered Successfully",
            ]);
        } else if ($req->table_choice == 3) {
            $req->validate([
                "Name" => "required",
                "Email" => "required|email|unique:agents|unique:admins|unique:clients|unique:shipping_companies|unique:fac_ex_im_companies",
                "Password" => "required|confirmed",
                "PhoneNumber" => "required|unique:agents|unique:clients|unique:shipping_companies|unique:fac_ex_im_companies",
                "Address" => "required",
                "Website" => "required",
                "TaxCard" => "required",
                "CommercialRecord" => "required",
                "IndustrialRecord" => "required",
                "CountryDealing" => "required",
                "CountryTarget" => "required",
            ]);
            clients::create([
                "Name" => $req->Name,
                "Email" => $req->Email,
                "Password" => Hash::make($req->Password),
                "PhoneNumber" => $req->PhoneNumber,
                "Address" => $req->Address,
                "Website" => $req->Website,
                "TaxCard" => $req->TaxCard,
                "CommercialRecord" => $req->CommercialRecord,
                "IndustrialRecord" => $req->IndustrialRecord,
                "CountryDealing" => $req->CountryDealing,
                "CountryTarget" => $req->CountryTarget,
                "TypeOfClient" => 2,   //Thats Mean Ex-Im Company
            ]);
            return response()->json([
                "status" => true,
                "message" => "Export-Import_Company Registered Successfully",
            ]);
        } else if ($req->table_choice == 4) {
            $req->validate([
                "Name" => "required",
                "Email" => "required|email|unique:agents|unique:admins|unique:clients|unique:shipping_companies|unique:fac_ex_im_companies",
                "Password" => "required|confirmed",
                "PhoneNumber" => "required|unique:agents|unique:clients|unique:shipping_companies|unique:fac_ex_im_companies",
                "Website" => "required",
                "CommercialRecord" => "required",
                "IndustrialRecord" => "required",
                "Address" => "required",
                "CountryDealing" => "required",
                "CountryTarget" => "required",
            ]);
            clients::create([
                "Name" => $req->Name,
                "Email" => $req->Email,
                "Password" => Hash::make($req->Password),
                "Address" => $req->Address,
                "PhoneNumber" => $req->PhoneNumber,
                "Website" => $req->Website,
                "CommercialRecord" => $req->CommercialRecord,
                "IndustrialRecord" => $req->IndustrialRecord,
                "CountryDealing" => $req->CountryDealing,
                "CountryTarget" => $req->CountryTarget,
                "TypeOfCompany" => 3, //Thats Mean Factory Company
            ]);
            return response()->json([
                "status" => true,
                "message" => "Factory Registered Successfully",
            ]);
        } else if ($req->table_choice == 5) {
            $req->validate([
                "Name" => "required",
                "Email" => "required|email|unique:agents|unique:admins|unique:clients|unique:shipping_companies|unique:fac_ex_im_companies",
                "Password" => "required|confirmed",
                "SSN" => "required|unique:admins|unique:clients",
            ]);
            admins::create([
                "Name" => $req->Name,
                "Email" => $req->Email,
                "Password" => Hash::make($req->Password),
                "SSN" => $req->SSN,
            ]);
            return response()->json([
                "status" => true,
                "message" => "Admin Registered Successfully"
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "Invalid Table_Choice"
            ]);
        }
    }
}
