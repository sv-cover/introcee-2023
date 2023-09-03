<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\ParticipantBarbecue;
use App\Models\ParticipantCamp;
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

    public static function send_last_email(){
        $participants = ParticipantBarbecue::all();
        forEach($participants as $participant)
            if($participant->confirmed && !$participant->email_sent){
                $wallet = $participant->getWallet();
                $mail_body = 'Dear ' . $participant->first_name . ',<br><br>
                As the barbecue is coming close, here is some information about paying for drinks at the bar. The bar staff
                will ask you to show them your QR code. Here is your QR:
                <br><br>
                <img src="https://chart.googleapis.com/chart?cht=qr&chs=200x200&chl='.$wallet->id.'" style="margin:auto;display:block;" />
                <br><br>Please take a screenshot of this QR code or save it to your phone to make things smoother. Alternatively, you can
                add your wallet website page to the home screen of your phone for easy access of the QR, purchase history and top-up.
                <br><br>If you haven\'t done so already, please top up your account. Paying with card or cash will not be possible. After the
                introduction events, the remaining funds will be reimbursed.<br><br>
                Right now, the balance of your wallet is <b>€ '.$wallet->balance.'.</b><br><br>
                We\'re looking forward to seeing you at the barbecue!';
                $button_text = 'Go to my wallet';
                $button_link = route('wallet', ['id' => $participant->getWallet()->id]);
                $subject = 'Last Information for Cover Introductory Barcue';
                $title = 'The barbecue is around the corner!';
                $mailData = [
                    'title' => $title,
                    'body' => $mail_body,
                    'buttonlink' => $button_link,
                    'buttontext' => $button_text
                ];
                Mail::to($participant->email_address)->send(new SendMail($mailData, $subject));
                $participant->email_sent = true;
                $participant->save();
            }
        return redirect(route('backoffice.bbq'));
    }
}
