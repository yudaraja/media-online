@extends('admin.layouts.index')
@section('title', 'Create Category')
@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Tambah Kategori</h4>
            <form class="forms-sample" action="{{ route('category.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input value="{{ old('name') }}" name="name" type="text" class="form-control @error('name') is-invalid
                    @enderror" id="name" placeholder="Nama kategori">
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="float-end">
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                </div>
            </form>
            <a href="{{ route('category.index') }}">
                <button class="btn btn-light float-end mx-2">Kembali</button>
            </a>
        </div>
    </div>
</div>
@endsection
