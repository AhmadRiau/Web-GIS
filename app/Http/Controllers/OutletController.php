<?php

namespace App\Http\Controllers;

use App\Outlet;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    public function index()
    {
        //$this->authorize('manage_outlet');

        $outletQuery = Outlet::query();
        $outletQuery->where('name', 'like', '%'.request('q').'%');
        $outlets = $outletQuery->paginate(25);

        return view('outlets.index', compact('outlets'));
    }

    public function create()
    {
        $this->authorize('create', new Outlet);

        return view('outlets.create');
    }


    public function store(Request $request)
    {
        $this->authorize('create', new Outlet);

        $newOutlet = $request->validate([
            'name'      => 'required|max:255',
            'address'   => 'nullable|max:255',
            'pemilik'   => 'nullable|max:255',
            'kontak_pemilik' => 'nullable|max:255',

            'tipe_kos'  => 'nullable|max:255',
            'harga_sewa'=> 'nullable|max:255',
            'fasilitas' => 'nullable|max:255',
            'sisa_kamar'=> 'nullable|max:255',

            'file_foto_kos'  => 'mimes:jpeg,bmp,png,jpg',
            'file_foto_kamar'=> 'mimes:jpeg,bmp,png,jpg',

            'latitude'  => 'nullable|required_with:longitude|max:15',
            'longitude' => 'nullable|required_with:latitude|max:15',
        ]);

        if ($request->hasFile('file_foto_kos')) {
            $path = $request->file('file_foto_kos')->getRealPath();
            $ext = $request->file_foto_kos->extension();
            $doc = file_get_contents($path);
            $base64 = base64_encode($doc);
            $mime = $request->file('file_foto_kos')->getClientMimeType();

            $newOutlet['name_foto_kos'] = $request->name .'.'.$ext;
            $newOutlet['file_foto_kos'] = $base64;
            $newOutlet['mime_foto_kos'] = $mime;
        }

        if ($request->hasFile('file_foto_kamar')) {
            $path = $request->file('file_foto_kamar')->getRealPath();
            $ext = $request->file_foto_kos->extension();
            $doc = file_get_contents($path);
            $base64 = base64_encode($doc);
            $mime = $request->file('file_foto_kamar')->getClientMimeType();

            $newOutlet['name_foto_kamar'] = $request->name .'.'.$ext;
            $newOutlet['file_foto_kamar'] = $base64;
            $newOutlet['mime_foto_kamar'] = $mime;
        }
        $newOutlet['creator_id'] = auth()->id();
        $outlet = Outlet::create($newOutlet);
        return redirect()->route('outlets.show', $outlet);
    }

    public function show(Outlet $outlet)
    {
        return view('outlets.show', compact('outlet'));
    }

    public function edit(Outlet $outlet)
    {
        $this->authorize('update', $outlet);

        return view('outlets.edit', compact('outlet'));
    }


    public function update(Request $request, Outlet $outlet)
    {
        $this->authorize('update', $outlet);

        $outletData = $request->validate([
            'name'      => 'required|max:255',
            'address'   => 'nullable|max:255',
            'pemilik'   => 'nullable|max:255',
            'kontak_pemilik' => 'nullable|max:255',

            'tipe_kos'  => 'nullable|max:255',
            'harga_sewa'=> 'nullable|max:255',
            'fasilitas' => 'nullable|max:255',
            'sisa_kamar'=> 'nullable|max:255',

            'file_foto_kos'  => 'mimes:jpeg,bmp,png,jpg',
            'file_foto_kamar'=> 'mimes:jpeg,bmp,png,jpg',

            'latitude'  => 'nullable|required_with:longitude|max:15',
            'longitude' => 'nullable|required_with:latitude|max:15',
        ]);

        if ($request->hasFile('file_foto_kos')) {
            $path = $request->file('file_foto_kos')->getRealPath();
            //dd($path);
            $ext = $request->file_foto_kos->extension();
            $doc = file_get_contents($path);
            //dd($doc);
            $base64 = base64_encode($doc);
            //dd($base64);
            $mime = $request->file('file_foto_kos')->getClientMimeType();

            $outletData['name_foto_kos'] = $request->name .'.'.$ext;
            $outletData['file_foto_kos'] = $base64;
            $outletData['mime_foto_kos'] = $mime;
        }

        if ($request->hasFile('file_foto_kamar')) {
            $path = $request->file('file_foto_kamar')->getRealPath();
            //dd($path);
            $ext = $request->file_foto_kamar->extension();
            $doc = file_get_contents($path);
            //dd($doc);
            $base64 = base64_encode($doc);
            $mime = $request->file('file_foto_kamar')->getClientMimeType();

            $outletData['name_foto_kamar'] = $request->name .'.'.$ext;
            $outletData['file_foto_kamar'] = $base64;
            $outletData['mime_foto_kamar'] = $mime;
        }

        $outlet->update($outletData);

        return redirect()->route('outlets.show', $outlet);
    }

    public function destroy(Request $request, Outlet $outlet)
    {
        $this->authorize('delete', $outlet);

        $request->validate(['outlet_id' => 'required']);

        if ($request->get('outlet_id') == $outlet->id && $outlet->delete()) {
            return redirect()->route('outlets.index');
        }

        return back();
    }

    public function convertBlob(){

    }
}
