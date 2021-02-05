<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use App\Traits\Messages;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Validator;


class StudentController extends Controller
{
    use Messages;

    protected $resources = [
        'styles' => [],
        'scripts' => ['student']
    ];

    public function index(Request $request){
        try{
            $data = $request->all();
            $students = Student::select('*');
            //filter
            $subject_filter = $request->input('subject');
            if (!is_null($subject_filter) && $subject_filter != "") {
                $students = $students->where('subject', 'LIKE', '%' . trim($subject_filter) . '%');
            }
            $students = $students->orderBy('id', 'desc');
            $students = $students->paginate(10);
            $this->resources['card_title'] = 'Manage Students';
            $this->resources['students'] = $students;
            $this->resources['data'] = $data;
            return view('students.index')->with($this->resources);
        }catch (\Exception $e){
            Log::error($e);
            dd($e);
        }
    }

    public function create(Request $request){
        try{
            $this->resources['card_title'] = 'Add New Student';
            $this->resources['grades'] = Grade::all();
            return view('students.create')->with($this->resources);
        }catch (\Exception $e){
            Log::error($e);
            dd($e);
        }
    }

    public function store(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'address' => 'required|max:255',
                'email' => 'required|max:255',
                'grade_id' => 'required|max:255',
            ]);
            if (!$validator->fails()) {
                $student = new Student();
                $student->first_name = $request->first_name;
                $student->last_name = $request->last_name;
                $student->address = $request->address;
                $student->email = $request->email;
                $student->grade_id = $request->grade_id;
                $student->register_date = Carbon::now();
                $student->status = 1;
                $student->save();
                $this->resources['common_msg'] = $this->success;
                return redirect()->to('students')->with($this->resources);
            } else {
                $this->resources['common_msg'] = $this->warning;
                return Redirect::back()->withErrors($validator)->withInput($this->resources);
            }
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->to('students')->with($this->resources);
            Log::error($e);
        }
    }

    public function view(Request $request){
        try{
            return view('subjects.index');
        }catch (\Exception $e){
            Log::error($e);
            dd($e);
        }
    }

    public function edit(Request $request){
        try{
            $this->resources['card_title'] = 'Edit Student';
            $this->resources['grades'] = Grade::all();
            if(isset($request->id) && $request->id != ''){
                $subject = Student::find($request->id);
                $this->resources['students'] = $subject;
                return view('students.edit')->with($this->resources);
            }else{
                $this->resources['common_msg'] = $this->infoWithMessage('No Record Found With ID : '.$request->id);
                return redirect()->to('students')->with($this->resources);
            }
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->to('students')->with($this->resources);
            Log::error($e);
        }
    }

    public function update(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'address' => 'required|max:255',
                'email' => 'required|max:255',
                'grade_id' => 'required|max:255',
            ]);
            if (!$validator->fails()) {
                $student = Student::find($request->id);
                $student->first_name = $request->first_name;
                $student->last_name = $request->last_name;
                $student->address = $request->address;
                $student->email = $request->email;
                $student->grade_id = $request->grade_id;
                $student->save();
                $this->resources['common_msg'] = $this->success;
                return redirect()->to('students')->with($this->resources);
            } else {
                $this->resources['common_msg'] = $this->warning;
                return Redirect::back()->withErrors($validator)->withInput($this->resources);
            }
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->to('students')->with($this->resources);
            Log::error($e);
        }
    }

    public function delete(Request $request){
        try{
            if ($request->ajax()) {
                if (isset($request->id) && $request->id != '') {
                    $subejct = Student::find($request->id);
                    $subejct->status = 0;
                    $subejct->save();
                    return response()->json(['common_msg' => $this->success,'data'=>$subejct->subject]);
                }
            }
        }catch (\Exception $e){
            Log::error($e);
            return response()->json(['common_msg' => $this->dangerWithMessage($e->getMessage()),'data'=>'']);
        }
    }
}
