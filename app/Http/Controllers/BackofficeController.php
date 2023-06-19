<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\ParticipantCamp;
use \App\Models\ParticipantBarbecue;

class BackofficeController extends Controller
{
    public function index(){
        return view('backoffice.main');
    }

    public function camp(){
        return view('backoffice.camp');
    }

    public function bbq(){
        return view('backoffice.bbq');
    }

    public function camp_participant(){
        if(!isset($_GET['id'])){
            return redirect()->route('backoffice.camp');
        }
        $participant = ParticipantCamp::where('id', request()->id)->first();
        if(!$participant){
            return redirect()->route('backoffice.camp');
        }
        return view('backoffice.camp_participant', ['participant' => $participant]);
    }

    public function bbq_participant(){
        if(!isset($_GET['id'])){
            return redirect()->route('backoffice.bbq');
        }
        $participant = ParticipantBarbecue::where('id', request()->id)->first();
        if(!$participant){
            return redirect()->route('backoffice.bbq');
        }
        return view('backoffice.bbq_participant', ['participant' => $participant]);
    }
}
