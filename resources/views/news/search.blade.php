@extends('news.layouts.index')

@section('content')
<div class="container">
    <h1>Hasil Pencarian untuk "{{ $query }}"</h1>

    @if($news->isEmpty())
    <p>Tidak ada hasil ditemukan.</p>
    @else
    <ul class="list-group">
        @foreach($news as $item)
        <li class="list-group-item">
            <div class="row">
                <div class="col-md-3">
                    @if($item->thumbnail)
                    <img src="{{ asset('storage/' . $item->thumbnail) }}" alt="{{ $item->title }}" class="img-fluid">
                    @else
                    <img src="path/to/default-image.jpg" alt="Default Image" class="img-fluid">
                    @endif
                </div>
                <div class="col-md-9">
                    <a href="{{ route('news.show', $item->id) }}">{{ $item->title }}</a>
                    <p>{!! Str::limit($item->content, 150) !!}</p>
                </div>
            </div>
        </li>
        @endforeach
    </ul>
    @endif
</div>

@endsection
