@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
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
                        <form action="admin/user/edit/{{$user->id}}" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="name" placeholder="Please Enter Name" value="{{$user->name}}" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Please Enter Email" value="{{$user->email}}" readonly="" />
                            </div>
                            <div class="form-group">
                            <input type="checkbox" name="changePassword" id="changePassword">
                                <label>Change Password</label>
                                <input type="password" class="form-control password" name="password" placeholder="Please Enter Password" disabled="" />
                            </div>
                            <div class="form-group">
                                <label>PasswordAgain</label>
                                <input type="password" class="form-control password" name="passwordAgain" placeholder="Please Enter Password Again" disabled="" />
                            </div>
                            @if(Auth::user()->level == 0)
                            <div class="form-group">
                                <label>Level</label>
                                <label class="radio-inline">
                                    <input name="level" value="0" 
                                    @if($user->level == 0)
                                    {{"checked"}}
                                    @endif
                                    type="radio">Admin
                                </label>
                                <label class="radio-inline">
                                    <input name="level" value="1" 
                                    @if($user->level == 1)
                                    {{"checked"}}
                                    @endif
                                    type="radio">Moderate
                                </label>
                                <label class="radio-inline">
                                    <input name="level" value="2" 
                                    @if($user->level == 2)
                                    {{"checked"}}
                                    @endif
                                    type="radio">Author
                                </label>
                            </div>
                            @endif
                            <button type="submit" class="btn btn-default">User Edit</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

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