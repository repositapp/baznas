<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="@if (Auth::user()->avatar != '') {{ asset('storage/' . Auth::user()->avatar) }}@else{{ URL::asset('build/dist/img/user2-160x160.jpg') }} @endif"
                    class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ session('nama') }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        {{-- <hr> --}}
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="main-utama">
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-dashboard"></i><span>Dashboard</span>
                </a>
            </li>
            <li class="header">MAIN NAVIGATION</li>
            <li
                class="treeview {{ Request::is('panel/upz*', 'panel/amil*', 'panel/muzaki*', 'panel/mustahik*') ? 'active menu-open' : '' }}">
                <a href="#">
                    <i class="fa fa-cubes"></i>
                    <span>Master Data</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @if (Auth::user()->role == 'admin')
                        <li class="{{ Request::is('panel/upz*') ? 'active' : '' }}"><a
                                href="{{ route('upz.index') }}"><i class="fa fa-circle-o"></i> Unit Pengumpul Zakat
                                (UPZ)</a></li>
                        <li class="{{ Request::is('panel/amil*') ? 'active' : '' }}"><a
                                href="{{ route('amil.index') }}"><i class="fa fa-circle-o"></i> Amil <br> (Petugas
                                Pengumpul Zakat) </a></li>
                        <li class="{{ Request::is('panel/laporan*') ? 'active' : '' }}"><a
                                href="{{ route('laporan.index') }}"><i class="fa fa-circle-o"></i> Laporan</a></li>
                    @endif
                    <li class="{{ Request::is('panel/muzaki*') ? 'active' : '' }}"><a
                            href="{{ route('muzaki.index') }}"><i class="fa fa-circle-o"></i> Muzaki (Pembayar
                            Zakat)</a></li>
                    <li class="{{ Request::is('panel/mustahik*') ? 'active' : '' }}"><a
                            href="{{ route('mustahik.index') }}"><i class="fa fa-circle-o"></i> Mustahik (Penerima
                            Zakat)</a></li>
                </ul>
            </li>
            <li class="{{ Request::is('panel/pembayaran*') ? 'active' : '' }}">
                <a href="{{ route('pembayaran.index') }}"><i class="fa fa-money"></i><span>Pembayaran</span></a>
            </li>
            <li class="{{ Request::is('panel/penyaluran*') ? 'active' : '' }}">
                <a href="{{ route('penyaluran.index') }}"><i class="fa fa-random"></i><span>Penyaluran</span></a>
            </li>
            @if (Auth::user()->role != 'petugas_upz')
                <li
                    class="treeview {{ Request::is('panel/program*', 'panel/bansos-penyaluran*') ? 'active menu-open' : '' }}">
                    <a href="#">
                        <i class="fa fa-files-o"></i> <span>Bantuan Sosial</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ Request::is('panel/program*') ? 'active' : '' }}"><a
                                href="{{ route('program.index') }}"><i class="fa fa-circle-o"></i> Program</a></li>
                        <li class="{{ Request::is('panel/bansos-penyaluran*') ? 'active' : '' }}"><a
                                href="{{ route('bansos-penyaluran.index') }}"><i class="fa fa-circle-o"></i>
                                Penyaluran</a></li>
                    </ul>
                </li>
            @endif
            @if (Auth::user()->role != 'petugas_upz')
                <li class="{{ Request::is('panel/artikel*') ? 'active' : '' }}">
                    <a href="{{ route('artikel.index') }}"><i class="fa fa-newspaper-o"></i><span>Artikel</span></a>
                </li>
            @endif
            <li
                class="treeview {{ Request::is('panel/pelaporan/pembayaran-zakat*', 'panel/pelaporan/penyaluran-zakat*') ? 'active menu-open' : '' }}">
                <a href="#">
                    <i class="fa fa-print"></i> <span>Pelaporan</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Request::is('panel/pelaporan/pembayaran-zakat*') ? 'active' : '' }}"><a
                            href="{{ route('pelaporan.pembayaran') }}"><i class="fa fa-circle-o"></i> Data
                            Pembayaran</a>
                    </li>
                    <li class="{{ Request::is('panel/pelaporan/penyaluran-zakat*') ? 'active' : '' }}"><a
                            href="{{ route('pelaporan.penyaluran') }}"><i class="fa fa-circle-o"></i> Data
                            Pengeluaran</a></li>
                </ul>
            </li>
            <li class="header">More</li>
            @if (Auth::user()->role != 'petugas_upz')
                <li class="treeview {{ Request::is('panel/halaman*', 'panel/menu*') ? 'active menu-open' : '' }}">
                    <a href="#">
                        <i class="fa fa-television"></i> <span>Modul</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ Request::is('panel/halaman*') ? 'active' : '' }}"><a
                                href="{{ route('halaman.index') }}"><i class="fa fa-circle-o"></i> Halaman</a></li>
                        <li class="{{ Request::is('panel/menu*') ? 'active' : '' }}"><a
                                href="{{ route('menu.index') }}"><i class="fa fa-circle-o"></i>
                                Menu</a></li>
                    </ul>
                </li>
            @endif
            @if (Auth::user()->role == 'admin')
                <li
                    class="treeview {{ Request::is('panel/users*', 'panel/kategori*', 'panel/kategori_upz*', 'panel/golongan_mustahik*', 'panel/zakat*', 'panel/aplikasi*', 'panel/bank*') ? 'active menu-open' : '' }}">
                    <a href="#">
                        <i class="fa fa-gears"></i> <span>Pengaturan</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="{{ Request::is('panel/users*') ? 'active' : '' }}"><a
                                href="{{ route('users.index') }}"><i class="fa fa-circle-o"></i> Akun Pengguna</a></li>
                        <li class="{{ Request::is('panel/bank*') ? 'active' : '' }}"><a
                                href="{{ route('bank.index') }}"><i class="fa fa-circle-o"></i> Akun Pembayaran</a>
                        </li>
                        <li class="{{ Request::is('panel/kategori*') ? 'active' : '' }}"><a
                                href="{{ route('kategori.index') }}"><i class="fa fa-circle-o"></i> Kategori
                                Artikel</a>
                        </li>
                        <li class="{{ Request::is('panel/kategori_upz*') ? 'active' : '' }}"><a
                                href="{{ route('kategori_upz.index') }}"><i class="fa fa-circle-o"></i> Kategori
                                UPZ</a>
                        </li>
                        <li class="{{ Request::is('panel/zakat*') ? 'active' : '' }}"><a
                                href="{{ route('zakat.index') }}"><i class="fa fa-circle-o"></i> Kategori Zakat</a>
                        </li>
                        <li class="{{ Request::is('panel/golongan_mustahik*') ? 'active' : '' }}"><a
                                href="{{ route('golongan_mustahik.index') }}"><i class="fa fa-circle-o"></i> Golongan
                                Mustahik</a></li>
                        <li class="{{ Request::is('panel/aplikasi*') ? 'active' : '' }}"><a
                                href="{{ route('aplikasi.index') }}"><i class="fa fa-circle-o"></i> Aplikasi</a></li>
                    </ul>
                </li>
            @endif
            <li>
                <a href="javascript:void();"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                        class="fa fa-power-off"></i><span>Keluar</span></a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
