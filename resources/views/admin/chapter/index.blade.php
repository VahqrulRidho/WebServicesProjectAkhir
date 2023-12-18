@extends('layouts.admin.app')
@section('title', 'Chapter')
@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="col-lg-12">

            <div class="row my-3">
                <div class="col-lg-6">
                    <h2>Chapter</h2>
                </div>
                <div class="col-lg-6 text-right">
                    <a class="btn btn-success" href="{{ route('chapter.create') }}">
                        <i class="fas fa-plus"></i> Add Chapter
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
                    <h6 class="m-0 font-weight-bold text-primary">Data Chapter Pembelajaran</h6>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th width="50px">No</th>
                                <th>Judul</th>
                                <th width="150px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($chapters as $chapter)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $chapter->name }}</td>
                                    <td>
                                        <form action="{{ route('chapter.destroy', $chapter->id) }}" method="POST">
                                            {{-- <a class="btn btn-info" href="{{ route('chapter.show', $chapter->id) }}">Show</a> --}}

                                            <a class="btn btn-primary"
                                                href="{{ route('chapter.edit', $chapter->id) }}">Edit</a>

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
