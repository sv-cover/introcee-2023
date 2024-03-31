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
                $wallet->barcode = 'COVER'.request()->barcode;
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

    public static function update_wallet_bank_account(){
        $wallet = Wallet::where('id', request()->wallet)->first();
        if($wallet){
            $wallet->iban = request()->iban;
            $wallet->bic = request()->bic;
            $wallet->account_holder = request()->account_holder;
            $wallet->save();
            $mail_body = 'Dear IntroCee,<br><br>This is a notification that <b>
            '.$wallet->first_name.' '.$wallet->last_name.'</b> has filled in their bank account details for the reimbursement: <br><br>
            <b>Account holder:</b> '.$wallet->account_holder.'<br>
            <b>IBAN:</b> '.$wallet->iban.'<br>
            <b>BIC:</b> '.$wallet->bic.'<br>
            <b>Balance:</b> €'.$wallet->balance.'<br><br>Please let the treasurer know so that the money are reimbursed.<br><br>All the best,<br>The Website';
            $button_text = 'Wallets List';
            $button_link = route('backoffice.pos.wallets');
            $title = 'Wallet Reimbursement Details';
            $mailData = [
                'title' => $title,
                'body' => $mail_body,
                'buttonlink' => $button_link,
                'buttontext' => $button_text
            ];
            $subject = '[Notification] Wallet Bank Account Details Updated';
            Mail::to('introcee@svcover.nl')->send(new SendMail($mailData, $subject));
            return redirect(route('wallet', ['id' => $wallet->id]));
        }
    }

    public static function send_data_deletion_warning() {
        $wallets = Wallet::all();
        forEach($wallets as $wallet){
            if($wallet->email_sent)
                continue;
            $mail_body = 'Dear ' . $wallet->first_name . ',<br><br>
            We are writing to inform you that we will be deleting your wallet & participant data from our system in 30 days. If you would like to take a last look at your transactions, please do so soon. Due to the financial nature of these records, we are legally required to keep the Mollie payments information for 7 years. These are stored on Mollie itself. If you still have funds in your wallet or you must pay debts, please refer to the previously sent emails. Don\'t hesitate to email us if you have any questions! <br><br>Kind regards,<br>The Cover Introduction Committee';
            $button_text = 'Go to my wallet';
            $button_link = route('wallet', ['id' => $wallet->id]);
            $subject = 'Cover IntroCee Data Deletion Warning';
            $title = 'Data Deletion Warning';
            $mailData = [
                'title' => $title,
                'body' => $mail_body,
                'buttonlink' => $button_link,
                'buttontext' => $button_text
            ];
            Mail::to($wallet->email)->send(new SendMail($mailData, $subject));
            $wallet->email_sent = true;
            $wallet->save();
        }
    }

    public static function send_balance_email(){
        $wallets = Wallet::all();
        forEach($wallets as $wallet){
            if(!$wallet->email_sent){
                if($wallet->balance > 0){
                    $mail_body = 'Dear ' . $wallet->first_name . ',<br><br>
                    You have a positive balance of <b>€ '.$wallet->balance.'</b> on your wallet. In order to get this amount back, please
                    fill in your bank account details on your wallet page. You can find your wallet page by clicking the button below. We will notify you
                    when the funds have been refunded. Don\'t hesitate to email us any questions you might have. P.S. Please fill in a Euro bank account!
                    <br><br>Kind regards,<br>The Cover Introduction Committee';
                    $button_text = 'Go to my wallet';
                    $button_link = route('wallet', ['id' => $wallet->id]);
                    $subject = '[UPDATE] Refund Introduction Week Wallet Balance';
                    $title = 'Wallet Refund';
                    $mailData = [
                        'title' => $title,
                        'body' => $mail_body,
                        'buttonlink' => $button_link,
                        'buttontext' => $button_text
                    ];
                    Mail::to($wallet->email)->send(new SendMail($mailData, $subject));
                    $wallet->email_sent = true;
                    $wallet->save();
                } else if ($wallet->balance < 0){
                    $mail_body = 'Dear ' . $wallet->first_name . ',<br><br>
                    You have a negative balance of <b>€ '.$wallet->balance.'</b> on your wallet. In order to pay this amount, please
                    transfer it to the following bank account:<br>
                    IBAN: NL54 RABO 0103 7969 40<br>
                    BIC: RABONL2U<br>
                    Account holder: Cover<br>
                    Please include your name in the description of the
                    transfer and make sure to notify us via email. Don\'t hesitate to also email us any questions you might have.
                    <br><br>
                    If you do not have a euro account or cannot/do not want to transfer the amount, you can visit your
                    wallet page on the website and use the "Pay negative balance" button to pay the amount using iDeal or another method.
                    <br><br>Yours truly,<br>The Cover Introduction Committee';
                    $button_text = 'Go to my wallet';
                    $button_link = route('wallet', ['id' => $wallet->id]);
                    $subject = '[UPDATE] Introduction Week Wallet Debts';
                    $title = 'Wallet Debts';
                    $mailData = [
                        'title' => $title,
                        'body' => $mail_body,
                        'buttonlink' => $button_link,
                        'buttontext' => $button_text
                    ];
                    Mail::to($wallet->email)->send(new SendMail($mailData, $subject));
                    $wallet->email_sent = true;
                    $wallet->save();
                }
            }
        }
        return redirect(route('backoffice.pos.wallets'));
    }
}
