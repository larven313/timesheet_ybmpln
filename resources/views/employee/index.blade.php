@extends('layouts.app')
@section('container')

<div class="page-wrapper">
    <div class="container-xl">
      <!-- Page title -->
      <div class="page-header d-print-none">
        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
           <strong> {{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="row g-2 align-items-center">
          <div class="col">
            <h2 class="page-title">
              Daftar Pegawai
            </h2>
            <div class="text-muted mt-1">{{ $item_awal}}-{{ $item_akhir }} dari {{ $total }} pegawai</div>
          </div>
          <!-- Page title actions -->
          <div class="col-12 col-md-auto ms-auto d-print-none">
            <div class="d-flex">
              <form action="/pegawai" method="get">
                @csrf
                <input type="search" class="form-control d-inline-block w-9 me-3 mr-3" id="search" name="search" value="{{ request('search') }}" placeholder="Cari pegawai…"/>
              </form>
              
              <a href="/pegawai/create" class="btn btn-success mx-2">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                Tambah pegawai
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="page-body">
      <div class="container-xl">
        <div class="row row-cards">
          @if ($users->count())
            @foreach ($users as $user)
              
              <div class="col-md-6 col-lg-3">
                <div class="card m-3">
                  @if (auth()->user()->role == 'admin')
                    @if (auth()->user()->id == $user->id)
                        
                    @else
                    <div class="col-auto d-flex position-relativ">
                      <div class="dropdown position-absolute top-1 end-0 my-2 mx-2">
                          <a href="#" class="btn-action" data-bs-toggle="dropdown" aria-expanded="false">
                              <!-- Download SVG icon from http://tabler-icons.io/i/dots-vertical -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="1" /><circle cx="12" cy="19" r="1" /><circle cx="12" cy="5" r="1" /></svg>
                          </a>
                          <div class="dropdown-menu dropdown-menu-end">
                              <a href="/pegawai/{{ $user->username }}/edit" class="dropdown-item">Edit</a>
                              <a href="#" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#modal-danger-{{ $user->id }}">
                                Delete
                              </a>
                          </div>
                      </div>
                    </div>
                    @endif
                  @else

                  @endif

                    {{-- modal --}}
                    <div class="modal modal-blur fade" id="modal-danger-{{ $user->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                      <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          <div class="modal-status bg-danger"></div>
                          <div class="modal-body text-center py-4">
                            <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v2m0 4v.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" /></svg>
                            <h3>Apakah kamu yakin?</h3>
                            <div class="text-muted">kamu yakin ingin menghapus pegawai <strong>{{ $user->name }}</strong>?</div>
                          </div>
                          <div class="modal-footer">
                            <div class="w-100">
                              <div class="row">
                                <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                    Cancel
                                  </a></div>
                                <div class="col">
                                  <form action="/pegawai/{{ $user->username }}/" method="POST">
                                  @method('delete')
                                  @csrf
                                    <button class="btn btn-danger w-100" data-bs-dismiss="modal">
                                      Delete
                                    </button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="card-body p-4 text-center">
                      
                      @if ($user->profile->image == null)
                        @if ($user->role === 'admin')
                        <span class="avatar avatar-xl mb-3 avatar-rounded" style=" background-image: url({{ asset('static') }}/avatars/admin.png)"></span>
                        @elseif($user->role === 'validator')
                          <span class="avatar avatar-xl mb-3 avatar-rounded" style=" background-image: url({{ asset('static') }}/avatars/validator.png)"></span>
                        @else
                          <span class="avatar avatar-xl mb-3 avatar-rounded" style=" background-image: url({{ asset('static') }}/avatars/user.png)"></span>
                        @endif
                      @else
                      <span class="avatar avatar-xl mb-3 avatar-rounded" style=" background-image: url({{ asset('img/'.$user->profile->image) }})"></span>
                      @endif
                        
                        <h5 class="m-0 mb-1 "><a href="#" class="text-decoration-none">{{ $user->name }}</a></h5>
                        @if ($user->profile->position)
                        <div class="text-muted">{{ $user->profile->position->name }}</div>
                        @else
                        <div class="text-muted">-</div>
                        @endif
                        <div class="mt-3">
                              @if ($user->role === 'admin')
                              <span class="badge bg-orange-lt">{{ ucwords($user->role) }}</span>
                              @elseif($user->role === 'validator')
                              <span class="badge bg-purple-lt">{{ ucwords($user->role) }}</span>
                              @else
                              <span class="badge bg-green-lt">{{ ucwords($user->role) }}</span>
                              @endif 
                        </div>
                    </div>
                    <a href="/pegawai/{{ $user->username }}" class="card-btn text-decoration-none">View full profile</a>
                </div>
            </div> 
            @endforeach
            @else
                <div class="empty">
                  <div class="empty-img"><img src="./static/illustrations/undraw_quitting_time_dm8t.svg" height="128"  alt="">
                  </div>
                  <p class="empty-title">Oops… Pegawai tidak ditemukan</p>
                  <p class="empty-subtitle text-muted">
                    Maaf, pegawai tidak ada
                  </p>
                  <div class="empty-action">
                    <a href="/pegawai" class="btn btn-primary">
                      <!-- Download SVG icon from http://tabler-icons.io/i/arrow-left -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"></path>
                        <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4"></path>
                     </svg>
                      Refresh
                    </a>
                  </div>
                </div>
            @endif 
        </div>
        <div class="d-flex mt-4">
            
          <ul class="pagination ms-auto">
            <li class="page-item">{{ $users->links() }}</li>
          </ul>
        </div>
      </div>
    </div>
  </div>

@endsection
@include('partials.script')
