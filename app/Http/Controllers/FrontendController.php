<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Candidate;
use App\Models\CandidateKhusus;
use App\Models\Opd;
use App\Models\Periode;
use App\Models\Visitor;
use App\Models\Vacancy;
use App\Models\Vacancydoc;
use Illuminate\Http\Request;
use App\Traits\UploadTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Vinkla\Hashids\Facades\Hashids;

class FrontendController extends Controller
{
    use UploadTrait;

    /**
     * Frontend : index (beranda)
     */
    public function index()
    {
        $opds = Opd::all();
        $vacarrays = array();
        $now = Carbon::now()->format('Y-m-d');
        foreach ($opds as $opd) {
            $vacancies = Vacancy::select('vacancies.*', 'opds.opd', 'opds.deskripsi', 'occupations.occupation')
                ->join('opds', 'opds.id', '=', 'vacancies.opd_id')
                ->join('occupations', 'occupations.id', '=', 'vacancies.occupation_id')
                ->where('status', 1)
                ->where('opd_id', '=', $opd->id)
                ->get();

            if (!$vacancies->isEmpty()) {
                $vacarrays[] = array('OPD' => $opd->deskripsi, 'vacancies' => $vacancies);
            }
        }

        $vaccols = collect($vacarrays);

        $articles = Article::select('articles.*', 'articlecategories.category')
            ->join('articlecategories', 'articlecategories.id', '=', 'articles.category_id')
            ->where('articles.status', '=', 'PUBLISHED')->whereDate('publish_at', '<=', $now)->orderBy('id', 'DESC')
            ->paginate(3);


        $countCan = 0;
        $periode = Periode::orderBy('start_date', 'DESC')->first();
        $vac = Vacancy::where([
            ['status', '=', true],
        ])->orderBy('updated_at', 'DESC')->first();
        if ($vac) {
            $umum = Candidate::whereHas('vacancy', function ($q) use ($vac) {
                $q->where('period_id', $vac->period_id);
            })->get()->count();
            $khusus = CandidateKhusus::whereHas('vacancy', function ($q) use ($vac) {
                $q->where('period_id', $vac->period_id);
            })->get()->count();
            $countCan = $umum + $khusus;
        }


        $today = date('Y-m-d');
        $month = date('Y-m');
        $year = date('Y');
        $visitor_today = Visitor::where('hari_kunjungan', 'LIKE', '%' . $today . '%')->distinct('ip_pengunjung')->count('ip_pengunjung');
        $visitor_today = $visitor_today + 1;
        $visitor_month = Visitor::where('hari_kunjungan', 'LIKE', '%' . $month . '%')->distinct('ip_pengunjung')->count('ip_pengunjung');
        $visitor_month = $visitor_month + 1;
        $visitor_year = Visitor::where('hari_kunjungan', 'LIKE', '%' . $year . '%')->distinct('ip_pengunjung')->count('ip_pengunjung');
        $visitor_year = $visitor_year + 1;
        $visitor_all = Visitor::distinct('ip_pengunjung')->count('ip_pengunjung');
        $visitor_all = $visitor_all + 1;

        return view('front.home', compact('vaccols', 'articles', 'countCan', 'visitor_today', 'visitor_month', 'visitor_year', 'visitor_all'));
    }

    public function singleJob($id)
    {
        $id = substr(Hashids::decode($id)[0], 0, -5);
        $vacancy = Vacancy::select('vacancies.*', 'opds.opd', 'opds.deskripsi', 'occupations.occupation', 'vacancy_types.type', 'periods.start_date', 'periods.end_date')
            ->join('opds', 'opds.id', '=', 'vacancies.opd_id')
            ->join('occupations', 'occupations.id', '=', 'vacancies.occupation_id')
            ->join('vacancy_types', 'vacancy_types.id', '=', 'vacancies.type_id')
            ->join('periods', 'periods.id', '=', 'vacancies.period_id')
            ->where('status', 1)
            ->where('vacancies.id', $id)
            ->first();

        // dd($vacancy);

        $vacdocs = Vacancydoc::where('vacancy_id', $id)->get();

        return view('front.single-job', compact('vacancy', 'vacdocs'));
    }

    public function singleArticle($id)
    {
        $id = substr(Hashids::decode($id)[0], 0, -5);
        $article = Article::select('articles.*', 'articlecategories.category')
            ->join('articlecategories', 'articlecategories.id', '=', 'articles.category_id')
            ->where('articles.id', $id)->where('status', 'PUBLISHED')
            ->first();

        if ($article) {

            $nextarticle = Article::where('articles.id', $id + 1)->first();

            $prevarticle = Article::where('articles.id', $id - 1)->first();

            return view('front.single-article', compact('article', 'nextarticle', 'prevarticle'));
        }
        return redirect()->back();
    }

