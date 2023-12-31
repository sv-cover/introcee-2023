@extends('base.layout')

@section('title', 'Wallet')

@section('content')
    <div class="auto-container">
        <section class="wallet">
            {{--            <div class="wallet-notification">--}}
            {{--                <div>--}}
            {{--                    <i class="fa fa-info-circle"></i>--}}
            {{--                </div>--}}
            {{--                <div>--}}
            {{--                    At the Introductory Camp and Barbecue, you will only be able to pay with your wallet. You can top-up--}}
            {{--                    your wallet at any time during the camp and barbecue as well, though it requires an internet--}}
            {{--                    connection. We recommend topping up your account prior to the events. You will be using the same--}}
            {{--                    wallet for both events. Your wallet information can always be access through the confirmation email.--}}
            {{--                    If you did not receive an email, please contact us at <a href="mailto:introcee@svcover.nl">introcee@svcover.nl</a>.--}}
            {{--                </div>--}}
            {{--            </div>--}}
            {{--            <div class="wallet-notification warning">--}}
            {{--                <div>--}}
            {{--                    <i class="fa fa-exclamation-triangle"></i>--}}
            {{--                </div>--}}
            {{--                <div>--}}
            {{--                    To have easy access to your wallet history & top-ups, it is a good idea to bookmark this page to the--}}
            {{--                    home screen of your phone. Regardless, you can always access this page through the link in your--}}
            {{--                    email.--}}
            {{--                </div>--}}
            {{--            </div>--}}
            @if($wallet->balance > 0)
                <div class="white-box mb-5">
                    <h4>Refund Details</h4>
                    @if(!$wallet->iban)
                        You currently have <b>€{{ $wallet->balance }}</b> left in your wallet. Please fill in your bank
                        account
                        details so that we are able to return your money. Please make sure that you are using an <b>EURO
                            ACCOUNT</b>.
                        Don't hesitate to email us at <a
                            href="mailto:introduction@svcover.nl">introduction@svcover.nl</a>
                        if you have any questions.
                        <form class="bank-form mt-4" action="{{ route('wallet.bankaccount') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-5">
                                    <label>Account Holder*</label>
                                    <input type="text" name="account_holder" placeholder="Ex: John Doe" required/>
                                </div>
                                <div class="col-md-5">
                                    <label>Bank Account (IBAN)*</label>
                                    <input type="text" name="iban" placeholder="Ex: NL02ABNA0123456789" required/>
                                </div>
                                <div class="col-md-2">
                                    <label>SWIFT/BIC*</label>
                                    <input type="text" name="bic" placeholder="Ex: ABNANL2A" required/>
                                </div>
                                <input type="hidden" name="wallet" value="{{ $wallet->id }}"/>
                            </div>
                            <button type="submit" class="btn-topup mt-3 px-4">Submit Details</button>
                        </form>
                    @else
                        <div class="wallet-notification mb-0">
                            <div>
                                <i class="fa fa-check-circle"></i>
                            </div>
                            <div>
                                <b>All done!</b><br />
                                Your payment details have been filled in. We will notify you when the balance is refunded.
                            </div>
                        </div>
                    @endif
                </div>
            @endif
            @if($wallet->balance < 0)
                <form action="{{ route('topup.payment') }}" method="post">
                    @csrf
                    <button
                        class="btn-topup btn-block"
                        style="background:#C8102E;margin-bottom: 40px;"
                        type="submit"
                    >
                        Pay Negative Balance
                    </button>
                    <input type="hidden" name="event" value="topup"/>
                    <input type="hidden" name="amount" id="amount" value="{{ -$wallet->balance }}"/>
                    <input type="hidden" name="id" value="{{ $wallet->id }}"/>
                </form>
            @endif
            <div class="wallet-header">
                <div class="row align-items-center">
                    <div class="col-12 col-md-8 wallet-info">
                        <div class="initials-picture">
                            {{ $wallet->first_name[0] }}{{ $wallet->last_name[0] }}
                        </div>
                        <div>
                            Hello,<br/>
                            <span>{{ $wallet->first_name }} {{ $wallet->last_name }}</span>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 wallet-funds text-right">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-8 text-center text-md-end">
                                <span>€ <b>{{ number_format($wallet->balance, 2, ',') }}</b></span>
                                <a href="{{ route('topup', ['id' => $wallet->id])  }}" class="btn-topup">Top-Up
                                    Wallet</a>
                            </div>
                            <div class="col-12 col-md-4 text-center text-md-end">
                                <img class="qr-code"
                                     src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $wallet->id }}"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12 col-md-6">
                    <!-- PURCHASES -->
                    <div class="white-box">
                        <h4>Purchases</h4>
                        <ul class="purchase-list">
                            @if(count($wallet->purchases) == 0 && $wallet->auctions()->count() == 0)
                                You have not made any purchases yet.
                            @endif
                            @foreach($wallet->auctions as $auction)
                                <li class="row">
                                    <div class="col-md-3 col-4 amount">
                                        <span>€ <b>{{ $auction->price }}</b></span>
                                    </div>
                                    <div class="col-md-9 col-8 details">
                                        <b>Auction:</b> {{ $auction->product }}
                                        <span>{{ $auction->created_at }}</span>
                                    </div>
                                </li>
                            @endforeach
                            @foreach($wallet->purchases->reverse() as $purchase)
                                <li class="row">
                                    <div class="col-md-3 col-4 amount">
                                        <span>€ <b>{{ $purchase->total }}</b></span>
                                    </div>
                                    <div class="col-md-9 col-8 details">
                                        {{ $purchase->quantity }}x {{ $purchase->product()->first()->name }}
                                        ({{ $purchase->price_per_unit }})
                                        <span>{{ $purchase->created_at }}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="white-box">
                        <h4>Top-ups</h4>
                        <ul class="purchase-list">
                            @if(count($wallet->topups) == 0)
                                You have not topped up your wallet yet.
                            @endif
                            @foreach($wallet->topUps()->where('confirmed', true)->orderBy('created_at', 'desc')->get() as $topup)
                                <li class="row">
                                    <div class="col-md-3 col-4 amount">
                                        <span>€ <b>{{ $topup->amount }}</b></span>
                                    </div>
                                    <div class="col-md-9 col-8 details">
                                        Top-Up
                                        <span>{{ $topup->created_at }}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
