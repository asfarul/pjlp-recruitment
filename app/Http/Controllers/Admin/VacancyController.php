<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VacancyRequest;
use App\Models\Opd;
use App\Models\Vacancy;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VacancyController extends Controller
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
        $query = Vacancy::with(['dinas', 'periode', 'type']);

        if (Auth::user()->hasRole('opd')){
            $query->dinas()->where('opd', '=', Auth::user()->name);
        }

        $vacancies = $query->get();

        return view('admin.vacancies.vacancy_list', compact('vacancies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $opds = Opd::select('id', DB::raw("CONCAT(opd, ' - ', deskripsi) AS display_name"))->get()->pluck('display_name', 'id');
        $occupations = DB::table('occupations')->pluck('occupation', 'id');
        $types = DB::table('vacancy_types')->pluck('type', 'id');
        $periods = DB::table('periods')->pluck('description', 'id');

        return view('admin.vacancies.vacancy_create', compact('opds', 'occupations', 'types', 'periods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(VacancyRequest $request)
    {
        $vacancy = new Vacancy();
        $vacancy->title = $request->input('title');
        $vacancy->vacancy_code = $request->input('vacancy_code');
        $vacancy->opd_id = $request->input('opd_id');
        $vacancy->description = $request->input('description');
        $vacancy->selection = $request->input('selection');
        $vacancy->salary_estimate = $request->input('salary_estimate');
        $vacancy->occupation_id = $request->input('occupation_id');
        $vacancy->number_of_employee = $request->input('number_of_employee');
        $vacancy->start_date = date('Y-m-d', strtotime(strtr($request->input('start_date'), '/','-')));
        $vacancy->finish_date = date('Y-m-d', strtotime(strtr($request->input('finish_date'), '/','-')));
        $vacancy->type_id = $request->input('type_id');
        $vacancy->period_id = $request->input('period_id');
        $vacancy->status = (($request->input('status') == 'active') ? 1 : 0);
        $vacancy->save();

        Toastr::success('Berhasil menambahkan lowongan pekerjaan');
        return redirect()->route('lowongan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vacancy = Vacancy::findOrFail($id);
        $opds = Opd::select('id', DB::raw("CONCAT(opd, ' - ', deskripsi) AS display_name"))->get()->pluck('display_name', 'id');
        $occupations = DB::table('occupations')->pluck('occupation', 'id');
        $types = DB::table('vacancy_types')->pluck('type', 'id');
        $periods = DB::table('periods')->pluck('description', 'id');

        return view('admin.vacancies.vacancy_edit', compact('vacancy', 'opds', 'occupations', 'types', 'periods'));
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
        $vacancy = Vacancy::findOrFail($id);
        $vacancy->title = $request->input('title');
        $vacancy->vacancy_code = $request->input('vacancy_code');
        $vacancy->opd_id = $request->input('opd_id');
        $vacancy->description = $request->input('description');
        $vacancy->selection = $request->input('selection');
        $vacancy->salary_estimate = $request->input('salary_estimate');
        $vacancy->occupation_id = $request->input('occupation_id');
        $vacancy->number_of_employee = $request->input('number_of_employee');
        $vacancy->start_date = date('Y-m-d', strtotime(strtr($request->input('start_date'), '/','-')));
        $vacancy->finish_date = date('Y-m-d', strtotime(strtr($request->input('finish_date'), '/','-')));
        $vacancy->type_id = $request->input('type_id');
        $vacancy->period_id = $request->input('period_id');
        $vacancy->status = (($request->input('status') == 'active') ? 1 : 0);
        $vacancy->save();

        Toastr::success('Berhasil mengubah lowongan pekerjaan');
        return redirect()->route('lowongan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vacancy = Vacancy::findOrFail($id);
        $vacancy->delete();

        Toastr::success('Berhasil menghapus lowongan pekerjaan');
        return redirect()->route('lowongan.index');
    }
}