    public function applyForJob($id)
    {
        $id = substr(Hashids::decode($id)[0], 0, -5);
        $vacancy = Vacancy::select('vacancies.*', 'opds.opd', 'opds.deskripsi', 'occupations.occupation', 'vacancy_types.type')
            ->join('opds', 'opds.id', '=', 'vacancies.opd_id')
            ->join('occupations', 'occupations.id', '=', 'vacancies.occupation_id')
            ->join('vacancy_types', 'vacancy_types.id', '=', 'vacancies.type_id')
            ->where('status', 1)
            ->where('vacancies.id', $id)
            ->first();

        $vacdocs = Vacancydoc::where('vacancy_id', $id)->get();

        return view('front.apply', compact('vacancy', 'vacdocs'));
    }

    public function submitVacancy(Request $request)
    {
        $rules = [
            'vacancy_id' => 'required',
            'nik' => 'required|numeric|min:16',
            'nama' => 'required',
            'email' => 'required',
            'notel' => 'required',
            'ktp' => 'required|mimes:jpeg,png,pdf|max:210',
            'ijazah' => 'required|mimes:jpeg,png,pdf|max:510',
            'transkrip' => 'required|mimes:jpeg,png,pdf|max:510',
            'sertifikat' => 'mimes:jpeg,png,pdf|max:3072',
            'foto' => 'required|mimes:jpeg,png|max:210',
            'surat_penawaran' => 'required|mimes:pdf|max:210',
            'pakta_integritas' => 'required|mimes:pdf|max:210',
            'formulir_kualifikasi' => 'required|mimes:pdf|max:210',
        ];

        $messages = [
            'vacancy_id.required' => 'Posisi wajib diisi!',
            'nik.required' => 'NIK wajib diisi!',
            'nik.numeric' => 'NIK harus berupa angka!',
            'nik.min' => 'NIK minimal 16 karakter!',
            'nik.max' => 'NIK maksimal 16 karakter!',
            'nik.unique' => 'NIK sudah pernah terdaftar!',
            'nama.required' => 'Nama wajib diisi!',
            'email.required' => 'Email wajib diisi!',
            'notel.required' => 'No Telepon/Handphone wajib diisi!',
            'ktp.required' => 'KTP wajib diupload!',
            'ktp.mimes' => 'Hanya dapat mengupload file berformat JPG/PNG/PDF!',
            'ktp.max' => 'File maksimal 200KB!',
            'ijazah.required' => 'Ijazah wajib diupload!',
            'ijazah.mimes' => 'Hanya dapat mengupload file berformat JPG/PNG/PDF!',
            'ijazah.max' => 'File maksimal 500KB!',
            'transkrip.required' => 'Transkrip wajib diupload!',
            'transkrip.mimes' => 'Hanya dapat mengupload file berformat JPG/PNG/PDF!',
            'transkrip.max' => 'File maksimal 500KB!',
            'sertifikat.mimes' => 'Hanya dapat mengupload file berformat JPG/PNG/PDF!',
            'sertifikat.max' => 'File maksimal 1MB!',
            'foto.required' => 'Foto wajib diupload!',
            'foto.mimes' => 'Hanya dapat mengupload file berformat JPG/PNG!',
            'foto.max' => 'File maksimal 200KB!',
            'surat_penawaran.required' => 'Surat Penawaran wajib diupload!',
            'surat_penawaran.mimes' => 'Hanya dapat mengupload file berformat PDF!',
            'surat_penawaran.max' => 'File maksimal 200KB!',
            'pakta_integritas.required' => 'Pakta Integritas wajib diupload!',
            'pakta_integritas.mimes' => 'Hanya dapat mengupload file berformat PDF!',
            'pakta_integritas.max' => 'File maksimal 200KB!',
            'formulir_kualifikasi.required' => 'Formulir Kualifikasi wajib diupload!',
            'formulir_kualifikasi.mimes' => 'Hanya dapat mengupload file berformat PDF!',
            'formulir_kualifikasi.max' => 'File maksimal 200KB!',
        ];

        $this->validate($request, $rules, $messages);


        $vacancy = Vacancy::where([
            ['id', '=', substr(Hashids::decode($request->input('vacancy_id'))[0], 0, -5)],
            ['status', '=', 1],
        ])->first();

        //dapatkan periode sekarang
        $currentPeriode = null;
        if ($vacancy) {
            $currentPeriode = $vacancy->period_id;
        } else {
            var_dump('Pendaftaran sudah ditutup');
        }
        //apakah nik di kandidat sudah terdaftar
        if ($currentPeriode) {
            //periksa apakah kandidat sdah pernah mendaftar di periode sekarang
            $kandidat = Candidate::where([
                ['nik', '=', $request->input('nik')],
                ['period_id', '=', $currentPeriode],
            ])->first();

            if (!$kandidat) {
                //jika belum mendaftar
                $id = substr(Hashids::decode($request->input('vacancy_id'))[0], 0, -5);
                $candidate = new Candidate();
                $candidate->vacancy_id = $id;
                $candidate->period_id = $currentPeriode;
                $candidate->nama = $request->input('nama');
                $candidate->nik = $request->input('nik');
                $candidate->email = $request->input('email');
                $candidate->notel = $request->input('notel');
                if ($request->has('ktp')) {
                    $image = $request->file('ktp');
                    $name = 'ktp_' . $request->input('nik') . '_' . time();
                    $folder = '/cpjlp/' . $request->input('nik') . '/';
                    $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
                    $this->uploadOne($image, $folder, 'public', $name);
                    $candidate->ktp = $filePath;
                }
                if ($request->has('ijazah')) {
                    $image = $request->file('ijazah');
                    $name = 'ijazah_' . $request->input('nik') . '_' . time();
                    $folder = '/cpjlp/' . $request->input('nik') . '/';
                    $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
                    $this->uploadOne($image, $folder, 'public', $name);
                    $candidate->ijazah = $filePath;
                }
                if ($request->has('transkrip')) {
                    $image = $request->file('transkrip');
                    $name = 'transkrip_' . $request->input('nik') . '_' . time();
                    $folder = '/cpjlp/' . $request->input('nik') . '/';
                    $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
                    $this->uploadOne($image, $folder, 'public', $name);
                    $candidate->transkrip = $filePath;
                }
                if ($request->has('sertifikat')) {
                    $image = $request->file('sertifikat');
                    $name = 'sertifikat_' . $request->input('nik') . '_' . time();
                    $folder = '/cpjlp/' . $request->input('nik') . '/';
                    $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
                    $this->uploadOne($image, $folder, 'public', $name);
                    $candidate->sertifikat = $filePath;
                }
                if ($request->has('foto')) {
                    $image = $request->file('foto');
                    $name = 'foto_' . $request->input('nik') . '_' . time();
                    $folder = '/cpjlp/' . $request->input('nik') . '/';
                    $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
                    $this->uploadOne($image, $folder, 'public', $name);
                    $candidate->foto = $filePath;
                }
                if ($request->has('surat_penawaran')) {
                    $image = $request->file('surat_penawaran');
                    $name = 'suratpenawaran_' . $request->input('nik') . '_' . time();
                    $folder = '/cpjlp/' . $request->input('nik') . '/';
                    $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
                    $this->uploadOne($image, $folder, 'public', $name);
                    $candidate->surat_penawaran = $filePath;
                }
                if ($request->has('pakta_integritas')) {
                    $image = $request->file('pakta_integritas');
                    $name = 'pakta_' . $request->input('nik') . '_' . time();
                    $folder = '/cpjlp/' . $request->input('nik') . '/';
                    $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
                    $this->uploadOne($image, $folder, 'public', $name);
                    $candidate->pakta_integritas = $filePath;
                }
                if ($request->has('formulir_kualifikasi')) {
                    $image = $request->file('formulir_kualifikasi');
                    $name = 'kualifikasi_' . $request->input('nik') . '_' . time();
                    $folder = '/cpjlp/' . $request->input('nik') . '/';
                    $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
                    $this->uploadOne($image, $folder, 'public', $name);
                    $candidate->formulir_kualifikasi = $filePath;
                }
                $candidate->status_id = 1;
                $candidate->save();

                return redirect()->route('front.lowongan.registered');
            } else {
                // $candidate = Candidate::findOrFail($kandidat->id);
                // $candidate->nama = $request->input('nama');
                // $candidate->nik = $request->input('nik');
                // $candidate->email = $request->input('email');
                // $candidate->notel = $request->input('notel');
                // if ($request->has('ktp')) {
                //     $image = $request->file('ktp');
                //     $name = 'ktp_' . $request->input('nik') . '_' . time();
                //     $folder = '/cpjlp/' . $request->input('nik') . '/';
                //     $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
                //     $this->uploadOne($image, $folder, 'public', $name);
                //     $candidate->ktp = $filePath;
                // }
                // if ($request->has('ijazah')) {
                //     $image = $request->file('ijazah');
                //     $name = 'ijazah_' . $request->input('nik') . '_' . time();
                //     $folder = '/cpjlp/' . $request->input('nik') . '/';
                //     $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
                //     $this->uploadOne($image, $folder, 'public', $name);
                //     $candidate->ijazah = $filePath;
                // }
                // if ($request->has('transkrip')) {
                //     $image = $request->file('transkrip');
                //     $name = 'transkrip_' . $request->input('nik') . '_' . time();
                //     $folder = '/cpjlp/' . $request->input('nik') . '/';
                //     $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
                //     $this->uploadOne($image, $folder, 'public', $name);
                //     $candidate->transkrip = $filePath;
                // }
                // if ($request->has('sertifikat')) {
                //     $image = $request->file('sertifikat');
                //     $name = 'sertifikat_' . $request->input('nik') . '_' . time();
                //     $folder = '/cpjlp/' . $request->input('nik') . '/';
                //     $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
                //     $this->uploadOne($image, $folder, 'public', $name);
                //     $candidate->sertifikat = $filePath;
                // }
                // if ($request->has('foto')) {
                //     $image = $request->file('foto');
                //     $name = 'foto_' . $request->input('nik') . '_' . time();
                //     $folder = '/cpjlp/' . $request->input('nik') . '/';
                //     $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
                //     $this->uploadOne($image, $folder, 'public', $name);
                //     $candidate->foto = $filePath;
                // }
                // if ($request->has('surat_penawaran')) {
                //     $image = $request->file('surat_penawaran');
                //     $name = 'suratpenawaran_' . $request->input('nik') . '_' . time();
                //     $folder = '/cpjlp/' . $request->input('nik') . '/';
                //     $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
                //     $this->uploadOne($image, $folder, 'public', $name);
                //     $candidate->surat_penawaran = $filePath;
                // }
                // if ($request->has('pakta_integritas')) {
                //     $image = $request->file('pakta_integritas');
                //     $name = 'pakta_' . $request->input('nik') . '_' . time();
                //     $folder = '/cpjlp/' . $request->input('nik') . '/';
                //     $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
                //     $this->uploadOne($image, $folder, 'public', $name);
                //     $candidate->pakta_integritas = $filePath;
                // }
                // if ($request->has('formulir_kualifikasi')) {
                //     $image = $request->file('formulir_kualifikasi');
                //     $name = 'kualifikasi_' . $request->input('nik') . '_' . time();
                //     $folder = '/cpjlp/' . $request->input('nik') . '/';
                //     $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
                //     $this->uploadOne($image, $folder, 'public', $name);
                //     $candidate->formulir_kualifikasi = $filePath;
                // }
                // $candidate->status_id = 1;
                // $candidate->save();
                var_dump('Sudah pernah mendaftar');
            }
        }
    }

