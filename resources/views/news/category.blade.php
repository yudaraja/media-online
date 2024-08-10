@extends('news.layouts.index')
@section('content')
<section class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="block category-listing category-style2">
                    <h3 class="news-title"><span>{{ $category->name }}</span></h3>

                    @if ($news->isNotEmpty())

                    @foreach ($news as $data)
                    <div class="post-block-wrapper post-list-view clearfix">
                        <div class="row">
                            <div class="col-md-5 col-sm-6">
                                <div class="post-thumbnail thumb-float-style">
                                    <a href="{{ route('news.show', $data->slug) }}">
                                        <img class="img-fluid" src="{{ asset('storage/' . $data->thumbnail) }}"
                                            alt="{{ $data->title }}" />
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-7 col-sm-6">
                                <div class="post-content">
                                    <div class="post-meta">
                                        <span>
                                            <i class="fa fa-clock-o"></i>
                                            <a href="{{ route('news.show', $data->slug) }}">{{
                                                $data->created_at->format('d M, Y') }}</a>
                                        </span>

                                        <span class="post-author">
                                            <a href="#" class="text-dark">by {{ $data->user->name ?? 'Unknown' }}</a>
                                        </span>
                                    </div>
                                    <h2 class="post-title title-large">
                                        <a href="{{ route('news.show', $data->slug) }}">{{ $data->title }}</a>
                                    </h2>

                                    <p>
                                        {!! Str::limit($data->content, 150) !!}
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <p>Tidak ada berita pada kategori ini.</p>
                    @endif
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                <div class="sidebar">
                    <div class="widget">
                        <h3 class="news-title">
                            <span>Berita Pilihan</span>
                        </h3>

                        @if ($pilihanNews->isNotEmpty())
                        {{-- Tampilkan berita pilihan pertama sebagai berita utama --}}
                        @php
                        $firstNews = $pilihanNews->first();
                        $otherNews = $pilihanNews->slice(1);
                        @endphp

                        <div class="post-overlay-wrapper">
                            <div class="post-thumbnail">
                                <img class="img-fluid" src="{{ asset('storage/' . $firstNews->thumbnail) }}"
                                    alt="post-thumbnail" />
                            </div>
                            <div class="post-content">
                                <a class="post-category white"
                                    href="{{ route('news.category', $firstNews->category->slug) }}">{{
                                    $firstNews->category->name }}</a>
                                <h2 class="post-title">
                                    <a href="{{ route('news.show', $firstNews->slug) }}">{{ $firstNews->title }}</a>
                                </h2>
                                <small class="text-white">Jumlah Views : {{ $firstNews->views }}</small>
                                <div class="post-meta white">
                                    <span class="posted-time"><i class="fa fa-clock-o mr-1"></i>{{
                                        $firstNews->created_at->format('d M, Y') }}</span>
                                    <span> by </span>
                                    <span class="post-author">
                                        <a href="#">{{ $firstNews->user->name ?? 'Unknown' }}</a>
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Tampilkan berita pilihan lainnya dalam bentuk daftar --}}
                        <div class="post-list-block">
                            @foreach ($otherNews as $news)
                            <div class="post-block-wrapper post-float">
                                <div class="post-thumbnail">
                                    <a href="{{ route('news.show', $news->slug) }}">
                                        <img class="img-fluid" src="{{ asset('storage/' . $news->thumbnail) }}"
                                            alt="post-thumbnail" />
                                    </a>
                                </div>
                                <div class="post-content">
                                    <h2 class="post-title title-sm">
                                        <a href="{{ route('news.show', $news->slug) }}">{{ $news->title }}</a>
                                    </h2>
                                    <small>Jumlah Views : {{ $news->views }}</small>
                                    <div class="post-meta">
                                        <span class="posted-time"><i class="fa fa-clock-o mr-1"></i>{{
                                            $news->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p>Tidak ada berita pilihan.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
