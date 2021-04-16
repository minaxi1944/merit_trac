<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Tsubject;
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
   
    $rules = [
      'subject_name' => 'required|unique:Tsubject',
      'code'=>'required',
      'coursenm'=>'required',
      'key'=>'required',
      'semester'=>'required'
      
    ];

    $validator = Validator::make($request->all(),$rules);
  if ($validator->fails()) {
   // return redirect('admin/subject_creation')
   return redirect('admin/edit_subject/gyhu111')
    ->withInput()
    ->withErrors($validator);
  }
  else{

  
		$cat =Tsubject::where('subject_name',$request->id123)->get()->first();
		$cat->subject_name=$request->subject_name;
    $cat->subject_code=$request->code;
      $cat->course_name=$request->coursenm;
      $cat->enrollment_key=$request->key;
      $cat->teacher_id=auth()->user()->uid;
			$cat->semester=$request->semester;
		 $cat->update();
    //  echo json_encode(array('status'=>'true','message'=>'Subject Successfully Updated',
    //  'reload'=>url('admin/subject_creation')));
     return redirect('admin/subject_creation')->with('status',"subject added success");
  }  
  }





  // public function edit_subject($subject_name)
  // {
  //     $cat =Tsubject::where('subject_name',$subject_name)->get()->first();
      
  //     // $ogdata = $subject['subject_name'];
  //     return view('admin.edit_subject',['subject'=>$cat]);
  // }
  // public function edit_new_subject(Request $request)
  // {
  //     $rules = [
  //         'subject_name' => 'required|unique:Tsubject',
  //     ];
  //     $validator = Validator::make($request->all(),$rules);
  // if ($validator->fails()) {
  //   return redirect('admin/edit_subject/gyhu111')
  //   ->withInput()
  //   ->withErrors($validator);
  // } else {
  //         $cat =Tsubject::where('subject_name',$request->id123)->get()->first();
  //         // $cat = $ogdata;
  //         $cat->subject_name=$request->subject_name;
  //         $cat->subject_code=$request->code;
  //         $cat->course_name=$request->cname;
  //         $cat->enrollment_key=$request->key;
  //         $cat->teacher_id=auth()->user()->uid;
  //         $cat->semester=$request->sem;
  //         $cat->update();
  //         return redirect('admin/subject_creation')->with('status',"Subject added successfully");
  //     }
  // }



}







