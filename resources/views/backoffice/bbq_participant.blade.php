@extends('backoffice.layout')
@section('title', $participant->first_name . ' ' . $participant->last_name . ' (BBQ)' )

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-0">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Barbecue Participant
                </h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin') }}" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('backoffice.bbq') }}" class="text-muted text-hover-primary">Barbecue</a>
                    </li>

                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>

                    <li class="breadcrumb-item text-muted">
                        {{ $participant->first_name . ' ' . $participant->last_name }}
                    </li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Layout-->
            <div class="d-flex flex-column flex-xl-row">
                <!--begin::Sidebar-->
                <div class="flex-column flex-lg-row-auto w-100 w-xl-350px mb-10">
                    <!--begin::Card-->
                    <div class="card mb-5 mb-xl-8">
                        <!--begin::Card body-->
                        <div class="card-body pt-15">
                            <!--begin::Summary-->
                            <div class="d-flex flex-center flex-column mb-5">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-100px symbol-circle mb-7">
                                    @if($participant->first_year)
                                        @php($image = asset('images/avatar.webp'))
                                    @else
                                        @php($image = 'https://svcover.nl/profile/'.$participant->membership_id.'/picture/square/256')
                                    @endif
                                    <img src="{{ $image }}" alt="image">
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Name-->
                                <a class="fs-3 text-gray-800 text-hover-primary fw-bold mb-1">
                                    {{ $participant->first_name . ' ' . $participant->last_name }}
                                </a>
                                <!--end::Name-->
                                <!--begin::Position-->
                                <div class="fs-5 fw-semibold text-muted mb-6">
                                    @if($participant->first_year)
                                        First Year
                                    @else
                                        Senior
                                    @endif
                                </div>
                                <!--end::Position-->
                            </div>
                            <!--end::Summary-->
                            <!--begin::Details toggle-->
                            <div class="d-flex flex-stack fs-4 py-3">
                                <div class="fw-bold rotate collapsible active" data-bs-toggle="collapse"
                                     href="#kt_customer_view_details" role="button" aria-expanded="true"
                                     aria-controls="kt_customer_view_details">Details
                                    <span class="ms-2 rotate-180">
										<i class="ki-outline ki-down fs-3"></i>
									</span>
                                </div>
                            </div>
                            <!--end::Details toggle-->
                            <div class="separator separator-dashed my-3"></div>
                            <!--begin::Details content-->
                            <div id="kt_customer_view_details" class="collapse show" style="">
                                <div class="py-5 fs-6">
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">Email Address</div>
                                    <div class="text-gray-600">{{ $participant->email_address }}</div>
                                    <!--begin::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">Phone Number</div>
                                    <div class="text-gray-600">
                                        <a href="#"
                                           class="text-gray-600 text-hover-primary">{{ $participant->phone_number }}</a>
                                    </div>
                                    <!--begin::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">Date of Birth</div>
                                    <div class="text-gray-600">
                                        {{ $participant->date_of_birth }}
                                    </div>
                                    <!--begin::Details item-->
                                    <!--begin::Details item-->
                                    @if($participant->first_year)
                                        <div class="fw-bold mt-5">Student Number</div>
                                        <div class="text-gray-600">{{ $participant->student_number }}</div>
                                    @else
                                        <div class="fw-bold mt-5">Membership ID</div>
                                        <div class="text-gray-600">#{{ $participant->membership_id }}</div>
                                    @endif
                                    <!--begin::Details item-->
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">Study</div>
                                    <div class="text-gray-600">{{ $participant->field_of_study }}
                                        ({{ $participant->study_year }})
                                    </div>
                                    <!--begin::Details item-->
                                </div>
                            </div>
                            <!--end::Details content-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Sidebar-->
                <!--begin::Content-->
                <div class="flex-lg-row-fluid ms-lg-15">
                    <div class="card pt-4 mb-6 mb-xl-9">
                        <!--begin::Card header-->
                        <div class="card-header border-0">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2 class="fw-bold">Remarks</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            @if($participant->remarks)
                                {{ $participant->remarks }}
                            @else
                                No remarks.
                            @endif
                        </div>
                        <!--end::Card body-->
                    </div>
                    <div class="card pt-4 mb-6 mb-xl-9">
                        <!--begin::Card header-->
                        <div class="card-header border-0">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2 class="fw-bold">Dietary Requirements</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            @if($participant->dietary_requirements)
                                {{ $participant->dietary_requirements }}
                            @else
                                No requirements.
                            @endif
                        </div>
                        <!--end::Card body-->
                    </div>
                    <div class="card pt-4 mb-6 mb-xl-9">
                        <!--begin::Card header-->
                        <div class="card-header border-0">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2 class="fw-bold">Extra Information</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td>IntroCee</td>
                                                <td class="text-right">
                                                    @if($participant->introcee)
                                                        <span class="badge badge-light-success">Yes</span>
                                                    @else
                                                        <span class="badge badge-light-danger">No</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>PhotoCee</td>
                                                <td>
                                                    @if($participant->photocee)
                                                        <span class="badge badge-light-success">Yes</span>
                                                    @else
                                                        <span class="badge badge-light-danger">No</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>HEROCee</td>
                                                <td>
                                                    @if($participant->herocee)
                                                        <span class="badge badge-light-success">Yes</span>
                                                    @else
                                                        <span class="badge badge-light-danger">No</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td style="width:80%;">Board</td>
                                                <td>
                                                    @if($participant->board)
                                                        <span class="badge badge-light-success">Yes</span>
                                                    @else
                                                        <span class="badge badge-light-danger">No</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Candidate Board</td>
                                                <td>
                                                    @if($participant->candy)
                                                        <span class="badge badge-light-success">Yes</span>
                                                    @else
                                                        <span class="badge badge-light-danger">No</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Mentor</td>
                                                <td>
                                                    @if($participant->mentor)
                                                        <span class="badge badge-light-success">Yes</span>
                                                    @else
                                                        <span class="badge badge-light-danger">No</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Card body-->
                    </div>
                    <div class="card pt-4 mb-6 mb-xl-9">
                        <!--begin::Card header-->
                        <div class="card-header border-0">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2 class="fw-bold">Payment</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            @if(!$participant->paid)
                                <span class="badge badge-danger">Not Paid</span>
                            @else
                                @php($payment = \App\Http\Controllers\PaymentController::getPaymentDetails($participant->payment_reference))
                                @php($method = \App\Http\Controllers\PaymentController::getPaymentMethod($payment->method))
                                @if($payment->method == Mollie\Api\Types\PaymentMethod::CREDITCARD)
                                    @php($card = $payment->details)
                                @endif
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td>Participant Fee</td>
                                                    <td class="text-right">
                                                        <span class="badge badge-light-primary">€ {{ $participant->fee }}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Commission</td>
                                                    <td class="text-right">
                                                        <span class="badge badge-light-warning">€ {{ $participant->final_fee - $participant->fee }}</span>
                                                    </td>
                                                </tr>
                                                @if(isset($card))
                                                    <tr>
                                                        <td><b>Card Type</b></td>
                                                        <td class="text-right">
                                                            <img src="{{ asset('backoffice/media/svg/card-logos/'. $card->cardLabel .'.svg') }}" height="24" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Card Number</b></td>
                                                        <td class="text-right">
                                                            <b>**** {{ $card->cardNumber }}</b>
                                                        </td>
                                                    </tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td>Final Fee</td>
                                                    <td class="text-right">
                                                        <span class="badge badge-light-info">€ {{ $participant->final_fee }}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Payment Method</td>
                                                    <td class="text-right">
                                                        <img src="{{ $method->image->size1x }}"/>
                                                    </td>
                                                </tr>
                                                @if(isset($card))
                                                    <tr>
                                                        <td><b>Card Holder</b></td>
                                                        <td class="text-right">
                                                            <b>{{ $card->cardHolder }}</b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Card Country</b></td>
                                                        <td class="text-right">
                                                            <img src="https://flagsapi.com/{{ $card->cardCountryCode }}/flat/64.png" height="24">
                                                        </td>
                                                    </tr>
                                                @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <!--end::Card body-->
                    </div>
                </div>
                <!--end::Content-->
            </div>
            <!--end::Layout-->
        </div>
        <!--end::Content container-->
    </div>
@endsection
