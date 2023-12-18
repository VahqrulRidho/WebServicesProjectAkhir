@extends('layouts.admin.app')
@section('title', 'Dashboard')
@section('content')

    <div class="container-fluid" id="container-wrapper">
        <div class="col-lg-12 d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
        </div>

        @if ($message = Session::get('success'))
            <div class="col-lg-12 text-center">
                <div class="alert alert-danger text-center">
                    <h6>{{ $message }}</h6>
                </div>
            </div>
        @endif

        {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4"> --}}
        <div class="col-lg-12 text-center">
            <div class="card">
                <div class="mt-3 mb-3">
                    <h3>Welcome Amin!!</h3>
                </div>
            </div>
        </div>
        {{-- </div> --}}

    </div>
@endsection
