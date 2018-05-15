@include ("frontend.partials.navigation")



<div id="blog-section" >
    <div id="posts-box-index" class="container">
        <div style="margin:0" class="row">
            <div>
                <div class="col-lg-8">
                    <h2 class="text-center albumName">Albums</h2>
                    <div class="row">

                        <div class="album">

                            <div class="album-buttons">

                                {{--<a href="#" class="active all" data-group="all">All</a>--}}
                                @foreach($albums as $album)
                                    <div class="album-click ">
                                    <img width="200" height="200" class="img-rounded" src="images/{{$album->cover_image}}" alt="">
                                <div class="album-link  text-center" href="#" data-id="{{$album->id}}">{{$album->name}}</div>
                            </div>
                                    @endforeach




                            </div>
                            <div id="links">

                            </div>



                        </div>



                    </div>




                </div>








                <!-- The Gallery as lightbox dialog, should be a child element of the document body -->
                <div id="blueimp-gallery" class="blueimp-gallery">
                    <div class="slides"></div>
                    <h3 class="title"></h3>
                    <a class="prev">‹</a>
                    <a class="next">›</a>
                    <a class="close">×</a>
                    <a class="play-pause"></a>
                    <ol class="indicator"></ol>
                </div>
            </div>

            <!--           // RECENT POST===========-->
            @include("frontend.partials.sidebar")
        </div>

    </div>
    </section>

</div>



@include("frontend.partials.footer")