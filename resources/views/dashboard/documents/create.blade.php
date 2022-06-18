@extends('layouts.app')
@section('title', 'Tambah Data Document')

@section('title-header', 'Tambah Data Document')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('documents.index') }}">Data Document</a></li>
    <li class="breadcrumb-item active">Tambah Data Document</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h5 class="mb-0">Formulir Tambah Data Document</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('documents.store') }}" method="POST" role="form" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="subject">Subject</label>
                            <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject"
                                placeholder="Subject Document" value="{{ old('subject') }}" name="subject">

                            @error('subject')
                                <div class="d-block invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
                                <a href="{{route('documents.index')}}" class="btn btn-sm btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
