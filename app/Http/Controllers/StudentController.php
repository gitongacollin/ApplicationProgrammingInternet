<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Program;
use App\Academic;
use App\Level;
use App\Shift;
use App\Time;
use App\Batch;
use App\Group;
use App\MyClass;
use App\Student;
use App\Status;
use App\FileUpload;
use DB;
use File;
use Storage;

class StudentController extends Controller
{
    public function getStudentRegister()
    {
    	$academics  = Academic::orderBy('academic')->get();
		$programs   = Program::orderBy('program')->get();
		$levels     = Level::orderBy('level')->get();
		$shifts     = Shift::orderBy('shift')->get();
		$times      = Time::orderBy('time')->get();
		$batches    = Batch::orderBy('batch')->get();
		$groups     = Group::orderBy('group')->get();
		$student_id = Student::max('student_id');
		
		return view('student.studentRegister', compact(
				'programs', 'academics', 'levels', 'shifts', 'times', 'batches', 'groups', 'student_id')
		);
    }
    //========================================================
    public function postStudentRegister(Request $request)
	{
		$student = new Student();
		$student->first_name = $request->first_name;
		$student->last_name  = $request->last_name;
		$student->sex = $request->sex;
		$student->dob = $request->dob;
		$student->email = $request->email;
		//$student->rac = $request->rac;
		$student->status = $request->status;
		$student->nationality = $request->nationality;
		$student->id_card_no = $request->id_card_no;
		$student->passport = $request->passport;
		$student->phone = $request->phone;
		$student->district = $request->district;
		$student->division = $request->division;
		$student->location = $request->location;
		$student->county = $request->county;
		$student->current_address = $request->current_address;
		$student->dateregistered = $request->dateregistered;
		$student->user_id = $request->user_id;
		//$student->photo = $request->photo;
		$student->photo = FileUpload::photo($request, 'photo');
		if($student->save())
		{
			$student_id = $student->student_id;
			// Save student id in the given class
			Status::create([
					'student_id' => $student_id,
					'class_id'   => $request->class_id,
					//'user_id'    => $request->user_id
			]);
		  	return redirect()->route('goPayment', ['student_id' => $student_id]);
		}
	}
	public function studentInfo(Request $request)
	  {
	    if ($request->has('search'))
	    {
	      $students = Student::where('student_id', $request->search)
	                        ->orWhere('first_name', 'LIKE', '%'. $request->search .'%')
	                        ->orWhere('last_name', 'LIKE', '%'. $request->search .'%')
	                        ->select(DB::raw('student_id,
	                                          first_name,
	                                          last_name,
	                                          CONCAT(first_name, " ", last_name) as full_name,
	                                          (CASE WHEN sex=0 THEN "M" ELSE "F" END) as Sex,
	                                          dob'))
	                        ->paginate(10)
		                      ->appends('search', $request->search);
	    } else {
	      $students = Student::select(DB::raw('student_id,
	                                          first_name,
	                                          last_name,
	                                          CONCAT(first_name, " ", last_name) as full_name,
	                                          (CASE WHEN sex=0 THEN "M" ELSE "F" END) as Sex,
	                                          dob'))
	                          ->paginate(10);
	    }
	    return view('student.studentList', compact('students'));
	  
	}
}
