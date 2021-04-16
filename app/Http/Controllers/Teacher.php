<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
// use App\Http\Controllers\Controller;
use App\Tsubject;
use Illuminate\Support\Facades\Validator;
class Teacher extends Controller
{
    public function index()
    {
        return view('teacher.dashboard');
    }
    public function subject_creation()
    {
        $data['subject'] = Tsubject::get()->toArray();
        return view('teacher.createSubject',$data);
    }
    public function add_new_subject(Request $request)
    {
        $rules = [
            'subject_name' => 'required|unique:tsubjects',
            'code'=>'required',
            'cname'=>'required',
            'key'=>'required',
            'sem'=>'required'
        ];
        $validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect('teacher/subject_creation')
			->withInput()
			->withErrors($validator);
		}
		else {
            $cat = new Tsubject();
            $cat->subject_code=$request->code;
            $cat->subject_name=$request->subject_name;
            $cat->course_name=$request->cname;
            $cat->semester=$request->sem;
            $cat->enrollment_key=$request->key;
            $cat->teacher_id=auth()->user()->uid;
            $cat->save();
            return redirect('teacher/subject_creation')->with('status',"Subject added successfully");
        }
    }
    public function delete_subject($subject_name)
    {
        $cat = Tsubject::where('subject_name',$subject_name)->get()->first();
        $cat->delete();
        return redirect(url('teacher/subject_creation'));
    } 
    public function update_subject($subnm)
    {
        $cat =Tsubject::where('subject_name',$subnm)->get()->first();
        return view('teacher.update_subject',['subject'=>$cat]);
    }
    public function confirm_update_subject(Request $request)
    {
        $cat =Tsubject::where('subject_name',$request->id123)->get()->first();
        $rules = [
            'subject_name' => 'required|unique:tsubjects',
            'code'=>'required',
            'cname'=>'required',
            'key'=>'required',
            'sem'=>'required'
        ];
        $validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
            if($cat->subject_name == $request->subject_name) {
                $cat->subject_name=$request->subject_name;
                $cat->subject_code=$request->code;
                $cat->course_name=$request->cname;
                $cat->enrollment_key=$request->key;
                $cat->teacher_id=auth()->user()->uid;
                $cat->semester=$request->sem;
                $cat->update();
                return redirect('teacher/subject_creation')->with('status',"Subject added successfully");
            } else {
                return redirect()->back()
                ->withInput()
                ->withErrors($validator);
            }
		} else {
            $cat =Tsubject::where('subject_name',$request->id123)->get()->first();
            $cat->subject_name=$request->subject_name;
            $cat->subject_code=$request->code;
            $cat->course_name=$request->cname;
            $cat->enrollment_key=$request->key;
            $cat->teacher_id=auth()->user()->uid;
            $cat->semester=$request->sem;
            $cat->update();
            return redirect('teacher/subject_creation')->with('status',"Subject added successfully");
        }
    }
}
