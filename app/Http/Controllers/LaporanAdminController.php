<?php

namespace App\Http\Controllers;

use App\Models\Loker;
use App\Models\MagangUser;
use App\Models\Beasiswa;
use App\Models\BeasiswaUser;
use App\Models\Lomba;
use App\Models\LombaUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

class LaporanAdminController extends Controller
{

    public function index()
    {
        $pageTitle = 'Data Beasiswa';
        $beasiswas = Beasiswa::all();
        $beasiswaUsers = BeasiswaUser::with(['beasiswa' => function ($query) {
        $query->withTrashed();
        }])->get();
        $lombas = Lomba::all();
        $lombaUsers = LombaUser::with(['lomba' => function ($query) {
            $query->withTrashed();
        }])->get();
        $lokers = Loker::all();
        $magangUsers = MagangUser::with(['loker' => function ($query) {
            $query->withTrashed();
        }])->get();

        // Persiapkan data untuk histogram
        $beasiswaCount = $beasiswaUsers->countBy('beasiswa.name')->toArray();
        $lombaCount = $lombaUsers->countBy('lomba.name')->toArray();
        $magangCount = $magangUsers->countBy('loker.name')->toArray();

        return view('admin.laporan.index', compact(
            'pageTitle', 
            'beasiswas', 
            'beasiswaUsers', 
            'lombas', 
            'lombaUsers', 
            'lokers', 
            'magangUsers', 
            'beasiswaCount', 
            'lombaCount', 
            'magangCount'
        ));
    }
    public function datalomba()
    {
        $pageTitle = 'Data Lomba';

        // Mengambil data beasiswa, lomba, loker/magang
        $beasiswas = Beasiswa::all();
        $beasiswaUsers = BeasiswaUser::with(['beasiswa' => function ($query) {
        $query->withTrashed();
        }])->get();
        $lombas = Lomba::all();
        $lombaUsers = LombaUser::with(['lomba' => function ($query) {
            $query->withTrashed();
        }])->get();
        $lokers = Loker::all();
        $magangUsers = MagangUser::with(['loker' => function ($query) {
            $query->withTrashed();
        }])->get();

        // Persiapkan data untuk histogram
        $beasiswaCount = $beasiswaUsers->countBy('beasiswa.name')->toArray();
        $lombaCount = $lombaUsers->countBy('lomba.name')->toArray();
        $magangCount = $magangUsers->countBy('loker.name')->toArray();

        return view('admin.laporan.datalomba', compact(
            'pageTitle', 
            'beasiswas', 
            'beasiswaUsers', 
            'lombas', 
            'lombaUsers', 
            'lokers', 
            'magangUsers', 
            'beasiswaCount', 
            'lombaCount', 
            'magangCount'
        ));
    }
    public function dataloker()
    {
        $pageTitle = 'Data Magang';

        // Mengambil data beasiswa, lomba, loker/magang
        $beasiswas = Beasiswa::all();
        $beasiswaUsers = BeasiswaUser::with(['beasiswa' => function ($query) {
        $query->withTrashed();
        }])->get();
        $lombas = Lomba::all();
        $lombaUsers = LombaUser::with(['lomba' => function ($query) {
            $query->withTrashed();
        }])->get();
        $lokers = Loker::all();
        $magangUsers = MagangUser::with(['loker' => function ($query) {
            $query->withTrashed();
        }])->get();

        // Persiapkan data untuk histogram
        $beasiswaCount = $beasiswaUsers->countBy('beasiswa.name')->toArray();
        $lombaCount = $lombaUsers->countBy('lomba.name')->toArray();
        $magangCount = $magangUsers->countBy('loker.name')->toArray();

        return view('admin.laporan.dataloker', compact(
            'pageTitle', 
            'beasiswas', 
            'beasiswaUsers', 
            'lombas', 
            'lombaUsers', 
            'lokers', 
            'magangUsers', 
            'beasiswaCount', 
            'lombaCount', 
            'magangCount'
        ));
    }
}
