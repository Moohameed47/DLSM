<?php

namespace App\Http\Controllers;

use App\Models\offers;
use App\Models\requests;
use Illuminate\Http\Request;

class requestController extends Controller
{

        public function index()
        {
            return requests::with('client')->whereHas('client')->get();
        }

    public function show($id)
    {
        $requests = requests::all()->where('id', $id)->first();
        return $requests == null ? "Not Found" : $requests;
    }

    public function updateBooking($id) // Booking
    {
        $requestToUpdate = requests::find($id);
        if ($requestToUpdate == null) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $requestToUpdate->update([
            'BestCase' => 1
        ]);
        return response()->json(['message' => 'Now Process => Booking'], 200);
    }

    public function updateLoading($id) // Loading
    {
        $requestToUpdate = requests::find($id);
        if ($requestToUpdate == null) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $requestToUpdate->update([
            'BestCase' => 2
        ]);
        return response()->json(['message' => 'Now Process => Loading'], 200);
    }

    public function updateTrucking($id) // Trucking
    {
        $requestToUpdate = requests::find($id);
        if ($requestToUpdate == null) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $requestToUpdate->update([
            'BestCase' => 3
        ]);
        return response()->json(['message' => 'Now Process => Trucking'], 200);
    }

    public function updateCustom_clearance($id) // Custom clearance
    {
        $requestToUpdate = requests::find($id);
        if ($requestToUpdate == null) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $requestToUpdate->update([
            'BestCase' => 4
        ]);
        return response()->json(['message' => 'Now Process => Custom clearance'], 200);
    }

    public function updateOn_trip($id) // On trip
    {
        $requestToUpdate = requests::find($id);
        if ($requestToUpdate == null) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $requestToUpdate->update([
            'BestCase' => 5
        ]);
        return response()->json(['message' => 'Now Process => On trip'], 200);
    }

    public function updateDone($id) // Done
    {
        $requestToUpdate = requests::find($id);
        if ($requestToUpdate == null) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        $requestToUpdate->update([
            'BestCase' => 6
        ]);
        return response()->json(['message' => 'Now Process => Done'], 200);
    }


    public function current_Process($id)
    {
        $requestToUpdate = requests::find($id);
        return $requestToUpdate->BestCase;
    }

    /*
updateBooking
updateLoading
updateTrucking
updateCustom_clearance
updateOn_trip
updateDone
*/


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
                "Location2" => "required",
                "Destination2" => "required",
                "Comment" => "required",
                "GoodsType" => "required",
            ]);
            requests::create([
                "Location" => $req->Location,
                "Destination" => $req->Destination,
                "Location2" => $req->Location2,
                "Destination2" => $req->Destination2,
                "Comment" => $req->Comment,
                "GoodsType" => $req->GoodsType,
                "TypeOfRequest" => 1,
                "client_id" => $req->client_id,
            ]);
            return response()->json([
                "status" => true,
                "message" => "DHL Request Sent Successfully",
            ]);
        }
        if ($req->req_type == 2) { // That's Mean International
            $req->validate([
                "Location" => "required",
                "Destination" => "required",
                "Location2" => "required",
                "Destination2" => "required",
                "Weight" => "required",
                "GoodsType" => "required",
                "Transport" => "required",
                "CustomsClearness" => "required",
                "Tracking" => "required",
            ]);
            if ($req->Transport == 1) { // That's mean Wild
                requests::create([
                    "Location" => $req->Location,
                    "Destination" => $req->Destination,
                    "Location2" => $req->Location2,
                    "Destination2" => $req->Destination2,
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
                    "CustomsClearness" => $req->CustomsClearness ? $req->CustomsClearness : 0,
                    "Tracking" => $req->Tracking ? $req->Tracking : 0,
                ]);
                return response()->json([
                    "status" => true,
                    "message" => "International ( WILD ) Request Sent Successfully",
                ]);
            } else if ($req->Transport == 2) { // That's mean Sea
                requests::create([
                    "Location" => $req->Location,
                    "Destination" => $req->Destination,
                    "Location2" => $req->Location2,
                    "Destination2" => $req->Destination2,
                    "Comment" => $req->Comment,
                    "GoodsType" => $req->GoodsType,
                    "Weight" => $req->Weight,
                    "Length" => $req->Length,
                    "Width" => $req->Width,
                    "Height" => $req->Height,
                    "ContainerTypeAndSize" => $req->ContainerTypeAndSize,
                    "NumberOfContainer" => $req->NumberOfContainer,
                    "TypeOfRequest" => 2,
                    "TypeOfInternational" => 2,
                    "client_id" => $req->client_id,
                    "CustomsClearness" => $req->CustomsClearness ? $req->CustomsClearness : 0,
                    "Tracking" => $req->Tracking ? $req->Tracking : 0,
                ]);
                return response()->json([
                    "status" => true,
                    "message" => "International ( Sea ) Request Sent Successfully",
                ]);
            } else if ($req->Transport == 3) { // That's mean Air
                requests::create([
                    "Location" => $req->Location,
                    "Destination" => $req->Destination,
                    "Location2" => $req->Location2,
                    "Destination2" => $req->Destination2,
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
                    "CustomsClearness" => $req->CustomsClearness ? $req->CustomsClearness : 0,
                    "Tracking" => $req->Tracking ? $req->Tracking : 0,
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
                    "Location2" =>0,
                    "Destination2" => 0,
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
                    "Location2" =>0,
                    "Destination2" => 0,
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

    public function offers()
    {
        return $this->hasMany(offers::class);
    }
}
