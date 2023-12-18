@extends('layouts.admin.app')
@section('title', 'Module')
@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Edit Module</h2>
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
                    <form action="{{ route('module.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label class="fw-bold text-dark">Judul</label>
                                    <input type="text" name="judul" value="{{ $data->judul }}" class="form-control"
                                        placeholder="Judul">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label class="fw-bold text-dark">Pilih Chapter Pertemuan</label>
                                    <select class="js-example-basic-single form-control" name="id_chapter" id="id_chapter">
                                        <option value="" disabled>Pilih Chapter</option>
                                        @foreach ($chapters as $chapter)
                                            <option value="{{ $chapter->id }}"
                                                {{ $data->id_chapter == $chapter->id ? 'selected' : '' }}>
                                                {{ $chapter->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Deskripsi</strong>
                                    <textarea type="text" name="deskripsi" id="deskripsi" class="form-control" placeholder="Deskripsi" rows="6">{{ $data->deskripsi }}</textarea>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label class="fw-bold text-dark">Upload Module</label>
                                    <input type="file" class="form-control" name="modul" accept="application/pdf" />
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Link Video</strong>
                                    <input type="text" name="video" value="{{ $data->video }}" class="form-control"
                                        placeholder="Link Video">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-right mb-3">
                                <a class="btn btn-dark" href="{{ route('module.index') }}"> Back</a>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
