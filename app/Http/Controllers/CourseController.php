<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Program;
use Auth;
use Session;
use App\Academic;
use App\Level;
use App\Shift;
use App\Time;
use App\Batch;
use App\Group;
use App\MyClass;

class CourseController extends Controller
{

    public function __construct()
    {
        $this->middleware('web'); 
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getManageCourse()
    {
        $programs = Program::all();
        $shift =Shift::all();
        $time=Time::all();
        $batch=Batch::all();
        $group=Group::all();
        $academics = Academic::orderBy('academic_id','DESC')->get();
        return view('courses.manageCourse',compact('programs','academics','shift','time','batch','group'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postInsertAcademic(Request $request)
    {
        if ($request->ajax())
        {
            return response(Academic::create($request->all()));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postInsertProgram(Request $request)
    {
        if ($request->ajax())
        {
            return response(Program::create($request->all()));
        }
    }
    public function postInsertLevel(Request $request)
    {
        if($request->ajax())
        {
            return response(Level::create($request->all()));

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showLevel(Request $request)
    {
        if($request->ajax())
        {
            return response(Level::where('program_id',$request->program_id)->get());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createShift(Request $request)
    {
        if($request->ajax())
        {
            return(Shift::create($request->all()));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createTime(Request $request)
    {
        if($request->ajax())
        {
            return(Time::create($request->all()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createBatch(Request $request)
    {
        if($request->ajax())
        {
            return(Batch::create($request->all()));
        }
    }

    //==============================================


    public function createGroup(Request $request)
    {
        if($request->ajax())
        {
            return(Group::create($request->all()));
        }
    }
    //==============================================

    public function createClass(Request $request)
    {
        if($request->ajax())
        {
            return(MyClass::create($request->all()));
        }
    }
    //==============================================
    public function showClassInformation(Request $request)
    {
        $criterial = [];
        
        if ($request->academic_id != "" && $request->program_id == "")
        {
            $criterial = ['academics.academic_id' => $request->academic_id];
            
        } elseif ($request->academic_id != "" &&
            $request->program_id  != "" &&
            $request->level_id    != "" &&
            $request->shift_id    == "" &&
            $request->time_id     == "" &&
            $request->batch_id    == "" &&
            $request->group_id    == "")
        {
            $criterial = [
                'academics.academic_id' => $request->academic_id,
                'programs.program_id'   => $request->program_id,
                'levels.level_id'       => $request->level_id
            ];
        } elseif ($request->academic_id != "" &&
            $request->program_id != "" &&
            $request->level_id != "" &&
            $request->shift_id    != "" &&
            $request->time_id    != "" &&
            $request->batch_id   != "" &&
            $request->group_id != "")
        {
            $criterial = [
                'academics.academic_id' => $request->academic_id,
                'programs.program_id'   => $request->program_id,
                'levels.level_id'       => $request->level_id,
                'shifts.shift_id'       => $request->shift_id,
                'times.time_id'         => $request->time_id,
                'batches.batch_id'      => $request->batch_id,
                'groups.group_id'       => $request->group_id
            ];
        }
        
        $classes = $this->classInformation($criterial)->get();
        
        return view('class.classInfo', compact('classes'));
    }
    //===============================================
    public function ClassInformation($criterial)
    {
        return MyClass::join('academics', 'academics.academic_id','=','classes.academic_id')
                            ->join('levels','levels.level_id','=','classes.level_id') 
                            ->join('programs', 'programs.program_id','=','levels.program_id')
                            ->join('shifts','shifts.shift_id','=','classes.shift_id')
                            ->join('times','times.time_id','=','classes.time_id')
                            ->join('batches','batches.batch_id','=','classes.batch_id')
                            ->join('groups','groups.group_id','=','classes.group_id')
                            ->where($criterial)
                            ->orderBy('classes.class_id','DESC');

    }
    //==================================================================
    public function deleteClass(request $request)
    {
        if($request->ajax())
        {
            MyClass::destroy($request->class_id);
            //return redirect::action('CourseController@getManageCourse')->with('success','Class Deleted successfully');
        }
    }
    //================================================================
    public function editClass(Request $request)
    {
        if ($request->ajax())
        {
            return response(MyClass::find($request->class_id));
        }
    }
    //=================================================================
    public function updateClassInfo(Request $request)
    {
        if ($request->ajax())
        {
            return response(MyClass::updateOrCreate(['class_id'=>$request->class_id], $request->all()));
        }
    }
}
