<!DOCTYPE html>
<html>
<head>
	  <title>Student - Sign-up </title>
   	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	  <style type="text/css">
	  	.signUp_container {
		    width: 70%;
		    height: 900px;
		    border: 1px solid;
		    border-radius: 35px;
		    padding: 21px;
		    margin-left: 20%;
		    margin-top: 15px;
		}
		hr.line {
			border: 1px solid #0099ff;
		}
		h3{
			color:#0099ff;
		}
	  </style>
</head>
<body>
	<div class="container">
		<div class="signUp_container">
			<div class="signUp_title">
				<h3 class="text-center">Student Sign-up</h3>
				<hr class="line">
			</div>
			<form action="{{ url('student/add_new_student') }}" class="database-operation" method="POST">
			<div class="signUp_form">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Enter PRNo</label>
							{{ csrf_field() }}
							<input type="text" name="PRNo" placeholder="Enter PR No." class="form-control">
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group">
							<label>Enter First Name</label>
							<input type="text" name="Fname" placeholder="Enter First Name" class="form-control">
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group">
							<label>Enter Last Name</label>
							<input type="text" name="Lname" placeholder="Enter Last Name" class="form-control">
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group">
							<label>Enter E-mail</label>
							<input id="email" type="text" name="email" placeholder="Enter Email" class="form-control">
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group">
							<label>Enter Password</label>
							<input id="password" type="password" name="password" placeholder="Enter Password" class="form-control">
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group">
							<label>Enter Confirm Password</label>
							<input type="password" name="Cpassword" placeholder="Enter Confirm Password" class="form-control">
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group">
							<label>Enter Roll No</label>
							<input type="text" name="rollNo" placeholder="Enter Roll No." class="form-control">
						</div>
					</div>
					
					<!--@if($course!= null)-->
					<div class="col-sm-12">
						<div class="form-group">
							<label for="course">Select course</label>
							<select name="course" class="form-control">
							@foreach($course as $row)
								<option value="{{$row['id']}}"> {{$row['name']}} </option>
								@endforeach
							</select>	
						</div>
					</div>
					<!-- @endif -->
					
					

					<div class="col-sm-12">
						<div class="form-group">
							<button type="submit" class="btn btn-info">Sign-up</button>
						</div>
					</div>
					<div class="col-sm-12">
						<p class="text-center"> have an account ? <a href="{{ url('student/student_login') }}">Login</a></p>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>

</body>
<!-- <script> 
 $(document).on('submit','.database_operation',function(){
     var url=$(this).attr('action');
     var data1=$(this).serialize();
     $.post(url,data1,function(fb){
         var resp=$.parseJSON(fb);
         if(resp.status=='true')
         {
             alert(resp.message);
             setTimeout(function(){
                 window.location.href=resp.reload;
             },1000);
         }
     });
     return false;
 });-->
 <script>
 $(document).on('submit','.database_operation',function(){
    var student_PRNo=$(this).attr('action');
    $.get(BASE_URL='/student/add_new_student/'+studentPRNo,function(fb){
        
    })
});
</script>
</html>