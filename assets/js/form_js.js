function update_profile() {
    var datastring = $("#update_profile_form").serialize();
    $.ajax({
        type: "POST",
        url: "profile/update",
        data: datastring,
        success: function (data) {
            var obj = jQuery.parseJSON(data);
            if (jQuery.isEmptyObject(obj.error)) {
                $('.close').trigger('click');
                $('#profile_form_success').fadeIn(2000);
                setTimeout(function() { 
                   $('#profile_form_success').fadeOut(2000)
                }, 3000); 
            } else {
                $('#profile_form_error').html('');
                $('#profile_form_error').append(obj.error);
                $('#profile_form_error').show('slow');
                
            }
        }
    });
}

//------------------------------------------------------------//

function portfolio(){
    var portfolio = new FormData($("form#portfolio_form")[0]);
        $.ajax({
            type: "POST",
            url: "profile/portfolio",
            data: portfolio,
            cache: false,
            processData: false,
            contentType: false,
            success: function(data) {
               var obj = jQuery.parseJSON(data);
            if (jQuery.isEmptyObject(obj.error)) {
                $('.close').trigger('click');
                $('#portfolio_form_success').fadeIn(2000);
                 var htm = '<a rel="prettyPhoto[pp_gal]" href="'+obj.img+'" class="preview">'
                              +'<img alt="'+obj.des+'" src="'+obj.img+'" width="230" style="padding-bottom: 5px">';
                          +'</a>';
                $('#example-1').append(htm);
                setTimeout(function() { 
                   $('#portfolio_form_success').fadeOut(2000)
                }, 3000);
                
            } else {
                $('#portfolio_form_error').html('');
                $('#portfolio_form_error').append(obj.error);
                $('#portfolio_form_error').show('slow');
            }
            }
        });
}
//------------------------------------------------------------//

function portfolio_html(){
    $.ajax({
            type: "get",
            url: "profile/portfolio",
            success: function(data) {
                 $('#example-1').html(data);
                 $('#example-1').show('slow');
            }
        });
}
//------------------------------------------------------------//

//  ****** search job ***********//
function search_job(){
    var title = $("#search_job_box").val();
    $.ajax({
        url : 'search_job',
        type : 'post',
        data : {'title' : title},
        success : function(result){
            $('.loading').hide();
            var obj = jQuery.parseJSON(result);
            $("#jobsContainer").fadeOut('slow', function () {
                $(".total_jobs").html(obj.total_jobs);
                $("#jobsContainer").html(obj.html);
                $("#jobsContainer").fadeIn('slow');
            });
        }
    })
}
//------------------------------------------------------------//

function hourlies(){
    var hourlies = new FormData($("form#hourlies_form")[0]);
        $.ajax({
            type: "POST",url: "profile/hourlies",data: hourlies,cache: false,processData: false,contentType: false,
            success: function(data) {
               var obj = jQuery.parseJSON(data);
                if (jQuery.isEmptyObject(obj.error)) {
                    $('.close').trigger('click');
                    $('#hourlies_form_success').fadeIn(2000);
                     var htm = '<div class="col-md-3" style="padding-top:11px"><img title="'+obj.des+'" src="'+obj.img+'" width="200" height="151" style="padding-bottom: 5px"></div>';
                    $('#hourliesDiv').append(htm);
                    setTimeout(function() { 
                       $('#hourlies_form_success').fadeOut(2000)
                    }, 3000);

                } else {
                    $('#hourlies_form_error').html('');
                    $('#hourlies_form_error').append(obj.error);
                    $('#hourlies_form_error').show('slow');
                }
            }
        });
}
//------------------------------------------------------------//

