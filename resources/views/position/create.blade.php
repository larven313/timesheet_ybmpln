@extends('layouts.app')
@section('container')
<div class="page-wrapper">
    <div class="container-xl">
      <!-- Page title -->
      <div class="page-header d-print-none">
        <div class="row g-2 align-items-center">
          <div class="col">
            <h2 class="page-title">
              Buat Jabatan Baru
            </h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/jabatan">Jabatan</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Create</li>
                </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
          <div class="row row-cards">
            <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Form jabatan baru</h3>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="/jabatan" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">Nama</label>
                            <div class="col">
                              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"  placeholder="Masukkan nama" required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                      <div class="form-footer float-end">
                        <button type="reset" class="btn btn-white">Reset</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </form>
                  </div>
                </div>
            </div>
          </div>
        </div>
    </div>
@endsection
@include('partials.script')
