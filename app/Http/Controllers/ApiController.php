<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Wallet;
use Illuminate\Http\Request;

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
            !isset(request()->total) ||
            !isset(request()->wallet)
        ){
            return $this->errorResponse('Request not formatted properly.', 400);
        }
        $wallet = Wallet::where('id', request()->wallet)->orWhere('barcode', request()->wallet)->first();
        if(!$wallet){
            return $this->errorResponse('Wallet not found.', 404);
        }

        if(request()->total > $wallet->balance && !(request()->bypass_balance == true)){
            return $this->errorResponse('Not enough funds in the wallet.', 402);
        }

        $purchases = [];
        $total = 0;

        foreach (request()->products as $pr){
            if(!isset($pr['id']) || !isset($pr['quantity']) || $pr['quantity'] < 1){
                return $this->errorResponse('Request not formatted properly.', 400);
            }
            $product = Product::find($pr['id']);
            if(!$product) return $this->errorResponse('Product not found.', 404);
            $purchase = new Purchase();
            $purchase->wallet = $wallet->id;
            $purchase->product = $product->id;
            $purchase->price_per_unit = $product->price;
            $purchase->quantity = $pr['quantity'];
            $purchase->total = $pr['quantity'] * $product->price;
            $purchases[] = $purchase;
            $total += $purchase->total;
        }

        if($total !== request()->total){
            return $this->errorResponse('Request not formatted properly.', 400);
        }

        foreach ($purchases as $purchase){
            $purchase->save();
        }
        $wallet->balance -= request()->total;
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