    public function submitVacancyKhusus(Request $request)
    {
        $rules = [
            'vacancy_id' => 'required',
            'nik' => 'required|numeric|min:16',
            'nama' => 'required',
            'email' => 'required',
            'notel' => 'required',
            'ktp' => 'required|mimes:jpeg,png,pdf|max:1024',
            'ijazah' => 'required|mimes:jpeg,png,pdf|max:1024',
            'transkrip' => 'required|mimes:jpeg,png,pdf|max:1024',
            'sertifikat' => 'mimes:jpeg,png,pdf|max:3072',
            'foto' => 'required|mimes:jpeg,png|max:1024',
            'surat_penawaran' => 'required|mimes:pdf|max:1024',
            'pakta_integritas' => 'required|mimes:pdf|max:1024',
            'formulir_kualifikasi' => 'required|mimes:pdf|max:2042',
            'kontrak_spk' => 'required|mimes:jpeg,png,pdf|max:2042',
            'evaluasi_prestasi' => 'required|mimes:jpeg,png,pdf|max:2042',
        ];

        $messages = [
            'vacancy_id.required' => 'Posisi wajib diisi!',
            'nik.required' => 'NIK wajib diisi!',
            'nik.numeric' => 'NIK harus berupa angka!',
            'nik.min' => 'NIK minimal 16 karakter!',
            'nik.max' => 'NIK maksimal 16 karakter!',
            'nik.unique' => 'NIK sudah pernah terdaftar!',
            'nama.required' => 'Nama wajib diisi!',
            'email.required' => 'Email wajib diisi!',
            'notel.required' => 'No Telepon/Handphone wajib diisi!',
            'ktp.required' => 'KTP wajib diupload!',
            'ktp.mimes' => 'Hanya dapat mengupload file berformat JPG/PNG/PDF!',
            'ktp.max' => 'File maksimal 200KB!',
            'ijazah.required' => 'Ijazah wajib diupload!',
            'ijazah.mimes' => 'Hanya dapat mengupload file berformat JPG/PNG/PDF!',
            'ijazah.max' => 'File maksimal 500KB!',
            'transkrip.required' => 'Transkrip wajib diupload!',
            'transkrip.mimes' => 'Hanya dapat mengupload file berformat JPG/PNG/PDF!',
            'transkrip.max' => 'File maksimal 500KB!',
            'sertifikat.mimes' => 'Hanya dapat mengupload file berformat JPG/PNG/PDF!',
            'sertifikat.max' => 'File maksimal 1MB!',
            'foto.required' => 'Foto wajib diupload!',
            'foto.mimes' => 'Hanya dapat mengupload file berformat JPG/PNG!',
            'foto.max' => 'File maksimal 200KB!',
            'surat_penawaran.required' => 'Surat Penawaran wajib diupload!',
            'surat_penawaran.mimes' => 'Hanya dapat mengupload file berformat PDF!',
            'surat_penawaran.max' => 'File maksimal 200KB!',
            'pakta_integritas.required' => 'Pakta Integritas wajib diupload!',
            'pakta_integritas.mimes' => 'Hanya dapat mengupload file berformat PDF!',
            'pakta_integritas.max' => 'File maksimal 200KB!',
            'formulir_kualifikasi.required' => 'Formulir Kualifikasi wajib diupload!',
            'formulir_kualifikasi.mimes' => 'Hanya dapat mengupload file berformat PDF!',
            'formulir_kualifikasi.max' => 'File maksimal 200KB!',
            'kontrak_spk.required' => 'Formulir Kualifikasi wajib diupload!',
            'kontrak_spk.mimes' => 'Hanya dapat mengupload file berformat PDF!',
            'kontrak_spk.max' => 'File maksimal 200KB!',
            'evaluasi_prestasi.required' => 'Formulir Kualifikasi wajib diupload!',
            'evaluasi_prestasi.mimes' => 'Hanya dapat mengupload file berformat PDF!',
            'evaluasi_prestasi.max' => 'File maksimal 200KB!',
        ];

        $this->validate($request, $rules, $messages);

        $vacancy = Vacancy::where([
            ['id', '=', substr(Hashids::decode($request->input('vacancy_id'))[0], 0, -5)],
            ['status', '=', 1],
        ])->first();

        //dapatkan periode sekarang
        $currentPeriode = null;
        if ($vacancy) {
            $currentPeriode = $vacancy->period_id;
        } else {
            var_dump('Pendaftaran sudah ditutup');
        }

        if ($currentPeriode) {
            //periksa apakah kandidat sdah pernah mendaftar di periode sekarang
            $kandidat = CandidateKhusus::where([
                ['nik', '=', $request->input('nik')],
            ])->first();

            if (!$kandidat) {
                //jika tidak ada 
                $id = substr(Hashids::decode($request->input('vacancy_id'))[0], 0, -5);
                $candidate = new CandidateKhusus();
                $candidate->vacancy_id = $id;
                $candidate->period_id = $currentPeriode;
                $candidate->nama = $request->input('nama');
                $candidate->nik = $request->input('nik');
                $candidate->email = $request->input('email');
                $candidate->notel = $request->input('notel');
                if ($request->has('ktp')) {
                    $image = $request->file('ktp');
                    $name = 'ktp_' . $request->input('nik') . '_' . time();
                    $folder = '/cpjlp/' . $request->input('nik') . '/';
                    $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
                    $this->uploadOne($image, $folder, 'public', $name);
                    $candidate->ktp = $filePath;
                }
                if ($request->has('ijazah')) {
                    $image = $request->file('ijazah');
                    $name = 'ijazah_' . $request->input('nik') . '_' . time();
                    $folder = '/cpjlp/' . $request->input('nik') . '/';
                    $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
                    $this->uploadOne($image, $folder, 'public', $name);
                    $candidate->ijazah = $filePath;
                }
                if ($request->has('transkrip')) {
                    $image = $request->file('transkrip');
                    $name = 'transkrip_' . $request->input('nik') . '_' . time();
                    $folder = '/cpjlp/' . $request->input('nik') . '/';
                    $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
                    $this->uploadOne($image, $folder, 'public', $name);
                    $candidate->transkrip = $filePath;
                }
                if ($request->has('sertifikat')) {
                    $image = $request->file('sertifikat');
                    $name = 'sertifikat_' . $request->input('nik') . '_' . time();
                    $folder = '/cpjlp/' . $request->input('nik') . '/';
                    $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
                    $this->uploadOne($image, $folder, 'public', $name);
                    $candidate->sertifikat = $filePath;
                }
                if ($request->has('foto')) {
                    $image = $request->file('foto');
                    $name = 'foto_' . $request->input('nik') . '_' . time();
                    $folder = '/cpjlp/' . $request->input('nik') . '/';
                    $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
                    $this->uploadOne($image, $folder, 'public', $name);
                    $candidate->foto = $filePath;
                }
                if ($request->has('surat_penawaran')) {
                    $image = $request->file('surat_penawaran');
                    $name = 'suratpenawaran_' . $request->input('nik') . '_' . time();
                    $folder = '/cpjlp/' . $request->input('nik') . '/';
                    $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
                    $this->uploadOne($image, $folder, 'public', $name);
                    $candidate->surat_penawaran = $filePath;
                }
                if ($request->has('pakta_integritas')) {
                    $image = $request->file('pakta_integritas');
                    $name = 'pakta_' . $request->input('nik') . '_' . time();
                    $folder = '/cpjlp/' . $request->input('nik') . '/';
                    $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
                    $this->uploadOne($image, $folder, 'public', $name);
                    $candidate->pakta_integritas = $filePath;
                }
                if ($request->has('formulir_kualifikasi')) {
                    $image = $request->file('formulir_kualifikasi');
                    $name = 'kualifikasi_' . $request->input('nik') . '_' . time();
                    $folder = '/cpjlp/' . $request->input('nik') . '/';
                    $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
                    $this->uploadOne($image, $folder, 'public', $name);
                    $candidate->formulir_kualifikasi = $filePath;
                }
                if ($request->has('kontrak_spk')) {
                    $image = $request->file('kontrak_spk');
                    $name = 'kontrak_spk_' . $request->input('nik') . '_' . time();
                    $folder = '/cpjlp/' . $request->input('nik') . '/';
                    $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
                    $this->uploadOne($image, $folder, 'public', $name);
                    $candidate->kontrak_spk = $filePath;
                }
                if ($request->has('evaluasi_prestasi')) {
                    $image = $request->file('evaluasi_prestasi');
                    $name = 'evaluasi_prestasi_' . $request->input('nik') . '_' . time();
                    $folder = '/cpjlp/' . $request->input('nik') . '/';
                    $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
                    $this->uploadOne($image, $folder, 'public', $name);
                    $candidate->evaluasi_prestasi = $filePath;
                }

                $candidate->status_id = 1;
                $candidate->save();

                return redirect()->route('front.lowongan.registered');
            } else {

                //update data
                $id = substr(Hashids::decode($request->input('vacancy_id'))[0], 0, -5);
                $candidate = CandidateKhusus::findOrFail($kandidat->id);
                $candidate->vacancy_id = $id;
                $candidate->period_id = $currentPeriode;
                $candidate->nama = $request->input('nama');
                $candidate->nik = $request->input('nik');
                $candidate->email = $request->input('email');
                $candidate->notel = $request->input('notel');
                if ($request->has('ktp')) {
                    $file_path = public_path("/uploads" . $candidate->ktp);  // Value is not URL but directory file path
                    if (File::exists($file_path)) {
                        File::delete($file_path);
                    }
                    $image = $request->file('ktp');
                    $name = 'ktp_' . $request->input('nik') . '_' . time();
                    $folder = '/cpjlp/' . $request->input('nik') . '/';
                    $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
                    $this->uploadOne($image, $folder, 'public', $name);
                    $candidate->ktp = $filePath;
                }
                if ($request->has('ijazah')) {
                    $file_path = public_path("/uploads" . $candidate->ijazah);  // Value is not URL but directory file path
                    if (File::exists($file_path)) {
                        File::delete($file_path);
                    }
                    $image = $request->file('ijazah');
                    $name = 'ijazah_' . $request->input('nik') . '_' . time();
                    $folder = '/cpjlp/' . $request->input('nik') . '/';
                    $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
                    $this->uploadOne($image, $folder, 'public', $name);
                    $candidate->ijazah = $filePath;
                }
                if ($request->has('transkrip')) {
                    $file_path = public_path("/uploads" . $candidate->transkrip);  // Value is not URL but directory file path
                    if (File::exists($file_path)) {
                        File::delete($file_path);
                    }
                    $image = $request->file('transkrip');
                    $name = 'transkrip_' . $request->input('nik') . '_' . time();
                    $folder = '/cpjlp/' . $request->input('nik') . '/';
                    $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
                    $this->uploadOne($image, $folder, 'public', $name);
                    $candidate->transkrip = $filePath;
                }
                if ($request->has('sertifikat')) {
                    $file_path = public_path("/uploads" . $candidate->sertifikat);  // Value is not URL but directory file path
                    if (File::exists($file_path)) {
                        File::delete($file_path);
                    }
                    $image = $request->file('sertifikat');
                    $name = 'sertifikat_' . $request->input('nik') . '_' . time();
                    $folder = '/cpjlp/' . $request->input('nik') . '/';
                    $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
                    $this->uploadOne($image, $folder, 'public', $name);
                    $candidate->sertifikat = $filePath;
                }
                if ($request->has('foto')) {
                    $file_path = public_path("/uploads" . $candidate->foto);  // Value is not URL but directory file path
                    if (File::exists($file_path)) {
                        File::delete($file_path);
                    }
                    $image = $request->file('foto');
                    $name = 'foto_' . $request->input('nik') . '_' . time();
                    $folder = '/cpjlp/' . $request->input('nik') . '/';
                    $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
                    $this->uploadOne($image, $folder, 'public', $name);
                    $candidate->foto = $filePath;
                }
                if ($request->has('surat_penawaran')) {
                    $file_path = public_path("/uploads" . $candidate->surat_penawaran);  // Value is not URL but directory file path
                    if (File::exists($file_path)) {
                        File::delete($file_path);
                    }
                    $image = $request->file('surat_penawaran');
                    $name = 'suratpenawaran_' . $request->input('nik') . '_' . time();
                    $folder = '/cpjlp/' . $request->input('nik') . '/';
                    $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
                    $this->uploadOne($image, $folder, 'public', $name);
                    $candidate->surat_penawaran = $filePath;
                }
                if ($request->has('pakta_integritas')) {
                    $file_path = public_path("/uploads" . $candidate->pakta_integritas);  // Value is not URL but directory file path
                    if (File::exists($file_path)) {
                        File::delete($file_path);
                    }
                    $image = $request->file('pakta_integritas');
                    $name = 'pakta_' . $request->input('nik') . '_' . time();
                    $folder = '/cpjlp/' . $request->input('nik') . '/';
                    $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
                    $this->uploadOne($image, $folder, 'public', $name);
                    $candidate->pakta_integritas = $filePath;
                }
                if ($request->has('formulir_kualifikasi')) {
                    $file_path = public_path("/uploads" . $candidate->formulir_kualifikasi);  // Value is not URL but directory file path
                    if (File::exists($file_path)) {
                        File::delete($file_path);
                    }
                    $image = $request->file('formulir_kualifikasi');
                    $name = 'kualifikasi_' . $request->input('nik') . '_' . time();
                    $folder = '/cpjlp/' . $request->input('nik') . '/';
                    $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
                    $this->uploadOne($image, $folder, 'public', $name);
                    $candidate->formulir_kualifikasi = $filePath;
                }
                if ($request->has('kontrak_spk')) {
                    $file_path = public_path("/uploads" . $candidate->kontrak_spk);  // Value is not URL but directory file path
                    if (File::exists($file_path)) {
                        File::delete($file_path);
                    }
                    $image = $request->file('kontrak_spk');
                    $name = 'kontrak_spk_' . $request->input('nik') . '_' . time();
                    $folder = '/cpjlp/' . $request->input('nik') . '/';
                    $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
                    $this->uploadOne($image, $folder, 'public', $name);
                    $candidate->kontrak_spk = $filePath;
                }
                if ($request->has('evaluasi_prestasi')) {
                    $file_path = public_path("/uploads" . $candidate->evaluasi_prestasi);  // Value is not URL but directory file path
                    if (File::exists($file_path)) {
                        File::delete($file_path);
                    }
                    $image = $request->file('evaluasi_prestasi');
                    $name = 'evaluasi_prestasi_' . $request->input('nik') . '_' . time();
                    $folder = '/cpjlp/' . $request->input('nik') . '/';
                    $filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
                    $this->uploadOne($image, $folder, 'public', $name);
                    $candidate->evaluasi_prestasi = $filePath;
                }

                $candidate->status_id = 1;
                $candidate->save();
                return redirect()->route('front.lowongan.registered');
            }
        }
    }

