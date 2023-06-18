<?php

namespace App\Http\Controllers;

use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use App\Models\ParticipantBarbecue;
use App\Models\TopUp;
use Illuminate\Http\Request;
use Mollie\Api\MollieApiClient;
use Illuminate\Support\Facades\Http;
use \App\Models\ParticipantCamp;
use App\Models\Wallet;


class PaymentController extends Controller
{

    public static array $events = [
        'camp' => 'Introductory Camp',
        'bbq' => 'Introductory Barbecue',
        'topup' => 'Wallet Top Up'
    ];

    public function view(Request $request)
    {
        if(!isset(request()->event) || !isset(request()->id)) return redirect(route('home'));
        $event = request()->event;
        $event_name = PaymentController::$events[$event];
        $participant = null;
        $topup = null;

        if($event == 'camp'){
            $participant = ParticipantCamp::find(request()->id);
        } else if($event == 'bbq') {
            $participant = ParticipantBarbecue::find(request()->id);
        } else if($event == 'topup'){
            $topup = TopUp::find(request()->id);
        }
        if (!$participant && !$topup) return redirect(route('home'));
        if(!$topup && $participant->paid) return redirect(route('home'));

        return view('payment', [
            'event_name' => $event_name,
            'fee' => $participant ? $participant->fee : $topup->amount,
            'id' => request()->id,
            'event' => request()->event
        ]);
    }

    public function pay(){
        $mollie = new MollieApiClient();
        $mollie->setApiKey(env('MOLLIE_API_KEY'));

        if(!isset(request()->event) || !isset(request()->id)) return redirect(route('home'));
        $participant = null;
        $topup = null;

        if(request()->event == 'camp'){
            $participant = ParticipantCamp::find(request()->id);
        } else if(request()->event == 'bbq') {
            $participant = ParticipantBarbecue::find(request()->id);
        } else if(request()->event == 'topup'){
            $topup = TopUp::find(request()->id);
        }
        if (!$participant && !$topup) return redirect(route('home'));

        print_r(request()->all());

        if($topup) {
            (float)$final_fee = (float)$topup->amount + (float)request()->commission;
            $final_fee = number_format($final_fee, 2, '.', '');

            $topup->final_amount = $final_fee;
            $topup->save();
        } else {
            (float)$final_fee = (float)$participant->fee + (float)request()->commission;
            $final_fee = number_format($final_fee, 2, '.', '');
        }

        $url_id = $participant ? $participant->id : $topup->id;

        $payment = $mollie->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" =>  strval($final_fee)
            ],
            "method" => request()->payment_method,
            "description" => "Cover ".PaymentController::$events[request()->event]." Fee",
            "redirectUrl" => url('/payment/process?event='.request()->event.'&id='.$url_id),
            "webhookUrl"  => "https://webshop.example.org/mollie-webhook/",
        ]);

        if($participant) {
            $participant->payment_reference = $payment->id;
            $participant->save();
        } else {
            $topup->payment_reference = $payment->id;
            $topup->save();
        }

        return redirect()->to($payment->getCheckoutUrl())->send();
    }

    public function process(){
        $mollie = new MollieApiClient();
        $mollie->setApiKey(env('MOLLIE_API_KEY'));
        if(!isset(request()->event) || !isset(request()->id)) return redirect(route('home'));
        $participant = null;
        $topup = null;
        if(request()->event == 'camp'){
            $participant = ParticipantCamp::find(request()->id);
        } else if(request()->event == 'bbq') {
            $participant = ParticipantBarbecue::find(request()->id);
        } else if(request()->event == 'topup'){
            $topup = TopUp::find(request()->id);
        }
        if (!$participant && !$topup) return redirect(route('home'));

        $payment = $mollie->payments->get($participant ? $participant->payment_reference : $topup->payment_reference);
        if($payment->isPaid()){
            $paid = true;
        } else {
            $paid = false;
        }
        if($paid){
            if($participant) {
                $participant->paid = true;
                $participant->confirmed = true;
                $participant->paid_at = now();
                $participant->final_fee = $payment->getSettlementAmount();
                $participant->save();
                WalletController::checkOrCreate($participant->email_address, $participant->first_name, $participant->last_name);
                $wallet = Wallet::where('email', $participant->email_address)->first();

                if(request()->event == 'camp'){
                    $link = '<a href="' . route('barbecue') . '">Introductory Barbecue</a>';
                } else {
                    $link = '<a href="' . route('camp') . '">Introductory Camp</a>';
                }

                $mailbody = 'Dear ' . $participant->first_name . ',<br><br>
                You are successfully signed up for Cover\'s ' . PaymentController::$events[request()->event] . '! You will receive more information about the event via your email. Please keep an eye on the <a href="https://introcee.svcover.nl/">IntroCee website</a> and <a href="https://instagram.com/svcover">Cover\'s Instagram</a> for updates and news about the events. <br><br>
                Please note that during the Introductory Barbecue and Camp we will be using a wallet system, which you can top up digitally. Please visit the wallet page to read more information and consider topping up before the event. <br><br>We can\'t wait to see you at the events!<br><br>Yours truly,<br>IntroCee (Cover\'s Introductory Committee)<br><br>
                P.S. If you haven\'t signed up for it yet, check out the <b>'.$link.'</b>, make sure to check it out.';

                $subject = 'Sign-Up Confirmation for ' . PaymentController::$events[request()->event];

                $mailData = [
                    'title' => 'Successfully signed up!',
                    'body' => $mailbody,
                    'buttonlink' => route('wallet', ['id' => $wallet->id]),
                    'buttontext' => 'Go to your wallet'
                ];

                Mail::to($participant->email_address)->send(new SendMail($mailData, $subject));

            } else {
                $topup->final_amount = $payment->getSettlementAmount();
                $topup->confirmed = true;
                $wallet = $topup->wallet()->first();
                $wallet->balance += $topup->amount;
                $wallet->save();
                $topup->save();
            }
        }

        return view('payment_process', [
            'event' => request()->event,
            'event_name' => PaymentController::$events[request()->event],
            'id' => request()->id,
            'paid' => $paid,
            'walletid' => $paid ?? $wallet->id
        ]);
    }
}
