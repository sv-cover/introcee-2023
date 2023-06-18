@extends('base.layout')
@section('title', 'Payment')

@section('title', 'Payment')

@section('content')
    <script>
        function set_commission(c) {
            document.getElementById('commission').innerText = (<?= $fee ?> + c).toFixed(2);
            document.getElementById('commission-input').value = c;
        }
    </script>
    <section class="payment-section">
        <div class="row justify-content-center">
            <div class="col-md-4 col-12">
                <div class="payment-box">
                    <form action="{{ route('payment.pay') }}" method="post">
                        @csrf
                        <div class="inner">
                            <h4 class="mb-3">Pay for {{ $event_name }}</h4>
                            <h5 class="mb-4">€ {{ $fee }}</h5>
                            <input type="radio" id="ideal" name="payment_method" value="ideal"
                                   onchange="set_commission(0.29)" required/>
                            <label class="payment-method-box" for="ideal">
                                <div class="payment-method-image">
                                    <img src="https://www.mollie.com/images/payscreen/methods/ideal.png" alt="iDeal"/>
                                </div>
                                <div class="payment-method-text">
                                    <h6>iDeal</h6>
                                    <p>€{{ number_format(0.29, 2, ',') }}</p>
                                </div>
                            </label>
                            <input type="radio" id="creditcard" name="payment_method" value="creditcard"
                                   onchange="set_commission(0.018 * <?=$fee?> + 0.25)"/>
                            <label class="payment-method-box" for="creditcard">
                                <div class="payment-method-image">
                                    <img src="https://www.mollie.com/images/payscreen/methods/creditcard.png"
                                         alt="iDeal"/>
                                </div>
                                <div class="payment-method-text">
                                    <h6>Debit/Credit Card</h6>
                                    <p>{{ number_format((0.018 * $fee + 0.25) * 100 / $fee, 2, ',') }}%
                                        (€{{ number_format(0.018 * $fee + 0.25, 2, ',') }})</p>
                                </div>
                            </label>
                            <input type="radio" id="bancontact" name="payment_method" value="bancontact"
                                   onchange="set_commission(0.39)"/>
                            <label class="payment-method-box" for="bancontact">
                                <div class="payment-method-image">
                                    <img src="https://www.mollie.com/images/payscreen/methods/bancontact.png"
                                         alt="iDeal"/>
                                </div>
                                <div class="payment-method-text">
                                    <h6>Bancontact</h6>
                                    <p>€{{ number_format(0.39, 2, ',') }}</p>
                                </div>
                            </label>
                            <input type="radio" id="sofort" name="payment_method" value="sofort"
                                   onchange="set_commission(0.009 * <?=$fee?> + 0.25)"/>
                            <label class="payment-method-box" for="sofort">
                                <div class="payment-method-image">
                                    <img src="https://www.mollie.com/external/icons/payment-methods/sofort.png"
                                         alt="iDeal"/>
                                </div>
                                <div class="payment-method-text">
                                    <h6>SOFORT Banking</h6>
                                    <p>€{{ number_format((0.009 * $fee + 0.25) * 100 / $fee, 2, ',') }}%
                                        (€{{ number_format(0.009 * $fee + 0.25, 2, ',') }})</p>
                                </div>
                            </label>
                            <input type="radio" id="przelewy24" name="payment_method" value="przelewy24"
                                   onchange="set_commission(0.022 * <?=$fee?> + 0.25)"/>
                            <label class="payment-method-box" for="przelewy24">
                                <div class="payment-method-image">
                                    <img src="https://www.mollie.com/external/icons/payment-methods/przelewy24.png"
                                         alt="Przelewy24"/>
                                </div>
                                <div class="payment-method-text">
                                    <h6>Przelewy24</h6>
                                    <p>€{{ number_format((0.022 * $fee + 0.25) * 100 / $fee, 2, ',') }}%
                                        (€{{ number_format(0.022 * $fee + 0.25, 2, ',') }})</p>
                                </div>
                            </label>
                        </div>
                        <input type="hidden" name="commission" id="commission-input" value="0"/>
                        <input type="hidden" name="id" value="{{ $id }}"/>
                        <input type="hidden" name="event" value="{{ $event }}"/>
                        <button class="pay-button" type="submit" name="submit">
                            Pay €<span id="commission">{{ $fee }}</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
