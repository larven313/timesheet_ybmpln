@extends('layouts.app')
@section('container')
<div class="page-wrapper">
    <div class="container-xl">
      <!-- Page title -->
      <div class="page-header d-print-none">
        <div class="row g-2 align-items-center">
          <div class="col">
            <h2 class="page-title">
              Buat Pegawai Baru
            </h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/pegawai">Pegawai</a></li>
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
                    <h3 class="card-title">Form pegawai baru</h3>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="/pegawai" enctype="multipart/form-data">
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
                      <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Username</label>
                        <div class="col">
                          <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}"  placeholder="Masukkan username" required>
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                      </div>
                      <div class="form-group mb-3 row">
                        <label class="form-label col-3 col-form-label">Email</label>
                        <div class="col">
                          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" aria-describedby="emailHelp" placeholder="Masukkan email" required>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                      </div>
                        <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">Password</label>
                            <div class="col">
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required>
                            @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            <small class="form-hint">
                                Password minimal terdiri dari 3 - 30 karakter
                            </small>
                            </div>
                        </div>
                        <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label @error('role') is-invalid @enderror">Role</label>
                            <div class="col">
                                <select name="role" id="role" class="form-select">
                                    <option hidden selected value="user">-Pilih role-</option>
                                    <option value="admin">Admin</option>
                                    <option value="validator">Validator</option>
                                    <option value="user">User</option>
                                </select>
                            @error('role')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            <small class="form-hint">
                                Jika tidak dipilih maka otomatis rolenya adalah user
                            </small>
                            </div>
                        </div>
                        {{-- <div class="form-group mb-3 row">
                          <label class="form-label col-3 col-form-label @error('supervisor_id') is-invalid @enderror">Supervisor</label>
                          <div class="col">
                              <select name="supervisor_id" id="supervisor_id" class="form-select">
                                  <option hidden selected value="{{ null }}">-Pilih atasan-</option>
                                  @foreach ($supervisors as $supervisor)
                                  <option value="{{ $supervisor->id }}">{{ $supervisor->name }}</option>
                                  @endforeach
                              </select>
                              @error('supervisor_id')
                                  <div class="invalid-feedback">
                                      {{ $message }}
                                  </div>
                              @enderror
                              @if ($supervisor_default)
                              <small class="form-hint">
                                Jika tidak dipilih maka otomatis supervisor nya adalah {{ $supervisor_default->name }}
                              </small>
                              @endif
                          </div>
                        </div> --}}
                        <div class="form-group mb-3 row">
                          <label class="form-label col-3 col-form-label @error('department_id') is-invalid @enderror">Departemen</label>
                          <div class="col">
                              <select name="department_id" id="department_id" class="form-select">
                                  <option hidden selected value="{{ null }}">-Pilih departemen-</option>
                                  @foreach ($departments as $department)
                                  <option value="{{ $department->id }}">{{ $department->name }}</option>
                                  @endforeach
                              </select>
                              @error('department_id')
                                  <div class="invalid-feedback">
                                      {{ $message }}
                                  </div>
                              @enderror
                              @if ($department_default)
                                <small class="form-hint">
                                  Jika tidak dipilih maka otomatis departemen nya nya adalah {{ $department_default->name }}
                                </small>
                              @endif
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
