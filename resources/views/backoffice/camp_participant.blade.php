@extends('backoffice.layout')
@section('title', $participant->first_name . ' ' . $participant->last_name . ' (Camp)' )

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-0">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    IntroCamp Participant
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
                        <a href="{{ route('backoffice.camp') }}" class="text-muted text-hover-primary">IntroCamp</a>
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
                                        @php($age = $participant->getAge())
                                        <span class="badge badge-{{ $age < 18 ? 'danger' : 'light-dark' }}">
                                            @if($age<18)
                                                <i class="ki ki-outline ki-flag text-white me-1"></i>
                                            @endif
                                            {{ $age }} years old
                                        </span>
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
                                    <!--begin::Details item-->
                                    <div class="fw-bold mt-5">Status</div>
                                    <div class="text-gray-600">
                                        @if($participant->confirmed)
                                            <span class="badge badge-success">Confirmed</span>
                                        @else
                                            <span class="badge badge-danger">Not Confirmed</span>
                                        @endif
                                    </div>
                                    <!--begin::Details item-->
                                    @if($participant->senior && !$participant->confirmed)
                                        <a href="#" class="btn btn-sm btn-light-primary btn-block mt-6"
                                           data-bs-toggle="modal"
                                           data-bs-target="#kt_modal_add_payment"
                                           style="width: 100%;"
                                        >
                                            Confirm Participant
                                        </a>
                                    @endif
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
                                <h2 class="fw-bold">Emergency Contact</h2>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="fw-bold fs-4">{{ $participant->emergency_contact_name }}</div>
                                    <div class="fs-7 fw-normal text-muted">Emergency Contact Name</div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="fw-bold fs-4">{{ $participant->emergency_contact_phone }}</div>
                                    <div class="fs-7 fw-normal text-muted">Emergency Contact Phone Number</div>
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
                                                        <span
                                                            class="badge badge-light-primary">€ {{ $participant->fee }}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Commission</td>
                                                    <td class="text-right">
                                                        <span
                                                            class="badge badge-light-warning">€ {{ $participant->final_fee - $participant->fee }}</span>
                                                    </td>
                                                </tr>
                                                @if(isset($card))
                                                    <tr>
                                                        <td><b>Card Type</b></td>
                                                        <td class="text-right">
                                                            <img
                                                                src="{{ asset('backoffice/media/svg/card-logos/'. $card->cardLabel .'.svg') }}"
                                                                height="24"/>
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
                                                        <span
                                                            class="badge badge-light-info">€ {{ $participant->final_fee }}</span>
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
                                                            <img
                                                                src="https://flagsapi.com/{{ $card->cardCountryCode }}/flat/64.png"
                                                                height="24">
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
            <div class="modal fade" id="kt_modal_add_payment" tabindex="-1" style="display: none;" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header">
                            <!--begin::Modal title-->
                            <h2 class="fw-bold">Confirm {{ $participant->first_name }}'s Registration</h2>
                            <!--end::Modal title-->
                            <!--begin::Close-->
                            <div id="kt_modal_add_payment_close" class="btn btn-icon btn-sm btn-active-icon-primary"
                                 data-bs-toggle="modal"
                                 data-bs-target="#kt_modal_add_payment"
                            >
                                <i class="ki-outline ki-cross fs-1"></i>
                            </div>
                            <!--end::Close-->
                        </div>
                        <!--end::Modal header-->
                        <!--begin::Modal body-->
                        <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                            <!--begin::Form-->
                            <form id="kt_modal_add_payment_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                                  action="#">
                                <!--begin::Input group-->

                                <!--begin::Input group-->
                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="required fs-6 fw-semibold form-label mb-2">Participant Fee</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <select class="form-select form-select-solid fw-bold select2-hidden-accessible"
                                            name="status" data-control="select2" data-placeholder="Select an option"
                                            data-hide-search="true" data-select2-id="select2-data-4-xvwc" tabindex="-1"
                                            aria-hidden="true" data-kt-initialized="1">
                                        <option data-select2-id="select2-data-6-ijzx"></option>
                                        <option value="14.75">IntroCee (25% - €14.75)</option>
                                        <option value="29.5">HEROCee (50% - €29.5)</option>
                                        <option value="44.25">PhotoCee (77% - €44.25)</option>
                                        <option value="59">Full (100% - €59)</option>
                                        <option value="0">Mentor (0% - €0)</option>
                                    </select><span class="select2 select2-container select2-container--bootstrap5"
                                                   dir="ltr" data-select2-id="select2-data-5-m8jy" style="width: 100%;"><span
                                            class="selection"><span
                                                class="select2-selection select2-selection--single form-select form-select-solid fw-bold"
                                                role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0"
                                                aria-disabled="false" aria-labelledby="select2-status-7z-container"
                                                aria-controls="select2-status-7z-container"><span
                                                    class="select2-selection__rendered" id="select2-status-7z-container"
                                                    role="textbox" aria-readonly="true" title="Select an option"><span
                                                        class="select2-selection__placeholder">Select an option</span></span><span
                                                    class="select2-selection__arrow" role="presentation"><b
                                                        role="presentation"></b></span></span></span><span
                                            class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    <!--end::Input-->
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Actions-->
                                <div class="text-center">
                                    <button type="reset" id="kt_modal_add_payment_cancel" class="btn btn-light me-3">
                                        Discard
                                    </button>
                                    <button type="submit" id="kt_modal_add_payment_submit" class="btn btn-primary">
                                        <span class="indicator-label">Submit</span>
                                        <span class="indicator-progress">Please wait...
																<span
                                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Modal body-->
                    </div>
                    <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
            </div>
        </div>
        <!--end::Content container-->
    </div>
@endsection
