<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use \App\Models\ParticipantCamp;
use \App\Models\ParticipantBarbecue;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class BackofficeController extends Controller {
    public function index() {
        return view('backoffice.main');
    }

    public function camp() {
        return view('backoffice.camp');
    }

    public function bbq() {
        return view('backoffice.bbq');
    }

    public function camp_participant() {
        if (!isset($_GET['id'])) {
            return redirect()->route('backoffice.camp');
        }
        $participant = ParticipantCamp::where('id', request()->id)->first();
        if (!$participant) {
            return redirect()->route('backoffice.camp');
        }
        return view('backoffice.camp_participant', ['participant' => $participant]);
    }

    public function bbq_participant() {
        if (!isset($_GET['id'])) {
            return redirect()->route('backoffice.bbq');
        }
        $participant = ParticipantBarbecue::where('id', request()->id)->first();
        if (!$participant) {
            return redirect()->route('backoffice.bbq');
        }
        return view('backoffice.bbq_participant', ['participant' => $participant]);
    }

    public function addproduct_view() {
        return view('backoffice.pos.addproduct');
    }

    public function product_add(Request $request) {
        // Validate the request data.
        $validator = Validator::make($request->all(), [
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the allowed image formats and maximum file size as needed.
        ]);

        // Check if the validation fails.
        if ($validator->fails()) {
            // Handle the validation errors. For example, you can redirect back with errors.
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $image = $request->file('picture');
        // Convert the image to a blob
        $imageBlob = file_get_contents($image->getRealPath());


        $product = new Product();
        $product->name = request()->product_name;
        $product->price = request()->price;
        $product->enabled = request()->enabled === 'on';
        $product->age_restriction = request()->restricted == 'on';
        $image = $request->file('picture');

        $compressedImage = Image::make($image->getRealPath())->fit(300, 300);
        $compressedImage->encode('jpg', 75);
        $imageBlob = (string)$compressedImage;
        $product->image = $imageBlob;
        $product->save();

        return redirect(route('backoffice.pos.products'));
    }

    public function product_edit() {
        if (!isset(request()->id)) {
            return redirect(route('backoffice.pos.products'));
        }
        $product = \App\Models\Product::where('id', request()->id)->first();
        if (!$product) {
            return redirect(route('backoffice.pos.products'));
        }
        return view('backoffice.pos.productedit', ['product' => $product]);
    }

    public function product_edit_save(Request $request) {
        if (!isset(request()->id)) {
            return redirect(route('backoffice.pos.products'));
        }
        $product = Product::find(request()->id);
        if (!$product) {
            return redirect(route('backoffice.pos.products'));
        }
        $product->name = request()->product_name;
        $product->price = request()->price;
        $product->enabled = request()->enabled === 'on';
        $product->age_restriction = request()->restricted == 'on';
        if ($request->hasFile('picture')) {
            // Validate the request data.
            $validator = Validator::make($request->all(), [
                'picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the allowed image formats and maximum file size as needed.
            ]);

            // Check if the validation fails.
            if ($validator->fails()) {
                // Handle the validation errors. For example, you can redirect back with errors.
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $image = $request->file('picture');

            $compressedImage = Image::make($image->getRealPath())->fit(300, 300);
            $compressedImage->encode('jpg', 75);
            $imageBlob = (string)$compressedImage;
            $product->image = $imageBlob;
        }
        $product->save();

        return redirect(route('backoffice.pos.products'));
    }

    public function product_delete(){
        if (!isset(request()->id)) {
            return redirect(route('backoffice.pos.products'));
        }
        $product = Product::find(request()->id);
        if (!$product) {
            return redirect(route('backoffice.pos.products'));
        }
        $product->delete();
        return redirect(route('backoffice.pos.products'));
    }
}
