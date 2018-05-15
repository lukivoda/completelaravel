<div class="col-lg-4">
    <div class="widget-sidebar">
        <h2 class="title-widget-sidebar">INFO</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odit modi voluptatibus, nobis reprehenderit, error recusandae aspernatur quia adipisci sint id corrupti sapiente suscipit, est accusantium ad natus consequuntur voluptates optio? <a href=""><span> Read more...</span></a></p>
    </div>
    <div class="widget-sidebar">
        <h2 class="title-widget-sidebar">RECENT POSTS</h2>
        <div class="content-widget-sidebar">
            <ul>
                @foreach($latest_posts as $post)
                <li class="recent-post">
                    <div class="post-img">
                        <img src="/images/{{$post->featured}}" class="img-responsive">
                    </div>
                    <a href="{{route("post.show",$post->slug)}}"><h5>{{$post->title}}</h5></a>
                    <p><small>{{$post->created_at->diffForHumans()}}</small></p>
                </li>
                <hr>
                @endforeach
            </ul>
        </div>
    </div>



    <!--=====================
           CATEGORIES
      ======================-->
    @if(Route::is('index'))
    <div class="widget-sidebar">
        <h2 class="title-widget-sidebar">CATEGORIES</h2>
        @foreach($categories as $category)
        <button data-id="{{$category->id}}" class="categories-btn">{{$category->name}}</button>
         @endforeach
    </div>

        <div class="widget-sidebar">
            <h2 class="title-widget-sidebar">POPULAR TAGS</h2>

            <p class="span_style">
                @foreach($tags as $tag)
                    <a href="{{route('tagged',$tag->name)}}"><span> {{$tag->name}}</span></a>
                @endforeach
            </p>

        </div>


     @endif







</div>