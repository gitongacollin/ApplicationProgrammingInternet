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
use App\User;
use App\Charts;
use DB;

class ReportController extends Controller
{
    public function getStudentList()
		{
			$programs  = Program::all();
			$shifts    = Shift::all();
			$times     = Time::all();
			$batches   = Batch::all();
			$groups    = Group::all();
			$academics = Academic::orderBy('academic_id', 'DESC')->get();
			return view('report.studentList', compact(
					'programs', 'academics', 'shifts', 'times', 'batches', 'groups')
			);
		}

		public function showStudentInfo(Request $request)
		{
			$classes = $this->info()
							->select(DB::raw('students.student_id,
	                          CONCAT(students.first_name," ",students.last_name) as name,
	                          (CASE WHEN students.sex=0 THEN "Male" ELSE "Female" END) as sex,
	                            students.dob,
	                            CONCAT(programs.program," / ",levels.level,
	                            " / ", shifts.shift," / ",times.time,
	                            " / Start-(",classes.start_date,
	                            " / ", classes.end_date, ")") as program
	                          '))
							->where('classes.class_id', $request->class_id)
							->get();
			return view('report.studentInfo', compact('classes'));
		}

		public function info()
	{
		return Status::join('classes', 'classes.class_id', '=', 'statuses.class_id')
					->join('students', 'students.student_id', '=', 'statuses.student_id')
	                ->join('levels', 'levels.level_id', '=', 'classes.level_id')
	                ->join('programs', 'programs.program_id', '=', 'levels.program_id')
					->join('academics', 'academics.academic_id', '=', 'classes.academic_id')
					->join('shifts', 'shifts.shift_id', '=', 'classes.shift_id')
					->join('times', 'times.time_id', '=', 'classes.time_id')
					->join('batches', 'batches.batch_id', '=', 'classes.batch_id')
					->join('groups', 'groups.group_id', '=', 'classes.group_id');
	}

	public function getStudentListMultiClass()
	{
		$programs  = Program::all();
		$shifts    = Shift::all();
		$times     = Time::all();
		$batches   = Batch::all();
		$groups    = Group::all();
		$academics = Academic::orderBy('academic_id', 'DESC')->get();
		
		return view('report.studentListMultiClass', compact(
				'programs', 'academics', 'shifts', 'times', 'batches', 'groups')
		);
	}
	
	public function showStudentInfoMultiClass(Request $request)
	{
		if ($request->ajax())
		{
			if (!empty($request['chk']))
			{
				$classes = $this->info()
								->select(DB::raw('students.student_id,
		                          CONCAT(students.first_name," ",students.last_name) as name,
		                          (CASE WHEN students.sex=0 THEN "Male" ELSE "Female" END) as sex,
		                            students.dob,
		                            programs.program,
		                            levels.level,
		                            shifts.shift,
		                            times.time,
		                            batches.batch,
		                            groups.group
		                          '))
								->whereIn('classes.class_id', $request['chk'])
								->get();
				
				return view('report.studentInfoMultiClass', compact('classes'));
			}
		}
	}

	public function getNewStudentRegister()
	{
		$users = User::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))

    				->get();

        $chart = Charts::database($users, 'bar', 'highcharts')

			      ->title("Monthly new Register Users")

			      ->elementLabel("Total Users")

			      ->dimensions(1000, 500)

			      ->responsive(false)

			      ->groupByMonth(date('Y'), true);

        return view('chart',compact('chart'));

    }

}
