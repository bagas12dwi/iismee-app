<?php

namespace App\Http\Controllers;

use App\Models\AssesmentAspect;
use App\Models\Assessment;
use App\Models\Document;
use App\Models\Internship;
use App\Models\Lecturer;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupervisorAssessmentController extends Controller
{
    public function index()
    {
        $email = auth()->user()->email;
        $dosen = Lecturer::where('email', '=', $email)->firstOrFail();

        // $is_assessment = Internship::selectRaw('IF(internships.student_id IN (SELECT assessments.student_id FROM assessments), true, false) AS is_assessment, internships.*, documents.document_path')
        //     ->leftJoin('students', 'internships.student_id', '=', 'students.id')
        //     ->leftJoin('documents', 'students.id', '=', 'documents.student_id')
        //     ->where('lecturer_id', $dosen->id)
        //     ->where('documents.type', '=', 'Surat Persetujuan Magang')
        //     ->get();

        $is_assessment = Internship::selectRaw('IF(internships.student_id IN (SELECT assessments.student_id FROM assessments), true, false) AS is_assessment, internships.*, documents.document_path')
            ->leftJoin('students', 'internships.student_id', '=', 'students.id')
            ->leftJoin('documents', function ($join) {
                $join->on('students.id', '=', 'documents.student_id')
                    ->where('documents.type', '=', 'Surat Persetujuan Magang');
            })
            ->where('lecturer_id', $dosen->id)
            ->get();


        return view('pembimbing.penilaian', [
            'title' => 'Penilaian',
            'mahasiswa' => $is_assessment
        ]);
    }

    public function show(Request $request, $registration_number)
    {
        return view('pembimbing.penilaian-details', [
            'title' => 'Penilaian',
            'data' => Student::where('registration_number', '=', $registration_number)->firstOrFail(),
            'mpk' => Subject::whereIn('id', function ($query) {
                $query->select('subject_id')->from('assesment_aspects');
            })->get()
        ]);
    }

    public function edit($registration_number)
    {

        $mhs = Student::where('registration_number', '=', $registration_number)->firstOrFail();
        // $subjects = Subject::with(['assessment' => function ($query) use ($mhs) {
        //     $query->where('student_id', '=', 1);
        // }, 'assessment.assesmentAspect'])->whereIn('id', function ($query) {
        //     $query->select('subject_id')->from('assesment_aspects');
        // })->get();

        $subjects = Subject::with(['assessment' => function ($query) use ($mhs) {
            $query->where('student_id', $mhs->id);
        }, 'assesmentAspect'])->whereIn('id', function ($query) {
            $query->select('subject_id')->from('assessments');
        })->get();


        $assesment = Assessment::with(['assesmentAspect', 'student', 'lecturer', 'subject'])
            ->where('student_id', '=', $mhs->id)->get();


        return view('pembimbing.penilaian-edit', [
            'title' => 'Penilaian',
            'data' => Student::where('registration_number', '=', $registration_number)->firstOrFail(),
            'assessment' => $assesment,
            'mpks' => $subjects
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'lecturer_id' => 'required',
            'student_id' => 'required',
            'subject_id' => 'required',
            'assesment_aspect_id' => 'required',
            'score' => 'required'
        ]);

        // dd($validatedData['subject_id']);

        foreach ($validatedData['score'] as $score => $value) {
            $item = new Assessment();
            $item->lecturer_id = $validatedData['lecturer_id'];
            $item->student_id = $validatedData['student_id'];
            $item->subject_id = $validatedData['subject_id'][$score];
            $item->assesment_aspect_id = $validatedData['assesment_aspect_id'][$score];
            $item->score = $validatedData['score'][$score];
            $item->save();
        }

        return redirect()->intended('/penilaian');
    }

    public function update(Request $request)
    {
        $data = $request->all();
        foreach ($data['score'] as $key => $score) {
            $assessment = Assessment::find($data['assessment_id'][$key]);
            if ($assessment->student_id == $data['student_id'] && $assessment->subject_id == $data['subject_id'][$key] && $assessment->assesment_aspect_id == $data['assesment_aspect_id'][$key]) {
                $assessment->update(['score' => $score]);
            }
        }
        return redirect('/penilaian');
    }
}
