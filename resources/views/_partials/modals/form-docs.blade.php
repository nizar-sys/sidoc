<div class="modal fade" id="setStatusModal-{{$document->id}}" tabindex="-1" role="dialog" aria-labelledby="setStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="setStatusModalLabel">Update Doc: {{$document->subject}}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label for="status">Status</label>
                    <select class="form-control @error('status') is-invalid @enderror" id="status-{{$document->id}}" name="status">
                        <option value="" selected>---Status---</option>
                        @php
                            $stats = ['approve', 'reject'];
                        @endphp
                        @foreach ($stats as $status)
                            <option value="{{ $status }}" @if (old('status', $document->status) == $status) selected @endif>
                                {{ str()->title($status) }}</option>
                        @endforeach
                    </select>

                    @error('status')
                        <div class="d-block invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="remark">Remark</label>
                    <textarea class="form-control @error('remark') is-invalid @enderror"
                    placeholder="Remark Document" name="remark" id="remark-{{$document->id}}" cols="30" rows="10">
                    {!! old('remark', $document->remark) !!}
                    </textarea>

                    @error('remark')
                        <div class="d-block invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" id="btnsubmit-{{$document->id}}" onclick="postSubmit('{{$document->id}}')" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>