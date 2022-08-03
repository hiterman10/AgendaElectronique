<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class AgendaController extends Controller
{
    protected $rules = [];

    public function createEvent(Request $request)
    {
            $reponse["error"]["code"] = "0";
            if(strtotime($request->startDate) > strtotime($request->endDate)){
                $reponse["error"]["code"] = "1";
                $reponse["error"]["description"] = "The start date must be less than the end date";
                echo json_encode($reponse, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE | JSON_FORCE_OBJECT);
                exit;
            }

            $validator = Validator::make($request->all(), [
                'eventName' => 'bail|required',
                'startDate' => 'bail|required',
                'endDate' => 'bail|required',
                'description' => 'bail|required|max:250',
                'participants' => 'bail'
            ]);

            if ($validator->fails()) {
                $reponse["error"]["code"] = "1";
                $reponse["error"]["description"] = "Validation Error check you informations";
                echo json_encode($reponse, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE | JSON_FORCE_OBJECT);
                exit;
            }

            $create = Agenda::updateOrCreate([
                'id' => $request->eventId,
            ], [
                'name' => $request->eventName,
                'start_date' => $request->startDate,
                'end_date' => $request->endDate,
                'description' => $request->description,
                'participants' => $request->participants
            ]);

            if($create){
                $reponse["message"] = array();
                $reponse["message"]["code"] = "200";
                $reponse["message"]["description"] = "SUCCESS !!!";
                echo json_encode($reponse, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE | JSON_FORCE_OBJECT);
                exit;
            }else{
                $reponse["error"]["code"] = "1";
            }

    }

    public function displayEvent()
    {
        return view('eventlist',[
            'events' => Agenda::get(),
        ]);
    }

    public function addParticipant ()
    {
        $reponse["error"]["code"] = "0";

        $even = Agenda::where('id',$_GET['id'])
            ->update( ['participants' => $_GET['participants'] ]);

        if($even){
            $reponse["message"] = array();
            $reponse["message"]["code"] = "200";
            $reponse["message"]["description"] = "SUCCESS !!!";
            echo json_encode($reponse, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE | JSON_FORCE_OBJECT);
            exit;
        }else{
            $reponse["error"]["code"] = "1";
        }
    }


    public function deleteEvent(Request $request)
    {
        $reponse["error"]["code"] = "0";
        $even= Agenda::find($_GET['id']);
        if($even->delete()){
            $reponse["message"] = array();
            $reponse["message"]["code"] = "200";
            $reponse["message"]["description"] = "SUCCESS !!!";
            echo json_encode($reponse, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE | JSON_FORCE_OBJECT);
            exit;
        }else{
            $reponse["error"]["code"] = "1";
        }
    }


}
