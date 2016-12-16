@extends('layout.index')
@section('content')

    <!-- Page Content -->
    <div class="container">

    	<!-- slider -->
    	<div class="row carousel-holder">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
				  	<div class="panel-heading">Account Profile</div>
				  	<div class="panel-body">
				  	@if(count($errors) > 0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                {{$err}}<br>
                            @endforeach
                        </div>
                    @endif

                    @if(session('notify'))
                        <div class="alert alert-success">
                            {{session('notify')}}
                        </div>
                    @endif
				    	<form action="account" method="post">
				    	<input type="hidden" name="_token" value="{{csrf_token()}}">
				    		<div>
				    			<label>Name</label>
							  	<input type="text" class="form-control" placeholder="Please Enter Name" name="name" aria-describedby="basic-addon1" value="{{$user->name}}">
							</div>
							<br>
							<div>
				    			<label>Email</label>
							  	<input type="email" class="form-control" placeholder="Please Enter Email" name="email" aria-describedby="basic-addon1"
							  	readonly="" value="{{$user->email}}" 
							  	>
							</div>
							<br>	
							<div>
								<input type="checkbox" id="changePassword" name="checkpassword">
				    			<label>Change Password</label>
							  	<input type="password" class="form-control password" name="password" aria-describedby="basic-addon1" disabled placeholder="Please Enter Password">
							</div>
							<br>
							<div>
				    			<label>PasswordAgain</label>
							  	<input type="password" class="form-control password" name="passwordAgain" aria-describedby="basic-addon1" disabled placeholder="Please Enter Password Again">
							</div>
							<br>
							<button type="submit" class="btn btn-default">Edit
							</button>

				    	</form>
				  	</div>
				</div>
            </div>
            <div class="col-md-2">
            </div>
        </div>
        <!-- end slide -->
    </div>
    <!-- end Page Content -->
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $("#changePassword").change(function(){
                if($(this).is(":checked"))
                {
                    $(".password").removeAttr('disabled');
                }
                else
                {
                    $(".password").attr('disabled','');
                }
            });
        });
    </script>
@endsection