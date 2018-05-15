@extends('layouts.master')


@section('content_title','Posts')

@section('content')
    <div class="col-lg-offset-2 col-lg-7">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">List of posts <span class='pull-right' data-toggle="tooltip" title="Add post"> <a id="plus" data-toggle="modal" data-target="#myModal" class="pull-right" href=""><i class="fa fa-plus "> </i></a></span></h3>
            </div>
            <div class="panel-body">
            <div id="post_container">
              @include("admin.partials.presult")
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
                    <h4 class="modal-title" id="myModalLabel">Create post</h4>
                </div>
                <div class="modal-body">
                    <div class="errors">

                    </div>

                    <form id="createForm"  enctype="multipart/form-data">

                        {{csrf_field()}}

                        <div class="form-group">

                            <label for="title">Title: </label>

                            <input id="title" type="text" name="title" class="form-control">

                        </div>

                        <div class="form-group">

                            <label for="featured">Featured image</label>


                            <input type="file" id="featured" name="featured" class="form-control" accept="image/*" onchange="loadFile(event)">
                            <img width="100" id="output"/>

                        </div>


                        <div class="form-group">

                            <label for="category">Category</label>
                            <select class="form-control" name="category_id" id="category">
                                <option value=''>Select category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}"  >{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="tags">Tags (use CTRL button)</label>
                            <select id="tags" name="tags[]" multiple="" class="form-control">

                                @foreach($tags as $tag)
                                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea  class="form-control" name="content" id="writing"></textarea>
                        </div>
                        <div class="modal-footer">
                        <div class="form-group">
                             <div class="pull-right">
                                <button type="reset" class="btn btn-default reset" data-dismiss="modal">Close</button>
                                <button type="button" id="addBtn" class="btn btn-primary" >Save changes</button>
                             </div>
                        </div>
                        </div>

                    </form>



                </div>
            </div>
        </div>
    </div>

    <!-- Modal with form for updating records -->
    <div  class="modal fade " id="myModalUpdate"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog admin-modal modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Update post</h4>
                </div>
                <div class="modal-body">
                    <div class="errorsUpdate"></div>

                    <form  id="updateForm" enctype="multipart/form-data">

                        {{csrf_field()}}



                        <div class="form-group">

                            <label for="title">Title: </label>

                            <input id="updateTitle" type="text" name="title" class="form-control">

                        </div>
                        <input type="hidden" id="id" value="">
                        <div class="form-group">

                            <label for="featured">Featured image</label><br>

                            <input type="file" id="featuredUpdate" name="featured" class="form-control" accept="image/*" onchange="loadFileUpdate(event)"  >
                            <img id="imageShown"  width="100" height="100" src="" alt="">
                            <img id="outputUpdate" style="display:none" width="100" height="100">

                        </div>


                        <div class="form-group">

                            <label for="category">Category</label>
                            <select class="form-control" name="category_id" id="categoryUpdate">
                                @foreach($categories as $category)
                                    <option class="optionUpdate" value="{{$category->id}}"  >{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="tags">Tags (use CTRL button)</label>
                            <select id="tagsUpdate" name="tags[]" multiple="" class="form-control">

                                @foreach($tags as $tag)
                                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="writingUpdate">Content</label>
                            <textarea  class="form-control" name="content" id="writingUpdate"></textarea>
                        </div>
                        <div class="modal-footer">
                            <div class="form-group">
                                <div class="pull-right">
                                    <a type="button" class="confirm btn btn-danger reset" data-dismiss="modal">Delete</a>
                                    <button type="button" id="saveUpdateBtn" class="btn btn-primary" >Save changes</button>
                                </div>
                            </div>
                        </div>

                    </form>



                </div>
            </div>
        </div>
    </div>

@stop