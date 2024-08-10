@extends('admin.layouts.index')
@section('title', 'Daftar Iklan')
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
                <a href="{{ route('iklan.create') }}">
                    <button class="btn btn-primary btn-sm float-end mb-3"><span class="mdi mdi-plus"></span> Tambah
                        Iklan</button>
                </a>
                <h4 class="card-title">Daftar Iklan</h4>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="15px">No</th>
                                <th>Gambar</th>
                                <th>Link</th>
                                <th>Is Tampil</th>
                                <th>Dibuat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($iklan as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="Iklan Image"
                                        style="width: 150px; height: auto;">
                                </td>
                                <td>{{ $item->link }}</td>
                                <td>
                                    <form action="{{ route('news.toggle-tampil', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="btn btn-sm {{ $item->is_tampil ? 'btn-success' : 'btn-secondary' }}">
                                            {{ $item->is_tampil ? 'Yes' : 'No' }}
                                        </button>
                                    </form>
                                </td>
                                <td>{{ $item->created_at->isoFormat('DD MMMM YYYY') }}</td>
                                <td>
                                    <div class="d-flex justify-content-evenly">
                                        <a href="{{ route('iklan.edit', $item->id) }}">
                                            <button class="btn btn-primary btn-sm">Edit</button>
                                        </a>
                                        <form action="{{ route('iklan.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
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
