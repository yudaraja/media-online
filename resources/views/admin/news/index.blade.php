@extends('admin.layouts.index')
@section('title', 'Berita')
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
                <a href="{{ route('news.create') }}">
                    <button class="btn btn-primary btn-sm float-end"><span class="mdi mdi-plus"></span> Tambah
                        Berita</button>
                </a>
                <h4 class="card-title">Daftar Berita</h4>
                <div class="table-responsive pt-3">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="15px">
                                    No
                                </th>
                                <th>
                                    Judul
                                </th>
                                <th>
                                    Kategori
                                </th>
                                <th>
                                    Is headline
                                </th>
                                <th>
                                    Is Pilihan
                                </th>
                                <th>
                                    Oleh
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
                            @foreach ($news as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->title }}</td>
                                <td>{{ $data->category->name }}</td>
                                <td>
                                    <form action="{{ route('news.toggle-headline', $data->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="btn btn-sm {{ $data->is_headline ? 'btn-success' : 'btn-secondary' }}">
                                            {{ $data->is_headline ? 'Yes' : 'No' }}
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{ route('news.toggle-pilihan', $data->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="btn btn-sm {{ $data->is_pilihan ? 'btn-success' : 'btn-secondary' }}">
                                            {{ $data->is_pilihan ? 'Yes' : 'No' }}
                                        </button>
                                    </form>
                                </td>
                                <td>{{ $data->user->name }}</td>
                                <td>{{ $data->created_at->isoFormat('DD MMMM YYYY') }}</td>
                                <td>
                                    <div class="d-flex justify-content-evenly">
                                        <a href="{{ route('news.edit', $data->id) }}">
                                            <button class="btn btn-primary btn-sm">Edit</button>
                                        </a>
                                        <form action="{{ route('news.destroy', $data->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Yakin ingin menghapus data?')"
                                                class="btn btn-danger btn-sm">Hapus</button>
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
