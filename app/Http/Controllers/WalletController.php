<?php

namespace App\Http\Controllers;
use App\Mail\SendMail;
use App\Models\ParticipantCamp;
use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Models\TopUp;
use Illuminate\Support\Facades\Mail;

class WalletController extends Controller
{
    public function view()
    {
        if(request()->id){
            $id = request()->id;
            $wallet = Wallet::find($id);
            if(!$wallet)
                return redirect('/');
            return view('wallet.wallet',[
                'wallet' => $wallet
            ]);
        }
        return redirect('/');
    }

    public function topUpView(){
        if(request()->id){
            $id = request()->id;
            $wallet = Wallet::find($id);
            if(!$wallet)
                return redirect('/');
            return view('wallet.topup',[
                'wallet' => $wallet
            ]);
        }
        return redirect('/');
    }

    public function toPayment(){
        if(request()->id){
            $id = request()->id;
            $wallet = Wallet::find($id);
            if(!$wallet)
                return redirect('/');

            $topup = new TopUp([
                'amount' => request()->amount,
                'wallet' => $wallet->id
            ]);
            $topup->save();

            return redirect(route('payment',[
                'event' => 'topup',
                'id' => $topup->id
            ]));
        }
        return redirect('/');
    }

    public static function checkOrCreate($email, $firstname, $lastname, $date_of_birth){
        $wallet = Wallet::where('email',$email)->first();
        if(!$wallet){
            $wallet = new Wallet([
                'email' => $email,
                'first_name' => $firstname,
                'last_name' => $lastname,
                'date_of_birth' => $date_of_birth
            ]);
            $wallet->save();
        }
    }

    public static function link_barcode(){
        $participant = ParticipantCamp::where('id', request()->participant)->first();
        if($participant) {
            $wallet = Wallet::where('email', $participant->email_address)->first();
            if ($wallet) {
                $wallet->barcode = request()->barcode;
                $wallet->save();
            }
        }
        return redirect(route('backoffice.camp.participant', ['id' => $participant->id]));
    }

    public static function unlink_barcode(){
        $participant = ParticipantCamp::where('id', request()->participant)->first();
        if($participant) {
            $wallet = Wallet::where('email', $participant->email_address)->first();
            if ($wallet) {
                $wallet->barcode = null;
                $wallet->save();
            }
        }
        return redirect(route('backoffice.camp.participant', ['id' => $participant->id]));
    }

    public static function negative_balance_topup(){

    }

    public static function find_wallet_view(){
        return view('wallet.findwallet');
    }

    public static function find_wallet_post(){
        $wallet = Wallet::where('email', request()->email)->first();
        if($wallet){
            $mail_body = 'Dear ' . $wallet->first_name . ',<br><br>
                You have requested us to email you the details for your wallet. Here is your QR code:
                <br><br>
                <img src="https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl='.$wallet->id.'" style="margin:auto;display:block;" />
                <br><br>Please take a screenshot of this QR code or save it to your phone to make things smoother. Alternatively, you can
                add your wallet website page to the home screen of your phone for easy access of the QR, purchase history and top-up.
                <br><br>Right now, the balance of your wallet is <b>€ '.$wallet->balance.'.';
            $button_text = 'Go to my wallet';
            $button_link = route('wallet', ['id' => $wallet->id]);
            $subject = '[IMPORTANT] Cover Introduction Wallet';
            $title = 'Wallet Details';
            $mailData = [
                'title' => $title,
                'body' => $mail_body,
                'buttonlink' => $button_link,
                'buttontext' => $button_text
            ];
            Mail::to($wallet->email)->send(new SendMail($mailData, $subject));
            return view('wallet.findwallet', [
                'info' => 'We have emailed you the link to your wallet and the QR code. Please reach out to the committee if you cannot find this email. Be sure to check the spam folder!'
            ]);
        }
        return view('wallet.findwallet', [
            'info' => 'We could not find a wallet with the email address you provided. Please try again or reach out to the introduction committee.'
        ]);
    }
}
