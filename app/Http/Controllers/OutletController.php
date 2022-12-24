<?php

namespace App\Http\Controllers;

use App\Outlet;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    public function index()
    {
        $this->authorize('manage_outlet');

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
            'name'      => 'required|max:60',
            'address'   => 'nullable|max:255',
            'pemilik'   => 'nullable|max:255',
            'kontak_pemilik' => 'nullable|max:255',

            'tipe_kos'  => 'nullable|max:255',
            'harga_sewa'=> 'nullable|max:255',
            'fasilitas' => 'nullable|max:255',
            'sisa_kamar'=> 'nullable|max:255',

            'latitude'  => 'nullable|required_with:longitude|max:15',
            'longitude' => 'nullable|required_with:latitude|max:15',
        ]);
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
            'name'      => 'required|max:60',
            'address'   => 'nullable|max:255',
            'pemilik'   => 'nullable|max:255',
            'kontak_pemilik' => 'nullable|max:255',

            'tipe_kos'  => 'nullable|max:255',
            'harga_sewa'=> 'nullable|max:255',
            'fasilitas' => 'nullable|max:255',
            'sisa_kamar'=> 'nullable|max:255',

            'latitude'  => 'nullable|required_with:longitude|max:15',
            'longitude' => 'nullable|required_with:latitude|max:15',
        ]);
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
}
