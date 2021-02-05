<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Traits\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;
use Illuminate\Support\Facades\Redirect;

class SubjectController extends Controller
{
    use Messages;

    protected $resources = [
        'styles' => [],
        'scripts' => ['subject']
    ];

    public function index(Request $request){
        try{
            $data = $request->all();
            $subjects = Subject::select('*');
            //filter
            $subject_filter = $request->input('subject');
            if (!is_null($subject_filter) && $subject_filter != "") {
                $subjects = $subjects->where('subject', 'LIKE', '%' . trim($subject_filter) . '%');
            }
            $subjects = $subjects->orderBy('id', 'desc');
            $subjects = $subjects->paginate(10);
            $this->resources['card_title'] = 'Manage Subjects';
            $this->resources['subjects'] = $subjects;
            $this->resources['data'] = $data;
            return view('subjects.index')->with($this->resources);
        }catch (\Exception $e){
            Log::error($e);
            dd($e);
        }
    }

    public function create(Request $request){
        try{

            $this->resources['card_title'] = 'Add New Subject';
            return view('subjects.create')->with($this->resources);
        }catch (\Exception $e){
            Log::error($e);
            dd($e);
        }
    }

    public function store(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'subject' => 'required|max:255',
            ]);
            if (!$validator->fails()) {
                $subject = new Subject();
                $subject->subject = $request->subject;
                $subject->status = 1;
                $subject->save();
                $this->resources['common_msg'] = $this->success;
                return redirect()->to('subjects')->with($this->resources);
            } else {
                $this->resources['common_msg'] = $this->warning;
                return Redirect::back()->withErrors($validator)->withInput($this->resources);
            }
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->to('subjects')->with($this->resources);
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
            $this->resources['card_title'] = 'Edit Subject';
            if(isset($request->id) && $request->id != ''){
                $subject = Subject::find($request->id);
                $this->resources['subject'] = $subject;
                return view('subjects.edit')->with($this->resources);
            }else{
                $this->resources['common_msg'] = $this->infoWithMessage('No Record Found With ID : '.$request->id);
                return redirect()->to('subjects')->with($this->resources);
            }
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->to('subjects')->with($this->resources);
            Log::error($e);
        }
    }

    public function update(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'subject' => 'required|max:255',
            ]);
            if (!$validator->fails()) {
                $subject =Subject::find($request->id);
                $subject->subject = $request->subject;
                $subject->status = 1;
                $subject->save();
                $this->resources['common_msg'] = $this->success;
                return redirect()->to('subjects')->with($this->resources);
            } else {
                $this->resources['common_msg'] = $this->warning;
                return Redirect::back()->withErrors($validator)->withInput($this->resources);
            }
        }catch (\Exception $e){
            $this->resources['common_msg'] = $this->dangerWithMessage($e->getMessage());
            return redirect()->to('subjects')->with($this->resources);
            Log::error($e);
        }
    }

    public function delete(Request $request){
        try{
            if ($request->ajax()) {
                if (isset($request->id) && $request->id != '') {
                    $subejct = Subject::find($request->id);
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
