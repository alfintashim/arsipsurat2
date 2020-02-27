<nav class="main-header navbar navbar-expand navbar-success navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      {{-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> --}}
    </ul>

    <!-- SEARCH FORM -->
    {{-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> --}}

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-stream"></i>
          {{-- <span class="badge badge-danger navbar-badge">3</span> --}}
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          @if(count(LogSurat::log()) > 0)
            @foreach ( LogSurat::log() as $item )
            <div class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <div class="media-body">
                  <h3 class="dropdown-item-title">No. Surat : {{$item->no_surat}}</h3>
                  @if ($item->status == 'DIKIRIM' && $item->read == NULL)
                    <p class="text-sm">Surat dikirim ke Kepala dan Sekcam.</p>
                  @elseif ($item->status == 'DIKIRIM' && $item->read == 'DIBACA')
                    <p class="text-sm">Surat telah dibaca oleh {{ $item->nama }}.</p>
                  @elseif ($item->status == 'DISPOSISI' && $item->read == NULL)
                    <p class="text-sm">Surat telah disposisi ke {{ $item->disp_ke }}.</p>
                  @elseif ($item->status == 'DISPOSISI' && $item->read == 'DIBACA')
                    <p class="text-sm">Disposisi telah dibaca oleh {{ $item->nama }}.</p>
                  @elseif ($item->status == 'SELESAI' && $item->read == 'NULL')
                    <p class="text-sm">Disposisi telah selesai oleh {{ $item->nama }}.</p>
                  @endif
                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{$item->created_at}}</p>
                  </div>
                </div>
                <!-- Message End -->
              </div>
              <div class="dropdown-divider"></div>
              @endforeach
            @else
              <div class="dropdown-item">
                <div class="media">
                  <div class="media-body">
                <p class="text-sm text-muted">Tidak ada data</p>
                  </div>
                </div>
              </div>
            @endif
        </div>
      </li>
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-danger navbar-badge">{{total()}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">{{total()}} Pemberitahun</span>
          <div class="dropdown-divider"></div>
          <div class="dropdown-item">
            <i class="fas fa-tasks text-yellow mr-2"></i> {{ disposisi() }} Disposisi Baru
            <span class="float-right text-muted text-sm">{{ disposisi_time() }}</span>
          </div>
          <div class="dropdown-divider"></div>
          <div class="dropdown-item">
            <i class="fas fa-clipboard-check text-green mr-2"></i> {{ selesai() }} Surat Selesai
            <span class="float-right text-muted text-sm">{{ selesai_time() }}</span>
          </div>
          <div class="dropdown-divider"></div>
          <a href="{{ route('tsm.index') }}" class="dropdown-item dropdown-footer">Lihat Semua</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <b>{{ Auth::user()->username }}</b>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          <a href="{{ route('password.change') }}" class="dropdown-item">
            <i class="fas fa-key mr-2"></i> Ubah Kata Sandi
          </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{ route('logout') }}"
          onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt mr-2"></i>
          {{ __('Keluar') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </div>
      </li>
      {{-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
            class="fas fa-th-large"></i></a>
      </li> --}}
    </ul>
  </nav>