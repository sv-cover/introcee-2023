<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\ParticipantBarbecue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BarbecueController extends Controller {
    public function view() {
        return view('barbecue',
            [
                'type' => request()->type ?? 'first_year',
            ]);
    }

    public function sign_up_first_year(){
        $data = request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'date_of_birth' => 'required',
            'email_address' => 'required',
            'phone_number' => 'required',
            'student_number' => 'required',
            'field_of_study' => 'required',
        ]);

        $participant = ParticipantBarbecue::create($data);
        $participant->first_year = true;
        $participant->fee = 3.5;
        $participant->terms_and_conditions = request()->terms_and_conditions == 'on';
        $participant->dietary_requirements = request()->dietary_requirements ?? '';
        $participant->remarks = request()->remarks ?? '';
        $participant->save();

        return redirect(route('payment', ['event' => 'bbq', 'id' => $participant->id]));
    }

    public function sign_up_senior(){
        $data = request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'date_of_birth' => 'required',
            'email_address' => 'required',
            'phone_number' => 'required',
            'membership_id' => 'required',
            'field_of_study' => 'required',
            'study_year' => 'required',
        ]);
        $participant = ParticipantBarbecue::create($data);
        $participant->senior = true;
        $participant->fee = 3.5;
        $participant->terms_and_conditions = request()->terms_and_conditions == 'on';
        $participant->mentor = request()->mentor == 'on';
        $participant->introcee = request()->introcee ?? false;
        $participant->photocee = request()->photocee ?? false;
        $participant->herocee = request()->herocee ?? false;
        $participant->board = request()->board ?? false;
        $participant->candidate_board = request()->candidate_board ?? false;
        $participant->dietary_requirements = request()->dietary_requirements ?? '';
        $participant->remarks = request()->remarks ?? '';
        $participant->save();

        return redirect(route('payment', ['event' => 'bbq', 'id' => $participant->id]));
    }

    public static function isFull(){
        $participants = ParticipantBarbecue::where('confirmed' , true)->count();
        return $participants >= 250;
    }
}
