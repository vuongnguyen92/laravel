@extends('layout.index')
@section('content')
	<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
            <div class="col-md-3">
            </div>
                <div class="col-md-6">
                    <div class="col-lg-12">
                        <h1 class="page-header">Favourite 
                            <small>List</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    @if(session('notify'))
                        <div class="alert alert-success">
                            {{session('notify')}}
                        </div>
                    @endif
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr align="center">
                                <th class="col-md-8">Link</th>                              
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($favourite as $fa)
                            <tr class="odd gradeX" align="center">
                                <td><a href="http://codeguideline.nv/topic/{{$fa->idTopic}}">{{$fa->name}}</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="favourite/delete/{{$fa->id}}"> Delete</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $favourite->links() }}
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

@endsection