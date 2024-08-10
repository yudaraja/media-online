@extends('admin.layouts.index')
@section('title', 'Create News')
@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Tambah Berita</h4>
            <form class="forms-sample" action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Judul</label>
                    <input value="{{ old('title') }}" name="title" type="text"
                        class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Judul Berita">
                    @error('title')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="thumbnail">Thumbnail</label>
                    <input type="file" name="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror"
                        id="thumbnail">
                    @error('thumbnail')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="content">Konten Berita</label>
                    <textarea name="content" class="form-control @error('content') is-invalid @enderror" id="content"
                        rows="5" placeholder="Isi berita">{{ old('content') }}</textarea>
                    @error('content')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="category_id">Kategori</label>
                    <select name="category_id" id="category_id"
                        class="form-control @error('category_id') is-invalid @enderror">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id')==$category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="float-end">
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                </div>
            </form>
            <a href="{{ route('news.index') }}">
                <button class="btn btn-light float-end mx-2">Kembali</button>
            </a>
        </div>
    </div>
</div>
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#content'))
        .catch(error => {
            console.error(error);
        });
</script>
@endsection
