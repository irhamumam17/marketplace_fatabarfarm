<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      {{-- <img src="{{asset('template_assets/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
      <span class="brand-text font-weight-light">Marketplace</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('template_assets/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link btnMenu">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link btnMenu">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.index') }}" class="nav-link">
                  <i class="fas fa-boxes nav-icon"></i>
                  <p>Admin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route("customer.index") }}" class="nav-link">
                  <i class="fas fa-toolbox nav-icon"></i>
                  <p>Pengguna</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link btnMenu">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Produk
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('product.category.index') }}" class="nav-link">
                  <i class="fas fa-boxes nav-icon"></i>
                  <p>Kategori</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('product.index') }}" class="nav-link">
                  <i class="fas fa-box nav-icon"></i>
                  <p>Produk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('product.varian.index') }}" class="nav-link">
                  <i class="fas fa-toolbox nav-icon"></i>
                  <p>Varian</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link btnMenu">
              <i class="nav-icon fas fa-clipboard-list"></i>
              <p>
                Transaksi
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('cart.index') }}" class="nav-link">
                  <i class="fas fa-shopping-cart nav-icon"></i>
                  <p>Keranjang</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('transaction.pending.index') }}" class="nav-link">
                  <i class="fas fa-spinner nav-icon"></i>
                  <p>Pending</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('transaction.konfirmasi.index') }}" class="nav-link">
                  <i class="fas fa-spinner nav-icon"></i>
                  <p>Konfirmasi Ongkir</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('transaction.packing.index') }}" class="nav-link">
                  <i class="fas fa-spinner nav-icon"></i>
                  <p>Packing</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('transaction.dikirim.index') }}" class="nav-link">
                  <i class="fas fa-spinner nav-icon"></i>
                  <p>Dikirim</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('transaction.success.index') }}" class="nav-link">
                  <i class="fas fa-check-circle nav-icon"></i>
                  <p>Sukses</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('transaction.cancel.index') }}" class="nav-link">
                  <i class="fas fa-ban nav-icon"></i>
                  <p>Batal</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('blog.index') }}" class="nav-link btnMenu">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>
                Berita
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('program.index') }}" class="nav-link btnMenu">
              <i class="nav-icon fas fa-tasks"></i>
              <p>
                Program
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link btnMenu">
              <i class="nav-icon fas fa-info"></i>
              <p>
                Informasi
                <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('info.sejarah') }}" class="nav-link">
                <i class="fas fa-history nav-icon"></i>
                <p>Sejarah</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('info.visi_misi') }}" class="nav-link">
                <i class="fas fa-bullseye nav-icon"></i>
                <p>Visi Misi</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('info.lokasi') }}" class="nav-link">
                <i class="fas fa-map-marker-alt nav-icon"></i>
                <p>Lokasi</p>
              </a>
            </li>
          </ul>
          <li class="nav-item">
            <a href="#" class="nav-link btnMenu">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Pengaturan
                <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('bank.index') }}" class="nav-link">
                <i class="fas fa-piggy-bank nav-icon"></i>
                <p>Bank</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('config.ui') }}" class="nav-link">
                <i class="fas fa-quidditch nav-icon"></i>
                <p>UI</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('config.pusher') }}" class="nav-link">
                <i class="fas fa-tools nav-icon"></i>
                <p>Pusher</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('config.smtp') }}" class="nav-link">
                <i class="fas fa-at nav-icon"></i>
                <p>Email</p>
              </a>
            </li>
          </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
