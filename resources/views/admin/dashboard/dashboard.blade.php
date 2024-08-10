@extends('admin.layouts.index')
@section('title', 'Dashboard')
@section('content')
<style>
    <style>

    /* Gaya untuk card yang berisi grafik */
    .performance-card {
        border-radius: 15px;
        background-color: #ffffff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-top: 20px;
    }

    .performance-card .card-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #333;
    }

    .performance-card .card-subtitle {
        font-size: 1rem;
        color: #666;
    }

    .chartjs-wrapper {
        position: relative;
        height: 400px;
        /* Sesuaikan tinggi grafik sesuai kebutuhan */
        margin-top: 20px;
    }

    .chartjs-wrapper canvas {
        width: 100% !important;
        /* Pastikan canvas mengisi lebar container */
        height: 100% !important;
        /* Pastikan canvas mengisi tinggi container */
    }
</style>

</style>
<div class="row">
    <div class="col-sm-12">
        <div class="home-tab">
            <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab"
                            aria-controls="overview" aria-selected="true">Overview</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content tab-content-basic">
                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="statistics-details d-flex align-items-center justify-content-between">
                                <div>
                                    <p class="statistics-title">Total Berita</p>
                                    <h3 class="rate-percentage">{{ $totalNews }}</h3>
                                </div>
                                <div>
                                    <p class="statistics-title">Total Kategori</p>
                                    <h3 class="rate-percentage">{{ $totalCategories }}</h3>
                                </div>
                                <div>
                                    <p class="statistics-title">Total Admin</p>
                                    <h3 class="rate-percentage">{{ $totalAdmins }}</h3>
                                </div>
                                <div>
                                    <p class="statistics-title">Total Views</p>
                                    <h3 class="rate-percentage">{{ number_format($totalViews) }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
