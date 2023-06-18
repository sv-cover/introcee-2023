<?php

namespace App\Http\Controllers;
use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Models\TopUp;

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

    public static function checkOrCreate($email, $firstname, $lastname){
        $wallet = Wallet::where('email',$email)->first();
        if(!$wallet){
            $wallet = new Wallet([
                'email' => $email,
                'first_name' => $firstname,
                'last_name' => $lastname
            ]);
            $wallet->save();
        }
    }
}
