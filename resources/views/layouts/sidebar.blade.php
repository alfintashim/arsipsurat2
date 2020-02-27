<aside class="main-sidebar sidebar-dark-success elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link navbar-success">
     {{ logo_profil() }}
      <span class="brand-text font-weight-light">Aplikasi Arsip</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if(auth()->user()->id_role == 1 || auth()->user()->id_role == 2)
          <img src="{{asset('img/admin.jpg')}}" class="img-circle elevation-2" alt="User Image">
          @else
          <img src="{{asset('img/user.jpg')}}" class="img-circle elevation-2" alt="User Image">
          @endif
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->username }}</a>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->

          <!--START-->

          <li class="nav-item">
            <a href="{{ url('/')}}" class="nav-link @if(url('/') == request()->url() ) active @else '' @endif">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Beranda
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview {{ ( (request()->is('tsm*')) or (request()->is('tsk*')) ) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ ( (request()->is('tsm*')) or (request()->is('tsk*')) ) ? 'active' : '' }}">
              <i class="nav-icon fas fa-envelope"></i>
              <p>
                Transaksi Surat
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('tsm.index') }}" class="nav-link {{ (request()->is('tsm*')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Surat Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('tsk.index') }}" class="nav-link {{ (request()->is('tsk*')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Surat Keluar</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview {{ ( (request()->is('lsm*')) or (request()->is('lsk*')) ) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ ( (request()->is('lsm*')) or (request()->is('lsk*')) ) ? 'active' : '' }}">
              <i class="nav-icon fas fa-print"></i>
              <p>
                Cetak Laporan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('lsm.index') }}" class="nav-link {{ (request()->is('lsm*')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Surat Masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('lsk.index') }}" class="nav-link {{ (request()->is('lsk*')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Surat Keluar</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview {{ (request()->is('profil*') ) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ (request()->is('profil*') ) ? 'active' : '' }}">
              <i class="nav-icon fas fa-building"></i>
              <p>
                Instansi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('profil.index') }}" class="nav-link {{ (request()->is('profil*')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profil</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview {{ ( (request()->is('kns*')) or (request()->is('role*')) or (request()->is('user*')) ) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ ( (request()->is('kns*')) or (request()->is('role*')) or (request()->is('user*')) ) ? 'active' : '' }}">
              <i class="nav-icon fas fa-th-list"></i>
              <p>
                Master Data
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('kns.index') }}" class="nav-link {{ (request()->is('kns*')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kode Nomor Surat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('role.index') }}" class="nav-link {{ (request()->is('role*')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Level Akses</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('user.index') }}" class="nav-link {{ (request()->is('user*')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
            </ul>
          </li>

          {{-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Pengaturan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Basis Data
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ backpack_url('backup') }}" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Backup</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Restore</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li> --}}
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>