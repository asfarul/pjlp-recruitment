<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VacdocRequest;
use App\Models\Opd;
use App\Models\Vacancy;
use App\Models\Vacancydoc;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Traits\UploadTrait;

class VacancydocController extends Controller
{
    use UploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Vacancydoc::select('vacancydocs.*', 'opds.opd', 'vacancies.title AS vacancy_title')
            ->join('opds', 'opds.id', '=', 'vacancydocs.opd_id')
            ->join('vacancies', 'vacancies.id', '=', 'vacancydocs.vacancy_id')
            ->orderBy('opds.id');

        if (Auth::user()->hasRole('opd')){
            $query->where('opds.opd', '=', Auth::user()->name);
        }

        $vacdocs= $query->get();

        return view('admin.vacancydocs.vcd_list', compact('vacdocs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $opds = Opd::pluck('opd', 'id');

        $vacancies = Vacancy::select('vacancies.id', DB::raw("CONCAT(opds.opd, ' - ', vacancies.title) AS name"))
            ->join('opds', 'opds.id', '=', 'vacancies.opd_id')
            ->get()
            ->pluck('name', 'id');

        return view('admin.vacancydocs.vcd_create', compact('opds', 'vacancies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VacdocRequest $request)
    {
        $opds = Opd::findOrFail($request->input('opd_id'));
        $vacancy = Opd::findOrFail($request->input('vacancy_id'));

        $vacdoc = new Vacancydoc();
        $vacdoc->opd_id = $request->input('opd_id');
        $vacdoc->vacancy_id = $request->input('vacancy_id');
        $vacdoc->title = $request->input('title');
        if ($request->has('document')) {
            $image = $request->file('document');
            $name = 'document_' . $request->input('title') . '_' . $vacancy->vacancy_code . time();
            $folder = '/berkas/' . $opds->opd . '/';
            $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
            $this->uploadOne($image, $folder, 'public', $name);
            $vacdoc->document = $filePath;
        }
        $vacdoc->save();

        Toastr::success('Berhasil menambahkan dokumen');
        return redirect()->route('dokumen.index');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vacdocs = Vacancydoc::findOrFail($id);
        $vacdocs->delete();

        Toastr::success('Berhasil menghapus dokumen');
        return redirect()->route('dokumen.index');
    }
}
