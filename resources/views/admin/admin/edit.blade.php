@extends('admin.layouts.index')
@section('title', 'Edit Admin')
@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Edit Admin : {{ $admin->name }}</h4>
            <form class="forms-sample" action="{{ route('admin.update', $admin->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input value="{{ old('name', $admin->name) }}" name="name" type="text" class="form-control @error('name') is-invalid
                    @enderror" id="name" placeholder="Nama">
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input value="{{ old('email', $admin->email) }}" name="email" type="email"
                        class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email">
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input name="password" type="password" class="form-control @error('password') is-invalid
                    @enderror" id="password" placeholder="Password">
                    @error('password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="float-end">
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                </div>
            </form>
            <a href="{{ route('admin.index') }}">
                <button class="btn btn-light float-end mx-2">Kembali</button>
            </a>
        </div>
    </div>
</div>
@endsection
