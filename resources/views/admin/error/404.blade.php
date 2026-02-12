@extends('layout.admin.master')

@section('title', '404 - الصفحة غير موجودة')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="d-md-flex d-block align-items-center justify-content-between my-4 page-header-breadcrumb">
                <div>
                    <p class="fw-semibold fs-18 mb-0">404 - الصفحة غير موجودة</p>
                </div>
            </div>
            <!-- Page Header Close -->

            <!-- Start::row-1 -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card custom-card">
                        <div class="card-body text-center py-5">
                            <div class="mb-4">
                                <h1 class="display-1 fw-bold text-primary">404</h1>
                                <h2 class="mb-3">الصفحة غير موجودة</h2>
                                <p class="text-muted mb-4">
                                    عذراً، الصفحة التي تبحث عنها غير موجودة أو تم نقلها.
                                </p>
                            </div>
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="{{ route('home') }}" class="btn btn-primary">
                                    <i class="ri-home-4-line me-1"></i>
                                    العودة للصفحة الرئيسية
                                </a>
                                <a href="javascript:history.back()" class="btn btn-outline-secondary">
                                    <i class="ri-arrow-left-line me-1"></i>
                                    العودة للخلف
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End::row-1 -->
        </div>
    </div>
@endsection

