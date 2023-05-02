@extends('layouts.app')
@section('container')
<div class="page-wrapper">
    <div class="container-xl">
      <!-- Page title -->
      <div class="page-header d-print-none">
        <div class="row g-2 align-items-center">
          <div class="col">
            <h2 class="page-title">
              Edit Pegawai
            </h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/pegawai">Pegawai</a></li>
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
                    <h3 class="card-title">Form edit pegawai</h3>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="/pegawai/{{ $user->username }}" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="form-group mb-3 row">
                            <label class="form-label col-3 col-form-label">Nama</label>
                            <div class="col">
                              <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}"  placeholder="Masukkan nama" required>
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
                          <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ $user->username }}"  placeholder="Masukkan username" required>
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
                          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}" aria-describedby="emailHelp" placeholder="Masukkan email" required>
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
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                            @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            <small class="form-hint">
                                Kosongkan jika password tidak ingin diubah
                            </small>
                            </div>
                        </div>
                        @if (auth()->user()->role == 'admin')
                        <div class="form-group mb-3 row">
                          <label class="form-label col-3 col-form-label @error('role') is-invalid @enderror">Role</label>
                          <div class="col">
                              <select name="role" id="role" class="form-select">
                                  <option value="{{ $user->role }}" hidden>{{ $user->role }}</option>
                                  <option value="admin">Admin</option>
                                  <option value="validator">Validator</option>
                                  <option value="user">User</option>
                              </select>
                          @error('role')
                                  <div class="invalid-feedback">
                                      {{ $message }}
                                  </div>
                              @enderror
                          </div>
                      </div>
                        @endif

                        <div class="form-group mb-3 row">
                          <label class="form-label col-3 col-form-label">Alamat</label>
                          <div class="col">
                            <textarea name="alamat" id="alamat" cols="30" rows="10" class="form-control @error('alamat') is-invalid @enderror"  value="{{ $profile->address }}">{{ $profile->address }}</textarea>
                              @error('alamat')
                                  <div class="invalid-feedback">
                                      {{ $message }}
                                  </div>
                              @enderror
                          </div>
                        </div>
                        <div class="form-group mb-3 row">
                          <label class="form-label col-3 col-form-label">NIP</label>
                          <div class="col">
                            <input type="number" name="nip" id="nip" class="form-control" value="{{ $profile->nip }}">
                              @error('nip')
                                  <div class="invalid-feedback">
                                      {{ $message }}
                                  </div>
                              @enderror
                          </div>
                        </div>
                        @if (auth()->user()->role == 'admin')
                        <div class="form-group mb-3 row">
                          <label class="form-label col-3 col-form-label">Departemen</label>
                          <div class="col">
                              <select name="departemen" id="departemen" class="form-select @error('departemen') is-invalid @enderror">
                                  <option value="{{ $user->department_id }}" selected hidden>{{ $user->profile->department->name }}</option>
                                  @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>    
                                  @endforeach
                              </select>
                          @error('departemen')
                                  <div class="invalid-feedback">
                                      {{ $message }}
                                  </div>
                              @enderror
                          </div>
                        </div>
                        <div class="form-group mb-3 row">
                          <label class="form-label col-3 col-form-label @error('jabatan') is-invalid @enderror">Jabatan</label>
                          <div class="col">
                              <select name="jabatan" id="jabatan" class="form-select">
                                  <option value="{{ $user->position_id }}" selected hidden>{{ $user->profile->position->name }}</option>
                                  @foreach ($positions as $position)
                                    <option value="{{ $position->id }}">{{ $position->name }}</option>    
                                  @endforeach
                              </select>
                          @error('jabatan')
                                  <div class="invalid-feedback">
                                      {{ $message }}
                                  </div>
                              @enderror
                          </div>
                        </div>
                        @endif
                        <div class="form-group mb-3 row">
                          <label class="form-label col-3 col-form-label">Avatar</label>
                          <div class="col">
                            @if ($user->profile->image)
                            <img src="{{ asset('img/' . $user->profile->image) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
                            @else
                            <img class="img-preview img-fluid mb-3 col-sm-5">
                            @endif
                            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" onchange="previewImage()" value="{{ old('image') }}">
                              @error('image')
                                  <div class="invalid-feedback">
                                      {{ $message }}
                                  </div>
                              @enderror
                          </div>
                        </div>
                      <div class="form-footer float-end">
                        <a href="/pegawai" class="btn btn-white">Back</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </form>
                  </div>
                </div>
            </div>
          </div>
        </div>
    </div>
    <script>
    function previewImage() {
        const image = document.querySelector("#image");
        const imgPreview = document.querySelector(".img-preview");    
        
        imgPreview.style.display = 'block';

        // perintah untuk mengambil data gambar
        const blob = URL.createObjectURL(image.files[0]);
        // untuk menampilkan gambar
        imgPreview.src = blob;
      }
    </script>
@endsection
@include('partials.script')
