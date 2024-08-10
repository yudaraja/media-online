@extends('news.layouts.index')
@section('content')
<section class="featured-posts">
    <div class="container">
        <div class="row no-gutters">
            @forelse ($headlines as $headline)
            <div class="col-md-6 col-xs-12 col-lg-4">
                <div class="featured-slider mr-md-3 mr-lg-3">
                    <div class="item" style="background-image:url({{ asset('storage/' . $headline->thumbnail) }})">
                        <div class="post-content">
                            <a href="{{ route('news.category', $headline->category->slug) }}"
                                class="post-cat bg-primary">{{ $headline->category->name }}</a>

                            <h2 class="slider-post-title">
                                <a href="{{ route('news.show', $headline->slug) }}">{{ $headline->title }}</a>
                            </h2>
                            <small class="text-white">Jumlah Views : {{ $headline->views }}</small>
                            <div class="post-meta mt-2">
                                <span class="posted-time"><i class="fa fa-clock-o mr-2 text-danger"></i>{{
                                    $headline->created_at->diffForHumans() }}</span>
                                <span class="post-author">
                                    <span> by </span>
                                    <a>{{ $headline->user->name ?? '-' }}</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="text-muted">Tidak ada headline</p>
            </div>
            @endforelse
        </div>
    </div>
</section>


<section class="block-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="news-style-one">
                    <h3 class="news-title">
                        <span>Semua Berita</span>
                    </h3>
                    <div class="news-style-one-slide">
                        @foreach ($allNews as $news)
                        <div class="item">
                            <div class="post-block-wrapper clearfix mb-5">
                                <div class="post-thumbnail">
                                    <a href="{{ route('news.show', $news->slug) }}">
                                        <img class="img-fluid" src="{{ asset('storage/' . $news->thumbnail) }}"
                                            alt="post-image" />
                                    </a>
                                </div>
                                <div class="post-content">
                                    <h2 class="post-title mt-3">
                                        <a href="{{ route('news.show', $news->slug) }}">{{ $news->title }}</a>
                                    </h2>
                                    <small>Jumlah Views : {{ $news->views }}</small>
                                    <div class="post-meta mb-2">
                                        <span class="posted-time"><i class="fa fa-clock-o mr-2"></i>{{
                                            $news->created_at->diffForHumans() }}</span>
                                        <span class="post-author">
                                            by
                                            <a href="#">{{ $news->user->name ?? 'Unknown' }}</a>
                                        </span>
                                    </div>
                                    <p>{!! Str::limit($news->content, 150) !!}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="py-40"></div>

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

<section class="news-style-four bg-light section-padding">
    <section class="news-style-four bg-light section-padding">
        <div class="container">
            <div class="row">
                @foreach ($newsByCategory as $categoryName => $newsItems)
                <div class="col-lg-4 col-md-6">
                    <div class="block">
                        <h3 class="news-title">
                            <span>{{ $categoryName }}</span>
                        </h3>
                        @if($newsItems->isNotEmpty())
                        <div class="post-overlay-wrapper clearfix">
                            @php
                            $featured = $newsItems->first();
                            @endphp
                            <div class="post-thumbnail">
                                <img class="img-fluid" src="{{ asset('storage/' . $featured->thumbnail) }}"
                                    alt="post-thumbnail" />
                            </div>
                            <div class="post-content">
                                <h2 class="post-title">
                                    <a href="{{ route('news.show', $featured->slug) }}">{{ $featured->title }}</a>
                                </h2>
                                <div class="post-meta white">
                                    <span class="posted-time">{{ $featured->created_at->diffForHumans() }}</span>
                                    <span class="post-author">by
                                        <a href="author.html">{{ $featured->user->name ?? 'Unknown' }}</a>
                                    </span>
                                    <span class="pull-right">
                                        <i class="fa fa-comments"></i>
                                        <a href="{{ route('news.show', $featured->slug) }}#comments">{{
                                            $featured->comments_count }}</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="post-list-block">
                            @foreach ($newsItems->slice(1) as $item)
                            <div class="post-block-wrapper post-float clearfix">
                                <div class="post-thumbnail">
                                    <img class="img-fluid" src="{{ asset('storage/' . $item->thumbnail) }}"
                                        alt="post-thumbnail" />
                                </div>
                                <div class="post-content">
                                    <h2 class="post-title title-sm">
                                        <a href="{{ route('news.show', $item->slug) }}">{{ $item->title }}</a>
                                    </h2>
                                    <div class="post-meta">
                                        <span class="posted-time">{{ $item->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p>Tidak ada berita pada kategori ini.</p>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</section>

<section class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="all-news-block">
                    <h3 class="news-title">
                        <span>Berita Terbaru</span>
                    </h3>
                    <div class="all-news">
                        <div class="row">
                            @foreach ($latestNews as $news)
                            <div class="col-lg-6 col-md-6">
                                <div class="post-block-wrapper post-float-half clearfix">
                                    <div class="post-thumbnail">
                                        <a href="{{ route('news.show', $news->id) }}">
                                            <img class="img-fluid post-thumbnail-img"
                                                src="{{ asset('storage/' . $news->thumbnail) }}" alt="post-thumbnail" />
                                        </a>
                                    </div>
                                    <div class="post-content">
                                        <a class="post-category"
                                            href="{{ route('news.category', $news->category->slug) }}">{{
                                            $news->category->name }}</a>
                                        <h2 class="post-title mt-3">
                                            <a href="{{ route('news.show', $news->slug) }}">{{ $news->title }}</a>
                                        </h2>
                                        <div class="post-meta">
                                            <span class="posted-time">{{ $news->created_at->diffForHumans() }}</span>
                                            <span class="post-author">by
                                                <a>{{ $news->user->name ?? 'Unknown' }}</a>
                                            </span>
                                        </div>
                                        <p>
                                            {!! Str::limit($news->content, 100) !!}...
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                <div class="sidebar">
                    <div class="widget">
                        <h3 class="news-title">
                            <span>Berita Terfavorit</span>
                        </h3>

                        @if ($beritaFavorit->isNotEmpty())
                        {{-- Tampilkan berita favorit pertama sebagai berita utama --}}
                        @php
                        $firstNews = $beritaFavorit->first();
                        $otherNews = $beritaFavorit->slice(1);
                        @endphp

                        <div class="post-overlay-wrapper">
                            <div class="post-thumbnail">
                                <img class="img-fluid" src="{{ asset('storage/' . $firstNews->thumbnail) }}"
                                    alt="post-thumbnail" />
                            </div>
                            <div class="post-content">
                                <a class="post-category white"
                                    href="{{ route('news.category', $firstNews->category->slug) }}">
                                    {{ $firstNews->category->name }}
                                </a>
                                <h2 class="post-title">
                                    <a href="{{ route('news.show', $firstNews->slug) }}">{{ $firstNews->title }}</a>
                                </h2>
                                <small class="text-white">Jumlah Views: {{ $firstNews->views }}</small>
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

                        {{-- Tampilkan berita favorit lainnya dalam bentuk daftar --}}
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
                                    <small>Jumlah Views: {{ $news->views }}</small>
                                    <div class="post-meta">
                                        <span class="posted-time"><i class="fa fa-clock-o mr-1"></i>{{
                                            $news->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p>Tidak ada berita favorit.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
