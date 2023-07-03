@extends('backoffice.layout')
@section('title', 'Start')

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
                        <a class="text-muted text-hover-primary"
                           href="{{ route('backoffice.pos.products') }}">Products</a>
                    </li>

                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>

                    <li class="breadcrumb-item text-muted">
                        Add Product
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
            <div class="card card-flush py-4">
                <!--begin::Card body-->
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <!--begin::Input group-->
                        <div class="mb-10 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="required form-label">Product Name</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" name="product_name" class="form-control mb-2" placeholder="Product name"
                                   value="" required>
                            <!--end::Input-->
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <label class="required form-label">Product Price</label>
                        <div class="input-group mb-10">
                            <span class="input-group-text" id="basic-addon1">€</span>
                            <input type="number" name="price" class="form-control" placeholder="Price"
                                   aria-label="Price"
                                   aria-describedby="basic-addon1" required min="0,1" step="0.1">
                        </div>
                        <!--end::Input group-->

                        <div class="row">
                            <div class="col-xl-2">
                                <label class="form-label">Enable Product</label>
                                <div class="form-check form-switch form-check-custom form-check-solid mb-20">
                                    <input class="form-check-input" name="enabled" type="checkbox" value="on" checked
                                           id="flexSwitchDefault"/>
                                    <label class="form-check-label" for="flexSwitchDefault">
                                        Enabled
                                    </label>
                                </div>
                            </div>
                            <div class="col-xl-2">
                                <label class="form-label">Age Restriction</label>
                                <div class="form-check form-switch form-check-custom form-check-danger form-check-solid mb-20">
                                    <input class="form-check-input" name="restricted" type="checkbox" value="on"
                                           id="flexSwitchDefault"/>
                                    <label class="form-check-label" for="flexSwitchDefault">
                                        Restricted
                                    </label>
                                </div>
                            </div>
                        </div>

                        <style>
                            .image-input-placeholder {
                                background-image: url({{ asset('backoffice/media/svg/avatars/blank.svg') }});
                            }

                            [data-bs-theme="dark"] .image-input-placeholder {
                                background-image: url({{ asset('backoffice/media/svg/avatars/blank-dark.svg') }});
                            }
                        </style>

                        <label class="required form-label mb-10">Product Image</label>
                        <div class="row align-items-center">
                            <div class="col-xl-2">
                                <!--begin::Image input-->
                                <div class="image-input image-input-empty image-input-placeholder"
                                     data-kt-image-input="true">
                                    <!--begin::Image preview wrapper-->
                                    <div class="image-input-wrapper w-125px h-125px"></div>
                                    <!--end::Image preview wrapper-->

                                    <!--begin::Edit button-->
                                    <label
                                        class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="change"
                                        data-bs-toggle="tooltip"
                                        data-bs-dismiss="click"
                                        title="Change picture">
                                        <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span
                                                class="path2"></span></i>

                                        <!--begin::Inputs-->
                                        <input required type="file" name="picture" accept=".png, .jpg, .jpeg"/>
                                        <input type="hidden" name="picture_remove"/>
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Edit button-->

                                    <!--begin::Cancel button-->
                                    <span
                                        class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="cancel"
                                        data-bs-toggle="tooltip"
                                        data-bs-dismiss="click"
                                        title="Remove picture">
        <i class="ki-outline ki-cross fs-3"></i>
    </span>
                                    <!--end::Cancel button-->

                                    <!--begin::Remove button-->
                                    <span
                                        class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="remove"
                                        data-bs-toggle="tooltip"
                                        data-bs-dismiss="click"
                                        title="Remove picture">
        <i class="ki-outline ki-cross fs-3"></i>
    </span>
                                    <!--end::Remove button-->
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div class="text-muted fs-7 mt-n10">Set the product thumbnail image. Only *.png, *.jpg
                                    and *.jpeg image files are accepted, but *.jpg preferred.
                                </div>
                            </div>
                            <!--end::Image input-->
                        </div>
                        <button type="submit" class="btn btn-light-primary mt-10">
                            <i class="ki-duotone ki-check-square fs-1">
                                <i class="path1"></i>
                                <i class="path2"></i>
                            </i>
                            Add Product
                        </button>
                    </form>
                </div>
                <!--end::Card header-->
            </div>
        </div>
        <!--end::Content container-->
    </div>
@endsection
