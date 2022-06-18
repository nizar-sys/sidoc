@extends('layouts.app')
@section('title', 'Documents Detail')

@section('title-header', 'Documents Detail')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Documents Detail</li>
@endsection

@section('action_btn')
    <a href="{{route('documents-details.create')}}" class="btn btn-default">Tambah Data</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h2 class="card-title h3">Documents Detail</h2>
                    <div class="table-responsive">
                        <table class="table table-flush table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Subject Parent</th>
                                    <th>Status Document</th>
                                    <th>Nasabah</th>
                                    <th>Amount</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($docsDetail as $docDetail)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ str()->title($docDetail->document->subject) }}</td>
                                        <td>
                                            @if ($docDetail->document->status == 'approve')
                                                <span class="badge badge-success">{{ str()->title($docDetail->document->status )}}</span>
                                            @elseif ($docDetail->document->status == 'reject')
                                                <span class="badge badge-danger">{{ str()->title($docDetail->document->status )}}</span>
                                            @else
                                                <span class="badge badge-default">{{ str()->title($docDetail->document->status )}}</span>
                                            @endif
                                        </td>
                                        <td>{{ str()->title($docDetail->nama_nasabah) }}</td>
                                        <td>{{ 'Rp.'.number_format($docDetail->amount, 0, ',', '.') }}</td>
                                        <td class="d-flex jutify-content-center">
                                            <a href="{{route('documents-details.edit', $docDetail->id)}}" class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i></a>
                                            <form id="delete-form-{{ $docDetail->id }}" action="{{ route('documents-details.destroy', $docDetail->id) }}" class="d-none" method="post">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button onclick="deleteForm('{{$docDetail->id}}')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4">
                                        {{ $docsDetail->links() }}
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (isset($document) && !is_null($document))
        
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h3 class="mb-0">Document : {{str()->title($document->subject)}}</h3>
                    
                    <ul class="mt-4">
                        <li>
                            Status : {{$document->status}},
                        </li>
                        <li>
                            Remark : {{$document->remark ?? 'No Remark'}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection

@section('script')
    <script>
        function deleteForm(id){
            Swal.fire({
                title: 'Hapus data',
                text: "Anda akan menghapus data!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $(`#delete-form-${id}`).submit()
                }
            }) 
        }
    </script>
@endsection