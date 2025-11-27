<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Laboratorium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SopController extends Controller
{
    public function index()
    {
        $sops = Document::where('tipe_dokumen', 'SOP')->with('laboratorium', 'uploadedBy')->latest()->get();
        return view('staf.sop.index', compact('sops'));
    }

    public function indexForUser()
    {
        $sops = Document::where('tipe_dokumen', 'SOP')->with('laboratorium')->latest()->get();
        return view('user.sop.index', compact('sops'));
    }

    public function create()
    {
        $laboratorium = Laboratorium::all();
        return view('staf.sop.create', compact('laboratorium'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lab_id' => 'required|exists:laboratorium,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,txt|max:5120',
        ]);

        $filePath = $request->file('file')->store('documents/sop', 'public');

        Document::create([
            'lab_id' => $request->lab_id,
            'tipe_dokumen' => 'SOP',
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file_path' => $filePath,
            'uploaded_by' => Auth::id(),
            'status' => 'confirmed',
        ]);

        return redirect()->route('staf.sop.index')->with('success', 'SOP berhasil diunggah.');
    }

    public function show(Document $sop)
    {
        return redirect()->route('staf.sop.index');
    }

    // Perbaikan method edit
    public function edit($id)
    {
        $sop = Document::findOrFail($id);
        $laboratorium = Laboratorium::all(); // tambahkan ini supaya dropdown bisa muncul
        return view('staf.sop.edit', compact('sop', 'laboratorium'));
    }

    public function update(Request $request, Document $sop)
    {
        if ($sop->tipe_dokumen !== 'SOP') {
            abort(404);
        }

        $request->validate([
            'lab_id' => 'required|exists:laboratorium,id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,txt|max:5120',
        ]);

        $filePath = $sop->file_path;

        if ($request->hasFile('file')) {
            if ($sop->file_path && Storage::disk('public')->exists($sop->file_path)) {
                Storage::disk('public')->delete($sop->file_path);
            }
            $filePath = $request->file('file')->store('documents/sop', 'public');
        }

        $sop->update([
            'lab_id' => $request->lab_id,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'file_path' => $filePath,
        ]);

        return redirect()->route('staf.sop.index')->with('success', 'SOP berhasil diperbarui.');
    }

    public function destroy(Document $sop)
    {
        if ($sop->tipe_dokumen !== 'SOP') {
            abort(404);
        }

        if ($sop->file_path && Storage::disk('public')->exists($sop->file_path)) {
            Storage::disk('public')->delete($sop->file_path);
        }

        $sop->delete();

        return redirect()->route('staf.sop.index')->with('success', 'SOP berhasil dihapus.');
    }

    public function download(Document $document)
    {
        if (!Storage::disk('public')->exists($document->file_path)) {
            abort(404, 'File not found.');
        }

        return Storage::disk('public')->download(
            $document->file_path,
            $document->judul . '.' . pathinfo($document->file_path, PATHINFO_EXTENSION)
        );
    }
}
