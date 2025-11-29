<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

        <a href="index.html" class="logo d-flex align-items-center" style="font-size: xx-large; font-weight: 900;">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <img src="{{ asset('storage/' . $aplikasi->logo) }}" alt="Logo Baznas">
            <h1 class="sitename"><strong>BAZNAS</strong> <br> Kabupaten Buton</h1>
            {{-- <h1 class="sitename">UpConstruction</h1> <span>.</span> --}}
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="{{ route('index') }}" class="active">Beranda</a></li>

                @php
                    $menus = \App\Models\Menu::with('children')->whereNull('parent_id')->orderBy('order')->get();
                @endphp

                @foreach ($menus as $menu)
                    @if ($menu->children->count())
                        <li class="dropdown">
                            <a href="javascript:void(0)">
                                <span>{{ $menu->name }}</span> <i class="bi bi-chevron-down toggle-dropdown"></i>
                            </a>
                            <ul>
                                @foreach ($menu->children as $child)
                                    <li><a href="{{ url($child->slug) }}">{{ $child->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li><a href="{{ url($menu->slug) }}">{{ $menu->name }}</a></li>
                    @endif
                @endforeach

                <li><a href="{{ route('laporan.show') }}">Laporan</a></li>
                <li><a href="{{ route('kontak.index') }}">Kontak</a></li>
                <li class="nav-zakat">
                    <a href="{{ route('bayarzakat.index') }}" class="btn-zakat btn-zakat-nav">ZAKAT</a>
                </li>
            </ul>


            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>


    </div>
</header>
