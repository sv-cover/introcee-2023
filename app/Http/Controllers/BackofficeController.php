<?php

namespace App\Http\Controllers;

use App\CoverApi;
use App\Mail\SendMail;
use App\Models\Auction;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Wallet;
use Illuminate\Http\Request;
use \App\Models\ParticipantCamp;
use \App\Models\ParticipantBarbecue;
use Illuminate\Support\Facades\Mail;
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
            return view('backoffice.404');
        }
        $participant = ParticipantCamp::where('id', request()->id)->first();
        if (!$participant) {
            return view('backoffice.404');
        }
        return view('backoffice.camp_participant', ['participant' => $participant]);
    }

    function confirm_camp_participant() {
        if (!isset($_GET['id'])) {
            return redirect()->route('backoffice.camp');
        }
        $participant = ParticipantCamp::where('id', request()->id)->first();
        if (!$participant) {
            return redirect()->route('backoffice.camp');
        }
        $participant->fee = (float)request()->fee;
        if ($participant->fee == 0) {
            $participant->confirmed = true;
        }
        $participant->save();

        if ($participant->fee == 0) {
            WalletController::checkOrCreate($participant->email_address, $participant->first_name, $participant->last_name, $participant->date_of_birth);
            $wallet = Wallet::where('email', $participant->email_address)->first();

            $mailbody = 'Dear ' . $participant->first_name . ',<br><br>
                You are successfully signed up for Cover\'s Introductory Camp! Your registration was confirmed by the IntroCee and you will be attending the camp for free. You will receive more information about the event via your email. Please keep an eye on the <a href="https://introcee.svcover.nl/">IntroCee website</a> and <a href="https://instagram.com/svcover">Cover\'s Instagram</a> for updates and news about the events. <br><br>
                Please note that during the Introductory Barbecue and Camp we will be using a wallet system, which you can top up digitally. Please visit the wallet page to read more information and consider topping up before the event. <br><br>We can\'t wait to see you at the events!<br><br>Yours truly,<br>IntroCee (Cover\'s Introductory Committee)<br><br>
                P.S. If you haven\'t signed up for it yet, check out the <b><a href="'.route('barbecue').'">Introductory Barbecue</a></b>';

            $subject = 'Sign-Up Confirmation for Cover Introductory Camp';

            $mailData = [
                'title' => 'Successfully signed up!',
                'body' => $mailbody,
                'buttonlink' => route('wallet', ['id' => $wallet->id]),
                'buttontext' => 'Go to your wallet'
            ];

            Mail::to($participant->email_address)->send(new SendMail($mailData, $subject));
        } else {
            $mailbody = 'Dear ' . $participant->first_name . ',<br><br>
        Your registration for Cover\'s Introductory Camp has been confirmed by the IntroCee. Please follow the link below to
        complete the payment and secure your spot at the camp. <br><br>We can\'t wait to see you at the events!<br><br>Yours truly,<br>IntroCee (Cover\'s Introductory Committee)<br><br>
                P.S. If you haven\'t signed up for it yet, check out the <b><a href="'.route('barbecue').'">Introductory Barbecue</a></b>.';

            $subject = 'Payment Link for Cover IntroCamp';

            $mailData = [
                'title' => 'Payment Link for Cover IntroCamp',
                'body' => $mailbody,
                'buttonlink' => route('payment', ['event' => 'camp', 'id' => $participant->id]),
                'buttontext' => 'Pay Participation Fee'
            ];

            Mail::to($participant->email_address)->send(new SendMail($mailData, $subject));
        }
        return redirect(route('backoffice.camp.participant', ['id' => $participant->id]));
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

    public function product_delete() {
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

    private function check(){
        if (!isset(request()->participant)) {
            return redirect(route('backoffice.404'));
        }
        $participant = ParticipantCamp::find(request()->participant);
        if (!$participant) {
            return redirect(route('backoffice.404'));
        }
        return $participant;
    }

    protected function make_name(){
        $coverApi = app(CoverApi::class);
        $session = $coverApi->get_cover_session();
        $name = $session->voornaam;
        if($session->tussenvoegsel)
            $name .= ' ' . $session->tussenvoegsel;
        $name .= ' ' . $session->achternaam;
        return $name;
    }

    public function check_in(){
        $participant = $this->check();
        if(!is_a($participant, 'App\Models\ParticipantCamp'))
            return $participant;
        $participant->checked_in = true;
        $participant->save();
        $text = $this->make_name() . ' has checked in the participant.';
        $comment = new Comment([
            'text' => $text,
            'participant' => $participant->id
        ]);
        $comment->save();
        return redirect(route('backoffice.camp.participant', ['id' => $participant->id]));
    }

    public function check_out(){
        $participant = $this->check();
        if(!is_a($participant, 'App\Models\ParticipantCamp'))
            return $participant;
        $participant->checked_in = false;
        $participant->save();
        $text = $this->make_name() . ' has checked out the participant.';
        $comment = new Comment([
            'text' => $text,
            'participant' => $participant->id
        ]);
        $comment->save();
        return redirect(route('backoffice.camp.participant', ['id' => $participant->id]));
    }

    public function add_comment(){
        $participant = $this->check();
        if(!is_a($participant, 'App\Models\ParticipantCamp'))
            return $participant;
        $comment = new Comment([
            'author' => $this->make_name(),
            'text' => request()->comment,
            'participant' => $participant->id
        ]);
        $comment->save();
        return redirect(route('backoffice.camp.participant', ['id' => $participant->id]) . '#comments');
    }

    public function submit_auction(){
        $wallet = Wallet::where('barcode', request()->barcode)->first();
        $auction = new Auction([
            'wallet' => $wallet->id,
            'product' => request()->product,
            'price' => request()->price,
        ]);
        $auction->save();
        $wallet->balance -= request()->price;
        $wallet->save();
        return redirect(route('backoffice.pos.auction'));
    }
}
