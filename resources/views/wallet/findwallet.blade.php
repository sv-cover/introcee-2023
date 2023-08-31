@extends('base.layout')
@section('title', 'Find Wallet')

@section('title', 'Find Wallet')

@section('content')
    <div class="auto-container">
        <section class="wallet">
            @if(isset($info))
                <div class="wallet-notification">
                    <div>
                        <i class="fa fa-info-circle"></i>
                    </div>
                    <div>
                        {{ $info }}
                    </div>
                </div>
            @endif
            <div class="wallet-notification warning">
                <div>
                    <i class="fa fa-exclamation-triangle"></i>
                </div>
                <div>
                    <h6 style="font-style:normal;font-weight:bold;">Can you not find your wallet link & QR code?</h6>
                    Fill in your email address below and we will send you an email with the QR code and link to your
                    wallet. If you did not receive an email, please find an Introduction Committee member to help you.
                </div>
            </div>
            <h6 style="font-style:normal;margin-bottom: 10px;"><span style="font-weight:bold;">Email address</span>
                (used at sign-up)</h6>
            <form action="{{ route('wallet.find') }}" method="post">
                @csrf
                <input type="email" placeholder="Email address..." name="email" required/>
                <br/>
                <button class="theme-btn btn-one" type="submit" name="submit-form">Submit</button>
            </form>
        </section>
    </div>
@endsection
