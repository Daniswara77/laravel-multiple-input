<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Laptop;
use App\Models\Fitur;

class LaptopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'data'  => Laptop::get(),
        ];
        return view('tabel')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $kode = date('dmyhis');

        $gambarExt      = $request->gambar->getClientOriginalExtension();
        $gambarStore    = 'gambar-'.time().'.'.$gambarExt;
        $request->gambar->storeAs('public/images', $gambarStore);

        $data           = new Laptop;
        $data->merk     = $request->merk;
        $data->gambar   = $gambarStore;
        $data->harga    = $request->harga;
        $data->deskripsi    = $request->deskripsi;
        $data->kode     = $kode;
        $data->save();

        foreach ($request->fields as $key => $value) {
            Fitur::create([
                'fitur' => $value['fitur'],
                'kode'  => $kode,
            ]);
        }

        return redirect('/laptop')->with('status', 'Berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $laptop = Laptop::find($id);
        $fitur  = Fitur::where('kode', '=', $laptop->kode)->get();

        $data = [
            'data' => $laptop,
            'fitur' => $fitur,
        ];
        return view('detail')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $laptop = Laptop::find($id);
        $fitur  = Fitur::where('kode', '=', $laptop->kode)->get();

        $data = [
            'data' => $laptop,
            'fitur' => $fitur,
        ];
        return view('edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->hasFile('gambar')) {
            $gambarExt      = $request->gambar->getClientOriginalExtension();
            $gambarStore    = 'gambar-'.time().'.'.$gambarExt;
            $request->gambar->storeAs('public/images', $gambarStore);
        }

        $data           = Laptop::find($id);
        $data->merk     = $request->merk;
        $data->harga    = $request->harga;
        $data->deskripsi    = $request->deskripsi;

        if ($request->hasFile('gambar')) {
            Storage::delete('public/images/'.$data->gambar);
            $data->gambar   = $gambarStore;
        }else{
            $data->gambar = $request->dataGambar;
        }
        $data->save();


        if(!empty($request->update)){
            foreach($request->update as $key => $value){
                $fitur = Fitur::find($value['id']);
                if ($fitur) {
                    $fitur->update([
                        'fitur' => $value['fitur'],
                        'kode' => $data->kode,
                    ]);
                }
            }
        }

        if(!empty($request->add)){
            foreach($request->add as $key => $value){
                Fitur::create([
                    'fitur' => $value['fitur'],
                    'kode' => $data->kode
                ]);
            }
        }

        return redirect('/laptop')->with('status', 'Berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Laptop::find($id);
        Fitur::where('kode', '=', $data->kode)->delete();
        Storage::delete('public/images/'.$data->gambar);
        $data->delete();

        return redirect('/laptop')->with('status','Berhasil dihapus');
    }

    public function hapusFitur(string $id){
        $data = Fitur::find($id);
        $data->delete();

        return response()->json(['status' => 'Fitur terhapus']);
    }
}
