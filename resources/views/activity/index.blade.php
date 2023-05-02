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
              Aktivitas pegawai
            </h2>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">{{ $total}} Aktivitas tersedia</li>
              </ol>
          </nav>
          </div>
          <div class="col-12 col-md-auto ms-auto d-print-none d-flex">
            <div>
              <form action="/aktivitas" class="d-flex">
              <span>cari dari tanggal :</span>
              <input type="date" name="tgl_awal" id="tgl_awal"  class="form-control mx-2"  style="width:30%;" value="{{ request()->tgl_awal }}">
              <span> sampai </span>
              <input type="date" name="tgl_akhir" onchange="this.form.submit()" id="tgl_akhir" class="form-control mx-2"  style="width:30%;" value="{{ request()->tgl_akhir }}">
            </form>
            </div>
            <div>
              <a href="/aktivitas/create" class="btn btn-success mx-2">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                Tambah aktivitas
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="page-body">
      <div class="container-xl">
        <div class="row row-cards">
          <div class="col-12">
            @if ($activities->count())
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
                      <th class="w-1"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($activities as $activity)
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ \Carbon\Carbon::parse($activity->date)->isoFormat('dddd, D MMMM Y') }}</td>
                        <td >{{ $activity->activity }}</td>
                        <td >{{ $activity->type->type }}</td>
                        <td >{{ $activity->time }}</td>
                        <td>
                            <div class="btn-list flex-nowrap">
                                <a href="/aktivitas/{{ $activity->id }}/edit" class="btn btn-small btn-warning btn-sm">
                                    Edit
                                </a>
                                  <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal-danger-{{ $activity->id }}">
                                    Delete
                                  </a>
                          {{-- modal --}}
                        <div class="modal modal-blur fade" id="modal-danger-{{ $activity->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              <div class="modal-status bg-danger"></div>
                              <div class="modal-body text-center py-4">
                                <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v2m0 4v.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" /></svg>
                                <h3>Apakah kamu yakin?</h3>
                                <div class="text-muted">kamu yakin ingin menghapus aktivitas <strong> "{{ $activity->activity }}"</strong>?</div>
                              </div>
                              <div class="modal-footer">
                                <div class="w-100">
                                  <div class="row">
                                    <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                        Cancel
                                      </a></div>
                                    <div class="col">
                                      <form action="/aktivitas/{{ $activity->id }}/" method="POST">
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

                            </div>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            @else
            <div class="empty">
              <div class="empty-img"><img src="./static/illustrations/undraw_quitting_time_dm8t.svg" height="128"  alt="">
              </div>
              <p class="empty-title">Oops… Aktivitas tidak ditemukan</p>
              <p class="empty-subtitle text-muted">
                Yuk tuliskan aktivitasmu!
              </p>
              <div class="empty-action">
                <a href="/aktivitas" class="btn btn-primary">
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
        </div>
        <span class="float-end">
        {{ $activities->links() }}
      </span>
      </div>
  </div>
@endsection
@include('partials.script')
