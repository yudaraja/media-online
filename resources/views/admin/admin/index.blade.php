@extends('admin.layouts.index')
@section('title', 'Daftar Admin')
@section('content')
<div class="row">
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <strong>{{ $message }}</strong>
    </div>
    @endif

    @if ($message = Session::get('error'))
    <div class="alert alert-danger">
        <strong>{{ $message }}</strong>
    </div>
    @endif
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('admin.create') }}">
                    <button class="btn btn-primary btn-sm float-end"><span class="mdi mdi-plus"></span> Tambah
                        Admin</button>
                </a>
                <h4 class="card-title">Daftar Admin</h4>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="15px">
                                    No
                                </th>
                                <th>
                                    Nama
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Dibuat
                                </th>
                                <th>
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->created_at->isoFormat('DD MMMM YYYY') }}</td>
                                <td>
                                    <div class="d-flex justify-content-evenly">
                                        <a href="{{ route('admin.edit', $data->id) }}">
                                            <button class="btn btn-primary btn-sm">Edit</button>
                                        </a>
                                        <form action="{{ route('admin.delete', $data->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Yakin ingin menghapus data?')" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
