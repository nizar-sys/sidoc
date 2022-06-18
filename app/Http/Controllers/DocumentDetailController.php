<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestStoreOrUpdateDocsDetail;
use App\Models\Document;
use App\Models\DocumentDetail;
use Illuminate\Http\Request;

class DocumentDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $docsDetail = DocumentDetail::latest();
        $document = null;
        if($request->has('doc_parent')){
            $docsDetail = $docsDetail->where('document_id', $request->doc_parent);
            $document = Document::find($request->doc_parent);
        }
        $docsDetail = $docsDetail->paginate(10);

        return view('dashboard.documents.detail.index', compact('docsDetail', 'document'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $docs = Document::all(['id', 'subject']);

        return view('dashboard.documents.detail.create', compact('docs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestStoreOrUpdateDocsDetail $request)
    {
        $document = Document::findOrFail($request->document_id);
        $newDocsDetail = $document->details()->create($request->validated());

        return redirect(route('documents-details.index'))->with('success', 'Document detail created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DocumentDetail  $documentDetail
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $documentDetail = DocumentDetail::findOrFail($id);
        return $documentDetail;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DocumentDetail  $documentDetail
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $documentDetail = DocumentDetail::findOrFail($id);
        $document = Document::all(['id', 'subject']);

        return view('dashboard.documents.detail.edit', compact('documentDetail', 'document'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DocumentDetail  $documentDetail
     * @return \Illuminate\Http\Response
     */
    public function update(RequestStoreOrUpdateDocsDetail $request, $id)
    {
        $documentDetail = DocumentDetail::findOrFail($id);
        $documentDetail->update($request->validated());

        return redirect(route('documents-details.index'))->with('success', 'Document detail updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DocumentDetail  $documentDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $documentDetail = DocumentDetail::findOrFail($id);
        $documentDetail->delete();

        return redirect(route('documents-details.index'))->with('success', 'Document detail deleted successfully');
    }
}
