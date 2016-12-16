    @extends('layout.index')

    @section('content')
        <!-- Page Content -->
    <div class="container">
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-9">

                <!-- Blog Post -->

                <!-- Title -->
                <h1>{{$topic->tittle}}</h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">{{$topic->user->name}}</a>
                </p>

                <!-- Preview Image -->
                <img class="img-responsive" src="upload/tintuc/{{$topic->image}}" alt="">

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on {{$topic->created_at}}</p>
                <hr>

                <!-- Post Content -->
                <p class="lead">{{$topic->shortdescription}}</p>
                <p>{{$topic->content}}</p>

                <hr>
                <ul class="nav nav-pills" role="tablist">
                <li role="presentation" class="active"><a>Viewed <span class="badge">{{$topic->viewed}}</span></a></li>
                </ul>
                <hr>
                <!-- Blog Comments -->

                <!-- Comments Form -->
                @if(Auth::check())
                <div class="well">
                @if(session('notify'))
                    <div class="alert alert-success">
                        {{session('notify')}}    
                    </div>
                @endif


                    <h4>Comment ...<span class="glyphicon glyphicon-pencil"></span></h4>
                    <form role="form" action="comment/{{$topic->id}}" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="container">
    <div class="row lead">

        <div id="stars" class="starrr" ></div>

        <!-- You gave a rating of <span id="count">0</span> star(s) -->
        <input type="hidden" name="vote" id="count" value="">
    </div>
</div>

                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="content"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                @else
                <div class="alert alert-danger" >
                    <a href="login">Please login for comment</a>                            
                </div>           
                @endif

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->
                @foreach ($topic->comment as $comment)
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{$comment->user->name}}
                            <small>{{$comment->created_at}}</small>
                        </h4>
                        <p>{{str_ireplace($array, '****', $comment->content)}}</p>
                    </div>
                </div>
                @endforeach
            </div>
               
                <!-- Comment -->

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-3">

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Top vote</b></div>
                    <div class="panel-body">

                        <!-- item -->
                        @foreach($topic2 as $tp)
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="detail.html">
                                    <img class="upload/tintuc/{{$topic->image}}" alt="">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="topic/{{$tp->id}}"><b>{{$tp->tittle}}</b></a>
                            </div>
                            <p>{{$tp->shortdescription}}</p>
                            <div class="break"></div>
                        </div>
                        <!-- end item -->
                        @endforeach
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Top viewed</b></div>
                    <div class="panel-body">

                        <!-- item -->
                        @foreach($topic1 as $tp)
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="detail.html">
                                    <img class="upload/tintuc/{{$topic->image}}" alt="">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="topic/{{$tp->id}}"><b>{{$tp->tittle}}</b></a>
                            </div>
                            <p>{{$tp->shortdescription}}</p>
                            <div class="break"></div>
                        </div>
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

    @section('script')
    <script>
        // Starrr plugin (https://github.com/dobtco/starrr)
var __slice = [].slice;

(function($, window) {
  var Starrr;

  Starrr = (function() {
    Starrr.prototype.defaults = {
      rating: void 0,
      numStars: 5,
      change: function(e, value) {}
    };

    function Starrr($el, options) {
      var i, _, _ref,
        _this = this;

      this.options = $.extend({}, this.defaults, options);
      this.$el = $el;
      _ref = this.defaults;
      for (i in _ref) {
        _ = _ref[i];
        if (this.$el.data(i) != null) {
          this.options[i] = this.$el.data(i);
        }
      }
      this.createStars();
      this.syncRating();
      this.$el.on('mouseover.starrr', 'span', function(e) {
        return _this.syncRating(_this.$el.find('span').index(e.currentTarget) + 1);
      });
      this.$el.on('mouseout.starrr', function() {
        return _this.syncRating();
      });
      this.$el.on('click.starrr', 'span', function(e) {
        return _this.setRating(_this.$el.find('span').index(e.currentTarget) + 1);
      });
      this.$el.on('starrr:change', this.options.change);
    }

    Starrr.prototype.createStars = function() {
      var _i, _ref, _results;

      _results = [];
      for (_i = 1, _ref = this.options.numStars; 1 <= _ref ? _i <= _ref : _i >= _ref; 1 <= _ref ? _i++ : _i--) {
        _results.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"));
      }
      return _results;
    };

    Starrr.prototype.setRating = function(rating) {
      if (this.options.rating === rating) {
        rating = void 0;
      }
      this.options.rating = rating;
      this.syncRating();
      return this.$el.trigger('starrr:change', rating);
    };

    Starrr.prototype.syncRating = function(rating) {
      var i, _i, _j, _ref;

      rating || (rating = this.options.rating);
      if (rating) {
        for (i = _i = 0, _ref = rating - 1; 0 <= _ref ? _i <= _ref : _i >= _ref; i = 0 <= _ref ? ++_i : --_i) {
          this.$el.find('span').eq(i).removeClass('glyphicon-star-empty').addClass('glyphicon-star');
        }
      }
      if (rating && rating < 5) {
        for (i = _j = rating; rating <= 4 ? _j <= 4 : _j >= 4; i = rating <= 4 ? ++_j : --_j) {
          this.$el.find('span').eq(i).removeClass('glyphicon-star').addClass('glyphicon-star-empty');
        }
      }
      if (!rating) {
        return this.$el.find('span').removeClass('glyphicon-star').addClass('glyphicon-star-empty');
      }
    };

    return Starrr;

  })();
  return $.fn.extend({
    starrr: function() {
      var args, option;

      option = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
      return this.each(function() {
        var data;

        data = $(this).data('star-rating');
        if (!data) {
          $(this).data('star-rating', (data = new Starrr($(this), option)));
        }
        if (typeof option === 'string') {
          return data[option].apply(data, args);
        }
      });
    }
  });
})(window.jQuery, window);

$(function() {
  return $(".starrr").starrr();
});

$( document ).ready(function() {
      
  $('#stars').on('starrr:change', function(e, value){
    $('#count').val(value);
  });


  $('#stars-existing').on('starrr:change', function(e, value){
    $('#count-existing').html(value);
  });
});
    </script>
@endsection