@extends('admin.layout.index')

@section('content')

<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Category
                            <small>List</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    @if(session('notify'))
                        <div class="alert alert-success">
                            {{session('notify')}}
                        </div>
                    @endif

                    <form action="admin/tag/searchtag" method="post" accept-charset="utf-8" class="navbar-form-navbar-left" role="search">
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
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>                                
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tag as $tg)
                            <tr class="odd gradeX" align="center">
                                <td>{{$tg->id}}</td>
                                <td>{{$tg->name}}</td>
                                <td>{{$tg->description}}</td>
                                <td>
                                @if($tg->status == 1)
                                {{"Enable"}}
                                @else
                                {{"Disable"}}
                                @endif
                                </td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/tag/delete/{{$tg->id}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/tag/edit/{{$tg->id}}">Edit</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $tag->links() }}
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

@endsection