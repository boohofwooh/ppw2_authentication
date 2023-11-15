<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Models\Buku;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $batas = 5;
        $data_buku = Buku::orderBy('id', 'desc')->paginate($batas);
        $no = $batas * ($data_buku->currentPage()-1);
        $jumlah_buku = Buku::count('id');
        $total_harga = Buku::sum('harga');

        return view('dashboard', compact('data_buku', 'no', 'jumlah_buku', 'total_harga' ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buku.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'judul'  => 'required|string',
            'penulis'   => 'required|string|max:30',
            'harga'  => 'required|numeric',
            'tgl_terbit' => 'required|date'
        ]);
        
        if  ($request->file('thumbnail')){
            $request->validate([
                'thumbnail' => 'image|mimes:jpeg,jpg,png|max:2048'
            ]);
    
            $fileName = time().'_'.$request->thumbnail->getClientOriginalName();
            $filePath = $request->file('thumbnail')->storeAs('uploads', $fileName, 'public');
    
            Image::make(storage_path().'/app/public/uploads/'.$fileName)
                ->fit(240,320)
                ->save();

            $buku = Buku::create([
                'judul' => $request->judul,
                'penulis' => $request->penulis,
                'harga' => $request->harga,
                'tgl_terbit' => $request->tgl_terbit,
                'filename' => $fileName,
                'filepath' => '/storage/' . $filePath        
            ]);
        }
        
       

        if ($request->file('gallery')){
            foreach($request->file('gallery') as $key => $file){
                $fileName = time().'_'.$file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');

                $gallery = Gallery::create([
                    'nama_galeri' => $fileName,
                    'path' => '/storage/' . $filePath,
                    'foto' => $fileName,
                    'buku_id' => $buku -> id
                ]);
            }
        }
        return redirect('/buku')->with('pesan', 'Data Buku Berhasil di Tambahkan');
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $buku = Buku::find($id);
        return view('buku.edit', compact('buku'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $buku = Buku::find($id);

        if  ($request->file('thumbnail')){
            $request->validate([
                'thumbnail' => 'image|mimes:jpeg,jpg,png|max:2048'
            ]);
    
            $fileName = time().'_'.$request->thumbnail->getClientOriginalName();
            $filePath = $request->file('thumbnail')->storeAs('uploads', $fileName, 'public');
    
            Image::make(storage_path().'/app/public/uploads/'.$fileName)
                ->fit(240,320)
                ->save();
                
            
            $buku->update([
                'judul' => $request->judul,
                'penulis' => $request->penulis,
                'harga' => $request->harga,
                'tgl_terbit' => $request->tgl_terbit,
                'filename' => $fileName,
                'filepath' => '/storage/' . $filePath
            ]);
        }

        
        $buku->update([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'harga' => $request->harga,
            'tgl_terbit' => $request->tgl_terbit,
        ]);
        

        if ($request->file('gallery')){
            foreach($request->file('gallery') as $key => $file){
                $fileName = time().'_'.$file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');

                $gallery = Gallery::create([
                    'nama_galeri' => $fileName,
                    'path' => '/storage/' . $filePath,
                    'foto' => $fileName,
                    'buku_id' => $id
                ]);
            }
        }
        return redirect('/buku')->with('pesan', 'Perubahan Data Buku Berhasil di Simpan');
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $buku = Buku::find($id);
        $buku->delete();
        return redirect('/buku')->with('pesan', 'Data Buku Berhasil di Hapus');
        //
    }

    public function search(Request $request)
    {
        $batas = 5;
        $cari = $request->kata;
        $data_buku = Buku::where('judul','like','%'.$cari.'%')->orwhere('penulis','like','%'.$cari.'%') 
            ->paginate($batas);
        $jumlah_buku = $data_buku->count();
        $no = $batas * ($data_buku->currentPage() - 1);
        $total_harga = Buku::sum('harga');

        return view('buku.search', compact('data_buku', 'no', 'jumlah_buku', 'cari', 'total_harga' ));
    }

    public function hapusGambarGallery($id){
        $gallery = Gallery::find($id);

        Storage::delete('public/'. $gallery->path);

        $gallery->delete();

        return redirect()->back()->with('pesan', 'Gambar Galeri Berhasil Dihapus');
    }
}
