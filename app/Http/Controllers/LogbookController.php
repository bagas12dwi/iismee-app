<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Logbook;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LogbookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mhs = Student::with('internship.lecturer')->where('email', '=', auth()->user()->email)->firstOrFail();
        $sptjm = Document::where('student_id', '=', $mhs->id)->where('type', '=', 'Surat Persetujuan Magang')->first();

        return view('mahasiswa.logbook', [
            'title' => 'Logbook',
            'data' => Student::with('internship.lecturer')->where('email', '=', auth()->user()->email)->firstOrFail(),
            'logbook' => Logbook::where('student_id', '=', $mhs->id)->get(),
            'suratMagang' => $sptjm
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswa.add-logbook', [
            'title' => 'Logbook'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $mhs = Student::where('email', '=', auth()->user()->email)->firstOrFail();

        $validatedData = $request->validate([
            'activity_name' => 'required',
            'activity_date' => 'required',
            'img' => 'required|image',
            'description' => 'required'
        ]);

        $validatedData['student_id'] = $mhs->id;
        $validatedData['img'] = $request->file('img')->store('logbook');

        Logbook::create($validatedData);
        return redirect()->intended('/logbook')->with('success', 'Data Berhasil Ditambahkan !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Logbook $logbook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Logbook $logbook)
    {
        return view('mahasiswa.edit-logbook', [
            'title' => 'Logbook',
            'logbook' => $logbook
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Logbook $logbook)
    {
        $mhs = Student::where('email', '=', auth()->user()->email)->firstOrFail();

        $validatedData = $request->validate([
            'activity_name' => 'required',
            'activity_date' => 'required',
            'img' => 'image',
            'description' => 'required'
        ]);

        $validatedData['student_id'] = $mhs->id;
        if ($request->file('img')) {
            if ($request->oldimg) {
                Storage::delete($request->oldimg);
            }
            $validatedData['img'] = $request->file('img')->store('logbook');
        }

        Logbook::where('id', $logbook->id)->update($validatedData);
        return redirect()->intended('/logbook')->with('success', 'Data Berhasil Diubah !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Logbook $logbook)
    {
        if ($logbook->img) {
            Storage::delete($logbook->img);
        }
        Logbook::destroy($logbook->id);
        return redirect()->intended('/logbook')->with('success', 'Data Berhasil Dihapus !');
    }
}
