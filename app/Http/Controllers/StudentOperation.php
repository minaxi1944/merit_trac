<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Subject;

class StudentOperation extends Controller
{
    public function student_dashboard()
    {
        if(!Session::get('student_session'))
        {
            return redirect(url('student/student_login'));
        }

        //$data['student_subject']= Subject::select(['subjects.*','courses.name as c_name'])->join('courses','subjects.subject_course','=','courses.id')->orderBy('subject_code','desc')->where('subjects.status','1')->get()->toArray();
    
        //$data['student_subject']= Subject::select(['subjects.*','student_details.course as stu_course','courses.name as c_name'])
                               //     ->join('courses','subjects.subject_course','=','courses.id')
                                //    ->join('courses','student_details.course','=','courses.id')
                                  //  ->orderBy('subject_code','desc')->where('subjects.status','1')->get()->toArray();


       //echo $session_data=Session::get('student_session'); //to get student id on deshboard
       return view('student.student_dashboard');
    }

    public function student_logout(Request $request)
    {
        $request->session()->forget('student_session');
        return redirect(url('student/student_login'));
    }
}
