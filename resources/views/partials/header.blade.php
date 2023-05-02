<header class="navbar navbar-expand-md navbar-light d-print-none">
  <div class="container-xl">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
      <a href="/">
        <img src="{{ asset('static') }}/ybm.png" width="140" height="32" alt="Tabler" class="navbar-brand-image">
      </a>
    </h1>
    <div class="navbar-nav flex-row order-md-last">
      <div class="d-none d-md-flex">
        <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode" data-bs-toggle="tooltip" data-bs-placement="bottom">
          <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" /></svg>
        </a>
        <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip" data-bs-placement="bottom">
          <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="4" /><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" /></svg>
        </a>
        {{-- notification --}}
        {{-- <div class="nav-item dropdown d-none d-md-flex me-3">
          <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" title="Show notifications" data-bs-toggle="tooltip" aria-label="Show notifications">
            <!-- Download SVG icon from http://tabler-icons.io/i/bell -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" /><path d="M9 17v1a3 3 0 0 0 6 0v-1" /></svg>
            @if ($notifications)
            @if (count($not_read) > 0)
                <span class="badge bg-red">{{ $not_read->count() }}</span>
            @else
                <span class=""></span>
            @endif
          @else
              <span class="badge bg-red"></span>
          @endif
        
        
        

          </a>
          <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Aktivitas baru</h3>
              </div>
             @foreach ($notifications as $notification)
              <div class="list-group list-group-flush list-group-hoverable">
                <div class="list-group-item">
                  <div class="row align-items-center">
                    @if ( $notification->isRead == 0)
                    <div class="col-auto"><span class="badge bg-success"></span></div>
                        
                    @else
                    <div class="col-auto"><span></span></div>
                        
                    @endif
                    @if ($notifications != null)
                    <div class="col text-truncate">
                      <form id="notification-form" action="/notification/edit/{{ $notification->id }}" method="post">
                        @csrf
                        @method('put')
                        <button type="submit" class="btn d-block" style="text-align: left" {{ $notification->isRead == '0' ? "title='belum_dilihat'" : "title='dilihat'" }}>
                            <span class="text-left">{{ $notification->activity->user->name ?? 'N/N' }}</span>
                            <div class="d-block text-muted text-truncate mt-n1">{{ $notification->message }} (#{{ $notification->id }})</div>
                        </button>
                    </form>
                    
                    <script>
                        const form = document.getElementById('notification-form');
                        const username = '{{ $notifications[0]->activity->user->username }}';
                        form.addEventListener('submit', function(e) {
                            e.preventDefault();
                            const url = this.action;
                            const method = this.method;
                            fetch(url, {
                                method: method,
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/x-www-form-urlencoded'
                                },
                                body: new URLSearchParams(new FormData(this))
                            })
                            .then(response => {
                                if (response.ok) {
                                    window.location.href = '/pegawai/' + username;
                                }
                            })
                            .catch(error => console.log(error));
                        });
                    </script>
                                                     
                    </div>
                    @else
                    <div class="col text-truncate">
                      <a href="#" class="text-reset d-block">Tidak ada aktivitas baru</a>
                      <div class="d-block text-muted text-truncate mt-n1">-</div>
                    </div>
                    @endif

                    <div class="col-auto">
                      <form action="/notifikasi/{{ $notification->id }}/" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-white btn-sm list-group-item-actions" title="hapus notifikasi"><!-- Download SVG icon from http://tabler-icons.io/i/star -->
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon text-danger icon-tabler icon-tabler-trash-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M20 6a1 1 0 0 1 .117 1.993l-.117 .007h-.081l-.919 11a3 3 0 0 1 -2.824 2.995l-.176 .005h-8c-1.598 0 -2.904 -1.249 -2.992 -2.75l-.005 -.167l-.923 -11.083h-.08a1 1 0 0 1 -.117 -1.993l.117 -.007h16z" stroke-width="0" fill="currentColor"></path>
                            <path d="M14 2a2 2 0 0 1 2 2a1 1 0 0 1 -1.993 .117l-.007 -.117h-4l-.007 .117a1 1 0 0 1 -1.993 -.117a2 2 0 0 1 1.85 -1.995l.15 -.005h4z" stroke-width="0" fill="currentColor"></path>
                         </svg>
                        </button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>  
              @endforeach

            </div>
          </div>
        </div> --}}
      </div>
      <div class="nav-item dropdown">
        @auth
        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
          @if ( auth()->user()->profile->image == null)
              @if (auth()->user()->role === 'admin')
              <span class="avatar avatar-sm" style="background-image: url(./static/avatars/admin.png)"></span>
              @elseif(auth()->user()->role === 'validator')
              <span class="avatar avatar-sm" style="background-image: url(./static/avatars/validator.png)"></span>
              @else
              <span class="avatar avatar-sm" style="background-image: url(./static/avatars/user.png)"></span>
              @endif
          @else
          <span class="avatar avatar-sm" style="background-image: url({{ asset('img') }}/{{ $user->profile->image }})"></span>
          @endif
          <div class="d-none d-xl-block ps-2">
            <div>{{ auth()->user()->name }}</div>
            <div class="mt-1 small text-muted">
              @if (auth()->user()->profile->position)
                {{ auth()->user()->profile->position->name }}
              @else
                -
              @endif
            </div>
          </div>
        </a>
        @endauth

        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          <a href="/pegawai/{{ auth()->user()->username }}" class="dropdown-item">Profile & account</a>
          <div class="dropdown-divider"></div>
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="dropdown-item" type="submit">Logout</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</header>