<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Tsubject;
use App\exam_creates;
use App\exam_question_master;
use Illuminate\Support\Facades\Validator;

class Admin extends Controller
{
    public function index(){
      // echo("logged in");
      return view('admin.dashboard');
    }

    public function subject_creation(){
     // echo("logged in");
     $data['subject']=Tsubject::get()->toArray();
     
     return view('admin.subject_creation',$data);
    }

    public function add_new_subject(Request $request){
      $rules = [
        'subject_name' => 'required|unique:Tsubject',
        'code'=>'required',
        'coursenm'=>'required',
        'key'=>'required',
        'semester'=>'required'
        
      ];

      $validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect('admin/subject_creation')
			->withInput()
			->withErrors($validator);
		}
		else{
      $cat = new Tsubject();
			$cat->subject_name=$request->subject_name;

      $cat->subject_code=$request->code;
      $cat->course_name=$request->coursenm;
      $cat->enrollment_key=$request->key;
      $cat->teacher_id=auth()->user()->uid;
			$cat->semester=$request->semester;
      $cat->status=1;
			$cat->save();
      return redirect('admin/subject_creation')->with('status',"Insert successfully");


    }

      
     }

     public function delete_subject($subnm){
      $cat = Tsubject::where('subject_name',$subnm)->get()->first();
      $cat->delete();
      return redirect(url('admin/subject_creation'));
     }

     public function edit_subject($subnm){
      $cat = Tsubject::where('subject_name',$subnm)->get()->first();
      
      return view('admin.edit_subject',['subject'=>$cat]);
     }
    
     public function edit_new_subject(Request $request)
	{
    $cat =Tsubject::where('subject_name',$request->id123)->get()->first();
    
    $rules = [
      'subject_name' => 'required|unique:Tsubject',
      'code'=>'required',
      'coursenm'=>'required',
      'key'=>'required',
      'semester'=>'required'
      
    ];
    $customMessages = [
      'subject_name.unique' => 'Subject name '.$request->subject_name.' has already been taken',
        'required'=>'field required here'
  
    ];



    $validator = Validator::make($request->all(),$rules, $customMessages);
  if ($validator->fails()) {
    $cat =Tsubject::where('subject_name',$request->id123)->get()->first();
    if($cat->subject_name==$request->subject_name){
      $cat->subject_name=$request->subject_name;
    $cat->subject_code=$request->code;
    $cat->course_name=$request->cname;
    $cat->enrollment_key=$request->key;
    $cat->teacher_id=auth()->user()->uid;
		$cat->semester=$request->sem;
		$cat->update();
    
     return redirect('admin/subject_creation')->with('status',"subject added success");
  

    }else{
     return redirect()->back()
      ->withInput()
      ->withErrors($validator);
    }
}
 

  else{

  
		$cat =Tsubject::where('subject_name',$request->id123)->get()->first();
    $cat->subject_name=$request->subject_name;
    $cat->subject_code=$request->code;
    $cat->course_name=$request->cname;
    $cat->enrollment_key=$request->key;
    $cat->teacher_id=auth()->user()->uid;
		$cat->semester=$request->sem;
		$cat->update();
    
     return redirect('admin/subject_creation')->with('status',"subject added success");
  
  }

  }


  public function subject_status($subject_name)
	{
		$cat=Tsubject::where('subject_name',$subject_name)->get()->first();
		if($cat->status==1)
			$status=0;
		else 
			$status=1;
		$cat1=Tsubject::where('subject_name',$subject_name)->get()->first();
		$cat1->status=$status;
		$cat1->update();
	}

  public function manage_exam()
  {
    $data['subject'] = Tsubject::where('status','1')->get()->toArray();
    $data['exams'] = exam_creates::select(['exam_creates.*'])->join('tsubject', function($join)
    {
        $join->on('exam_creates.subjectName','=','tsubject.subject_name')
            ->where('tsubject.teacher_id','=',auth()->user()->uid);
    })->get()->toArray();
    return view('admin.manage_exam',$data);
}
public function add_new_exam(Request $request)
{
    $rules = [
        'subject_name' => 'required',
        'exam_date'=>'required',
        'title'=>'required',
        'exam_duration'=>'required|integer',
        'total_marks'=>'required|integer'
    ];
    $validator = Validator::make($request->all(),$rules);
if ($validator->fails()) {
  return redirect('admin/manage_exam')
  ->withInput()
  ->withErrors($validator);
}
else {
        $cat = new exam_creates();
        $cat->exam_title=$request->title;
        $cat->exam_date=$request->exam_date;
        $cat->duration=$request->exam_duration;
        $cat->total_marks=$request->total_marks;
        $cat->subjectName=$request->subject_name;
        $cat->status=1;
        $cat->save();
        return redirect('admin/manage_exam')->with('status',"Exam created successfully");
    }
}

public function exam_status($id)
	{
		$exam=exam_creates::where('id',$id)->get()->first();
		if($exam->status==1)
			$status=0;
		else 
			$status=1;
		$exam=exam_creates::where('id',$id)->get()->first();
		$exam->status=$status;
		$exam->update();
	}


  public function delete_exam($id){
    $exam = exam_creates::where('id',$id)->get()->first();
    $exam->delete();
    return redirect(url('admin/manage_exam'));
   }

   public function update_exam($id)
	{
		$data['exam']=exam_creates::where('id',$id)->get()->first();
    $data['subject'] = Tsubject::where('status','1')->get()->toArray();
    return view('admin.update_exam',$data);
	}
  public function confirm_update_exam(Request $request)
  {
      $cat =exam_creates::where('id',$request->id123)->get()->first();
      $rules = [
          'subject_name' => 'required',
          'exam_date'=>'required',
          'title'=>'required',
          'exam_duration'=>'required|integer',
          'total_marks'=>'required|integer'
      ];
      $validator = Validator::make($request->all(),$rules);
  if ($validator->fails()) {
          return redirect()->back()
          ->withInput()
          ->withErrors($validator);
  } else {
          $cat->exam_title=$request->title;
          $cat->exam_date=$request->exam_date;
          $cat->duration=$request->exam_duration;
          $cat->total_marks=$request->total_marks;
          $cat->subjectName=$request->subject_name;
          $cat->update();
          return redirect('admin/manage_exam')->with('status',"Exam details updated successfully");
      }
  }



  
  


}





