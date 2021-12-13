<?php

namespace App\Http\Controllers\Admin;

use ZipArchive;
use App\Models\Periode;
use App\Models\Candidate;
use Illuminate\Http\Request;
use App\Models\Candidatestatuses;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CandidateRequest;
use Illuminate\Support\Facades\DB;

class CandidateController extends Controller
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
    public function index(Request $request)
    {
        $query = Candidate::with(['vacancy','vacancy.dinas','vacancy.periode', 'candidate_status']);

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

        return view('admin.candidates.cdt_list', compact('candidates','periods'));
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CandidateRequest $request)
    {
//        $candidate = new Candidate();
//        $candidate->vacancy_id = $request->input('vacancy_id');
//        $candidate->nik = $request->input('nik');
//        $candidate->email = $request->input('email');
//        $candidate->notel = $request->input('notel');
//        $candidate->ktp = $request->input('ktp');
//        $candidate->ijazah = $request->input('ijazah');
//        $candidate->transkrip = $request->input('transkrip');
//        $candidate->sertifikat = $request->input('sertifikat');
//        $candidate->foto = $request->input('foto');
//        $candidate->surat_penawaran = $request->input('surat_penawaran');
//        $candidate->pakta_integritas = $request->input('pakta_integritas');
//        $candidate->formulir_kualifikasi = $request->input('formulir_kualifikasi');
//        $candidate->save();
//
//        Toastr::success('Berhasil mendaftar');
//        return redirect()->route('front.lowongan.lamar');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pelamar = Candidate::where('id', $id)->first();
        $status = Candidatestatuses::all()->pluck('candidate_status', 'id');

        return view('admin.candidates.cdt_edit', compact('pelamar', 'status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update = Candidate::where('id', $id)->first();
        $update->nik        = $request->nik;
        $update->nama       = $request->nama;
        $update->email      = $request->email;
        $update->notel      = $request->notel;
        $update->status_id  = $request->status_id;
        $update->save();

        return redirect()->route('pelamar.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $query = Candidate::findOrFail($id);
        $query->delete();

        Toastr::success('Berhasil menghapus data');
        return redirect()->route('pelamar.index');
    }

    public function download($id, Request $request)
    {
        $data    = Candidate::with(['vacancy','vacancy.dinas','vacancy.periode', 'candidate_status'])->find($id);
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
