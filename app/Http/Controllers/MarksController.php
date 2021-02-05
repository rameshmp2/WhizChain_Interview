<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use App\Models\StudentMarks;
use App\Traits\Messages;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Validator;

class MarksController extends Controller
{
    use Messages;

    protected $resources = [
        'styles' => [],
        'scripts' => []
    ];

    public function add(Request $request){
        try{
            $this->resources['card_title'] = 'Add Marks For Student';
            $this->resources['students'] = Student::all();
            return view('marks.add')->with($this->resources);
        }catch (\Exception $e){
            Log::error($e);
            dd($e);
        }
    }

    public function store(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'student_id' => 'required',
                'marks' => 'required',
            ]);
            if (!$validator->fails()) {
                $student = new StudentMarks();
                $student->student_id = $request->student_id;
                $student->marks = $request->marks;
                $student->save();
                $this->resources['common_msg'] = $this->success;
                return redirect()->to('marks/add')->with($this->resources);
            } else {
                $this->resources['common_msg'] = $this->warning;
                return Redirect::back()->withErrors($validator)->withInput($this->resources);
            }
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->to('marks/add')->with($this->resources);
            Log::error($e);
        }
    }

}
