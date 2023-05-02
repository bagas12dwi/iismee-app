<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIndustrialAssessmentRequest;
use App\Http\Requests\UpdateIndustrialAssessmentRequest;
use App\Models\IndustrialAdviser;
use App\Models\IndustrialAssessment;
use App\Models\Internship;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class IndustrialAssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $email = auth()->user()->email;
        $pembimbing = IndustrialAdviser::where('email', '=', $email)->firstOrFail();

        $is_assessment = Student::selectRaw('IF(students.id IN (SELECT industrial_assessments.student_id FROM industrial_assessments), true, false) AS is_assessment, students.*, documents.document_path')
            ->leftJoin('industrial_assessments', 'students.id', '=', 'industrial_assessments.student_id')
            ->leftJoin('documents', function ($join) {
                $join->on('students.id', '=', 'documents.student_id')
                    ->where('documents.type', '=', 'Surat Persetujuan Magang');
            })
            ->where('company_id', $pembimbing->company_id)
            ->get();

        return view('pembimbing-industri.penilaian', [
            'title' => 'Penilaian',
            'mahasiswa' => $is_assessment
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'industrial_adviser_id' => 'required',
            'student_id' => 'required',
            'subject_id' => 'required',
            'assesment_aspect_id' => 'required',
            'score' => 'required'
        ]);

        // dd($validatedData['subject_id']);

        foreach ($validatedData['score'] as $score => $value) {
            $item = new IndustrialAssessment();
            $item->industrial_adviser_id = $validatedData['industrial_adviser_id'];
            $item->student_id = $validatedData['student_id'];
            $item->subject_id = $validatedData['subject_id'][$score];
            $item->assesment_aspect_id = $validatedData['assesment_aspect_id'][$score];
            $item->score = $validatedData['score'][$score];
            $item->save();
        }

        return redirect()->intended('/penilaian-industri');
    }

    /**
     * Display the specified resource.
     */
    public function show($registration_number)
    {
        $email = auth()->user()->email;
        $pembimbing = IndustrialAdviser::where('email', '=', $email)->firstOrFail();

        return view('pembimbing-industri.penilaian-details', [
            'title' => 'Penilaian',
            'pembimbing' => $pembimbing,
            'data' => Student::where('registration_number', '=', $registration_number)->firstOrFail(),
            'mpk' => Subject::whereIn('id', function ($query) {
                $query->select('subject_id')->from('assesment_aspects');
            })->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($registration_number)
    {
        $mhs = Student::where('registration_number', '=', $registration_number)->firstOrFail();

        $subjects = Subject::with(['industrialAssessment' => function ($query) use ($mhs) {
            $query->where('student_id', $mhs->id);
        }, 'assesmentAspect'])->whereIn('id', function ($query) {
            $query->select('subject_id')->from('industrial_assessments');
        })->get();


        $assesment = IndustrialAssessment::with(['assesmentAspect', 'student', 'industrialAdviser', 'subject'])
            ->where('student_id', '=', $mhs->id)->get();


        return view('pembimbing-industri.penilaian-edit', [
            'title' => 'Penilaian',
            'data' => Student::where('registration_number', '=', $registration_number)->firstOrFail(),
            'assessment' => $assesment,
            'mpks' => $subjects
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->all();
        foreach ($data['score'] as $key => $score) {
            $assessment = IndustrialAssessment::find($data['assessment_id'][$key]);
            if ($assessment->student_id == $data['student_id'] && $assessment->subject_id == $data['subject_id'][$key] && $assessment->assesment_aspect_id == $data['assesment_aspect_id'][$key]) {
                $assessment->update(['score' => $score]);
            }
        }
        return redirect('/penilaian-industri');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IndustrialAssessment $industrialAssessment)
    {
        //
    }
}
