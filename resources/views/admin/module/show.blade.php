@extends('layouts.admin.app')
@section('title', 'Module')
@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Show Modul</h2>
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
                    <form action="{{ route('module.update', $data->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label class="fw-bold text-dark">Chapter Pertemuan</label>
                                    <input type="text" name="id_chapter" value="{{ $data->chapter->name }}"
                                        class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label class="fw-bold text-dark">Judul</label>
                                    <input type="text" name="judul" value="{{ $data->judul }}" class="form-control"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label class="fw-bold text-dark">Deskripsi</label>
                                    <textarea type="text" name="deskripsi" id="deskripsi" class="form-control" rows="6" disabled>{{ $data->deskripsi }}</textarea>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label class="fw-bold text-dark">Modul Pembelajaran</label>
                                    <a href="{{ route('show-modul', ['filename' => $data->modul]) }}" target="_blank"
                                        class="form-control" style="display: block; cursor: pointer;">
                                        {{ $data->modul }}
                                    </a>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label class="fw-bold text-dark">Link VIdeo</label>
                                    <input type="text" name="video" value="{{ $data->video }}" class="form-control"
                                        disabled>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-right mb-3">
                                <a class="btn btn-dark" href="{{ route('module.index') }}"> Back</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
