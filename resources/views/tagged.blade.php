@include("frontend.partials.navigation")

<!-- Slider start -->

<!-- End of slider -->





<section id="blog-section" >
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">


                    <div id="posts-box-index">
                        <h1 style="margin-bottom:20px;" class="text-center">Tag: {{$tag->name}}</h1>
                        <div class="infinite-scroll"  >

                            @foreach( $posts as $post)
                                <div  class="col-lg-6 col-md-6">
                                    <aside  class="post-index">
                                        <div class="tile-image">
                                            <p class="category-tile">{{$post->category->name}}</p>
                                            <img  src="/images/{{$post->featured}}" class="img-responsive post-image">
                                        </div>
                                        <div class="content-title">
                                            <div class="text-center">
                                                <h3><a href="{{route('post.show',$post->slug)}}">{{$post->title}}</a></h3>
                                            </div>
                                            <hr>
                                            <div class="card-content">

                                                {!! str_limit(strip_tags($post->content), $limit = 30, $end = '...')  !!}

                                            </div>
                                        </div>
                                        <div class="content-footer">
                                            <img width="40" class="img-rounded" src="{{asset('images/avatar5.png')}}">
                                            <span style="font-size: 16px;color: #fff;">{{$name}}</span>
                                            <span class="pull-right">
				<span class="created">{{$post->created_at->diffForHumans()}}</span>
				</span>
                                        </div>
                                    </aside>
                                </div>

                            @endforeach
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
            </div>

            <!--           // RECENT POST===========-->
            @include("frontend.partials.sidebar")
        </div>
    </div>

</section>
@include("frontend.partials.footer")