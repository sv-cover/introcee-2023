@extends('backoffice.layout')
@section('title', 'POS Products')

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-0">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    POS Products
                </h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="http://127.0.0.1:8000/admin" class="text-muted text-hover-primary">Home</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted text-hover-primary">POS</a>
                    </li>

                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>

                    <li class="breadcrumb-item text-muted">
                        Products
                    </li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::Primary button-->
                <button data-bs-toggle="modal" data-bs-target="#send_balance_email" class="btn btn-sm fw-bold btn-primary">
                    <i class="ki-duotone ki-directbox-default fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                    </i>
                    Send balance emails
                </button>
                <!--end::Primary button-->
            </div>
        </div>
        <!--end::Toolbar container-->
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped gy-5 gs-7">
                            <thead>
                            <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email Address</th>
                                <th>Balance</th>
                                <th>Last Used</th>
                                <th>View</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\App\Models\Wallet::all() as $wallet)
                                <tr>
                                    <td>{{ $wallet->first_name }}</td>
                                    <td>{{ $wallet->last_name }}</td>
                                    <td>{{ $wallet->email }}</td>
                                    <td>€ <b>{{ $wallet->balance }}</b></td>
                                    <td><span class="badge badge-secondary"><i class="las la-history"></i>&nbsp;&nbsp;{{ $wallet->updated_at }}</span>
                                    </td>
                                    <td>
                                        <a
                                            class="btn btn-sm btn-icon btn-light-primary"
                                            href="{{ route('wallet', ['id' => $wallet->id]) }}"
                                            target="_blank"
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
            </div>
        </div>
        <!--end::Content container-->
    </div>
    <div class="modal fade" tabindex="-1" id="send_balance_email">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Send balance emails</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                         data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>

                <div class="modal-body">
                    <p class="text-center fs-5">
                        Are you sure you wish to send the confirmation email? please only do so after the camp and after consultation with the chair of the committee.
                    </p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal" data-bs-target="#send_balance_email">
                        Cancel
                    </button>
                    <form action="{{ route('backoffice.pos.wallets.email') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-info">Send Balance Email</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
