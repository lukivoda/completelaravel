$(document).ready(function(){

    $('.modal').on('hidden.bs.modal', function () {
        $("input[type='file']").val('');
        $("#output").attr("src","");
    });

   // $("body").on("click","#plus,.upload-btn-wrapper",function(){
   //  $("#output").attr("src","");
   // }) ;


    $(document).on('click',"#plus",function(){
        $(".errors").html('');
    });

  $("#addAlbumBtn").click(function(){


    var albumName = $("#albumTitle").val();
    var _token = $('input[name=_token]').val();
    var description = $("#albumDescription").val();
    var  coverImage = $("#coverImage")[0].files[0];
    form = new FormData();
    form.append('albumName',albumName);
    form.append('_token',_token);
    form.append('description',description);
    form.append('coverImage',coverImage);

      $.ajax({
          url: '/albums',
          data: form,
          cache: false,
          contentType: false,
          processData: false,
          type: 'POST',
          success:function(response) {
              //console.log(response);
              //loading table after success

              //hiding modal
              $('#myModal').modal('hide');
              //resetting form
              $("#createForm")[0].reset();
              //loading only the table
              $("#albumBox").load("http://www.completelaravel.com/albums #albumBox > *");
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


    $("#addPhotoBtn").click(function(){
        var photoName = $("#photoName").val();
        var albumId = $("#albumId").val();
        var _token = $('input[name=_token]').val();
        var  photo = $("#photo")[0].files[0];
        form = new FormData();
        form.append('photoName',photoName);
        form.append('_token',_token);
        form.append('photo',photo);
        form.append('albumId',albumId);
        $.ajax({
            url: '/photos',
            data: form,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            success:function(response) {
                console.log(response);
                //loading table after success

                //hiding modal
                $('#myModal').modal('hide');
                //resetting form
                $("#createForm")[0].reset();
                //loading only the table
              $("#photoBox").load("http://www.completelaravel.com/albums/"+response+" #photoBox > *");
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



    $(document).on('click','.updateAlbumBtn',function(event){

        //preventing the default behaviour of <a> tag
        event.preventDefault();
        $(".errorsUpdate").html('');
        $(".errors").html('');
        $("#outputUpdate").hide();
        //getting the id for the post that we clicked
        var id = $(this).attr("data-id");
        $("#id").val(id);
        //ajax request to server(edit method) and getting the result
        $.get('/albums/'+id+'/edit', {'id':id,'_token':$('input[name=_token]').val()} ,function (data) {
            //data from server
            console.log(data);
            //filling the title input
            $("#updateAlbumTitle").val(data.name);
            //showing the image from the post that we are editing
            $("#imageShown").attr('src',"/images/"+data.cover_image);

            $("#updateAlbumDescription").val(data.description);
            });
    });

    $("#saveUpdateAlbumBtn").click(function(){

        //getting all the values that the user has entered
        var albumName = $("#updateAlbumTitle").val();
        var albumDescription = $("#updateAlbumDescription").val();

        var id = $("#id").val();

        var coverImage = $('#coverImageUpdate')[0].files[0];

        var _token = $('input[name=_token]').val();
        // appending all data to our form object
        form = new FormData();

        form.append('albumName',albumName);
        form.append('albumDescription',albumDescription);
        form.append('coverImage', coverImage);
        form.append('_token',_token);
        form.append('id',id);

        $.ajax({
            url: '/albums/update',
            data: form,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            success:function(response) {
                console.log(response);

                //hide the preview image
                $("#outputUpdate").hide();
                //hiding modal
                $('#myModalUpdate').modal('hide');
                //resetting form
                $("#updateForm")[0].reset();
                //loading only the table
                $("#albumBox").load("http://www.completelaravel.com/albums #albumBox > *");
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



    $(document).on("click", ".confirmBtnDeleteAlbum", function(e) {
        e.preventDefault();
        // saving $(this)(clicked delete button) in variable so that we can use it in the callback function
        var id = $("#id").val();

        //using bootbox modal plugin
        bootbox.hideAll();
        bootbox.confirm({
            message: "Are you sure you want to delete this album?",
            buttons: {
                confirm: {
                    label: 'Yes',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                if (result === true) {
                    //we are getting the value of the attribute from the button(a)

                    $.ajax({
                        url: "/albums/delete",
                        //we need to send the id of the movie to be deleted
                        data: {'id':id,'_token':$('input[name=_token]').val()},
                        type: "POST",
                        success: function (data) {
                            $("#albumBox").load("http://www.completelaravel.com/albums #albumBox > *");
                        }
                    });
                }
            }
        })
    });


    $(document).on("click", ".confirmBtnDeletePhoto", function(e) {
        e.preventDefault();
        // saving $(this)(clicked delete button) in variable so that we can use it in the callback function
        var id = $(this).attr('data-id');
        var albumId = $(this).attr('data-albumId');
          //console.log(id);
        //using bootbox modal plugin
        bootbox.hideAll();
        bootbox.confirm({
            message: "Are you sure you want to remove this photo from your album?",
            buttons: {
                confirm: {
                    label: 'Yes',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                if (result === true) {
                    //we are getting the value of the attribute from the button(a)

                    $.ajax({
                        url: "/photos/delete",
                        //we need to send the id of the movie to be deleted
                        data: {'id':id,'albumId':albumId,'_token':$('input[name=_token]').val()},
                        type: "POST",
                        success: function (data) {
                            $("#photoBox").load("http://www.completelaravel.com/albums/"+data+" #photoBox > *");
                        }
                    });
                }
            }
        })
    });


});