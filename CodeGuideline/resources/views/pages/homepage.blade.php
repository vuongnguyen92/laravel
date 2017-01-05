    @extends('layout.index')

    @section('content')
    <!-- Page Content -->
    <div class="container">

    @include('layout.slide')

        <div class="space20"></div>


        <div class="row main-left">

        @include('layout.menu')
            <div class="col-md-9">
	            <div class="panel panel-default">            
	            	<div class="panel-heading" style="background-color:#337AB7; color:white;" >
	            		<h2 style="margin-top:0px; margin-bottom:0px;">Codeguideline</h2>
	            	</div>

	            	<div class="panel-body">
	            		<!-- item -->
	            		@foreach($category as $ctg)
	            			@if(count($ctg->topic)>0)	            		
					    <div class="row-item row">
		                	<h3>
		                		<a href="category/{{$ctg->id}}">{{$ctg->name}}</a> 
		                	</h3>
		                	<?php 
		                	$data = $ctg->topic->where('approvestatus',1)->sortbydesc('created_at')->take(5);
		                	$new1 = $data->shift();
		                	 ?>
		                	<div class="col-md-8 border-right">
		                		<div class="col-md-5">
			                        <a href="topic/{{$new1->id}}">
			                            <img class="img-responsive" src="upload/tintuc/{{$new1->image}}" alt="">
			                        </a>
			                    </div>
			                    <div class="col-md-7">
			                        <h3>{{$new1->tittle}}</h3>
			                        <p>{{$new1->shortdescription}}</p>
			                        <a class="btn btn-primary" href="topic/{{$new1->id}}">Detail ... <span class="glyphicon glyphicon-chevron-right"></span></a>
								</div>
		                	</div>		                    
							<div class="col-md-4">
							@foreach($data->all() as $tp)
								<a href="topic/{{$tp->id}}">
									<h4>
										<span class="glyphicon glyphicon-list-alt"></span>
										{{$tp->tittle}}
									</h4>
								</a>
							@endforeach
							</div>
							
							<div class="break"></div>
		                </div>
		                	@endif
		                @endforeach		                
		                <!-- end item -->
					</div>
	            </div>
        	</div>
        </div>
        
        <!-- /.row -->
    </div>
    <!-- end Page Content -->
    @endsection