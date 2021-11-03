<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CandidateRequest;
use App\Models\Candidate;
use App\Models\Candidatestatuses;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function index()
    {
        $query = Candidate::select('candidates.*', 'opds.opd', 'vacancies.title', 'candidatestatuses.candidate_status')
            ->join('vacancies', 'vacancies.id', '=', 'candidates.vacancy_id')
            ->join('candidatestatuses', 'candidatestatuses.id', '=', 'candidates.status_id')
            ->orderBy('candidates.id')
            ->join('opds', 'opds.id', '=', 'vacancies.opd_id');

        if (Auth::user()->hasRole('opd')){
            $query->where('opds.opd', '=', Auth::user()->name);
        }

        $candidates = $query->get();

        return view('admin.candidates.cdt_list', compact('candidates'));
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
}
