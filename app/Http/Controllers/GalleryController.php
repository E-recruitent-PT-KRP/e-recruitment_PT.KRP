<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gallery = Gallery::all();
        return view('admin.gallery.index', compact('gallery'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'image' => 'required|image|max:5000',
        ], [
            'image.required' => 'Gambar harus diisi',
            'image.image' => 'File harus berupa gambar',
        ]);

        $gallery = new Gallery();

        // if ($request->hasFile('image')) {
        //     $extFile = $request->image->getClientOriginalExtension();
        //     $isiFile = 'gallery-' . time() . "." . $extFile;
        //     $path = $request->image->move('images\gallery', $isiFile);
        //     $gallery->image = $path;
        // }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageFilename = 'gallery-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/gallery'), $imageFilename);
            $gallery->image = $imageFilename;
        }


        $gallery->save();
        $request->session()->flash('pesan', 'Penambahan data berhasil');
        return redirect('/admin/gallery')->with('success', 'Gambar berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     $gallery = Gallery::findOrFail($id);
    //     return view('landing.index',compact('gallery'));
    // }

    // public function showGallery()
    // {
    //     $galleryItems = Gallery::all();
    //     return view('landing.index', compact('galleryItems'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('admin.gallery.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'image' => 'nullable|image|max:5000',
        ], [
            'image.image' => 'File harus berupa gambar',
        ]);

        $gallery = Gallery::findOrFail($id);

        if ($request->hasFile('image')) {
            // Menghapus gambar lama jika ada
            if ($gallery->image) {
                $oldImagePath = public_path('images/gallery/' . $gallery->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Mengupload gambar baru
            $file = $request->file('image');
            $imageFilename = 'gallery-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/gallery'), $imageFilename);
            $gallery->image = $imageFilename;
        }

        $gallery->save();

        return redirect('/admin/gallery')->with('success', 'Gambar berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Temukan item galeri berdasarkan ID
        $galleryItem = Gallery::find($id);

        if ($galleryItem) {
            // Hapus item galeri
            $galleryItem->delete();

            // Set flash message dan redirect
            return redirect()->route('gallery.index')->with('success', 'Gallery item deleted successfully.');
        }

        // Jika tidak ditemukan, redirect dengan pesan error
        return redirect()->route('gallery.index')->with('error', 'Gallery item not found.');
    }

    // public function gallery()
    // {
    //     return view ('admin.gallery.index');
    // }
}
