@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
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
                        <form action="admin/user/add" method="POST">
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="name" placeholder="Please Enter Name" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Please Enter Email" />
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Please Enter Password" />
                            </div>
                            <div class="form-group">
                                <label>PasswordAgain</label>
                                <input type="password" class="form-control" name="passwordAgain" placeholder="Please Enter Password Again" />
                            </div>
                            <div class="form-group">
                                <label>Level</label>
                                <label class="radio-inline">
                                    <input name="level" value="0" checked="" type="radio">Admin
                                </label>
                                <label class="radio-inline">
                                    <input name="level" value="1" type="radio">Moderate
                                </label>
                                <label class="radio-inline">
                                    <input name="level" value="2" type="radio">Author
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Register</button>
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