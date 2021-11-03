<?php

namespace App\Http\Controllers\Admin;

use App\Models\CandidateKhusus;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidateKhususController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = CandidateKhusus::select('candidate_khususes.*', 'opds.opd', 'vacancies.title', 'candidatestatuses.candidate_status')
            ->join('vacancies', 'vacancies.id', '=', 'candidate_khususes.vacancy_id')
            ->join('candidatestatuses', 'candidatestatuses.id', '=', 'candidate_khususes.status_id')
            ->orderBy('candidate_khususes.id')
            ->join('opds', 'opds.id', '=', 'vacancies.opd_id');

        if (Auth::user()->hasRole('opd')){
            $query->where('opds.opd', '=', Auth::user()->name);
        }

        $candidates = $query->get();
//
        return view('admin.candidatekhususes.cdt_list', compact('candidates'));
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
}
