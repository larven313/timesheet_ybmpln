@extends('layouts.app')
@section('container')
@if (auth()->user()->role == 'admin' || auth()->user()->role == 'validator')
<div class="container-xl">
    <div class="page-header d-print-none">
      <div class="row g-2 align-items-center">
        <div class="col">
          <!-- Page pre-title -->
          <div class="page-pretitle">
            Overview
          </div>
          <h2 class="page-title">
            Dashboard
          </h2>
        </div>
        <div class="col-12 col-md-auto ms-auto d-print-none">
          <div class="d-flex">
            <a href="/" class="btn btn-primary mx-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"></path>
                <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4"></path>
             </svg>
              Refresh
            </a>
          </div>
        </div>
      </div>
    </div> 
  </div>
  <div class="page-body">
    <div class="container-xl">
      <div class="row row-deck row-cards">
        @if (auth()->user()->role == 'admin')
        <div class="col-12">
          <div class="row row-cards">
            <div class="col-sm-6 col-lg-3">
              <div class="card card-sm">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <span class="bg-facebook text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                          <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                          <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                          <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                          <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                       </svg>
                      </span>
                    </div>
                    <div class="col">
                      <div class="font-weight-medium">
                        {{ $total_user }} Pegawai
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card card-sm">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <span class="bg-yellow text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
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
                    <div class="col">
                      <div class="font-weight-medium">
                        {{ $total_departemen }} Departemen
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card card-sm">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <span class="bg-twitter text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-id-badge-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                          <path d="M7 12h3v4h-3z"></path>
                          <path d="M10 6h-6a1 1 0 0 0 -1 1v12a1 1 0 0 0 1 1h16a1 1 0 0 0 1 -1v-12a1 1 0 0 0 -1 -1h-6"></path>
                          <path d="M10 3m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z"></path>
                          <path d="M14 16h2"></path>
                          <path d="M14 12h4"></path>
                       </svg>
                      </span>
                    </div>
                    <div class="col">
                      <div class="font-weight-medium">
                        {{ $total_jabatan }} Jabatan
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card card-sm">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <span class="bg-green text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-checklist" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                          <path d="M9.615 20h-2.615a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v8"></path>
                          <path d="M14 19l2 2l4 -4"></path>
                          <path d="M9 8h4"></path>
                          <path d="M9 12h2"></path>
                       </svg>
                      </span>
                    </div>
                    <div class="col">
                      <div class="font-weight-medium">
                        {{ $total_aktivitas }} Aktivitas hari ini
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>   
        @endif

        <div class="row">
          <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  Status
                </div>
                <h2 class="page-title">
                  Aktivitas Pegawai
                </h2>
              </div>
            </div>
          </div>
          <div class="page-body">
            <div class="container-xl">
                  @if ($status_activity->count())
                  <div class="card">
                    <div class="table-responsive">
                      <table
                          class="table table-vcenter card-table">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Total jam</th>
                            <th>Status</th>
                            <th class="w-1"></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($status_activity as $status)
                          <tr>
                              <td>{{ ++$no }}</td>
                              <td>{{ $status->name }}</td>
                              
                              <td>{{ $status->time  }}</td>
                              <td>
                                <span class="badge {{ $status->time < 8 ? 'bg-red' : 'bg-success' }} ">
                                  {{ $status->time < 8 ? 'Tidak tuntas' : 'Tuntas' }}
                                </span>
                              </td>
                              <td>
                                {{-- <a href="/pegawai/{{ $status->username }}" class="btn btn-primary btn-sm">Detail</a> --}}
                                <a href="/aktivitas/{{ $status->username }}" class="btn btn-primary btn-sm">Detail</a>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                  @else
                  <div class="card">
                    <div class="table-responsive">
                      <table
                          class="table table-vcenter card-table">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Hari/Tanggal</th>
                            <th>Nama aktivitas</th>
                            <th>Jenis aktivitas</th>
                            <th>Waktu (Jam)</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td >
                              tidak ada aktivitas 
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  @endif
      
                </div>
              <span class="float-end mt-2">
              {{ $activities->links() }}
            </span>
            </div>
          </div>
        <div class="row">
          <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                  Riwayat
                </div>
                <h2 class="page-title">
                  Aktivitas Pegawai
                </h2>
              </div>
              <div class="col-md-6 text-end">
                <form action="{{ url('/') }}" class="d-flex flex-row">
                  {{-- @csrf --}}
                  <span>cari dari tanggal :</span>
                  <input type="date" name="tgl_awal" id="tgl_awal"  class="form-control mx-2"  style="width:30%;" value="{{ request()->tgl_awal }}">
                  <span> sampai </span>
                  <input type="date" name="tgl_akhir" onchange="this.form.submit()" id="tgl_akhir" class="form-control mx-2"  style="width:30%;" value="{{ request()->tgl_akhir }}">

                  <select name="filter" id="filter" onchange="this.form.submit()" class="form-select mx-3"  style="width:20%;">
                    <option hidden value="">
                      @if (request()->filter == 'today')
                      Hari ini
                      @elseif(request()->filter == 'this_week')
                      Minggu ini
                      @elseif(request()->filter == 'this_month')
                      Bulan ini
                      @else
                      -pilih-
                      @endif
                    </option>
                    <option value="today">Hari ini</option>
                    <option value="this_week">Minggu ini</option>
                    <option value="this_month">Bulan ini</option>
                  </select>
                </form>     
              </div>
            </div>
          </div>
          <div class="page-body mt-2">
            <div class="container-xl">
                @if ($activities2->count())
                  
              
                  <div class="card">
                    <div class="table-responsive">
                      <table
                          class="table table-vcenter card-table">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Hari/Tanggal</th>
                            <th>Nama</th>
                            <th>Nama aktivitas</th>
                            <th>Waktu (Jam)</th>
                            <th class="w-1"></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($activities2 as $activity)
                          <tr>
                              <td>{{ ++$no2 }}</td>
                              <td>{{ \Carbon\Carbon::parse($activity->date)->isoFormat('dddd, D MMMM Y') }}</td>
                              @if ($activity->user)
                                  <td>{{ $activity->user->name }}</td>
                              @else
                                  <td>User not found</td>
                              @endif
                              <td >{{ $activity->type->type }}</td>
                              <td >{{ $activity->time }}</td>
                          </tr>
                      @endforeach
                      
                        </tbody>
                      </table>
                    </div>
                  </div>
                @else
                <div class="card">
                  <div class="table-responsive">
                    <table
                        class="table table-vcenter card-table">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Hari/Tanggal</th>
                          <th>Nama</th>
                          <th>Nama aktivitas</th>
                          <th>Waktu (Jam)</th>
                          <th class="w-1"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td >
                            tidak ada aktivitas 
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                @endif
                </div>
              <span class="float-end mt-2">
              {{ $activities2->links() }}
            </span>
            </div>
        </div>
      </div>
    </div>
  </div>