    public function registered()
    {
        return view('front.registered');
    }

    public function getFormation()
    {
        $khususes = Vacancy::select('vacancies.id', 'opds.deskripsi', 'vacancies.title', 'vacancies.number_of_employee')
            ->join('opds', 'opds.id', '=', 'vacancies.opd_id')
            ->where('status', 1)
            ->where('type_id', 1)
            ->get();

        $umums = Vacancy::select('vacancies.id', 'opds.deskripsi', 'vacancies.title', 'vacancies.number_of_employee')
            ->join('opds', 'opds.id', '=', 'vacancies.opd_id')
            ->where('status', 1)
            ->where('type_id', '=', 2)
            ->get();

        return view('front.allcandidates', compact('umums', 'khususes'));
    }

    public function getUmum()
    {
        $opds = Opd::all();
        $vacarrays = array();
        foreach ($opds as $opd) {
            $vacancies = Vacancy::select('vacancies.*', 'opds.opd', 'opds.deskripsi', 'occupations.occupation')
                ->join('opds', 'opds.id', '=', 'vacancies.opd_id')
                ->join('occupations', 'occupations.id', '=', 'vacancies.occupation_id')
                ->where('status', 1)
                ->where('opd_id', '=', $opd->id)
                ->where('type_id', '=', 2)
                ->get();

            if (!$vacancies->isEmpty()) {
                $vacarrays[] = array('OPD' => $opd->deskripsi, 'vacancies' => $vacancies);
            }
        }

        $vaccols = collect($vacarrays);

        return view('front.umum', compact('vaccols'));
    }

