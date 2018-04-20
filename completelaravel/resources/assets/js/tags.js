$(document).ready(function() {
    //tooltip for plus sign(adding category)
    $('[data-toggle="tooltip_tag"]').tooltip();

    //adding post
    $("#addBtnTag").click(function(event){
        //getting all the values that the user has entered
        var tag_name = $("#tag-name").val();
        console.log(tag_name);
        var _token = $('input[name =_token]').val();
        //appending all data to our form object
        //ajax request to our store method
        $.ajax({
            url: '/tags',
            data: {'tag_name':tag_name,'_token':_token},
            type: 'POST',
            success:function(response) {
                console.log(response);
                //loading table after success

                //hiding modal
                $('#myModal').modal('hide');
                //resetting form
                $("#createForm")[0].reset();
                //loading only the table
                $("#postBox").load("http://www.completelaravel.com/tags/create #postBox > *");
            },
            error: function(data) {
                //emptying the error div
                $(".errors").html('');
                //errors from controller@edit in json
                var errors = data.responseJSON;
                var x;
                //printing the errors on errors div(appending the error )
                for (x in errors){
                    $(".errors").append("<div class='alert alert-danger'>"+errors[x][0]+"</div>");
                }
                // Render the errors with js ...
            }
        });

    });


    //clicking on update link
    $(document).on('click','.updateTagBtn',function(event){

        //preventing the default behaviour of <a> tag
        event.preventDefault();
        $(".errorsUpdate").html('');
        $(".errors").html('');
        //getting the id for the post that we clicked
        var id = $(this).attr("data-id");
        $("#id").val(id);
        //ajax request to server(edit method) and getting the result
        $.get('/tags/'+id+'/edit', {'id':id,'_token':$('input[name=_token]').val()} ,function (data) {
            //data from server
            //console.log(data);
            //filling the title input
            $("#updateTag").val(data.tag_name);


        });
    });




    //clicking on save changes after update
    $("#saveUpdateTagBtn").on("click",function(){

        var id =$("#id").val();
        console.log(id);
        //getting all the values that the user has entered
        var tag_name = $("#updateTag").val();
        console.log(tag_name);
        var _token = $('input[name=_token]').val();
        // appending all data to our form object


        $.ajax({
            url: '/tags/update',
            data: {'id':id,'tag_name':tag_name,'_token': _token},
            type: 'POST',
            success:function(response) {
                console.log(response);
                //hiding modal
                $('#myModalUpdate').modal('hide');
                //resetting form
                $("#updateForm")[0].reset();
                //loading only the table
                $("#postBox").load("http://www.completelaravel.com/tags/create #postBox > *");
            },
            error: function(data) {
                //errors from controller@edit in json
                console.log(data);
                var errors = data.responseJSON;
                var x;
                //printing the errors on errors div(appending the error )
                for (x in errors){
                    $(".errorsUpdate").append("<div class='alert alert-danger'>"+errors[x][0]+"</div>");
                }
                // Render the errors with js ...
            }
        });


    });

    //deleting the movies row(frontend) after deleting it in the database
    $(document).on("click", ".confirmBtnDeleteTag", function(e) {
        e.preventDefault();
        // saving $(this)(clicked delete button) in variable so that we can use it in the callback function
        var id = $("#id").val();

        //using bootbox modal plugin
        // bootbox.prompt({
        //
        //     message: "Are you sure you want to delete this category?",
        //     buttons: {
        //         confirm: {
        //             label: 'Yes',
        //             className: 'btn-success'
        //         },
        //         cancel: {
        //             label: 'No',
        //             className: 'btn-danger'
        //         }
        //     },
        //     callback: function (result) {
        //         if (result === true) {
        //             //we are getting the value of the attribute from the button(a)
        //
        //             $.ajax({
        //                 url: "/categories/delete",
        //                 //we need to send the id of the movie to be deleted
        //                 data: {'id':id,'_token':$('input[name=_token]').val()},
        //                 type: "POST",
        //                 success: function (data) {
        //                     $("#postBox").load("http://www.completelaravel.com/categories/create #postBox > *");
        //                 }
        //             });
        //         }
        //     }
        // })


        var dialog = bootbox.dialog({

            message: "<p>Are you sure you want to delete this tag?</p>",
            buttons: {
                cancel: {
                    label: "No",
                    className: 'btn-danger',
                    callback: function(){
                        bootbox.hideAll();
                    }
                },
                ok: {
                    label: "Yes",
                    className: 'btn-success',
                    callback: function(){
                        //we are getting the value of the attribute from the button(a)
                        $.ajax({
                            url: "/tags/delete",
                            //we need to send the id of the movie to be deleted
                            data: {'id':id,'_token':$('input[name=_token]').val()},
                            type: "POST",
                            success: function (data) {
                                $("#postBox").load("http://www.completelaravel.com/tags/create #postBox > *");
                            },
                            error: function(data) {
                                console.log(data);
                            }
                        });
                        bootbox.hideAll();
                    }
                }
            }
        });




    });





});