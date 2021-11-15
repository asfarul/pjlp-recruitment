<?php

namespace App\Http\Controllers\Admin;

use App\Models\CandidateKhusus;
use App\Models\Periode;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ZipArchive;
use File;
use Illuminate\Support\Facades\DB;

class CandidateKhususController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = CandidateKhusus::with(['vacancy','vacancy.dinas','vacancy.periode', 'candidate_status']);

        if (Auth::user()->hasRole('opd')){
            $query->whereHas('vacancy.dinas', function($q){
                $q->where('opd', Auth::user()->name);
            });
        }

        if ($request->get('period_id') && $request->period_id != null) {
            $query->where('period_id', $request->period_id);
        }

        $candidates = $query->get();
        $periods = DB::table('periods')->pluck('description', 'id');
        return view('admin.candidatekhususes.cdt_list', compact('candidates', 'periods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CandidateKhusus  $candidateKhusus
     * @return \Illuminate\Http\Response
     */
    public function show(CandidateKhusus $candidateKhusus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CandidateKhusus  $candidateKhusus
     * @return \Illuminate\Http\Response
     */
    public function edit(CandidateKhusus $candidateKhusus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CandidateKhusus  $candidateKhusus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CandidateKhusus $candidateKhusus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CandidateKhusus  $candidateKhusus
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $query = CandidateKhusus::findOrFail($id);
        $query->delete();

        Toastr::success('Berhasil menghapus data');
        return redirect()->route('pelamar.index');
    }

    public function download($id, Request $request)
    {
        $data    = CandidateKhusus::with(['vacancy','vacancy.dinas','vacancy.periode', 'candidate_status'])->find($id);
        $zipFile = str_replace(" ", "-", $data->nama). ".zip";
        $zip     = new ZipArchive;
        
        $zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        
        $path  = public_path("uploads/cpjlp/".$data->nik);
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));
        foreach ($files as $name => $file) {
            if (!$file->isDir()) {
                $filePath     = $file->getRealPath();
                $relativePath = substr($filePath, strlen($path) + 1);
                $zip->addFile($filePath, $relativePath);
            }
        }
        $zip->close();
        $headers = ["Content-Type"=>"application/zip"];
        return response()->download(public_path($zipFile), $zipFile, $headers);
    }
}
