@extends('layouts.app')
@section('title', 'Tambah Data Document Detail')

@section('title-header', 'Tambah Data Document Detail')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('documents-details.index') }}">Data Document Detail</a></li>
    <li class="breadcrumb-item active">Tambah Data Document Detail</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h5 class="mb-0">Formulir Tambah Data Document Detail</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('documents-details.store') }}" method="POST" role="form" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="document_id">Document Parent</label>
                            <select class="form-control @error('document_id') is-invalid @enderror" id="document_id" name="document_id">
                                <option value="" selected>---Document Parent---</option>
                                @foreach ($docs as $docs)
                                    <option value="{{ $docs->id }}" @if (old('document_id') == $docs->id) selected @endif>
                                        {{ str()->title($docs->subject) }}</option>
                                @endforeach
                            </select>

                            @error('document_id')
                                <div class="d-block invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="nama_nasabah">Nama Nasabah</label>
                                    <input type="text" class="form-control @error('nama_nasabah') is-invalid @enderror" id="nama_nasabah"
                                        placeholder="Nama Nasabah Document Detail" value="{{ old('nama_nasabah') }}" name="nama_nasabah">
        
                                    @error('nama_nasabah')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="amount">Amount</label>
                                    <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount"
                                        placeholder="Amount Document Detail" value="{{ old('amount') }}" name="amount">
        
                                    @error('amount')
                                        <div class="d-block invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
                                <a href="{{route('documents-details.index')}}" class="btn btn-sm btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
