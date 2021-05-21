<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Course;
use App\studentDetails;
use Illuminate\Support\Facades\Validator;
use Session;
//use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
//use Reminder;
use Mail;

class Student extends Controller
{
    public function student_signup()
    {
        if(Session::get('student_session'))
        {
            return redirect(url('student/student_dashboard'));
        }
        $data['course'] = Course::get()->toArray();
        return view('student.signup',$data);

    }

    public function add_new_student(Request $request)
    {
        $rules = [
            'PRNo' => 'required|unique:student_details|exists:studentid,id',
            'Fname'=>'required',
            'Lname'=>'required',
            'email'=>'required',
            'password'=>'required',
            'Cpassword'=>'required',
            'rollNo'=>'required|integer',
            'course'=>'required',
        ];
        $validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect('student/signup')
			->withInput()
			->withErrors($validator);
		}
		else {
            $cat = new studentDetails(); 
            $cat->PRNo=$request->PRNo;
            $cat->Fname=$request->Fname;
            $cat->Lname=$request->Lname;
            $cat->email=$request->email;
            $cat->password=$request->password;
            $cat->Cpassword=$request->Cpassword;
            $cat->rollNO=$request->rollNo;
            $cat->course=$request->course;
            $cat->save();

            //email data   
            $email_data = array(
                'name' => $request['Fname'],
                'email' => $request['email'],
            );  

                //Send email with the template
            Mail::send(['text'=>'mail'], $email_data, function($message) use ($email_data) {
                $message->to($email_data['email'], $email_data['name'])
                    ->subject('Successfull Registration');
                $message->from('salswe1011@gmail.com', 'Salria Pereira');
        });

            return redirect('student/student_login');
        }

    }

    public function student_login()
    {
        if(Session::get('student_session'))
        {
            return redirect(url('student/student_dashboard'));
        }
        return view('student.student_login');
    }

    public function stud_login(Request $request)
    {
        $login=studentDetails::where('email',$request->email)->where('password',$request->password)->get()->toArray();
        if($login)
        {
            $request->session()->put('student_session',$login[0]['PRNo']);
            return redirect('student/student_dashboard');
        }
        else
        {
            echo '<script>alert("You have entered invalid credentials")</script>';
        }

    }

   /* public function forgot(){
        return view('student.forgot');
    }

    public function password(Request $request){
        $student = studentDetails::whereEmail($request->email)->first();

        if($student == null){
            return redirect()->back()->with(['error' => 'Email not exists']);
        }
        $student = Sentinel::findById($student->PRNo);
        $reminder = Reminder::exists($student) ? : Reminder::create($student);
        $this->sendEmail($student, $reminder->code);

        return redirect()->back()->with(['success' => 'Reset code sent to your email.']);
    }

    public function sendEmail($student, $code){
        Mail::send(
            'email.forgot',
            ['student' => $student, 'code' => $code],
            function($message) use ($student){
                $message->to($student->email);
                $message->subject("$student->Fname, reset your password.");
            }
        );
    }*/


}
