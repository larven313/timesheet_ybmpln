@extends('layouts.app')
@section('container')
<div class="col-md-12 col-xl-12">
      <div class="card-cover card-cover-blurred text-center" style=" background-image: url({{ asset('static') }}/photos/1b73704b282a8ec6.jpg); height: 300px;">
        @auth
        @if ($user->profile->image == null)
          @if ($user->role === 'admin')
          <span class="avatar avatar-xl avatar-thumb avatar-rounded" style="margin-top:190px; background-image: url({{ asset('static') }}/avatars/admin.png)"></span>
          @elseif($user->role === 'validator')
            <span class="avatar avatar-xl avatar-thumb avatar-rounded" style="margin-top:190px; background-image: url({{ asset('static') }}/avatars/validator.png)"></span>
          @else
            <span class="avatar avatar-xl avatar-thumb avatar-rounded" style="margin-top:190px; background-image: url({{ asset('static') }}/avatars/user.png)"></span>
          @endif
        @else
        <span class="avatar avatar-xl avatar-thumb avatar-rounded" style="margin-top:190px; background-image: url({{ asset('img/'.$user->profile->image) }})"></span>
        @endif
        @endauth
      </div>
      <div class="card-body text-center">  
        <div class="card-title mt-3 z-3 position-relative">{{ $user->name }}</div>
        <div class="text-muted">{{ $user->profile->position->name }}</div>
      </div>
  </div>
<div class="row mx-3 my-3">
  <div class="col-4">
    <div class="card">
      <div class="card-body">
        <div class="card-title">
          <div class="row">
            <div class="col-md-6">Basic info</div>
            <div class="col-md-6 text-end">
              <a href="/pegawai/{{ $user->username }}/edit">
                Edit
              </a>
            </div>
          </div>
        </div>
        @if ($user->profile->department->user->name != $user->name)
        <div class="mb-2">
          <!-- Download SVG icon from http://tabler-icons.io/i/book -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M12 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
         </svg>
          Atasan : <strong>{{ $user->profile->department->user->name ?? 'N/N'  }}</strong>
        </div>
        @endif

        <div class="mb-2">
          <!-- Download SVG icon from http://tabler-icons.io/i/briefcase -->
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
          Departemen : <strong>{{ $user->profile->department->name }}</strong>
        </div>
        <div class="mb-2">
          <!-- Download SVG icon from http://tabler-icons.io/i/briefcase -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-id-badge-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
            <path d="M7 12h3v4h-3z"></path>
            <path d="M10 6h-6a1 1 0 0 0 -1 1v12a1 1 0 0 0 1 1h16a1 1 0 0 0 1 -1v-12a1 1 0 0 0 -1 -1h-6"></path>
            <path d="M10 3m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z"></path>
            <path d="M14 16h2"></path>
            <path d="M14 12h4"></path>
         </svg>
          Jabatan : <strong>{{ $user->profile->position->name }}</strong>
        </div>
        <div class="mb-2">
          <!-- Download SVG icon from http://tabler-icons.io/i/home -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
          Alamat : <strong>{{ $user->profile->address }}</strong>
        </div>
        <div class="mb-2">
          <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2 text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="4" y="5" width="16" height="16" rx="2" /><line x1="16" y1="3" x2="16" y2="7" /><line x1="8" y1="3" x2="8" y2="7" /><line x1="4" y1="11" x2="20" y2="11" /><line x1="11" y1="15" x2="12" y2="15" /><line x1="12" y1="15" x2="12" y2="18" /></svg>
          Bergabung pada : <strong>{{ \Carbon\Carbon::parse($user->created_at)->format('d M Y H:i:s') }}
          </strong>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-xl-3">
    <div class="row">
      <div class="card card-sm">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-auto">
              <span class="bg-blue text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
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
            </div>
            <div class="col ">
              <div class="font-weight-medium">
                {{ $user->profile->department->name }}
              </div>
              <div class="text-muted">
                {{ $total }} Staff
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row mt-2">
      <div class="card card-sm">
        <div class="card-body">
          @if ($time >= 8)
          <div class="row align-items-center">
            <div class="col-auto">
              <span class="bg-green text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
                  <path d="M9 12l2 2l4 -4"></path>
               </svg>
              </span>
            </div>
            <div class="col">
              <div class="font-weight-medium">
                Jam aktivitas terpenuhi
              </div>
              <div class="text-muted">
                Hari ini, {{ $user->name }} Telah melakukan aktivitas selama {{ $time }} jam
              </div>
            </div>
          </div>
          @else
          <div class="row align-items-center">
            <div class="col-auto">
              <span class="bg-red text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                  <path d="M18 6l-12 12"></path>
                  <path d="M6 6l12 12"></path>
               </svg>
              </span>
            </div>
            <div class="col">
              <div class="font-weight-medium">
                Jam aktivitas tidak terpenuhi
              </div>
              <div class="text-muted">
                @if (request()->filter == 'today')
                Hari ini
                @elseif(request()->filter == 'this_week')
                Minggu ini
                @elseif(request()->filter == 'this_month')
                Bulan ini
                @else
                Hari ini
                @endif, {{ $user->name }} Telah melakukan aktivitas selama {{ $time }} jam
              </div>
            </div>
          </div>
          @endif
  
        </div>
      </div>
    </div>
  </div>
@endsection
@include('partials.script')