@elseif(auth()->user()->role == 'user')
<div class="page-body">
  <div class="container-xl">
      <div class="row g-2 align-items-center mb-3">
        <div class="col">
          <!-- Page pre-title -->
          <div class="page-pretitle">
            Overview
          </div>
          <h2 class="page-title">
            Dashboard
          </h2>
        </div>
        <div class="col-12 col-md-auto ms-auto d-print-none">
          <div class="d-flex">
            <a href="/" class="btn btn-primary mx-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-refresh" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M20 11a8.1 8.1 0 0 0 -15.5 -2m-.5 -4v4h4"></path>
                <path d="M4 13a8.1 8.1 0 0 0 15.5 2m.5 4v-4h-4"></path>
             </svg>
              Refresh
            </a>
          </div>
        </div>
      </div>

    <div class="row row-deck row-cards">
      <div class="col-12">
        <div class="row row-cards ">
          <div class="d-flex justify-content-center">
            <div class="col-sm-6 col-lg-3 mx-3">
              <div class="card card-sm">
                <div class="card-body">
                  <div class="row align-items-center">
                  @if (count($activities) > 0 && $activities[0]->time !== null)
                  <div class="col-auto">
                      @if ($activities[0]->time < 8 )
                        <span class="bg-red text-white avatar">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-letter-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M7 4l10 16"></path>
                            <path d="M17 4l-10 16"></path>
                          </svg>
                        </span>
                      @else
                        <span class="bg-green text-white avatar">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M5 12l5 5l10 -10"></path>
                          </svg>
                        </span>
                      @endif
                    </div>
                    <div class="col">
                      <div class="font-weight-medium">
                        Hari ini {{ $activities[0]->time < 8 ? 'Tidak tuntas' : 'Tuntas' }}
                      </div>
                    </div>
                    @else
                    <div class="col-auto">
                        <span class="bg-red text-white avatar">
                          <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-letter-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M7 4l10 16"></path>
                            <path d="M17 4l-10 16"></path>
                          </svg>
                        </span>
                    </div>
                    <div class="col">
                      <div class="font-weight-medium">
                        Hari ini Tidak Tuntas
                      </div>
                    </div>
                    @endif
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-lg-3">
              <div class="card card-sm">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <span class="bg-facebook text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" /></svg>
                      </span>
                    </div>
                    <div class="col">
                      <div class="font-weight-medium">
                        {{ $total_aktivitas }} aktivitas dikerjakan
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row m-3">
            <div class="col-md-6">
              <!-- Page pre-title -->
              <div class="page-pretitle">
                Riwayat
              </div>
              <h2 class="page-title">
                Aktivitasku
              </h2>
            </div>
            <div class="col-md-6 text-end my-3">
              <form action="{{ url('/') }}" class="d-flex flex-row">
                {{-- @csrf --}}
                <span>cari dari tanggal :</span>
                <input type="date" name="tgl_awal" id="tgl_awal"  class="form-control mx-2"  style="width:30%;" value="{{ request()->tgl_awal }}">
                <span> sampai </span>
                <input type="date" name="tgl_akhir" onchange="this.form.submit()" id="tgl_akhir" class="form-control mx-2"  style="width:30%;" value="{{ request()->tgl_akhir }}">

                <select name="filter" id="filter" onchange="this.form.submit()" class="form-select mx-3"  style="width:20%;">
                  <option hidden value="">
                    @if (request()->filter == 'today')
                    Hari ini
                    @elseif(request()->filter == 'this_week')
                    Minggu ini
                    @elseif(request()->filter == 'this_month')
                    Bulan ini
                    @else
                    -pilih-
                    @endif
                  </option>
                  <option value="today">Hari ini</option>
                  <option value="this_week">Minggu ini</option>
                  <option value="this_month">Bulan ini</option>
                </select>
              </form>     
            </div>
            
            
            <div class="col-md-12">
              <div class="row row-cards">
                <div class="col-12">
                  
                  <div class="card">
                    <div class="table-responsive">
                      <table
                          class="table table-vcenter card-table">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Hari/Tanggal</th>
                            <th>Waktu (Jam)</th>
                            <th>status</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($activities as $activity)
                          <tr>
                              <td>{{ ++$no }}</td>
                              <td>{{ \Carbon\Carbon::parse($activity->date)->isoFormat('dddd, D MMMM Y') }}</td>
                              <td>{{ $activity->time }}</td>
                              <td>
                                <span class="badge {{ $activity->time < 8 ? 'bg-red' : 'bg-success' }} ">
                                  {{ $activity->time < 8 ? 'Tidak tuntas' : 'Tuntas' }}
                                </span>
                              </td>
                          </tr> 
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@else

@endif
@endsection
@include('partials.script')
