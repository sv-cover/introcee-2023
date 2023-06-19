@extends('backoffice.layout')
@section('title', 'Camp Participants')

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-0">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Barbecue Participants
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
                    <li class="breadcrumb-item text-muted">Barbecue</li>
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
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                            <input type="text" data-kt-customer-table-filter="search"
                                   class="form-control form-control-solid w-250px ps-12" placeholder="Search Participants">
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                            <!--begin::Filter-->
                            <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click"
                                    data-kt-menu-placement="bottom-end">
                                <i class="ki-outline ki-filter fs-2"></i>Filter
                            </button>
                            <!--begin::Menu 1-->
                            <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true"
                                 id="kt-toolbar-filter" style="">
                                <!--begin::Header-->
                                <div class="px-7 py-5">
                                    <div class="fs-4 text-dark fw-bold">Filter Options</div>
                                </div>
                                <!--end::Header-->
                                <!--begin::Separator-->
                                <div class="separator border-gray-200"></div>
                                <!--end::Separator-->
                                <!--begin::Content-->
                                <div class="px-7 py-5">
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <!--begin::Label-->
                                        <label class="form-label fs-5 fw-semibold mb-3">Confirmed:</label>
                                        <!--end::Label-->
                                        <!--begin::Options-->
                                        <div class="d-flex flex-column flex-wrap fw-semibold"
                                             data-kt-customer-table-filter="participant_confirmed">
                                            <!--begin::Option-->
                                            <label
                                                class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5">
                                                <input class="form-check-input" type="radio" name="participant_confirmed"
                                                       value="all" checked="checked">
                                                <span class="form-check-label text-gray-600">All</span>
                                            </label>
                                            <!--end::Option-->
                                            <!--begin::Option-->
                                            <label
                                                class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5">
                                                <input class="form-check-input" type="radio" name="participant_confirmed"
                                                       value="yes">
                                                <span class="form-check-label text-gray-600">Yes</span>
                                            </label>
                                            <!--end::Option-->
                                            <!--begin::Option-->
                                            <label
                                                class="form-check form-check-sm form-check-custom form-check-solid mb-3">
                                                <input class="form-check-input" type="radio" name="participant_confirmed"
                                                       value="no">
                                                <span class="form-check-label text-gray-600">No</span>
                                            </label>
                                            <!--end::Option-->
                                        </div>
                                        <!--end::Options-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <!--begin::Label-->
                                        <label class="form-label fs-5 fw-semibold mb-3">Participant type:</label>
                                        <!--end::Label-->
                                        <!--begin::Options-->
                                        <div class="d-flex flex-column flex-wrap fw-semibold"
                                             data-kt-customer-table-filter="participant_type">
                                            <!--begin::Option-->
                                            <label
                                                class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5">
                                                <input class="form-check-input" type="radio" name="participant_type"
                                                       value="all" checked="checked">
                                                <span class="form-check-label text-gray-600">All</span>
                                            </label>
                                            <!--end::Option-->
                                            <!--begin::Option-->
                                            <label
                                                class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5">
                                                <input class="form-check-input" type="radio" name="participant_type"
                                                       value="first_year">
                                                <span class="form-check-label text-gray-600">First Year</span>
                                            </label>
                                            <!--end::Option-->
                                            <!--begin::Option-->
                                            <label
                                                class="form-check form-check-sm form-check-custom form-check-solid mb-3">
                                                <input class="form-check-input" type="radio" name="participant_type"
                                                       value="senior">
                                                <span class="form-check-label text-gray-600">Senior</span>
                                            </label>
                                            <!--end::Option-->
                                        </div>
                                        <!--end::Options-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="d-flex justify-content-end">
                                        <button type="reset" class="btn btn-light btn-active-light-primary me-2"
                                                data-kt-menu-dismiss="true" data-kt-customer-table-filter="reset">Reset
                                        </button>
                                        <button type="submit" class="btn btn-primary" data-kt-menu-dismiss="true"
                                                data-kt-customer-table-filter="filter">Apply
                                        </button>
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Menu 1-->
                            <!--end::Filter-->
                        </div>
                        <!--end::Toolbar-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <div id="kt_customers_table_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer"
                                   id="kt_customers_table">
                                <thead>
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="sorting" tabindex="0" aria-controls="kt_customers_table"
                                        rowspan="1" colspan="1"
                                        aria-label="Customer Name: activate to sort column ascending"
                                        >Participant Name
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="kt_customers_table"
                                        rowspan="1" colspan="1" aria-label="Email: activate to sort column ascending"
                                        >Email
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="kt_customers_table"
                                        rowspan="1" colspan="1" aria-label="Company: activate to sort column ascending"
                                        >Phone Number
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="kt_customers_table"
                                        rowspan="1" colspan="1"
                                        aria-label="Payment Method: activate to sort column ascending"
                                        >Type
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="kt_customers_table"
                                        rowspan="1" colspan="1"
                                        aria-label="Payment Method: activate to sort column ascending"
                                        >Confirmed
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="kt_customers_table"
                                        rowspan="1" colspan="1"
                                        aria-label="Created Date: activate to sort column ascending"
                                        >Created Date
                                    </th>
                                    <th class="sorting text-right" tabindex="0" aria-controls="kt_customers_table"
                                        rowspan="1" colspan="1"
                                        aria-label="Created Date: activate to sort column ascending"
                                    >View
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                @php($i = 1)
                                @foreach(\App\Models\ParticipantBarbecue::all() as $participant)
                                    <tr class="{{ $i++ % 2 == 0 ? 'even' : 'odd' }}">
                                        <td>
                                            <a
                                                href="{{ route('backoffice.bbq.participant', ['id' => $participant->id]) }}"
                                                class="text-gray-800 text-hover-primary mb-1"
                                            >
                                                {{ $participant->first_name }}
                                                {{ ' ' }}
                                                {{ $participant->last_name }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $participant->email_address }}
                                        </td>
                                        <td>
                                            {{ $participant->phone_number }}
                                        </td>
                                        <td data-filter="{{ $participant->first_year ? 'first_year' : 'senior' }}">
                                            @if($participant->first_year == true)
                                                <span class="badge badge-primary">First Year</span>
                                            @elseif($participant->senior == true)
                                                <span class="badge badge-success">Senior</span>
                                            @endif
                                        </td>
                                        <td data-filter="{{ $participant->confirmed ? 'yes' : 'no' }}">
                                            @if($participant->confirmed == true)
                                                <span class="badge badge-success">Yes</span>
                                            @else
                                                <span class="badge badge-danger">No</span>
                                            @endif
                                        </td>
                                        <td data-order="{{ $participant->created_at }}">{{ $participant->created_at }}</td>
                                        <td>
                                            <a
                                                href="{{ route('backoffice.camp.participant', ['id' => $participant->id]) }}"
                                                class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                            >
                                                <i class="ki-outline ki-eye fs-3"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Content container-->
    </div>
@endsection
