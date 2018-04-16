$(document).ready(function(){
    //tooltip for plus sign(adding post)
    $('[data-toggle="tooltip"]').tooltip();
    //in the textarea
    $('#writing').summernote({
        toolbar: [
            ["style", ["style"]],
            ["font", ["bold", "underline", "clear"]],
            ["fontname", ["fontname"]],
            ["color", ["color"]],
            ["para", ["ul", "ol", "paragraph"]],
            //["table", ["table"]],
            //["insert", ["link", "picture", "video"]],
            ["view", ["fullscreen"]]
        ]
    });
    $('#writingUpdate').summernote({
        toolbar: [
            ["style", ["style"]],
            ["font", ["bold", "underline", "clear"]],
            ["fontname", ["fontname"]],
            ["color", ["color"]],
            ["para", ["ul", "ol", "paragraph"]],
            //["table", ["table"]],
            //["insert", ["link", "picture", "video"]],
            ["view", ["fullscreen"]]
        ]
    });




    //adding post
    $("#addBtn").click(function(event){
        //getting all the values that the user has entered
        var title = $("#title").val();
        var writing = $("#writing").val();

        var category = $("#category").val();


        var tags =  $("#tags").val();
        var featured = $('#featured')[0].files[0];
        var _token = $('input[name=_token]').val();
        //appending all data to our form object
        form = new FormData();
        form.append('title',title);
        form.append('writing',writing);
        if(category !=='') {
         form.append('category', category);
        }
        form.append('featured',featured);
        form.append('_token',_token);
        form.append('tags',tags);
        //console.log(text);
         //ajax request to our store method
        $.ajax({
            url: '/posts',
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
               $("#postBox").load("http://www.completelaravel.com/posts/create #postBox > *");
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


        // $.post('/posts',form  ,function (data) {
        //     console.log(data);
        // });
    });
    //on clicking the update button we are filling the inputs from the update form with the data that we are getting from the server
    //because we are using dynamically generated elements we need on() function on document model
    $(document).on('click','.updateBtn',function(event){

        //preventing the default behaviour of <a> tag
        event.preventDefault();
        $(".errorsUpdate").html('');
        $(".errors").html('');
        //getting the id for the post that we clicked
        var id = $(this).attr("data-id");
        $("#id").val(id);
      //ajax request to server(edit method) and getting the result
      $.get('/posts/'+id+'/edit', {'id':id,'_token':$('input[name=_token]').val()} ,function (data) {

          //data from server
         console.log(data.content);
         //filling the title input
          $("#updateTitle").val(data.title);
          //showing the image from the post that we are editing
          $("#imageShown").attr('src',"/images/"+data.featured);
          //getting all the options from the category select menu
          var options = $("#categoryUpdate option");

          //storing all the id's from category option values in an array category_ids
          var category_ids = $.map(options ,function(option) {
              return option.value;
          });
          //getting category value for our select option from server data
          var cat_id = data.category.id;
          //console.log(cat_id);

          // giving selected attribute true value to the option value with same value with category value from the server
         category_ids.forEach(function(category_id){
          if(category_id == cat_id){
              var specificOption = $("#categoryUpdate option[value="+cat_id+"]")[0];
             specificOption.selected = true;
          }
         });

         //storing the id's from the server data tags values id's in an array tagsSelected
         var tagsSelected = $.map(data.tags ,function(tag) {
             return tag.id;
         });
         //console.log(tagsSelected);

          //// giving selected attribute true values to the option values tags which are same with tags id's from the server data(tagsSelected)
          $("#tagsUpdate").val(tagsSelected);

          var content = data.content;

           //must use this for inserting our code for summernote
          $("#writingUpdate").summernote('code',content);





        });
    });

    $("#saveUpdateBtn").click(function(){

        //getting all the values that the user has entered
        var title = $("#updateTitle").val();
        var writing = $("#writingUpdate").val();

        var category = $("#categoryUpdate").val();

         var id = $("#id").val();

        var tags =  $("#tagsUpdate").val();

        var featured = $('#featuredUpdate')[0].files[0];

        var _token = $('input[name=_token]').val();
        // appending all data to our form object
        form = new FormData();

        form.append('title',title);
        form.append('writing',writing);
        form.append('category', category);
        form.append('featured',featured);


        form.append('_token',_token);
        form.append('tags',tags);
        form.append('id',id);

        $.ajax({
            url: '/posts/update',
            data: form,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            success:function(response) {
                console.log(response);
                //hiding modal
                $('#myModalUpdate').modal('hide');
                //resetting form
                $("#updateForm")[0].reset();
                //loading only the table
                $("#postBox").load("http://www.completelaravel.com/posts/create #postBox > *");
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








    //resetting the errors field
    $(".reset").click(function(){
        $(".errors").html('');
    });



//{'title':title,'category':category,'tags':tags,'writing':writing,'_token':$('input[name=_token]').val()}

});