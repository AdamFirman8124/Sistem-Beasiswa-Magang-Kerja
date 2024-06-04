<?php

namespace App\Http\Controllers;

use App\Models\Beasiswa;
use App\Models\BeasiswaUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

class BeasiswaAdminController extends Controller
{
    public function index()
    {
        $pageTitle = 'List Beasiswa';
        $beasiswas = Beasiswa::orderBy('created_at', 'desc')->get();
        return view('admin.beasiswa.index', compact('pageTitle', 'beasiswas'));
    }

    public function create()
    {
        $pageTitle = 'Create Beasiswa';
        return view('admin.beasiswa.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => ':Attribute harus diisi.'
        ];
    
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'persyaratan' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], $messages);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $beasiswa = new Beasiswa();
        $beasiswa->name = $request->nama;
        $beasiswa->requirement = $request->persyaratan;
        $beasiswa->description = $request->deskripsi;
    
        if ($request->hasFile('foto')) {
            $imageName = time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('poster_beasiswa'), $imageName);
            $beasiswa->image = 'poster_beasiswa/' . $imageName;
        }
        
        $beasiswa->save();
    
        Alert::success('Added Successfully', 'Beasiswa Data Added Successfully.');
        return redirect()->route('admin.beasiswa');
    }
    
    public function show(string $id)
    {

        $pageTitle = 'Beasiswa Detail';


        $beasiswa = Beasiswa::find($id);


        $beasiswaUsers = BeasiswaUser::where('beasiswa_id', $id)
                                     ->select('nama','serial','bukti')
                                     ->get();

        return view('admin.beasiswa.show', compact('pageTitle', 'beasiswa', 'beasiswaUsers'));
    }

    public function edit(string $id)
    {
        $pageTitle = 'Beasiswa Edit';
        $beasiswa = Beasiswa::find($id);
        return view('admin.beasiswa.edit', compact('pageTitle', 'beasiswa'));
    }

    public function update(Request $request, string $id)
    {
        $messages = [
            'required' => ':Attribute harus diisi.'
        ];
    
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'persyaratan' => 'required',
            'deskripsi' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], $messages);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $beasiswa = Beasiswa::find($id);
        $beasiswa->name = $request->nama;
        $beasiswa->requirement = $request->persyaratan;
        $beasiswa->description = $request->deskripsi;
    
        $file = $request->file('foto');
        if ($file != null) {
            $imageName = time() . '.' . $file->extension();
            $file->move(public_path('poster_beasiswa'), $imageName);
            $beasiswa->image = 'poster_beasiswa/' . $imageName;
        }
    
        $beasiswa->save();
    
        Alert::success('Changed Successfully', 'Beasiswa Data Changed Successfully.');
        return redirect()->route('admin.beasiswa');
    }
    

    public function destroy(string $id)
    {
        $beasiswa = Beasiswa::find($id);
        if ($beasiswa->image) {
            Storage::delete('public/files/' . $beasiswa->image);
        }
        $beasiswa->delete();
        Alert::success('Deleted Successfully', 'Beasiswa Data Deleted Successfully.');
        return redirect()->route('admin.beasiswa');
    }
}
