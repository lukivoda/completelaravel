@extends('layouts.master')


@section('content_title','Posts')

@section('content')
    <div class="col-lg-offset-3 col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">List of posts <span class='pull-right' data-toggle="tooltip" title="Add post"> <a  data-toggle="modal" data-target="#myModal" class="pull-right" href=""><i class="fa fa-plus "> </i></a></span></h3>
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th >Type</th>
                        <th>Column heading</th>
                        <th >Column heading</th>
                        <th>Column heading</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td class="ourItem" data-toggle="modal" data-target="#myModal" >Light</td>
                        <td class="ourItem" data-toggle="modal" data-target="#myModal" >Column content</td>
                        <td class="ourItem" data-toggle="modal" data-target="#myModal" >Column content</td>
                        <td class="ourItem" data-toggle="modal" data-target="#myModal" >Column content</td>
                    </tr>

                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    Some content
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


@stop