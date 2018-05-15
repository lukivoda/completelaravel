@include ("frontend.partials.navigation")



<div id="blog-section" >
    <div id="posts-box-index" class="container">
        <div style="margin:0" class="row">
            <div>
            <div class="col-lg-8">
                <div class="row">



                    <div class="single-post">
                        <div class="content-title">
                            <div class="text-center">
                                <h3><a href="#">{{$post->title}}</a></h3><br>

                                <img class="img-responsive single-post-image " src="/images/{{$post->featured}}" >

                            </div>
                            <br>
                            <div class="card-content-single ">
                                {!!$post->content!!}
                            </div>

                        </div>


                        <div class="content-footer">
                            <img class="img-circle single-post-avatar" src="{{asset('images/avatar5.png')}}">
                            <span style="font-size: 16px;color: #fff;">Admin</span>

				        <span  class="created ">{{$post->created_at->diffForHumans()}}</span>


                        </div>

                        <br>

                        <div class="widget w-tags">
                            <div class="tags-wrap">
                                <h4>Tags:</h4>
                            @foreach( $post_tags as $tag)
                                <a href="{{route("tagged",$tag->name)}}" class="w-tags-item">{{$tag->name}}</a>
                             @endforeach
                            </div>
                        </div>

                        <hr>

                    </div>

                    </div>




                </div>
            </div>

            <!--           // RECENT POST===========-->
    @include("frontend.partials.sidebar")
        </div>

    </div>
</section>

</div>



@include("frontend.partials.footer")