jQuery(document).ready(function($){
    $('[data-toggle="tooltip"]').tooltip();
    
    //************Change profile image**************//
    $('#profile_image').change(function(){
        var profile_data = new FormData($("form#profile_image_form")[0]);
        $.ajax({
            type: "POST",
            url: "profile/update",
            data: profile_data,
            cache: false,
            processData: false,
            contentType: false,
            success: function(data) {
                $('.profile-image').attr("src", data);
            }
        });
    })
//------------------------------------------------------------//
    
    
    //************Change cover image**************//
     $('#cover_image').change(function(){
        var cover_data = new FormData($("form#cover_image_form")[0]);
        $.ajax({
            type: "POST",
            url: "profile/cover_image",
            data: cover_data,
            cache: false,
            processData: false,
            contentType: false,
            success: function(data) {
                $('#cover-image-div').css("background-image", "url('"+data+"')");
            }
        });
    })
//------------------------------------------------------------//
    
    
    //************get subcategory**************//
     $('#job_category').change(function(){
        var category = $(this).val();
        $.ajax({
            type: "POST",
            url: "get_subcategory",
            data: {'category' : category},
            success: function(data) {
                if(data != ''){
                    $('#job_subcategory').prop('disabled', false);
                    $('#job_subcategory').html(data);
                }else{
                    $('#job_subcategory').html('<option> Subcategory </option>  ');
                    $('#job_subcategory').prop('disabled', 'disabled');
                }
            }
        });
    })
//------------------------------------------------------------//
    
    
//***********changing the experince level color***************//
   $('.experience_panel').click(function(){
       var id = $(this).attr('id');
       var dom = '#'+id+' > .panel-heading';
       var value = $(this).data('value')
       //**removing class and color****//
       $('.panel.panel-primary.experience_panel .panel-heading').removeClass('experience_level_heading_selected')
       $(".panel").css('background-color', 'white');
       $('.panel.panel-primary.experience_panel .panel-heading > p').css('color', '#7a7a7a');
       
       //**adding class and color****//
       $(dom).addClass('experience_level_heading_selected');
       $(this).css('background-color', '#e6e6e6');
       $(dom+' > p').css('color', 'white');
       $('input[name="job[level]"]').val(value);
   });
//------------------------------------------------------------//
   
   
   
   // *********** jobs pagination***///
     $('.pagination li a').click(function(){
        $('.pagination li a').removeClass('nav-active');    
        $(this).addClass('nav-active')
            var page = $(this).text();
             $('.loading').show();
            // ************* Sorting with Experince Level ***********//
            var level1 = $('input[name="level1"]:checked').val();
            var level2 = $('input[name="level2"]:checked').val();
            var level3 = $('input[name="level3"]:checked').val();
            var level = level1+','+level2+','+level3;
            level = level.replace('undefined,', '');
            level = level.replace('undefined', '');
            level = level.replace(',undefined', '');
            var comma = level.slice(-1); 
            var comma1 = level.slice(0, 1); 
            if(comma == ','){
                level = level.slice(0,-1);
            }else if(comma1 == ','){
                level = level.substring(1);
            }
            
            //********** Sorting with job type *************//
            var job_type = $('input[name="job_type"]:checked').val();
            
            //**********Sorting with category*************//
             var li = $(".act").data('id');
             $.ajax({
                 url:'sorting',
                 type:'post',
                 data : {'level':level, 'job_type':job_type, 'cat_id' : li, 'page' : page},
                 success:function(result){
                    $('.loading').hide();
                     var obj = jQuery.parseJSON(result);
                     $("#jobsContainer").fadeOut('slow', function(){
                         $(".total_jobs").html(obj.total_jobs);
                         $("#jobsContainer").html(obj.html);
                         $("#jobsContainer").fadeIn('slow');
                     });
                 }
             })
        })
   
   
   //---------------------------------------------------//
   
   //****************job filtering*********************//
    $('.categories_ul li a').click(function(){
        $('.categories_ul li a').removeClass('act');
       $(this).addClass('act');

   });

    $('.sorting').click(function(){
        $('.loading').show();
        // ************* Sorting with Experince Level ***********//
        var level1 = $('input[name="level1"]:checked').val();
        var level2 = $('input[name="level2"]:checked').val();
        var level3 = $('input[name="level3"]:checked').val();
        var level = level1+','+level2+','+level3;
        level = level.replace('undefined,', '');
        level = level.replace('undefined', '');
        level = level.replace(',undefined', '');
        var comma = level.slice(-1); 
        var comma1 = level.slice(0, 1); 
        if(comma == ','){
            level = level.slice(0,-1);
        }else if(comma1 == ','){
            level = level.substring(1);
        }

        //********** Sorting with job type *************//
        var job_type = $('input[name="job_type"]:checked').val();


        //**********Sorting with category*************//
         var li = $(".act").data('id');


         $.ajax({
             url:'sorting',
             type:'post',
             data : {'level':level, 'job_type':job_type, 'cat_id' : li},
             success:function(result){
                $('.loading').hide();
                 var obj = jQuery.parseJSON(result);
                 $("#jobsContainer").fadeOut('top', function(){
                     $(".total_jobs").html(obj.total_jobs);
                     $("#jobsContainer").html(obj.html);
                     $("#jobsContainer").fadeIn('slow');
                 });


             }
         })
    });
    
    //**********workstream chat*************//
    
    $('#send_workstream').click(function (e) {
        var m_names = new Array("Jan", "Feb", "Mar", 
                        "Apr", "May", "Jun", "Jul", "Aug", "Sep", 
                        "Oct", "Nov", "Dec");
            var d = new Date();
            var curr_date = d.getDate();
            var curr_month = d.getMonth();
            var curr_year = d.getFullYear();
            
            var msg = $('#workstream-textarea').val();
            if(msg != ''){
            var sender = $("input[name='sender']").val();
            var receiver = $("input[name='receiver']").val();
            var job_id = $("input[name='job_id']").val();
            var html = '<div class="row"><div class="col-md-1">'+
                            '<img src=" '+base_url+'assets/uploads/profile/'+user.profile_image+'" style="margin-top: 33px;" class="browse_job_user_img">'+
                        '</div>'+
                        '<div class="col-md-11">'+
                            '<h6>'+curr_date+' '+m_names[curr_month]+' '+curr_year+'</h6>'+
                            '<p id="othermsg" class="alert alert-success">'+msg+'</p>'+
                        '</div></div>';
            $('#workstream_thread').append(html);
            $("#workstream_thread").scrollTop($("#workstream_thread")[0].scrollHeight);
            $('#workstream-textarea').val('');
            $.ajax({
                type: 'post',
                url: base_url+'job/workstream',
                data: {'message': msg, 'sender': sender, 'receiver': receiver, 'job_id' : job_id},
                success: function (result) {
                    if (result == 'success') {
                        
                    }
                }
            })
        }
    })
    
    //**********workstream auto chat*************//
    
//    setInterval(function () {
//        var sender = $("input[name='sender']").val();
//        var receiver = $("input[name='receiver']").val();
//        var job_id = $("input[name='job_id']").val();
//        $.ajax({
//            type: 'post',
//            url: base_url+'job/workstream',
//            data: {'receiver_id': sender, 'job_id': job_id},
//            success: function (result) {
//                if (result) {
//                    var ht = '<p class="pull-left alert alert-success" id="othermsg" >'+result+'</p>';
//                    $('#workstream_thread').append(ht);
//                    $("#workstream_thread").scrollTop($("#workstream_thread")[0].scrollHeight);
//                }
//            }
//        })
//    }, 2500)
    
//------------------------------------------------------------//
});


      
      















//$.ajax({
//  xhr: function() {
//    var xhr = new window.XMLHttpRequest();
//
//    xhr.upload.addEventListener("progress", function(evt) {
//      if (evt.lengthComputable) {
//        var percentComplete = evt.loaded / evt.total;
//        percentComplete = parseInt(percentComplete * 100);
//        console.log(percentComplete);
//
//        if (percentComplete === 100) {
//
//        }
//
//      }
//    }, false);
//
//    return xhr;
//  },
//  url: posturlfile,
//  type: "POST",
//  data: JSON.stringify(fileuploaddata),
//  contentType: "application/json",
//  dataType: "json",
//  success: function(result) {
//    console.log(result);
//  }
//});