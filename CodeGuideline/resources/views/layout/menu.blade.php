<div class="row main-left">
            <div class="col-md-3 ">
                <ul class="list-group" id="menu">
                    <li href="#" class="list-group-item menu1 active">
                        Menu
                    </li>
                    @foreach($category as $ctg)
                    <li class="list-group-item menu1">
                    <a href="category/{{$ctg->id}}">{{$ctg->name}}</a>                        
                    </li>
                    @endforeach
                </ul>
            </div>  