<?php

namespace App\Http\Controllers;

use App\Models\requests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
class requestController extends Controller
{

    public function index_Dhl()
    {
        return requests::all()->where('TypeOfRequest', 1);
    }

    public function index_Wild()
    {
        return requests::all()->where('TypeOfInternational', 1);
    }

    public function index_Sea()
    {
        return requests::all()->where('TypeOfInternational', 2);
    }

    public function index_Air()
    {
        return requests::all()->where('TypeOfInternational', 3);
    }

    public function index_Local()
    {
        return requests::all()->where('TypeOfRequest', 3);
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
            "req_type" => "required",
            "client_id" => "required"
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
                "TypeOfRequest" => 1,
                "client_id" => $req->client_id,
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
            if ($req->Transport == 1) { // That's mean Wild
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
                    "TypeOfRequest" => 2,
                    "TypeOfInternational" => 1,
                    "client_id" => $req->client_id,
                ]);
                return response()->json([
                    "status" => true,
                    "message" => "International ( WILD ) Request Sent Successfully",
                ]);
            } else if ($req->Transport == 2) { // That's mean Sea
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
                    "TypeOfRequest" => 2,
                    "TypeOfInternational" => 2
                ]);
                return response()->json([
                    "status" => true,
                    "message" => "International ( Sea ) Request Sent Successfully",
                ]);
            } else if ($req->Transport == 3) { // That's mean Air
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
                    "TypeOfRequest" => 2,
                    "TypeOfInternational" => 3,
                    "client_id" => $req->client_id,
                ]);
                return response()->json([
                    "status" => true,
                    "message" => "International ( Air ) Request Sent Successfully",
                ]);
            }
        } else if ($req->req_type == 3) { // That's Mean Local
            $req->validate([
                "Country" => "required",
                "Location" => "required",
                "Destination" => "required",
                "GoodsType" => "required",
                "Weight" => "required",
                "Comment" => "required",
            ]);
            if ($req->dangerous == "1") {
                $req->validate([
                    "Safety" => "required",
                ]);
                requests::create([
                    "Country" => $req->Country,
                    "Location" => $req->Location,
                    "Destination" => $req->Destination,
                    "GoodsType" => $req->GoodsType,
                    "Weight" => $req->Weight,
                    "Safety" => $req->Safety,
                    "Comment" => $req->Comment,
                    "TypeOfRequest" => 3,
                    "client_id" => $req->client_id,
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
                    "TypeOfRequest" => 3,
                    "client_id" => $req->client_id,
                ]);
                return response()->json([
                    "status" => true,
                    "message" => "Local Request Sent Successfully",
                ]);
            }
        }
        return response()->json([
            "status" => false,
            "message" => "Request Failed",
        ]);
    }
}
