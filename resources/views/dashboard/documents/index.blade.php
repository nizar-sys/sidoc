@extends('layouts.app')
@section('title', 'Documents')

@section('title-header', 'Documents')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Documents</li>
@endsection

@section('action_btn')
    <a href="{{route('documents.create')}}" class="btn btn-default">Tambah Data</a>
@endsection

@section('content')
    <div id="modalcontent"></div>
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-transparent border-0 text-dark">
                    <h2 class="card-title h3">Documents</h2>
                    <div class="table-responsive">
                        <table class="table table-flush table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Subject</th>
                                    <th>Status</th>
                                    <th>Created By</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($docs as $doc)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ str()->title($doc->subject) }}</td>
                                        <td>
                                            @if ($doc->status == 'approve')
                                                <span class="badge badge-success">{{ str()->title($doc->status )}}</span>
                                            @elseif ($doc->status == 'reject')
                                                <span class="badge badge-danger">{{ str()->title($doc->status )}}</span>
                                            @else
                                                <span style="cursor: pointer" onclick="setStatus({{$doc->id}})" class="badge badge-default">{{ str()->title($doc->status )}}</span>
                                            @endif
                                        </td>
                                        <td>{{ str()->title($doc->createdBy->name) }}</td>
                                        <td class="d-flex jutify-content-center">
                                            <a href="{{ route('documents-details.index', ['doc_parent' => $doc->id]) }}" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                                            <a href="{{route('documents.edit', $doc->id)}}" class="btn btn-sm btn-warning"><i class="fas fa-pencil-alt"></i></a>
                                            <form id="delete-form-{{ $doc->id }}" action="{{ route('documents.destroy', $doc->id) }}" class="d-none" method="post">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button onclick="deleteForm('{{$doc->id}}')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
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
                                        {{ $docs->links() }}
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @include('_partials.cjs.ajaxPromise')
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

        async function setStatus(doc){
            try {
                var modalcontent = $('#modalcontent');
                const response = await HitData("{{route('documents.form', ':id')}}".replace(':id', doc), 'GET')
                modalcontent.html(response)

                modalcontent.find('#setStatusModal-'+doc).modal('show');
            } catch (error) {
                Snackbar.show({
                    text: error.message,
                    postition: 'top-right',
                    showAction: false,
                    backgroundColor: '#e74c3c',
                    textColor: '#fff',
                    duration: 5000
                });
            }
        }

        async function postSubmit(doc_id) {
            var buttonsubmit = $('#btnsubmit-'+doc_id);
            try {
                buttonsubmit.attr('disabled', true);
                var url = "{{route('documents.status', ':id')}}".replace(':id', doc_id), data = {
                    status: $('#status-'+doc_id).val(),
                    remark: $('#remark-'+doc_id).val()
                };
                const response = await HitData(url, data, 'POST');
                if(response.success){
                    Snackbar.show({
                        text: response.message,
                        postition: 'top-right',
                        showAction: false,
                        backgroundColor: '#2ecc71',
                        textColor: '#fff',
                        duration: 5000
                    });
                    window.location.reload();
                }
            } catch (error) {
                buttonsubmit.attr('disabled', false);
                Snackbar.show({
                    text: error.responseJSON.message,
                    postition: 'top-right',
                    showAction: false,
                    backgroundColor: '#e74c3c',
                    textColor: '#fff',
                    duration: 5000
                });
            }
        }
    </script>
@endsection