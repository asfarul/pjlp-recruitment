<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Menus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if (isset($user)) {
            \Menu::make('Menu', function ($menu) {
                $user = Auth::user();
                /*
                * ############################### Dashboard
                */
                $menu->add('Dashboard', ['route' => 'dashboard'])
                    ->prepend('<i class="gi gi-pie_chart sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">')
                    ->append('</span>');

                /*
                * ############################### Manajemen User
                */
                if ($user->hasPermission('read-users') || $user->hasPermission('read-roles') || $user->hasPermission('read-permissions')) {
                    $menu->add('Manajemen User')
                        ->prepend('<i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i>
                               <i class="gi gi-group sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">')
                        ->append('</span>')
                        ->link->attr(['class' => 'sidebar-nav-menu'])
                        ->href('#');
                    if ($user->hasPermission('read-users')) {
                        $menu->manajemenUser->add('Data User', ['route' => 'users.index']);
                    }
                    if ($user->hasPermission('read-roles')) {
                        $menu->manajemenUser->add('Data Role', ['route' => 'roles.index']);
                    }
                    if ($user->hasPermission('read-permissions')) {
                        $menu->manajemenUser->add('Data Permission', ['route' => 'permission.index']);
                    }
                }

                /*
                * ############################### Artikel
                */
                if ($user->hasPermission('read-articles')) {
                    $menu->add('Artikel')
                        ->prepend('<i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i>
                               <i class="gi gi-book sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">')
                        ->append('</span>')
                        ->link->attr(['class' => 'sidebar-nav-menu'])
                        ->href('#');
                    if ($user->hasPermission('read-articles')) {
                        $menu->artikel->add('Artikel', ['route' => 'artikel.index']);
                        $menu->artikel->add('Kategori', ['route' => 'kategori.index']);
                    }
                }

                /*
               * ############################### Lowongan Pekerjaan
               */
                if ($user->hasPermission('read-vacancies') || $user->hasPermission('read-vacancydocs')) {
                    $menu->add('Lowongan Pekerjaan')
                        ->prepend('<i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i>
                                <i class="gi gi-sort sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">')
                        ->append('</span>')
                        ->link->attr(['class' => 'sidebar-nav-menu'])
                        ->href('#');
                    if ($user->hasPermission('read-vacancies')) {
                        $menu->lowonganPekerjaan->add('Data Lowongan Pekerjaan', ['route' => 'lowongan.index']);
                    }
                    if ($user->hasPermission('read-vacancydocs')) {
                        $menu->lowonganPekerjaan->add('Data Dokumen', ['route' => 'dokumen.index']);
                    }
                }

                /*
                * ############################### Pelamar
                */
                $menu->add('Pelamar')
                    ->prepend('<i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i>
                                <i class="gi gi-user sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">')
                    ->append('</span>')
                    ->link->attr(['class' => 'sidebar-nav-menu'])
                    ->href('#');
                    $menu->pelamar->add('UMUM', ['route' => 'pelamar.index']);
                    $menu->pelamar->add('KHUSUS', ['route' => 'khusus.index']);

                /*
                * ############################### Data Master
                */
                if ($user->hasPermission('read-opds') || $user->hasPermission('read-periods')) {
                    $menu->add('Data Master')
                        ->prepend('<i class="fa fa-angle-left sidebar-nav-indicator sidebar-nav-mini-hide"></i>
                               <i class="gi gi-folder_flag sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide">')
                        ->append('</span>')
                        ->link->attr(['class' => 'sidebar-nav-menu'])
                        ->href('#');
                    if ($user->hasPermission('read-opds')) {
                        $menu->dataMaster->add('Data OPD', ['route' => 'opd.index']);
                    }
                    if ($user->hasPermission('read-periods')) {
                        $menu->dataMaster->add('Data Periode', ['route' => 'periods.index']);
                    }
                }
            });
        }
        return $next($request);
    }
}
