<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\requests;
use Illuminate\Support\Facades\Hash;

class requestController extends Controller
{

    public function index()
    {
        return requests::all();
    }

    public function show($id)
    {
        $requests = requests::all()->where('id', $id)->first();
        return $requests == null ? "Not Found" : $requests;
    }

    public function delete($id)
    {
        $requests = requests::all()->where('id', $id)->delete();
        return `The request with id = $id is Deleted`;
    }

    public function store(Request $req)
    {
        $req->validate([
            "req_type" => "required"
        ]);
        if ($req->req_type == 1) { // That's Mean DHL
            $req->validate([
                "Location" => "required",
                "Destination" => "required",
                "Comment" => "required",
                "GoodsType" => "required",
            ]);
            requests::create([
                "Location" => $req->Location,
                "Destination" => $req->Destination,
                "Comment" => $req->Comment,
                "GoodsType" => $req->GoodsType,
            ]);
            return response()->json([
                "status" => true,
                "message" => "DHL Request Sent Successfully",
            ]);
        } else if ($req->req_type == 2) { // That's Mean International
            $req->validate([
                "Location" => "required",
                "Destination" => "required",
                "Weight" => "required",
                "Length" => "required",
                "Width" => "required",
                "Height" => "required",
                "Comment" => "required",
                "GoodsType" => "required",
                "Transport" => "required",
            ]);
            if ($req->Transport == 1){ // That's mean Wild
                requests::create([
                    "Location" => $req->Location,
                    "Destination" => $req->Destination,
                    "Comment" => $req->Comment,
                    "GoodsType" => $req->GoodsType,
                    "Weight" => $req->Weight,
                    "Length" => $req->Length,
                    "Width" => $req->Width,
                    "Height" => $req->Height,
                    "TypesOfTruck" => $req->TypesOfTruck,
                    "WeightOfSingleCarton" => $req->WeightOfSingleCartoon,
                ]);
                return response()->json([
                    "status" => true,
                    "message" => "International ( WILD ) Request Sent Successfully",
                ]);
            }
            else if ($req->Transport == 2){ // That's mean Sea
                requests::create([
                    "Location" => $req->Location,
                    "Destination" => $req->Destination,
                    "Comment" => $req->Comment,
                    "GoodsType" => $req->GoodsType,
                    "Weight" => $req->Weight,
                    "Length" => $req->Length,
                    "Width" => $req->Width,
                    "Height" => $req->Height,
                    "ContainerTypeAndSize" => $req->ContainerTypeAndSize,
                    "NumberOfContainer" => $req->NumberOfContainer,
                ]);
                return response()->json([
                    "status" => true,
                    "message" => "International ( Sea ) Request Sent Successfully",
                ]);
            } else if ($req->Transport == 3){ // That's mean Air
                requests::create([
                    "Location" => $req->Location,
                    "Destination" => $req->Destination,
                    "Comment" => $req->Comment,
                    "GoodsType" => $req->GoodsType,
                    "Weight" => $req->Weight,
                    "Length" => $req->Length,
                    "Width" => $req->Width,
                    "Height" => $req->Height,
                    "NumberOfCartons" => $req->NumberOfCartons,
                    "WeightOfSingleCarton" => $req->WeightOfSingleCarton,
                ]);
                return response()->json([
                    "status" => true,
                    "message" => "International ( Air ) Request Sent Successfully",
                ]);
            }
        } else if ($req->req_type == 2) { // That's Mean Local
            $req->validate([
                "Location" => "required",
                "Destination" => "required",
                "Weight" => "required",
                "Length" => "required",
                "Width" => "required",
                "Height" => "required",
                "Comment" => "required",
                "GoodsType" => "required",
                "Transport" => "required",
            ]);
            if ($req->Transport == 1){ // That's mean Wild
                if($req->dangerous){
                    requests::create([
                        "Country" => $req->Country,
                        "Location" => $req->Location,
                        "Destination" => $req->Destination,
                        "Comment" => $req->Comment,
                        "GoodsType" => $req->GoodsType,
                        "Weight" => $req->Weight,
                        "Safety" => $req->Safety,
                    ]);
                    return response()->json([
                        "status" => true,
                        "message" => "Local Request Sent Successfully",
                    ]);
                } else {
                    requests::create([
                        "Country" => $req->Country,
                        "Location" => $req->Location,
                        "Destination" => $req->Destination,
                        "Comment" => $req->Comment,
                        "GoodsType" => $req->GoodsType,
                        "Weight" => $req->Weight,
                    ]);
                    return response()->json([
                        "status" => true,
                        "message" => "Local Request Sent Successfully",
                    ]);
                }
            }
        }   
    }
}
