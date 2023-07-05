<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Wallet;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    protected function errorResponse($message = null, $code)
    {
        return response()->json([
            'details' => $message,
        ], $code);
    }

    public function products(){
        $products = Product::select('id', 'name', 'price', 'image')->where('enabled', true)->get();

        // Convert the image BLOB to base64-encoded string
        foreach ($products as $product) {
            $product->image = base64_encode($product->image);
        }

        return response()->json($products);
    }

    public function wallets(){
        $wallets = Wallet::select('id', 'first_name', 'last_name', 'barcode')->get();
        foreach ($wallets as $wallet){
            $wallet->name = $wallet->first_name . ' ' . $wallet->last_name;
            unset($wallet->first_name);
            unset($wallet->last_name);
        }
        return response()->json($wallets);
    }

    public function purchase(){
        if(
            !isset(request()->products) ||
            count(request()->products) == 0 ||
            !isset(request()->wallet)
        ){
            return $this->errorResponse('Request not formatted properly.', 400);
        }
        $wallet = Wallet::where('id', request()->wallet)->orWhere('barcode', request()->wallet)->first();
        if(!$wallet){
            return $this->errorResponse('Wallet not found.', 404);
        }

        $purchases = [];
        $total = 0;

        $error = null;

        collect(request()->products)->each(function($quantity, $pr) use (&$purchases, &$total, &$wallet, &$error){
            if($quantity < 1){
                $error = $this->errorResponse('Request not formatted properly.', 400);
                return false;
            }
            $product = Product::find($pr);
            if(!$product){
                $error = $this->errorResponse('Product not found.', 404);
                return false;
            }
            $today = new DateTime();
            $bday = new DateTime($wallet->date_of_birth);
            $ageInterval = $today->diff($bday);
            $age = $ageInterval->y + ($ageInterval->m / 12) + ($ageInterval->d / 365.25);

            if($product->age_restriction && $age < 18){
                $error = $this->errorResponse('Participant is underage.', 403);
                return false;
            }
            $purchase = new Purchase();
            $purchase->wallet = $wallet->id;
            $purchase->product = $product->id;
            $purchase->price_per_unit = $product->price;
            $purchase->quantity = $quantity;
            $purchase->total = $quantity * $product->price;
            $purchases[] = $purchase;
            $total += $purchase->total;
        });

        if($error){
            return $error;
        }

        if($total > $wallet->balance && !(request()->bypass_balance == true)){
            return $this->errorResponse('Not enough funds in the wallet.', 402);
        }

        foreach ($purchases as $purchase){
            $purchase->save();
        }
        $wallet->balance -= $total;
        $wallet->save();

        return response('', 200);
    }

    public function pin(){
        if(!isset(request()->pin)){
            return $this->errorResponse('Request not formatted properly.', 400);
        }
        if(request()->pin != 2411){
            return response('Wrong PIN code.', 401);
        }
        return response('', 200);
    }
}
