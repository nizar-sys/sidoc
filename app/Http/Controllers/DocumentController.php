<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestStoreOrUpdateDocs;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['roles:maker'])->except(['index', 'show', 'form', 'status']);
    }

    public function index()
    {
        $docs = Document::latest();
        $docs = $docs->paginate(100);

        return view('dashboard.documents.index', compact('docs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.documents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestStoreOrUpdateDocs $request)
    {
        $newDocs = Document::create($request->validated());

        return redirect(route('documents.index'))->with('success', 'Document created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        return $document;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        return view('dashboard.documents.edit', compact('document'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(RequestStoreOrUpdateDocs $request, Document $document)
    {
        $document->update($request->validated());

        return redirect(route('documents.index'))->with('success', 'Document updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        $document->delete();

        return redirect(route('documents.index'))->with('success', 'Document deleted successfully');
    }

    public function form(Document $document)
    {
        return view('_partials.modals.form-docs', compact('document'))->render();
        // return view('_partials.modals.form-docs', compact('document'));
    }

    public function status(RequestStoreOrUpdateDocs $request, Document $document)
    {
        $document->update($request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully',
        ]);
    }
}
