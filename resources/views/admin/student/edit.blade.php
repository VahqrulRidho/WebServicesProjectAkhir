@extends('layouts.admin.app')
@section('title', 'Mahasiswa')
@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Edit Data Mahasiswa</h2>
                    </div>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> Something went wrong.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card mb-4">
                <div class="col-lg-12 mt-4">
                    <form action="{{ route('student.update', $data->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Nama Lengkap</strong>
                                    <input type="text" name="nama_lengkap" value="{{ $data->nama_lengkap }}"
                                        class="form-control" placeholder="Nama Lengkap">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>NIM</strong>
                                    <input type="number" name="nim" value="{{ $data->nim }}" class="form-control"
                                        placeholder="Nomor Induk Mahasiswa">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Program Studi</strong>
                                    <input type="text" name="prodi" value="{{ $data->prodi }}" class="form-control"
                                        placeholder="Program Studi">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Jenis Kelamin</strong>
                                    <select class="form-control" name="jenis_kelamin">
                                        <option value="" disabled>-Pilih Jenis Kelamin-</option>
                                        <option value="Laki-laki"
                                            {{ $data->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan"
                                            {{ $data->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Status</strong>
                                    <select class="form-control" name="status">
                                        <option value="" disabled>-Pilih Status-</option>
                                        <option value="1" {{ $data->status == '1' ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ $data->status == '0' ? 'selected' : '' }}>Non Aktif
                                        </option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-right mb-3">
                                <a class="btn btn-dark" href="{{ route('student.index') }}"> Back</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
