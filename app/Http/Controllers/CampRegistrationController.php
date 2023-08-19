<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use App\Models\Bus;
use Illuminate\Support\Facades\Mail;
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
        $participant->dietary_requirements = request()->dietary_requirements ?? '';
        $participant->remarks = request()->remarks ?? '';
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
        $participant->dietary_requirements = request()->dietary_requirements ?? '';
        $participant->remarks = request()->remarks ?? '';
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

    public static function get_min_bus(){
        $min = 99999;
        $minBus = null;
        foreach(Bus::all() as $bus){
            if(!$bus->is_full() && $bus->get_count() < $min){
                $minBus = $bus;
            }
        }
        return $minBus;
    }

    public static function send_last_email(){
        $participants = ParticipantCamp::all();
        forEach($participants as $participant)
            if($participant->confirmed && !$participant->email_sent){
                if(!$participant->bus){
                    $minBus = self::get_min_bus();
                    if($minBus){
                        $participant->bus = $minBus->id;
                        $participant->save();
                    }
                }
                $mail_body = 'Dear ' . $participant->first_name . ',<br><br>
                As we are coming closer to the camp, here is some important information: <br><br>
                On <b>Friday, September 10</b>, the buses will depart at 15:00. Please gather at 14:50 at the designated
                spot (<a href="https://goo.gl/maps/GAXAjBiL2BKNhmTg9">click here</a>). While boarding the bus, please show
                this QR code to the IntroCee representatives checking you in:<br><br>
                <img src="https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl='.$participant->id.'" style="margin:auto;display:block;" />
                <br><br>Please only board your assigned bus number. Your bus number is:<br><br>
                <span style="font-weight: bold;font-size:30px;text-align: center;">Bus '.$participant->bus()->first()->bus_number.'</span><br><br>Please keep this email ready in the bus as well, as you will receive your bracelet and barcode during the trip.<br><br>
                <b>Here are some important items that you should not forget home:</b>
                <ul>
                    <li>Clothing:
                        <ul>
                            <li>Clothes, socks and underwear for 3 days</li>
                            <li>Pair of long pants</li>
                            <li>Sweater (in case of cold weather)</li>
                            <li>Sun hat</li>
                            <li>Old t-shirt and bottoms (to get dirty)</li>
                            <li>Pyjamas</li>
                            <li>Any kind of neon +  army/camo clothing or accesories</li>
                            <li>Comfortable shoes</li>
                            <li>(Garbage) bag for dirty clothes</li>
                        </ul>
                    </li>
                    <li>Hygiene:
                        <ul>
                            <li>Towel + Washcloth</li>
                            <li>Toothbrush + Toothpaste</li>
                            <li>Shampoo, Soap, Shower Gel</li>
                            <li>Deodorant</li>
                            <li>Sunscreen</li>
                            <li>Bugspray</li>
                            <li>Medicine (if applicable)</li>
                        </ul>
                    </li>
                    <li>Others:
                        <ul>
                            <li>Wallet / Money (in case of emergencies)</li>
                            <li>Water bottle</li>
                            <li>ID</li>
                            <li>Phone + Charger</li>
                            <li>Any fun group board/card games (Optional)</li>
                        </ul>
                    </li>
                </ul><br><br>
                We look forward to seeing you at the camp! Please remember that all drinks at the camp will be purchased
                using your virtual wallet. If you haven\'t done so already, consider topping up your account.';
                $button_text = 'Go to my wallet';
                $button_link = route('wallet', ['id' => $participant->getWallet()->id]);
                $subject = 'Last Information for Cover Introductory Camp';
                $title = 'The camp is around the corner!';
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
        return redirect(route('backoffice.camp'));
    }
}
