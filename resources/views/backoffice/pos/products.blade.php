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
                <a href="{{ route('backoffice.pos.products.add') }}" class="btn btn-sm fw-bold btn-primary">
                    <i class="ki-duotone ki-plus-square fs-1">
                        <i class="path1"></i>
                        <i class="path2"></i>
                        <i class="path3"></i>
                    </i>
                    Add Product
                </a>
                <!--end::Primary button-->
            </div>
        </div>
        <!--end::Toolbar container-->
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="row g-5 g-xl-10">
                @foreach(\App\Models\Product::all() as $product)
                    <div class="col-xl-3 mb-xl-10">
                        <!--begin::Card-->
                        <div class="card card-flush flex-row-fluid p-7 pb-5">
                            @if(!$product->enabled)
                                <span class="badge badge-secondary position-absolute" style="top: -5px;right: 10px;">Disabled</span>
                            @endif
                            <!--begin::Body-->
                            <div class="card-body text-center p-0">
                                <!--begin::Food img-->
                                <img src="data:image/jpg;base64,{{ base64_encode($product->image) }}"
                                     class="rounded-3 mb-4 mw-90px {{  $product->enabled ? '' : 'opacity-50' }}"
                                     alt="lol">
                                <!--end::Food img-->
                                <!--begin::Info-->
                                <div class="mb-2 {{  $product->enabled ? '' : 'opacity-50' }}">
                                    <!--begin::Title-->
                                    <div class="text-center">
                                        <span
                                            class="fw-bold text-gray-800 cursor-pointer text-hover-primary fs-3 fs-xl-1">
                                            {{ $product->name }}
                                            @if($product->age_restriction)
                                                <span class="badge badge-danger">NIX 18</span>
                                            @endif
                                        </span>
                                    </div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Total-->
                                <span
                                    class="text-success {{  $product->enabled ? '' : 'opacity-75' }} text-end fw-bold fs-2">€{{ number_format($product->price, 2, ',') }}</span>
                                <!--end::Total-->
                                <div class="row g-5 mt-1">
                                    <div class="col-6">
                                        <a data-bs-toggle="modal" data-bs-target="#d{{ $product->id }}"
                                           class="btn btn-sm btn-icon btn-block w-100 btn-light-danger"><i
                                                class="ki-outline ki-trash"></i></a>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('backoffice.pos.products.edit', ['id' => $product->id]) }}"
                                           class="btn btn-sm btn-icon btn-block w-100 btn-light-primary"><i
                                                class="ki-outline ki-pencil"></i></a>
                                    </div>
                                </div>
                                <div class="modal fade" tabindex="-1" id="d{{ $product->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title">Delete</h3>

                                                <!--begin::Close-->
                                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                                     data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                                            class="path2"></span></i>
                                                </div>
                                                <!--end::Close-->
                                            </div>

                                            <div class="modal-body">
                                                <p class="fs-2">Are you sure you want to delete the product
                                                    '<b>{{ $product->name }}</b>'?</p>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                                    Cancel
                                                </button>
                                                <form
                                                    action="{{ route('backoffice.pos.products.delete', ['id' => $product->id]) }}" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Card-->
                    </div>
                @endforeach
            </div>
        </div>
        <!--end::Content container-->
    </div>
@endsection
