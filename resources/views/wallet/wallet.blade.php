@extends('base.layout')

@section('title', 'Wallet')

@section('content')
    <div class="auto-container">
        <section class="wallet">
            <div class="wallet-notification">
                <div>
                    <i class="fa fa-info-circle"></i>
                </div>
                <div>
                    At the Introductory Camp and Barbecue, you will only be able to pay with your wallet. You can top-up
                    your wallet at any time during the camp and barbecue as well, though it requires an internet
                    connection. We recommend topping up your account prior to the events. You will be using the same
                    wallet for both events. Your wallet information can always be access through the confirmation email.
                    If you did not receive an email, please contact us at <a href="mailto:introcee@svcover.nl">introcee@svcover.nl</a>.
                </div>
            </div>
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
                            <div class="col-8">
                                <span>€ <b>{{ number_format($wallet->balance, 2, ',') }}</b></span>
                                <a href="{{ route('topup', ['id' => $wallet->id])  }}" class="btn-topup">Top-Up
                                    Wallet</a>
                            </div>
                            <div class="col-4 text-right">
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
