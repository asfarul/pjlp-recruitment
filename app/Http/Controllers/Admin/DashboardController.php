<?php

namespace App\Http\Controllers\Admin;

use App\Models\Candidate;
use App\Models\Vacancy;
use App\Models\Vacancydoc;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    // Only Authenticated User have access to Dashboard
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Show Dashboard Page
    public function index()
    {
        $query = Vacancy::select('vacancies.*', 'opds.opd', 'opds.deskripsi', 'occupations.occupation')
            ->join('opds', 'opds.id', '=', 'vacancies.opd_id')
            ->join('occupations', 'occupations.id', '=', 'vacancies.occupation_id');
        if (Auth::user()->hasRole('opd')){
            $query->where('opds.opd', '=', Auth::user()->name);
        }
        $vacancies = $query->count();

        $query = Vacancydoc::select('vacancydocs.*', 'opds.opd', 'vacancies.title AS vacancy_title')
            ->join('opds', 'opds.id', '=', 'vacancydocs.opd_id')
            ->join('vacancies', 'vacancies.id', '=', 'vacancydocs.vacancy_id')
            ->orderBy('opds.id');
        if (Auth::user()->hasRole('opd')){
            $query->where('opds.opd', '=', Auth::user()->name);
        }
        $vacdocs= $query->count();

        $query = Candidate::select('candidates.*', 'opds.opd')
            ->join('vacancies', 'vacancies.id', '=', 'candidates.vacancy_id')
            ->join('opds', 'opds.id', '=', 'vacancies.opd_id');
        if (Auth::user()->hasRole('opd')){
            $query->where('opds.opd', '=', Auth::user()->name);
        }
        $candidates = $query->count();

        return view('admin.dashboard', compact('vacancies', 'vacdocs', 'candidates'));
    }
}
