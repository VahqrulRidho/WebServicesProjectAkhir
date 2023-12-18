@extends('layouts.admin.app')
@section('title', 'Informasi')
@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="col-lg-12">

            <div class="row my-3">
                <div class="col-lg-6">
                    <h2>Informasi</h2>
                </div>
                <div class="col-lg-6 text-right">
                    <a class="btn btn-success" href="{{ route('informasi.create') }}">
                        <i class="fas fa-plus"></i> Add Informasi
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
                    <h6 class="m-0 font-weight-bold text-primary">Data Informasi Terkini</h6>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th width="30px">No</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th width="200px">Tanggal Posting</th>
                                <th width="150px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($informasis as $informasi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $informasi->judul }}</td>
                                    <td>{{ $informasi->deskripsi }}</td>
                                    <td>{{ $informasi->updated_at }}</td>
                                    <td>
                                        <form action="{{ route('informasi.destroy', $informasi->id) }}" method="POST">
                                            {{-- <a class="btn btn-info" href="{{ route('informasi.show', $informasi->id) }}">Show</a> --}}

                                            <a class="btn btn-primary"
                                                href="{{ route('informasi.edit', $informasi->id) }}">Edit</a>
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
