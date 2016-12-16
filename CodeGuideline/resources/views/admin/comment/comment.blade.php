@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Topic
                            <small>Add</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
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
                        <form action="admin/comment/filtercomment" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Content</th>
                                <th>Vote</th>
                                <th>Date time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($comment as $cm)
                            <tr class="odd gradeX" align="center">
                                <td>{{$cm->id}}</td>     
                                <td>
                                {{str_ireplace($array, '****', $cm->content)}}
                                </td>                                                         
                                <td>{{$cm->vote}}</td>
                                <td>{{$cm->created_at}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

@endsection