@extends('layouts.master')


@section('content_title',$album->name)

@section('content')
    <div class="col-lg-offset-2 col-lg-7">
        <div class="panel panel-default">
            <div style="overflow: hidden" class="panel-heading">
                <h3 class=" pull-left panel-title "></h3>
                <div class="upload-btn-wrapper pull-right" data-toggle="modal" data-target="#myModal" >
                    <button class="btn">Upload photo to album</button>
                    {{--<input type="file" name="myfile" />--}}
                </div>
            </div>
            <div class="panel-body">


                <div class="row">
                    <ul id="photoBox" class="list-group">



                        @foreach($photos as $photo)
                            <li  class="col-sm-6 col-md-4 list-group-item">
                                <h3 >{{$photo->name}} <a data-albumId="{{$album->id}}" data-id="{{$photo->id}}" class="confirmBtnDeletePhoto   pull-right btn btn-danger btn-xs" href="">Remove</a></h3>

                                <p><img class="cardImg"  src="{{asset('images/'.$photo->photo)}}" alt=""></p>


                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>
        </div>
    </div>

    <div  class="modal fade " id="myModal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add photo</h4>
                </div>
                <div class="modal-body">
                    <div class="errors">

                    </div>

                    <form id="createForm" >

                        <input type="hidden" id="albumId" value="{{$album->id}}">

                        {{csrf_field()}}

                        <div class="form-group">

                            <label for="photoName">Add photo name: </label>

                            <input id="photoName" type="text" name="photoName" class="form-control">

                        </div>

                        <div class="form-group">

                            <label for="photo">Photo</label>

                            <input type="file" id="photo" name="photo" class="form-control" accept="image/*" onchange="loadFile(event)">
                            <img width="100" id="output"/>

                        </div>

                        <div class="modal-footer">
                            <div class="form-group">
                                <div class="pull-right">
                                    <button type="reset" class="btn btn-default reset" data-dismiss="modal">Close</button>
                                    <button type="button" id="addPhotoBtn" class="btn btn-primary" >Save changes</button>
                                </div>
                            </div>
                        </div>

                    </form>



                </div>
            </div>
        </div>
    </div>

@stop