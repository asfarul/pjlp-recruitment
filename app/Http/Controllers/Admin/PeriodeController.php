<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Periode;
use Brian2694\Toastr\Facades\Toastr;
use Mapper;

class PeriodeController extends Controller
{
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
        $periods = Periode::orderBy('created_at', 'DESC')->get();

        return view('admin.periods.period_list', compact('periods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.periods.period_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'description' => 'required|max:100',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after:start_date',
        ]);

        try {
            $data              = new Periode;
            $data->start_date  = $request->start_date;
            $data->end_date    = $request->end_date;
            $data->description = $request->description;
            $data->save();

            Toastr::success('Berhasil menambahkan Periode');
            return redirect()->route('periods.index');
        } catch (\Throwable $th) {
            Toastr::error($th->getMessage());
            return redirect()->route('periods.index');
        }
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
        $periode = Periode::find($id);
        return view('admin.periods.period_edit', compact('periode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'description' => 'required|max:100',
            'start_date'  => 'required|date',
            'end_date'    => 'required|date|after:start_date',
        ]);

        try {
            $data              = Periode::find($id);
            $data->start_date  = $request->start_date;
            $data->end_date    = $request->end_date;
            $data->description = $request->description;
            $data->save();

            Toastr::success('Berhasil mengubah Periode');
            return redirect()->route('periods.index');
        } catch (\Throwable $th) {
            Toastr::error($th->getMessage());
            return redirect()->route('periods.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Periode::find($id)->delete();
        Toastr::success('Berhasil menghapus Periode');
        return redirect()->route('periods.index');
    }
}
