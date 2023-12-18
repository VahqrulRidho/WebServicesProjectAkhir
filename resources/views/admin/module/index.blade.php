@extends('layouts.admin.app')
@section('title', 'Module')
@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="col-lg-12">

            <div class="row my-3">
                <div class="col-lg-6">
                    <h2>Modul</h2>
                </div>
                <div class="col-lg-6 text-right">
                    <a class="btn btn-success" href="{{ route('module.create') }}">
                        <i class="fas fa-plus"></i> Add Modul
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
                    <h6 class="m-0 font-weight-bold text-primary">Data Modul Pembelajaran</h6>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th width="30px">No</th>
                                <th>Chapter</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Modul</th>
                                <th>Video</th>
                                <th width="230px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($modules as $module)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $module->chapter->name }}</td>
                                    <td>{{ $module->judul }}</td>
                                    <td>{{ $module->deskripsi }}</td>
                                    <td>
                                        <a href="{{ route('show-modul', ['filename' => $module->modul]) }}"
                                            target="_blank">{{ $module->modul }}</a>
                                    </td>

                                    <td>{{ $module->video }}</td>
                                    <td>
                                        <form action="{{ route('module.destroy', $module->id) }}" method="POST">
                                            <a class="btn btn-success"
                                                href="{{ route('module.show', $module->id) }}">Show</a>
                                            <a class="btn btn-primary"
                                                href="{{ route('module.edit', $module->id) }}">Edit</a>

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
