@extends('layouts.admin.app')
@section('title', 'Mahasiswa')
@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="col-lg-12">

            <div class="row my-3">
                <div class="col-lg-6">
                    <h2>Mahasiswa</h2>
                </div>
                <div class="col-lg-6 text-right">
                    <a class="btn btn-success" href="{{ route('student.create') }}">
                        <i class="fas fa-plus"></i> Add Mahasiswa
                    </a>
                </div>
            </div>

            @if ($message = Session::get('success'))
                <div class="alert alert-success text-center">
                    <h6>{{ $message }}</h6>
                </div>
            @endif

            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Mahasiswa</h6>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th width="30px">No</th>
                                <th>Username</th>
                                <th>Nama Lengkap</th>
                                <th>NIM</th>
                                <th>Program Studi</th>
                                <th>Jenis Kelamin</th>
                                <th>Status</th>
                                <th width="150px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $student->user->name }}</td>
                                    <td>{{ $student->nama_lengkap }}</td>
                                    <td>{{ $student->nim }}</td>
                                    <td>{{ $student->prodi }}</td>
                                    <td>{{ $student->jenis_kelamin }}</td>
                                    <td>
                                        @if ($student->status == 1)
                                            Aktif
                                        @else
                                            Non-Aktif
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('student.destroy', $student->id) }}" method="POST">
                                            {{-- <a class="btn btn-info" href="{{ route('student.show', $student->id) }}">Show</a> --}}

                                            <a class="btn btn-primary"
                                                href="{{ route('student.edit', $student->id) }}">Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>

                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
