<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OpdRequest;
use App\Models\Opd;
use Brian2694\Toastr\Facades\Toastr;
use Mapper;
use Illuminate\Http\Request;

class OpdController extends Controller
{
    // Only Authenticated User have access to Dashboard
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $opds = Opd::all();

        return view('admin.opd.opds_list', compact('opds'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lat = -0.026487329912665437;
        $lng = 109.34246061920169;
        Mapper::map($lat, $lng, [
            'zoom' => 15,
            'type' => 'ROADMAP',
            'draggable' => true,
            'mapTypeControl' => false,
            'fullscreenControl' => false,
            'streetViewControl' => false,
            'markers' => array(
                'icon' => asset('assets/img/map/marker-building-red.png'),
                'animation' => 'DROP',
            ),
            'clusters' => [
                'size' => 10,
                'center' => true,
                'zoom' => 20
            ],
            'eventBeforeLoad' => 'setLatLng(' . $lat .', ' . $lng . ')',
            'eventDragEnd' => 'setLatLng(event.latLng.lat(), event.latLng.lng())',
        ]);

        return view('admin.opd.opds_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OpdRequest $request)
    {
        $opd = new Opd();
        $opd->opd = $request->input('opd');
        $opd->kode_opd = $request->input('kode_opd');
        $opd->deskripsi = $request->input('deskripsi');
        $opd->alamat = $request->input('alamat');
        $opd->telepon = $request->input('telepon');
        $opd->lat = $request->input('lat');
        $opd->long = $request->input('lng');
        $opd->save();

        Toastr::success('Berhasil menambahkan OPD');
        return redirect()->route('opd.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $opd = Opd::findOrFail($id);
        $lat = $opd->lat;
        $lng = $opd->long;

        Mapper::map($lat, $lng, [
            'zoom' => 15,
            'type' => 'ROADMAP',
            'draggable' => true,
            'mapTypeControl' => false,
            'fullscreenControl' => false,
            'streetViewControl' => false,
            'markers' => array(
                'icon' => asset('assets/img/map/marker-building-red.png'),
                'animation' => 'DROP',
            ),
            'clusters' => [
                'size' => 10,
                'center' => true,
                'zoom' => 20
            ],
            'eventBeforeLoad' => 'setLatLng(' . $lat .', ' . $lng . ')',
            'eventDragEnd' => 'setLatLng(event.latLng.lat(), event.latLng.lng())',
        ]);

        return view('admin.opd.opds_edit', compact('opd'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OpdRequest $request, $id)
    {
        $opd = Opd::findOrFail($id);
        $opd->opd = $request->input('opd');
        $opd->kode_opd = $request->input('kode_opd');
        $opd->deskripsi = $request->input('deskripsi');
        $opd->alamat = $request->input('alamat');
        $opd->telepon = $request->input('telepon');
        $opd->lat = $request->input('lat');
        $opd->long = $request->input('lng');
        $opd->save();

        Toastr::success('Berhasil mengubah OPD');
        return redirect()->route('opd.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $opd = Opd::findOrFail($id);
        $opd->delete();

        Toastr::success('Berhasil menghapus data');
        return redirect()->route('opd.index');
    }
}
