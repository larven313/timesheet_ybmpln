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
              Data departemen
            </h2>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">{{ $total}} Departemen tersedia</li>
              </ol>
          </nav>
          </div>
          <div class="col-12 col-md-auto ms-auto d-print-none">
            <div class="d-flex">
              <a href="/departemen/create" class="btn btn-success mx-2">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                Tambah departemen
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
            @if ($departments->count())
            <div class="card">
              <div class="table-responsive">
                <table
                    class="table table-vcenter card-table">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama departemen</th>
                      <th class="w-1"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($departments as $department)
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td >{{ $department->name }}</td>
                        <td>
                            <div class="btn-list flex-nowrap">
                                <a href="/departemen/{{ $department->id }}/edit" class="btn btn-small btn-warning btn-sm">
                                    Edit
                                </a>
                                  <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal-danger-{{ $department->id }}">
                                    Delete
                                  </a>
                          {{-- modal --}}
                        <div class="modal modal-blur fade" id="modal-danger-{{ $department->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              <div class="modal-status bg-danger"></div>
                              <div class="modal-body text-center py-4">
                                <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v2m0 4v.01" /><path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" /></svg>
                                <h3>Apakah kamu yakin?</h3>
                                <div class="text-muted">kamu yakin ingin menghapus departemen <strong>{{ $department->name }}</strong>?</div>
                              </div>
                              <div class="modal-footer">
                                <div class="w-100">
                                  <div class="row">
                                    <div class="col"><a href="#" class="btn w-100" data-bs-dismiss="modal">
                                        Cancel
                                      </a></div>
                                    <div class="col">
                                      <form action="/departemen/{{ $department->id }}/" method="POST">
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
              <p class="empty-title">Oops… Departemen tidak ditemukan</p>
              <p class="empty-subtitle text-muted">
                Maaf, departemen tidak ada
              </p>
              <div class="empty-action">
                <a href="/departemen" class="btn btn-primary">
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
        {{ $departments->links() }}
      </span>
      </div>
    </div>
@endsection
@include('partials.script')
