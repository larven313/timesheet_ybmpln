@extends('layouts.app')
@section('container')
<div class="page-wrapper">
    <div class="container-xl">
      <!-- Page title -->
      <div class="page-header d-print-none">
        <div class="row g-2 align-items-center">
          <div class="col">
            <h2 class="page-title">
              Edit departemen
            </h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/departemen">Departemen</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                    <h3 class="card-title">Form edit departemen</h3>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="/departemen/{{ $departments->id }}" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">Nama</label>
                            <div class="col">
                              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $departments->name }}"  placeholder="Masukkan nama" required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                          <label class="form-label col-3 col-form-label">Nama Ketua</label>
                          <div class="col">
                            <select name="user_id" id="user_id" class="form-select">
                              <option hidden value="{{ $departments->user->id }}">{{ $departments->user->name }}</option>
                              @foreach ($users as $user)
                              <option value="{{ $user->id }}">{{ $user->name }}</option>
                              @endforeach
                            </select>
                              @error('user_id')
                                  <div class="invalid-feedback">
                                      {{ $message }}
                                  </div>
                              @enderror
                          </div>
                      </div>
                      <div class="form-footer float-end">
                        <a href="/departemen" class="btn btn-white">Back</a>
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
