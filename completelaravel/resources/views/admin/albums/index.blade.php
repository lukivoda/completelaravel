@extends('layouts.master')


@section('content_title','Albums')

@section('content')
    <div class="col-lg-offset-2 col-lg-7">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title ">List of albums <span class='pull-right' data-toggle="tooltip" title="Add album"> <a id="plus" data-toggle="modal" data-target="#myModal" class="pull-right" href=""><i id="plus" class="fa fa-plus "> </i></a></span></h3>
            </div>
            <div class="panel-body">


                      <div class="row">
                          <ul id="albumBox" class="list-group ">

                 @foreach($albums as $album)
                        <li  class="col-sm-6 col-md-4 list-group-item element ">
                            <h4 style="overflow: hidden">  <a  class="pull-left" href="{{route("albums.show",$album->id)}}">{{$album->name}}</a> <a href="" data-id="{{$album->id}}" data-target="#myModalUpdate"  data-toggle="modal" class=" pull-right btn btn-xs btn-warning updateAlbumBtn" href="">update  </a>
                                 </h4>
                            <hr>
                            {{--<p  class="text-center"><a  data-target="#myModalUpdate" data-toggle="modal"  data-id="4" class="btn btn-warning btn-sm updateAlbumBtn pull-right "  href="#">Update</a></p>--}}
                            <div class="coverBox"><a href="{{route("albums.show",$album->id)}}"><img  class="cardImg" src="{{asset('images/'.$album->cover_image)}}" alt=""></a>

                            </div>
                            <br>
                            <p style="font-style: italic;overflow:hidden;" class="">{{str_limit($album->description, $limit = 30, $end = '...')}}</p>

                        </li>

                  @endforeach

                          </ul>

                    </div>

            </div>
        </div>
    </div>

    <!-- Modal with form for inserting records -->
    <div  class="modal fade " id="myModal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Create album</h4>
                </div>
                <div class="modal-body">
                    <div class="errors">

                    </div>

                    <form id="createForm">

                        {{csrf_field()}}

                        <div class="form-group">

                            <label for="albumTitle">Name: </label>

                            <input id="albumTitle" type="text" name="albumTitle" class="form-control">

                        </div>

                        <div class="form-group">

                            <label for="albumDescription">Description: </label>

                            <input id="albumDescription" type="text" name="albumDescription" class="form-control">

                        </div>

                        <div class="form-group">

                            <label for="coverImage">Cover image</label>


                            <input type="file" id="coverImage" name="coverImage" class="form-control" accept="image/*" onchange="loadFile(event)">
                            <img width="100" id="output"/>

                        </div>


                        <div class="modal-footer">
                            <div class="form-group">
                                <div class="pull-right">
                                    <button type="reset" class="btn btn-default reset" data-dismiss="modal">Close</button>
                                    <button type="button" id="addAlbumBtn" class="btn btn-primary" >Save changes</button>
                                </div>
                            </div>
                        </div>

                    </form>



                </div>
            </div>
        </div>
    </div>

    <div  class="modal fade " id="myModalUpdate"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog admin-modal modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Update album</h4>
                </div>
                <div class="modal-body">
                    <div class="errorsUpdate"></div>

                    <form  id="updateForm">

                        {{csrf_field()}}



                        <div class="form-group">

                            <label for="title">Update album title: </label>

                            <input id="updateAlbumTitle" type="text" name="updateAlbumTitle" class="form-control">

                        </div>

                        <div class="form-group">

                            <label for="updateAlbumDescription">Update album description: </label>

                            <input id="updateAlbumDescription" type="text" name="updateAlbumDescription" class="form-control">

                        </div>

                        <input type="hidden" id="id" value="">


                        <div class="form-group">

                            <label for="coverImageUpdate">Cover image</label><br>
                            <input type="file" id="coverImageUpdate" name="coverImageUpdate" class="form-control" accept="image/*" onchange="loadFileUpdate(event)" >
                            <img id="imageShown"  width="100" height="100" src="" alt="">
                            <img id="outputUpdate" style="display:none" width="100" height="100">

                        </div>

                        <div class="modal-footer">
                            <div class="form-group">
                                <div class="pull-right">
                                    <a type="button" class="confirmBtnDeleteAlbum confirm btn btn-danger reset" data-dismiss="modal">Delete</a>
                                    <button type="button" id="saveUpdateAlbumBtn" class="btn btn-primary" >Save changes</button>
                                </div>
                            </div>
                        </div>

                    </form>



                </div>
            </div>
        </div>
    </div>

@stop