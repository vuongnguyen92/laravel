@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
        @if(session('notify'))
                        <div class="alert alert-success">
                            {{session('notify')}}
                        </div>
                    @endif
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
            @if(Auth::user()->level == 0)
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">{{$user->where('level',3)->count()}}</div>
                                    <div>Total User!</div>
                                </div>
                            </div>
                        </div>
                        <a href="admin/user/list/user">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-edit fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">{{$topic->where('approvestatus',1)->count()}}</div>
                                    <div>Total Topic!</div>
                                </div>
                            </div>
                        </div>
                        <a href="admin/topic/list">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">{{$category->where('status',1)->count()}}</div>
                                    <div>Total Category!</div>
                                </div>
                            </div>
                        </div>
                        <a href="admin/category/list">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            @elseif(Auth::user()->level == 2)
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-edit fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">{{$topic->where('idUser',Auth::user()->id)->count()}}</div>
                                    <div>Total Topic!</div>
                                </div>
                            </div>
                        </div>
                        <a href="admin/topic/listauthor">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            @elseif(Auth::user()->level == 1)
                <div class="col-lg-4 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-edit fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">{{$topic->where('approvedby',Auth::user()->name)->count()}}</div>
                                    <div>Total Topic!</div>
                                </div>
                            </div>
                        </div>
                        <a href="admin/topic/listmoderate">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

            @endif
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Latest Posts
                            <div class="pull-right">
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tittle</th>
                                                    <th>ShortDescription</th>
                                                    <th>Author</th>
                                                    <th>Viewed</th>
                                                    <th>Detail</th>
                                                    <th>Edit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @if(Auth::user()->level == 0 || Auth::user()->level == 1)
                                            @foreach($topic1 as $tp)
                                                <tr>
                                                    <td>{{$tp->id}}</td>
                                                    <td>{{$tp->tittle}}</td>
                                                    <td>{{$tp->shortdescription}}</td>
                                                    <td>{{$tp->user->name}}</td>
                                                    <td>{{$tp->viewed}}</td>
                                                    <td class="center"><i class="fa fa-ellipsis-h  fa-fw"></i><a href="topic/{{$tp->id}}"> Detail</a></td>
                                                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/topic/edit/{{$tp->id}}">Edit</a></td>
                                                </tr>
                                            @endforeach
                                            @elseif(Auth::user()->level == 2)
                                            @foreach($topic2 as $tp)
                                                <tr>
                                                    <td>{{$tp->id}}</td>
                                                    <td>{{$tp->tittle}}</td>
                                                    <td>{{$tp->shortdescription}}</td>
                                                    <td>{{$tp->user->name}}</td>
                                                    <td>{{$tp->viewed}}</td>
                                                    <td class="center"><i class="fa fa-ellipsis-h  fa-fw"></i><a href="topic/{{$tp->id}}"> Detail</a></td>
                                                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/topic/edit/{{$tp->id}}">Edit</a></td>
                                                </tr>
                                            @endforeach    
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                                <div class="col-lg-8">
                                    <div id="morris-bar-chart"></div>
                                </div>
                                <!-- /.col-lg-8 (nested) -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-rocket fa-fw"></i> Top
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                            <div class="list-group">
                            @if(Auth::user()->level == 0 || Auth::user()->level == 1)
                                @foreach($topic_rating as $tp)
                                <a href="topic/{{$tp->id}}" class="list-group-item">
                                    <i class="fa fa-check fa-fw"></i> Topic vote
                                    <span class="pull-right text-muted small"><em>{{$tp->vote_count}} vote</em>
                                    </span>
                                </a>
                                @endforeach
                                @foreach($topicv as $tp)
                                <a href="topic/{{$tp->id}}" class="list-group-item">
                                    <i class="fa fa-search fa-fw"></i> Topic view
                                    <span class="pull-right text-muted small"><em>{{$tp->viewed}} view</em>
                                    </span>
                                </a>
                                @endforeach
                                @foreach($topiccmt as $tp)
                                <a href="topic/{{$tp->id}}" class="list-group-item">
                                    <i class="fa fa-comment fa-fw"></i> Topic comment
                                    <span class="pull-right text-muted small"><em>{{$tp->cmt_count}} comment</em>
                                    </span>
                                </a>
                                @endforeach
                            @elseif(Auth::user()->level == 2)    
                            @foreach($topic_rating1 as $tp)
                                <a href="topic/{{$tp->id}}" class="list-group-item">
                                    <i class="fa fa-check fa-fw"></i> Topic vote
                                    <span class="pull-right text-muted small"><em>{{$tp->vote_count}} vote</em>
                                    </span>
                                </a>
                                @endforeach
                                @foreach($topicv1 as $tp)
                                <a href="topic/{{$tp->id}}" class="list-group-item">
                                    <i class="fa fa-search fa-fw"></i> Topic view
                                    <span class="pull-right text-muted small"><em>{{$tp->viewed}} view</em>
                                    </span>
                                </a>
                                @endforeach
                                @foreach($topiccmt as $tp)
                                <a href="topic/{{$tp->id}}" class="list-group-item">
                                    <i class="fa fa-comment fa-fw"></i> Topic comment
                                    <span class="pull-right text-muted small"><em>{{$tp->cmt_count}} comment</em>
                                    </span>
                                </a>
                                @endforeach
                            @endif
                            <!-- /.list-group -->
                            </div>
                        </div>
                    </div>
                </div>
            @if(Auth::user()->level == 1)
            <div class="row">
                <div class="col-lg-8">
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Post Approve : Waiting
                            <div class="pull-right">
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Tittle</th>
                                                    <th>ShortDescription</th>
                                                    <th>Author</th>
                                                    <th>Viewed</th>
                                                    <th>Detail</th>
                                                    <th>Edit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($topic3 as $tp)
                                                <tr>
                                                    <td>{{$tp->id}}</td>
                                                    <td>{{$tp->tittle}}</td>
                                                    <td>{{$tp->shortdescription}}</td>
                                                    <td>{{$tp->user->name}}</td>
                                                    <td>{{$tp->viewed}}</td>
                                                    <td class="center"><i class="fa fa-ellipsis-h  fa-fw"></i><a href="topic/{{$tp->id}}"> Detail</a></td>
                                                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/topic/edit/{{$tp->id}}">Edit</a></td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                                <div class="col-lg-8">
                                    <div id="morris-bar-chart"></div>
                                </div>
                                <!-- /.col-lg-8 (nested) -->
                            </div>
                            <!-- /.row -->
                            @endif    
            </div>
        </div>

@endsection