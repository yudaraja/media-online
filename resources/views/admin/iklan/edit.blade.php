@extends('admin.layouts.index')
@section('title', 'Edit Iklan')
@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Iklan: {{ $iklan->link }}</h4>
            <form class="forms-sample" action="{{ route('iklan.update', $iklan->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="image">Gambar</label>
                    <input name="image" type="file" class="form-control @error('image') is-invalid @enderror"
                        id="image">
                    <img src="{{ asset('storage/' . $iklan->image) }}" alt="Iklan Image"
                        style="width: 150px; height: auto;" class="mt-2">
                    @error('image')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="link">Link</label>
                    <input value="{{ old('link', $iklan->link) }}" name="link" type="text"
                        class="form-control @error('link') is-invalid @enderror" id="link" placeholder="Link iklan">
                    @error('link')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="float-end">
                    <button type="submit" class="btn btn-primary me-2">Update</button>
                </div>
            </form>
            <a href="{{ route('iklan.index') }}">
                <button class="btn btn-light float-end mx-2">Kembali</button>
            </a>
        </div>
    </div>
</div>
@endsection
