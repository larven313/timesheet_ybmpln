<div class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
      <div class="navbar navbar-light">
        <div class="container-xl">
          <ul class="navbar-nav">
            <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
              <a class="nav-link" href="/" >
                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                </span>
                <span class="nav-link-title">
                  Beranda
                </span>
              </a>
            </li>
            @if(Auth::user()->role != 'user' )
            <li class="nav-item {{ Request::is('pegawai*') ? 'active' : '' }}">
              <a class="nav-link" href="/pegawai" >
                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/users -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="9" cy="7" r="4" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
                </span>
                <span class="nav-link-title">
                  Pegawai
                </span>
              </a>
            </li>
              @if (Auth::user()->role == 'admin')
              <li class="nav-item {{ Request::is('departemen*') ? 'active' : '' }}">
                <a class="nav-link" href="/departemen" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/users -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-skyscraper" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M3 21l18 0"></path>
                      <path d="M5 21v-14l8 -4v18"></path>
                      <path d="M19 21v-10l-6 -4"></path>
                      <path d="M9 9l0 .01"></path>
                      <path d="M9 12l0 .01"></path>
                      <path d="M9 15l0 .01"></path>
                      <path d="M9 18l0 .01"></path>
                  </svg>
                  </span>
                  <span class="nav-link-title">
                    Departemen
                  </span>
                </a>
              </li>
              <li class="nav-item {{ Request::is('jabatan*') ? 'active' : '' }}">
                <a class="nav-link" href="/jabatan" >
                  <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/users -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-id-badge-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M7 12h3v4h-3z"></path>
                      <path d="M10 6h-6a1 1 0 0 0 -1 1v12a1 1 0 0 0 1 1h16a1 1 0 0 0 1 -1v-12a1 1 0 0 0 -1 -1h-6"></path>
                      <path d="M10 3m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z"></path>
                      <path d="M14 16h2"></path>
                      <path d="M14 12h4"></path>
                  </svg>
                  </span>
                  <span class="nav-link-title">
                    Jabatan
                  </span>
                </a>
              </li>
              @endif
            @endif
            <li class="nav-item {{ Request::is('aktivitas*') ? 'active' : '' }}">
              <a class="nav-link" href="/aktivitas" >
                <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/users -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checklist" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M9.615 20h-2.615a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8"></path>
                    <path d="M14 19l2 2l4 -4"></path>
                    <path d="M9 8h4"></path>
                    <path d="M9 12h2"></path>
                 </svg>
                </span>
                <span class="nav-link-title">
                  Aktivitas
                </span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>