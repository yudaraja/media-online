<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item nav-category">Media Online</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('category.index') }}">
                <i class="mdi mdi-shape menu-icon"></i>
                <span class="menu-title">Kategori</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('news.index') }}">
                <i class="mdi mdi-newspaper menu-icon"></i>
                <span class="menu-title">Berita</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('iklan.index') }}">
                <i class="mdi mdi-newspaper menu-icon"></i>
                <span class="menu-title">Banner Iklan</span>
            </a>
        </li>
        <li class="nav-item nav-category">Menu</li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.index') }}">
                <i class="mdi mdi-account menu-icon"></i>
                <span class="menu-title">Admin</span>
            </a>
        </li>
    </ul>
</nav>
