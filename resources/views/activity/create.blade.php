@extends('layouts.app')
@section('container')
<div class="page-wrapper">
    <div class="container-xl">
      <!-- Page title -->
      <div class="page-header d-print-none">
        <div class="row g-2 align-items-center">
          <div class="col">
            <h2 class="page-title">
              Buat Aktivitas Baru
            </h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/aktivitas">Aktivitas</a></li>
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
                    <h3 class="card-title">Form aktivitas baru</h3>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="/aktivitas" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">Aktivitas</label>
                            <div class="col">
                              <textarea  name="activity" class="form-control @error('activity') is-invalid @enderror" value="{{ old('activity') }}"  placeholder="Tuliskan aktivitas" required cols="30" rows="5">{{ old('activity') }}</textarea>
                                @error('activity')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                          <label class="form-label col-3 col-form-label @error('type_id') is-invalid @enderror">Jenis aktivitas</label>
                          <div class="col">
                            <select name="type_id" id="type_id" class="form-select">
                              <option value="" hidden>-Pilih jenis aktivitas-</option>
                              @foreach ($types as $type)
                                <option value="{{ $type->id }}">{{ $type->type }}</option>
                              @endforeach
                            </select>                            
                              @error('type_id')
                                  <div class="invalid-feedback">
                                      {{ $message }}
                                  </div>
                              @enderror
                          </div>
                        </div>
                        <div class="form-group mb-3 row">
                          <label class="form-label col-3 col-form-label">Waktu (Jam)</label>
                          <div class="col">
                            <input type="number" name="time" min="1" class="form-control @error('time') is-invalid @enderror" value="{{ old('time') }}"  placeholder="Masukkan waktu (Jam)" required>
                              @error('time')
                                  <div class="invalid-feedback">
                                      {{ $message }}
                                  </div>
                              @enderror
                          </div>
                      </div>
                      <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Hari/tanggal</label>
                        <div class="col">
                          <input type="date" name="date" min="1" class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}"  placeholder="Masukkan waktu (Jam)" required>
                            @error('date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
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