    public function getKhusus()
    {
        $opds = Opd::all();
        $vacarrays = array();
        foreach ($opds as $opd) {
            $vacancies = Vacancy::select('vacancies.*', 'opds.opd', 'opds.deskripsi', 'occupations.occupation')
                ->join('opds', 'opds.id', '=', 'vacancies.opd_id')
                ->join('occupations', 'occupations.id', '=', 'vacancies.occupation_id')
                ->where('status', 1)
                ->where('opd_id', '=', $opd->id)
                ->where('type_id', '=', 1)
                ->get();

            if (!$vacancies->isEmpty()) {
                $vacarrays[] = array('OPD' => $opd->deskripsi, 'vacancies' => $vacancies);
            }
        }

        $vaccols = collect($vacarrays);

        return view('front.khusus', compact('vaccols'));
    }

    public function pageStatus()
    {
        return view('front.pagestatus');
    }

    public function checkStatus(Request $request)
    {
        $rules = [
            'nik' => 'required|numeric|min:16',
        ];

        $messages = [
            'nik.required' => 'NIK wajib diisi!',
            'nik.numeric' => 'NIK harus berupa angka!',
            'nik.min' => 'NIK minimal 16 karakter!',
        ];

        $this->validate($request, $rules, $messages);

        if ($request->has('nik')) {
            $candidate = Candidate::select('candidates.*', 'candidatestatuses.candidate_status', 'candidatestatuses.color', 'candidatestatuses.id AS statusid')
                ->where('nik', '=', $request->input('nik'))
                ->join('candidatestatuses', 'candidatestatuses.id', '=', 'candidates.status_id')
                ->orderBy('candidates.created_at', 'DESC')
                ->first();

            if ($candidate == null) {
                $candidate = CandidateKhusus::select('candidate_khususes.*', 'candidatestatuses.candidate_status', 'candidatestatuses.color', 'candidatestatuses.id AS statusid')
                    ->where('nik', '=', $request->input('nik'))
                    ->join('candidatestatuses', 'candidatestatuses.id', '=', 'candidate_khususes.status_id')
                    ->first();
            }

            if ($candidate != null) {
                return view('front.candidate-status', compact('candidate'));
            } else {
                return view('front.pagestatus')
                    ->withInput('nik')
                    ->withErrors(array('nik' => 'Data tidak ditemukan'));
            }
        } else {
            return view('front.pagestatus');
        }

        return view('front.pagestatus');
    }

    public function printCard(Request $request)
    {
        if ($request->has('nik')) {
            $candidate = Candidate::select('candidates.*', 'candidatestatuses.candidate_status', 'candidatestatuses.color', 'vacancies.title')
                ->join('candidatestatuses', 'candidatestatuses.id', '=', 'candidates.status_id')
                ->join('vacancies', 'vacancies.id', '=', 'candidates.vacancy_id')
                ->where('nik', '=', $request->input('nik'))
                ->orderBy('candidates.created_at', 'DESC')
                ->first();

            if ($candidate != null) {
                return view('front.candidate-print', compact('candidate'));
            } else {
                return view('front.pagestatus')
                    ->withInput('nik')
                    ->withErrors(array('nik' => 'Data tidak ditemukan'));
            }
        } else {
            return view('front.pagestatus');
        }

        return view('front.pagestatus');
    }
}
