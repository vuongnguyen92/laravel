@extends('admin.layout.index')

@section('content')

<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Topic
                            <small>List</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    @if(session('notify'))
                        <div class="alert alert-success">
                            {{session('notify')}}
                        </div>
                    @endif
                    <form action="admin/topic/searchtopic" method="post" accept-charset="utf-8" class="navbar-form-navbar-left" role="search">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <div class="form-group">
                            <input type="text" name="key" class="form-control" placeholder="Search">
                        </div>
                        <button type="submit" class="btn btn-default">Search</button>
                    </form>
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tittle</th>
                                <th>Image</th>
                                <th>ShortDescription</th>
                                <th>Content</th>
                                <th>Author</th>
                                <th>Viewed</th>
                                <th>ApproveStatus</th>
                                <th>Approvedby</th>
                                <th>TimeApproved</th>
                                <th>Status</th>                                
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topic as $tp)
                            <tr class="odd gradeX" align="center">
                                <td>{{$tp->id}}</td>
                                <td>{{$tp->tittle}}</td>
                                <td><img width="100px" src="upload/tintuc/{{$tp->image}}"></td>
                                <td>{{$tp->shortdescription}}</td>
                                <td>{{$tp->content}}</td>
                                <td>{{Auth::user()->name}}</td>
                                <td>{{$tp->viewed}}</td>
                                <td>
                                @if($tp->approvestatus == 0)
                                {{"Deny"}}
                                @elseif($tp->approvestatus == 1)
                                {{"Approved"}}
                                @else
                                {{"Waiting"}}
                                @endif
                                </td>
                                <td>{{$tp->approvedby}}</td>
                                <td>{{$tp->timeapproved}}</td>
                                <td>
                                @if($tp->status == 1)
                                {{"Enable"}}
                                @else
                                {{"Disable"}}
                                @endif
                                </td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/topic/delete/{{$tp->id}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/topic/edit/{{$tp->id}}">Edit</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

@endsection