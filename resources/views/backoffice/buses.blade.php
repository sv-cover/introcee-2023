@extends('backoffice.layout')
@section('title', 'Camp Buses')

@section('content')
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-0">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Buses
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
                        Wallets
                    </li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
        </div>
        <!--end::Toolbar container-->
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="row g-5 g-xl-10">
                <div class="card">
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table table-striped mt-7 gy-5 gs-7">
                                <thead>
                                <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                                    <th>ID</th>
                                    <th>Bus Number</th>
                                    <th>Capacity</th>
                                    <th>Count</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach(\App\Models\Bus::all() as $bus)
                                        <tr>
                                            <td>{{ $bus->id }}</td>
                                            <td><b>Bus {{ $bus->bus_number }}</b></td>
                                            <td>{{ $bus->capacity }}</td>
                                            <td>{{ $bus->get_count() }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Content container-->
    </div>
    <div class="modal fade" id="kt_modal_auction" tabindex="-1" style="display: none;" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bold">Make Auction</h2>
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
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7 mt-2">
                    <!--begin::Form-->
                    <form id="kt_modal_add_payment_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                          action="{{ route('backoffice.pos.submitauction') }}" method="post">
                        @csrf

                        <label for="product" class="mb-2">Product Name</label>
                        <input name="product" class="mb-6 form-control" id="product" type="text"
                               placeholder="Product here..."/>
                        <label for="price" class="mb-2">Price</label>
                        <div class="input-group mb-5">
                            <span class="input-group-text" id="basic-addon1">€</span>
                            <input name="price" type="number" class="form-control" placeholder="Price..." min="0"
                                   step="0.1">
                        </div>
                        <label for="barcode" class="mb-2">Barcode</label>
                        <input name="barcode" class="mb-6 form-control" id="barcode" type="text"
                               placeholder="Barcode here..."/>

                        <!--begin::Actions-->
                        <div class="text-center mt-15">
                            <button type="reset" data-bs-toggle="modal"
                                    data-bs-target="#kt_modal_auction" class="btn btn-light me-3">
                                Cancel
                            </button>
                            <button type="submit" name="confirm" value="1" id="kt_modal_add_payment_submit"
                                    class="btn btn-primary">
                                <span class="indicator-label">Submit auction</span>
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
@endsection
