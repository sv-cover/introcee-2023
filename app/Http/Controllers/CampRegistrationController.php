<?php

namespace App\Http\Controllers;

use App\Models\ParticipantCamp;
use Illuminate\Http\Request;

class CampRegistrationController extends Controller
{
    public function view() {
        return view('campregistration',
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
            'emergency_contact_name' => 'required',
            'emergency_contact_phone' => 'required',
            'field_of_study' => 'required',
        ]);

        $participant = ParticipantCamp::create($data);
        $participant->first_year = true;
        $participant->fee = 49;
        $participant->terms_and_conditions = request()->terms_and_conditions == 'on';
        $participant->save();
        return redirect(route('payment', ['event' => 'camp', 'id' => $participant->id]));
    }

    public function sign_up_senior(){
        $data = request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'date_of_birth' => 'required',
            'email_address' => 'required',
            'phone_number' => 'required',
            'membership_id' => 'required',
            'emergency_contact_name' => 'required',
            'emergency_contact_phone' => 'required',
            'field_of_study' => 'required',
            'study_year' => 'required',
        ]);
        $participant = ParticipantCamp::create($data);
        $participant->senior = true;
        $participant->fee = 59;
        $participant->terms_and_conditions = request()->terms_and_conditions == 'on';
        $participant->mentor = request()->mentor == 'on';
        $participant->driving_license = request()->driving_license == 'on';
        $participant->introcee = request()->introcee ?? false;
        $participant->photocee = request()->photocee ?? false;
        $participant->herocee = request()->herocee ?? false;
        $participant->board = request()->board ?? false;
        $participant->candidate_board = request()->candidate_board ?? false;
        $participant->save();

        return view('campregistration_confirmed_senior');
    }

    public function confirm(){
        $id = request()->id;
        if(!$id) return redirect(route('home'));
        $participant = ParticipantCamp::find($id);
        if(!$participant) return redirect(route('home'));
        $participant->paid = true;
        $participant->paid_at = now();
        $participant->payment_details = 'INSERT PAYMENT DETAILS HERE';
        $participant->save();

        return view('campregistrationconfirm', ['id' => $id]);
    }

    public static function countFirstYears(){
        return ParticipantCamp::where([
            ['first_year', true],
            ['confirmed', true],
        ])->count();
    }
}
