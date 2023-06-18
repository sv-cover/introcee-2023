@extends('base.layout')
@section('title', 'Process Payment')

@section('content')
    <section class="payment-section">
        <div class="row justify-content-center">
            <div class="col-md-4 col-12">
                <div class="payment-box">
                    @if($paid)
                        <div class="inner">
                            <h4>Payment for {{ $event_name }} complete!</h4>
                            <p class="mt-4 mb-4">
                                The payment has been complete. You will receive an email with confirmation and more
                                details about your registration.
                            </p>
                            <p>
                                P.S. If you have any questions please email us at <a href="mailto:introcee@svcover.nl">introcee@svcover.nl</a>.
                            </p>
                        </div>
                        <a href="{{ route('wallet', ['id' => $walletid]) }}">
                            <button class="pay-button">
                                Go to My Wallet
                            </button>
                        </a>
                    @else
                        <div class="inner">
                            <h4>Payment could not go through.</h4>
                            <p class="mt-4">
                                The payment failed. Please try again or contact us at <a
                                    href="mailto:introcee@svcover.nl">introcee@svcover.nl</a> if you think this is an
                                issue.
                            </p>
                        </div>
                        <a href="{{ url('/payment?event='.$event.'&id='.$id) }}">
                            <button class="pay-button">
                                Try Again
                            </button>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

