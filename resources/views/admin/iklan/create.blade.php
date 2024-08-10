@extends('admin.layouts.index')
@section('title', 'Tambah Iklan')
@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Tambah Iklan</h4>
            <form class="forms-sample" action="{{ route('iklan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="image">Gambar</label>
                    <input name="image" type="file" class="form-control @error('image') is-invalid @enderror"
                        id="image">
                    @error('image')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="link">Link</label>
                    <input value="{{ old('link') }}" name="link" type="text"
                        class="form-control @error('link') is-invalid @enderror" id="link" placeholder="Link iklan">
                    @error('link')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="float-end">
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                </div>
            </form>
            <a href="{{ route('iklan.index') }}">
                <button class="btn btn-light float-end mx-2">Kembali</button>
            </a>
        </div>
    </div>
</div>
@endsection
