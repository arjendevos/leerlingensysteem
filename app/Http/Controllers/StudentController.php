<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use App\Models\Education;
use App\Models\Classes;
use App\Models\Subject;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class StudentController extends Controller
{
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
        return view('students.index', []);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $class_id = $request->query('class_id');

        if ($class_id !== null) {
            $classes = Classes::where('id', $class_id)->get();
        } else {
            $classes = Classes::all();
        }

        $educations = Education::all();
        return view('students.create', ['educations' => $educations, 'classes' => $classes, 'classId' => $class_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'street' => 'required',
            'postcode' => 'required',
            'city' => 'required',
            'country' => 'required',
            'education_id' => 'required',
            'class_id' => 'required',
            'password' => ['required', 'string', 'min:8'],
        ]);


        $student = Student::create($request->except(['_token', '_method']));

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'student_id' => $student->id
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student,  $id= null)
    {
        $student = Student::with('results')->with('user')->where('id', '=', $id)->get();
        $educations = Education::all();
        $classes = Classes::all();
        $subjects = Subject::all();
        return view('students.show', ['student' => $student[0], 'educations' => $educations, 'classes' => $classes, 'subjects' => $subjects]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student, $id = null)
    {
        $request->validate([
            'name' => 'required',
            'street' => 'required',
            'postcode' => 'required',
            'city' => 'required',
            'country' => 'required',
            'education_id' => 'required',
            'class_id' => 'required',
        ]);

        Student::where('id', $id)->update($request->except(['_token', '_method']));

        return redirect()->route('students.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student, $id = null)
    {
        $class_id = Student::where('id', $id)->get()[0]->class_id;
        Student::destroy($id);
        return redirect()->route('classes.show', $class_id);
    }
}
