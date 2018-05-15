 $(document).ready(function(){

     $('#search').autocomplete({

         source: "/autocomplete",
             //the autocomplete results as links
         select:function(e,ui){
            location.href = "/post/"+ui.item.slug;
         }

     });



         $('[data-toggle="tooltip"]').tooltip(); 

           $('#mogo-slider').carousel({
    		interval: 3000
});

     $(document).on('mouseenter',".tile-image",function(){
         $(this).find(".category-tile").stop().fadeIn();
     });

     $(document).on('mouseleave',".tile-image",function(){
         $(this).find(".category-tile").stop().fadeOut()
     });



         // .mouseleave(function(){
         //     $(this).find(".category-tile").stop().fadeOut();
         // });

     $('ul.pagination').hide();
     $(function() {
         $('.infinite-scroll').jscroll({
             autoTrigger: true,
             loadingHtml: '<img class="center-block" src="/images/loading.gif" alt="Loading..." />',
             padding: 0,
             nextSelector: '.pagination li.active + li a',
             contentSelector: 'div.infinite-scroll',
             callback: function() {
                 $('ul.pagination').remove();
             }
         });
     });


       $(".categories-btn").click(function(){
           $("#posts-box-index").empty();
           $("#posts-box-index").append('<img style="display:block;margin:50% auto"  src="/images/loading.gif" alt="Loading..." />');
           var category_id = $(this).attr('data-id');
           var category_name = $(this).text();
           $.ajax({
               url: '/category_posts',
               data: {"category_id": category_id},
               type: 'GET',
               success:function(response) {

                   //console.log(response.data);
                   $("#posts-box-index").empty();
                   $("#posts-box-index").html("<h1 style='padding-bottom: 10px' class='text-center'>Category:"+category_name+"</h1>");
                   $.each(response.data,function(index,object){
                       console.log(object);
                       var content = stripHtml(object.content);
                      $("#posts-box-index").append("<div class=\"col-lg-6 col-md-6\">\n" +
                          "                        <aside class=\"post-index\">\n" +
                          "                            <div class=\"tile-image\">\n" +
                          "                            <p class=\"category-tile\">"+category_name+"</p>\n" +
                          "<img  src='/images/" +object.featured+"' class='img-responsive post-image'\>"+
                          "                            </div>" +
                          "                            <div class=\"content-title\">\n" +
                          "                                <div class=\"text-center\">\n" +
                          "                                    <h3><a href=\"#\">"+object.title+"</a></h3>\n" +
                          "                                </div>\n" +
                          "                                <hr>\n" +
                          "                                <div class=\"card-content\">\n" +content.substring(0,30)+"..."+
                          "\n" +
                          "                                </div>\n" +
                          "                            </div>\n" +
                          "                            <div class=\"content-footer\">\n" +
                          "                                <img width=\"40\" class=\"img-rounded\" src=\"http://www.completelaravel.com/images/avatar5.png\">\n" +
                          "                                <span style=\"font-size: 16px;color: #fff;\">Markus Johns</span>\n" +
                          "                                <span class=\"pull-right\">\n" +
                          "\t\t\t\t<span class=\"created\">posted: 23 hours ago</span>\n" +
                          "\t\t\t\t</span>\n" +
                          "                            </div>\n" +
                          "                        </aside>\n" +
                          "                    </div>\n" +
                          "                            ");
                   });

               },
               error: function(data) {
                   var errors = data.responseJSON;
               }
           });


       });








         $("#searchBtn").click(function (e) {
             e.preventDefault();
             var current_location = window.location;
             var searchTerm = $("#search").val();
             var _token = $('input[name=_token]').val();

                  $.ajax({
                      url: "/search",
                      type: "POST",
                      data: {"searchTerm": searchTerm, "_token": _token},
                      success: function (response) {

                          if(current_location == "http://www.completelaravel.com/") {
                              console.log(response);
                              $("#posts-box-index").empty();
                              $.each(response, function (index, object) {
                                  var content = stripHtml(object.content);
                                  console.log(object);
                                  $("#posts-box-index").append("<div class=\"col-lg-6 col-md-6\">\n" +
                                      "                        <aside class=\"post-index\">\n" +
                                      "                            <div class=\"tile-image\">\n" +
                                      "                            <p class=\"category-tile\">" + object.category_name + "</p>\n" +
                                      "<img  src='/images/" + object.featured + "' class='img-responsive post-image'\>" +
                                      "                            </div>" +
                                      "                            <div class=\"content-title\">\n" +
                                      "                                <div class=\"text-center\">\n" +
                                      "                                    <h3><a href=" + '/post/' + object.slug + ">" + object.title + "</a></h3>\n" +
                                      "                                </div>\n" +
                                      "                                <hr>\n" +
                                      "                                <div class=\"card-content\">\n" + content.substring(0, 30) + "..." +
                                      "\n" +
                                      "                                </div>\n" +
                                      "                            </div>\n" +
                                      "                            <div class=\"content-footer\">\n" +
                                      "                                <img width=\"40\" class=\"img-rounded\" src=\"http://www.completelaravel.com/images/avatar5.png\">\n" +
                                      "                                <span style=\"font-size: 16px;color: #fff;\">Markus Johns</span>\n" +
                                      "                                <span class=\"pull-right\">\n" +
                                      "\t\t\t\t<span class=\"created\">posted: 23 hours ago</span>\n" +
                                      "\t\t\t\t</span>\n" +
                                      "                            </div>\n" +
                                      "                        </aside>\n" +
                                      "                    </div>");
                              });

                          }else {
                              $("#blog-section").empty();
                              $("#blog-section").addClass('container');
                              $.each(response, function (index, object) {
                                  var content = stripHtml(object.content);
                                  console.log(object);
                                  $("#blog-section").append(
                                      " <div class=\"col-lg-4 col-md-4\">\n" +
                                      "                        <aside class=\"post-index\">\n" +
                                      "                            <div class=\"tile-image\">\n" +
                                      "                            <p class=\"category-tile\">" + object.category_name + "</p>\n" +
                                      "<img  src='/images/" + object.featured + "' class='img-responsive post-image'\>" +
                                      "                            </div>" +
                                      "                            <div class=\"content-title\">\n" +
                                      "                                <div class=\"text-center\">\n" +
                                      "                                    <h3><a href=" + '/post/' + object.slug + ">" + object.title + "</a></h3>\n" +
                                      "                                </div>\n" +
                                      "                                <hr>\n" +
                                      "                                <div class=\"card-content\">\n" + content.substring(0, 30) + "..." +
                                      "\n" +
                                      "                                </div>\n" +
                                      "                            </div>\n" +
                                      "                            <div class=\"content-footer\">\n" +
                                      "                                <img width=\"40\" class=\"img-rounded\" src=\"http://www.completelaravel.com/images/avatar5.png\">\n" +
                                      "                                <span style=\"font-size: 16px;color: #fff;\">Markus Johns</span>\n" +
                                      "                                <span class=\"pull-right\">\n" +
                                      "\t\t\t\t<span class=\"created\">posted: 23 hours ago</span>\n" +
                                      "\t\t\t\t</span>\n" +
                                      "                            </div>\n" +
                                      "                        </aside>\n" +
                                      "                   </div>");
                              });
                          }
                      },
                      error: function (data) {

                          var errors = data.responseJSON;
                          //console.log(errors);
                          var x;
                          //printing the errors on errors div(appending the error )
                          for (x in errors) {
                              $(".errorSearch").html("<div style='background-color: #fff;padding:3px;'>" + errors[x][0] + "</div>");
                          }
                      }
                  })


         })






     //Functions
     function stripHtml(html){
         // Create a new div element
         var temporalDivElement = document.createElement("div");
         // Set the HTML content with the providen
         temporalDivElement.innerHTML = html;
         // Retrieve the text property of the element (cross-browser support)
         return temporalDivElement.textContent || temporalDivElement.innerText || "";
     }





     $(".album-click").click(function(){
         $(this).parent().hide();
         var id =  $(this).find(".album-link").attr('data-id');
         console.log(id);
         $.get('/gallery/photos/', {'id':id} ,function (data) {

             //data from server
             console.log(data);
             if(data.length !== 0 ) {


                 var albumName = data[0].albumName;
                 console.log(albumName);
                 var output = '';

                 $.each(data, function (index, object) {

                     output += "<a href=" + "'/images/" + object.photo + "'  title='" + object.name + "'>" +
                         " <img width='100' src='/images/" + object.photo + "' ></a>";


                 });
                 $("#links").append(output);
                 $("#links").fadeIn(1000);
                 $(".albumName").text(albumName);
                 console.log(output);
             }else{
                 $(".albumName").text('No photos in this album');
             }
             // giving selected attribute true value to the option value with same value with category value from the server
             // category_ids.forEach(function(category_id){
             //     if(category_id == cat_id){
             //         var specificOption = $("#categoryUpdate option[value="+cat_id+"]")[0];
             //         specificOption.selected = true;
             //     }
             // });
             });
         // $(this).parent().next().fadeIn(1000);
     });


     document.getElementById('links').onclick = function (event) {
         event = event || window.event;
         var target = event.target || event.srcElement,
             link = target.src ? target.parentNode : target,
             options = {index: link, event: event},
             links = this.getElementsByTagName('a');
         blueimp.Gallery(links, options);
     };

         });
























