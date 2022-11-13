<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">
                        Menu
                    </li>
                    {{-- @if (Auth()->user()->role == 'admin') --}}
                   
                    {{-- Role PPIC --}}
                    @if (Auth()->user()->role == 'ppic')

                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-14" aria-controls="submenu-14"><i class="fas fa-fw"></i>Dashboard</a>
                        <div id="submenu-14" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="/dashboard_ppic">Dashboard<span class="badge badge-secondary">New</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fa fa-fw "></i>Produk</a>
                        <div id="submenu-2" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="/master_produk">Produk<span class="badge badge-secondary">New</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-fw"></i>Bahan Baku</a>
                        <div id="submenu-3" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="/master_bahan_baku">Bahan Baku<span class="badge badge-secondary">New</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-4"><i class="fas fa-fw"></i>BOM</a>
                        <div id="submenu-4" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="/bom">Bill Of Material<span class="badge badge-secondary">New</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-5" aria-controls="submenu-5"><i class="fas fa-fw"></i>Pesanan</a>
                        <div id="submenu-5" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="/pesanan">Pesanan<span class="badge badge-secondary">New</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-6" aria-controls="submenu-6"><i class="fas fa-fw"></i>MPS</a>
                        <div id="submenu-6" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="/mps">Master Production Schedule<span class="badge badge-secondary">New</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-7" aria-controls="submenu-7"><i class="fas fa-fw"></i>MRP</a>
                        <div id="submenu-7" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="/mrp/create">Material Requirement Planning<span class="badge badge-secondary">New</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-13" aria-controls="submenu-13"><i class="fas fa-fw"></i>Laporan</a>
                        <div id="submenu-13" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="/laporan_perpesanan">Laporan Perpesanan<span class="badge badge-secondary">New</span></a>
                                </li>
                            </ul>

                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="/laporan_perbulan">Laporan Perbulan<span class="badge badge-secondary">New</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endif

                    {{-- Role Gudang --}}
                    @if (Auth()->user()->role == 'gudang')

                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-12" aria-controls="submenu-12"><i class="fas fa-fw"></i>Dashboard</a>
                        <div id="submenu-12" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="/dashboard_masuk">Dashboard<span class="badge badge-secondary">New</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-8" aria-controls="submenu-8"><i class="fas fa-fw"></i>Bahan Baku Masuk</a>
                        <div id="submenu-8" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="/bahan_baku_masuk">Bahan Baku Masuk<span class="badge badge-secondary">New</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-9" aria-controls="submenu-9"><i class="fas fa-fw"></i>Bahan Baku Keluar</a>
                        <div id="submenu-9" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="/bahan_baku_keluar">Bahan Baku Keluar<span class="badge badge-secondary">New</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-10" aria-controls="submenu-10"><i class="fas fa-fw"></i>Laporan</a>
                        <div id="submenu-10" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="/laporan_masuk">Laporan Masuk<span class="badge badge-secondary">New</span></a>
                                </li>
                            </ul>

                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="/laporan_keluar">Laporan Keluar<span class="badge badge-secondary">New</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-16" aria-controls="submenu-16"><i class="fas fa-fw"></i>Kartu Stok</a>
                        <div id="submenu-16" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="/kartu_stok">Kartu Stok<span class="badge badge-secondary">New</span></a>
                                </li>
                            </ul>

                            {{-- <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="/kartu_keluar">Kartu Stok Keluar<span class="badge badge-secondary">New</span></a>
                                </li>
                            </ul> --}}
                        </div>
                    </li>
                    @endif

                    {{-- Role Pemesanan --}}
                    @if (Auth()->user()->role == 'pengadaan')
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-15" aria-controls="submenu-15"><i class="fas fa-fw"></i>Laporan Pemesanan</a>
                        <div id="submenu-15" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="/laporan_pemesanan">Laporan Pemesanan<span class="badge badge-secondary">New</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endif

                    {{-- Role Produksi --}}
                    @if (Auth()->user()->role == 'produksi')
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-11" aria-controls="submenu-11"><i class="fas fa-fw"></i>Laporan MPS</a>
                        <div id="submenu-11" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="/laporan_mps">Laporan MPS<span class="badge badge-secondary">New</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endif
                    

                    

                    

                    

                    

                    
                    {{-- @endif --}}
                   

                    {{-- @forelse (session('role') as $item)
                    @if (Auth()->user()->role == 'pegawai' || Auth()->user()->role == 'admin') --}}
                    {{-- <li class="nav-item"> --}}
                        {{-- <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                            data-target="#submenu-{{$item->id_role+10}}" aria-controls="submenu-{{$item->id_role+10}}"><i
                                class="fa fa-fw "></i>{{$item->header}}</a>
                        <div id="submenu-{{$item->id_role+10}}" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{$item->url}}">{{$item->nama}}<span
                                            class="badge badge-secondary">New</span></a>
                                </li>
                            </ul>
                        </div> --}}
                    {{-- </li> --}}
                {{-- @endif --}}
                    {{-- @empty --}}
                        
                    {{-- @endforelse --}}

                   


                    {{-- @if ( Auth()->user()->role == 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                                data-target="#submenu-5" aria-controls="submenu-5"><i
                                    class="fas fa-fw fa-table"></i>Supplier</a>
                            <div id="submenu-5" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="/master_supplier">Master Supplier</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                       

                       
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                                data-target="#submenu-3" aria-controls="submenu-3"><i
                                    class="fas fa-fw fa-chart-pie"></i>Transaksi</a>
                            <div id="submenu-3" class="collapse submenu" style="">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="/transaksi_masuk">Transaksi Bahan Baku Masuk<span
                                                class="badge badge-secondary">New</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="/transaksi_keluar">Transaksi Bahan Baku Keluar</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif --}}

                    {{-- @if (Auth()->user()->role == 'pegawai' )
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                            data-target="#submenu-5" aria-controls="submenu-5"><i
                                class="fas fa-fw fa-table"></i>Supplier</a>
                        <div id="submenu-5" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="/master_supplier">Master Supplier</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                   

                   
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                            data-target="#submenu-3" aria-controls="submenu-3"><i
                                class="fas fa-fw fa-chart-pie"></i>Transaksi</a>
                        <div id="submenu-3" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="/transaksi_masuk">Transaksi Bahan Baku Masuk<span
                                            class="badge badge-secondary">New</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/transaksi_keluar">Transaksi Bahan Baku Keluar</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif

                    <li class="nav-divider">
                        Reports
                    </li>--}}
                    {{-- @if (Auth()->user()->role == 'admin') --}}
                  {{-- <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                            data-target="#submenu-3" aria-controls="submenu-3"><i
                                class="fas fa-fw "></i>Laporan Masuk</a>
                        <div id="submenu-3" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="/laporan_masuk">Laporan Masuk<span
                                            class="badge badge-secondary">New</span></a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link" href="/transaksi_keluar">Transaksi Bahan Baku Keluar</a>
                                </li> --}}
                            {{-- </ul>
                        </div>
                    </li> --}} 
                    {{-- @endif --}}

                    {{-- @if (Auth()->user()->role == 'admin') --}}
                    {{-- <li class="nav-item">
                          <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                              data-target="#submenu-6" aria-controls="submenu-6"><i
                                  class="fas fa-fw "></i>Laporan Keluar</a>
                          <div id="submenu-6" class="collapse submenu" style="">
                              <ul class="nav flex-column">
                                  <li class="nav-item">
                                      <a class="nav-link" href="/laporan_keluar">Laporan Keluar<span
                                              class="badge badge-secondary">New</span></a>
                                  </li> --}}
                                  {{-- <li class="nav-item">
                                      <a class="nav-link" href="/transaksi_keluar">Transaksi Bahan Baku Keluar</a>
                                  </li> --}}
                              {{-- </ul>
                          </div>
                      </li> --}}
                      {{-- @endif --}}

                    {{-- <li class="nav-divider">
                        Akun
                    </li> --}}
                    {{-- @if (Auth()->user()->role == 'admin') --}}
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-8" aria-controls="submenu-8"><i class="fas fa-fw "></i>Manajemen Akun</a>
                        <div id="submenu-8" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="/manajemen_akun">Manajemen Akun</a>
                                </li>
                            </ul>
                        </div>
                    </li> --}}
                    {{-- @endif --}}

                </ul>
            </div>
        </nav>
    </div>
</div>
