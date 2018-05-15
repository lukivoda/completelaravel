@extends('layouts.master')


@section('content_title','Tags')

@section('content')
    <div class="col-lg-offset-3 col-lg-5">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">List of tags <span class='pull-right' data-toggle="tooltip_tag" title="Add tag"> <a id="plus" data-toggle="modal" data-target="#myModal" class="pull-right" href=""><i class="fa fa-plus "> </i></a></span></h3>
            </div>
            <div class="panel-body">
                <table   class="table table-hover">
                    <thead>
                    <tr>
                        <th>tag</th>
                    </tr>
                    </thead>
                    <tbody id="postBox" >

                    @foreach($tags as $tag)
                        <tr>
                            <td>{{$tag->name}}</td>
                            <td  class=""><a  data-target="#myModalUpdate" data-toggle="modal"  data-id="{{$tag->id}}" class="btn btn-warning btn-sm updateTagBtn pull-right "  href="#">Update</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal with form for inserting records -->
    <div  class="modal fade " id="myModal"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Create tag</h4>
                </div>
                <div class="modal-body">
                    <div class="errors">

                    </div>

                    <form id="createForm" >

                        {{csrf_field()}}

                        <div class="form-group">

                            <label for="tag-name">Add tag: </label>

                            <input id="tag-name" type="text" name="tag-name" class="form-control">

                        </div>

                        <div class="modal-footer">
                            <div class="form-group">
                                <div class="pull-right">
                                    <button type="reset" class="btn btn-default reset" data-dismiss="modal">Close</button>
                                    <button type="button" id="addBtnTag" class="btn btn-primary" >Save changes</button>
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
                    <h4 class="modal-title" id="myModalLabel">Update tag</h4>
                </div>
                <div class="modal-body">
                    <div class="errorsUpdate"></div>

                    <form  id="updateForm">

                        {{csrf_field()}}



                        <div class="form-group">

                            <label for="updateTag">Update tag: </label>

                            <input id="updateTag" type="text" name="updateTag" class="form-control">

                        </div>
                        <input type="hidden" id="id" value="">

                        <div class="modal-footer">
                            <div class="form-group">
                                <div class="pull-right">
                                    <a type="button" class="confirmBtnDeleteTag  btn btn-danger reset" data-dismiss="modal">Delete</a>
                                    <button type="button" id="saveUpdateTagBtn" class="btn btn-primary" >Save changes</button>
                                </div>
                            </div>
                        </div>

                    </form>



                </div>
            </div>
        </div>
    </div>

@stop