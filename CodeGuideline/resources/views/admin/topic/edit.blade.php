@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Topic
                            <small>Edit</small>
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
                        <form action="admin/topic/edit/{{$topic->id}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Tittle</label>
                                <input class="form-control" name="tittle" placeholder="Please Enter Tittle" value="{{$topic->tittle}}" />
                            </div>
                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control" name="category">
                                    @foreach($category as $ctg)
                                    @if($ctg->status == 1)
                                    <option 
                                    @if($topic->idCatagory == $ctg->id)
                                        {{"selected"}}
                                    @endif
                                    value="{{$ctg->id}}">{{$ctg->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tag</label>
                                <select id="select" class="form-control" name="tag[]" multiple="multiple">
                                    @foreach($tag as $t)
                                    @if($t->status == 1)
                                    <option value="{{$t->id}}"
                                        @foreach ($topic->tag as $tags) 
                                            @if($tags->id == $t->id)
                                                 {{"selected=selected"}}
                                            @endif
                                        @endforeach
                                    >{{$t->name}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>ShortDescription</label>
                                <textarea class="form-control" name="shortdescription" rows="3" placeholder="Please Enter Short Description">{{$topic->shortdescription}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Content</label>
                                <textarea class="form-control ckeditor" name="content" rows="5" placeholder="Please Enter Content">{{$topic->content}}</textarea>                                
                            </div>
                             <div class="form-group">
                                <label>Image</label>
                                <p>
                                    <img width="400px" src="upload/tintuc/{{$topic->image}}" alt="">
                                </p>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Viewed</label>
                                <input class="form-control" name="viewed" value="0" disabled="" />
                            </div>
                            <div class="form-group">
                                <label>Author</label>
                                <input class="form-control" name="author" value="{{Auth::user()->id}}" disabled="" />
                            </div>
                            @if(Auth::user()->level == 0 || Auth::user()->level == 1)
                            <div class="form-group">
                                <label>ApproveStatus</label>
                                <label class="radio-inline">
                                    <input name="approvestatus" value="0" 
                                    @if($topic->approvestatus == 0)
                                    {{"checked"}}
                                    @endif
                                    type="radio">Deny
                                </label>
                                <label class="radio-inline">
                                    <input name="approvestatus" value="1" 
                                    @if($topic->approvestatus == 1)
                                    {{"checked"}}
                                    @endif
                                    type="radio">Approved
                                </label>
                                <label class="radio-inline">
                                    <input name="approvestatus" value="2" 
                                    @if($topic->approvestatus == 2)
                                    {{"checked"}}
                                    @endif                                    
                                    type="radio">Waiting
                                </label>
                            </div>
                            <div class="form-group">
                                <label>Approvedby</label>
                                <input class="form-control" name="approvedby" value="{{Auth::user()->name}}" />
                            </div>
                            @endif
                            <div class="form-group">
                                <label>Status</label>
                                <label class="radio-inline">
                                    <input name="status" value="1" 
                                    @if($topic->status == 1)
                                    {{"checked"}}
                                    @endif
                                    type="radio">Enable
                                </label>
                                <label class="radio-inline">
                                    <input name="status" value="0" 
                                    @if($topic->status == 0)
                                    {{"checked"}}
                                    @endif
                                    type="radio">Disable
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Edit Topic</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
                @if(Auth::user()->level == 0 || Auth::user()->level == 1)
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Comment
                            <small>List</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    @if(session('notify'))
                    <div class="alert alert-success">
                        {{session('notify')}}
                    </div>
                    @endif
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Content</th>
                                <th>Vote</th>
                                <th>Date time</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topic->comment as $cm)
                            <tr class="odd gradeX" align="center">
                                <td>{{$cm->id}}</td>
                                <td>{{$cm->user->name}}</td>
                                <td>{{$cm->content}}</td>
                                <td>{{$cm->vote}}</td>
                                <td>{{$cm->created_at}}</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/delete/{{$cm->id}}/{{$topic->id}}"> Delete</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

@endsection

@section('script')
    <script type="text/javascript">
  $('select').select2();
</script>
@endsection