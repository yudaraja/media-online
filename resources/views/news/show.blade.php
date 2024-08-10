@extends('news.layouts.index')
@section('content')
<section class="single-block-wrapper section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                <div class="single-post">
                    <div class="post-header mb-5">
                        <a class="post-category" href="{{ route('news.category', $news->category->slug) }}">{{
                            $news->category->name }}</a>
                        <h2 class="post-title">
                            {{ $news->title }}
                        </h2>
                        <small>Jumlah Views : {{ $news->views }}</small>
                    </div>
                    <div class="post-body">
                        <div class="post-featured-image">
                            <img src="{{ asset('storage/' . $news->thumbnail) }}" class="img-fluid"
                                alt="featured-image">
                        </div>
                        <div class="entry-content">
                            {!! $news->content !!}
                        </div>
                    </div>
                </div>


                <div class="related-posts-block">
                    <h3 class="news-title">
                        <span>Berita Serupa</span>
                    </h3>
                    <div class="news-style-two-slide">
                        @foreach($relatedPosts as $relatedPost)
                        <div class="item">
                            <div class="post-block-wrapper clearfix">
                                <div class="post-thumbnail mb-0">
                                    <a href="{{ route('news.show', $relatedPost->slug) }}">
                                        <img class="img-fluid" src="{{ asset('storage/' . $relatedPost->thumbnail) }}"
                                            alt="post-thumbnail" />
                                    </a>
                                </div>
                                <a class="post-category"
                                    href="{{ route('news.category', $relatedPost->category->slug) }}">
                                    {{ $relatedPost->category->name }}
                                </a>
                                <div class="post-content">
                                    <h2 class="post-title title-sm">
                                        <a href="{{ route('news.show', $relatedPost->slug) }}">{{ $relatedPost->title
                                            }}</a>
                                    </h2>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div id="comments" class="comments-block block">
                    <h3 class="news-title">
                        <span>{{ $comments->count() }} Komentar</span>
                    </h3>
                    <ul class="all-comments">
                        @foreach($comments as $comment)
                        <li>
                            <div class="comment">
                                <img class="commented-person" alt="" src="/media-online/images/user.png">
                                <div class="comment-body">
                                    <div class="meta-data">
                                        <span class="commented-person-name">{{ $comment->name }}</span>
                                        <span class="comment-hour d-block"><i class="fa fa-clock-o mr-2"></i>{{
                                            $comment->created_at->isoFormat('DD MMMM YYYY') }}</span>
                                    </div>
                                    <div class="comment-content">
                                        <p>{{ $comment->message }}</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="comment-form">
                    <h3 class="title-normal">Komentar</h3>
                    <p class="mb-4">Email yang kamu isi tidak akan dipublish</p>
                    <form action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="news_id" value="{{ $news->id }}">
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <input class="form-control" name="name" placeholder="Nama" type="text" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input class="form-control" name="email" placeholder="Email" type="email" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control required-field" name="message" placeholder="Pesan"
                                        rows="8" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button class="comments-btn btn btn-primary" type="submit">Kirim</button>
                            </div>
                        </div>
                    </form>
                </div>


            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="sidebar sidebar-right">

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
