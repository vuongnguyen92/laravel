@extends('layout.index')
@section('content')

<!-- Page Content -->
    <div class="container">
    	<div class="row carousel-holder">
    		<div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="panel panel-default">
				  	<div class="panel-heading">Please Login</div>
				  	<div class="panel-body">
				  	@if(count($errors)>0)
				  		<div class="alert alert-danger">
				  			@foreach($errors->all() as $err)
				  				echo $err<br>;
				  			@endforeach
				  		</div>
				  	@endif

				  	@if(session('notify'))
				  		<div class="alert alert-danger">
				  			{{session('notify')}}
				  		</div>
				  	@endif
				    	<form action="login" method="post">
				    	<input type="hidden" name="_token" value="{{csrf_token()}}">
							<div class="input-group input-group-lg">
							<span class="input-group-addon">
   								 <span class="glyphicon glyphicon-envelope"></span>
  							</span>
							  	<input type="text" class="form-control" placeholder="Email address" name="email">
							</div>
							<br>	
							<div class="input-group input-group-lg">
								<span class="input-group-addon">
    								<span class="glyphicon glyphicon-lock"></span>
  								</span>
							  	<input type="password" class="form-control" placeholder="Password" name="password">
							</div>
							<br>
							<button type="submit" class="btn btn-default">Login
							</button>
				    	</form>
				  	</div>
				</div>
            </div>
            <div class="col-md-4"></div>
        </div>
        <!-- end slide -->
    </div>
    <!-- end Page Content -->
@endsection