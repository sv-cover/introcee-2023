@extends('base.layout')
@section('title', 'Payment')

@section('title', 'Payment')

@section('content')
    <script>
        function set_value(c) {
            document.getElementById('amount').value = c.toFixed(2);
            document.getElementById('value').innerText = c.toFixed(2);
        }
    </script>
    <section class="payment-section">
        <div class="row justify-content-center">
            <div class="col-md-4 col-12">
                <div class="payment-box">
                    <form action="{{ route('topup.payment') }}" method="post">
                        @csrf
                        <div class="inner">
                            <h4 class="mb-3">Top Up {{ $wallet->first_name }}'s Wallet</h4>
                            <input type="radio" id="v25" name="payment_method" value="2.5"
                                   onchange="set_value(2.5)" required checked="checked" />
                            <label class="payment-method-box" for="v25">
                                <div class="payment-method-text">
                                    <h5>€ 2.5</h5>
                                </div>
                            </label>
                            <input type="radio" id="v5" name="payment_method" value="5"
                                   onchange="set_value(5)" required/>
                            <label class="payment-method-box" for="v5">
                                <div class="payment-method-text">
                                    <h5>€ 5</h5>
                                </div>
                            </label>
                            <input type="radio" id="v10" name="payment_method" value="10"
                                   onchange="set_value(10)" required/>
                            <label class="payment-method-box" for="v10">
                                <div class="payment-method-text">
                                    <h5>€ 10</h5>
                                </div>
                            </label>
                            <input type="radio" id="v15" name="payment_method" value="15"
                                   onchange="set_value(15)" required/>
                            <label class="payment-method-box" for="v15">
                                <div class="payment-method-text">
                                    <h5>€ 15</h5>
                                </div>
                            </label>
                            <input type="radio" id="v20" name="payment_method" value="20"
                                   onchange="set_value(20)" required/>
                            <label class="payment-method-box" for="v20">
                                <div class="payment-method-text">
                                    <h5>€ 20</h5>
                                </div>
                            </label>
                            <input type="radio" id="v30" name="payment_method" value="30"
                                   onchange="set_value(30)" required/>
                            <label class="payment-method-box" for="v30">
                                <div class="payment-method-text">
                                    <h5>€ 30</h5>
                                </div>
                            </label>
                            <input type="radio" id="v50" name="payment_method" value="50"
                                   onchange="set_value(50)" required/>
                            <label class="payment-method-box" for="v50">
                                <div class="payment-method-text">
                                    <h5>€ 50</h5>
                                </div>
                            </label>
                        </div>
                        <input type="hidden" name="id" value="{{ $wallet->id }}"/>
                        <input type="hidden" name="amount" id="amount" value="2.5"/>
                        <input type="hidden" name="event" value="topup"/>
                        <button class="pay-button" type="submit" name="submit">
                            Pay €<span id="value">2.5</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
