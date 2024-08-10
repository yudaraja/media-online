<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <nav class="navbar navbar-expand-lg site-main-nav navigation">
                <a class="navbar-brand d-lg-none" href="index.html">
                    <img src="images/logos/footer-logo.png" alt="">
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="fa fa-bars"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">

                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">Home</a>
                        </li>

                        @foreach ($categories as $category)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('news.category', $category->slug) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    <div class="nav-search ml-auto d-none d-lg-block">
                        <span id="search">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
<form class="site-search" action="{{ route('news.search') }}" method="POST">
    @csrf
    <input type="text" name="query" id="searchInput" placeholder="Masukkan kata kunci..." autofocus="">
    <button type="submit">Search</button>
    <div class="search-close">
        <span class="close-search">
            <i class="fa fa-times"></i>
        </span>
    </div>
</form>
