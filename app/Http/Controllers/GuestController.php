<?php

namespace App\Http\Controllers;

use App\Models\Beasiswa;
use App\Models\Loker;
use App\Models\Lomba;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function indexwelcome(Request $request)
    {
        $pageTitle = 'Terbaru';
        $search = $request->input('search');

        // Filter results based on the search query
        $beasiswas = Beasiswa::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        })->orderBy('created_at', 'desc')->take(2)->get();

        $lombas = Lomba::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        })->orderBy('created_at', 'desc')->take(2)->get();

        $lokers = Loker::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        })->orderBy('created_at', 'desc')->take(2)->get();

        return view('welcome', compact('pageTitle', 'beasiswas', 'lombas', 'lokers'));
    }




    public function indexbeasiswa()
    {
        $pageTitle = 'Beasiswa List';

        $beasiswas = Beasiswa::all();

        return view('guest.beasiswa', compact('pageTitle', 'beasiswas'));
    }

    public function indexlomba()
    {
        $pageTitle = 'Lomba List';

        $lombas = Lomba::all();

        return view('guest.lomba', compact('pageTitle', 'lombas'));
    }

    public function indexloker()
    {
        $pageTitle = 'Loker List';

        $lokers = Loker::all();

        return view('guest.loker', compact('pageTitle', 'lokers'));
    }

    public function infobeasiswa(string $id)
    {
        $pageTitle = 'List Beasiswa';

        $beasiswa = Beasiswa::find($id);

        return view('guest.detail_beasiswa', compact('pageTitle', 'beasiswa'));
    }

    public function infoLomba(string $id)
    {
        $pageTitle = 'List Lowonga Kerja';

        $lomba = Lomba::find($id);

        return view('guest.detail_lomba', compact('pageTitle', 'lomba'));
    }

    public function infoloker(string $id)
    {
        $pageTitle = 'List Lowonga Kerja';

        $loker = Loker::find($id);

        return view('guest.detail_loker', compact('pageTitle', 'loker'));
    }
}
