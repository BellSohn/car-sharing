$(document).ready(function(){
    
    $('.to-login').on('click',function(){        
        //$('.messagepop').slideFadeToggle();
        $('#exampleModalCenter').slideFadeToggle();
    });

    /*function deselected(e){
        $('.pop').slideFadeToggle(function(){
            e.removeClass('selected');
        });
    }*/

    $('.close').click(function(){
        $('.messagepop').css('display','none');
    });

    $.fn.slideFadeToggle = function(easing, callback) {
        return this.animate({ opacity: 'toggle', height: 'toggle' }, 'fast', easing, callback);
      };

      /*with this code the personal menu, after loggin will be display */
      $('#personal-menu').on('click',function(){
          $('.menu-options').css('display','block');
      });

     /*With this code I conceal the personal menu,once you click outside it */
      document.addEventListener("click",function(e){
         var a = document.getElementById('personal-menu');
         //console.log("haces click");
         var click = e.target;
         //console.log(click);
         if(click != a && $('.menu-options').css('display','block')){
             //console.log("click fuera");
             $('.menu-options').css('display','none');
         }         
     });

     /*password restore */

     $('.pass-confirm').on('change',function(){
         //console.log("confirmation!");
         var pass = $('.pass-field').val();
         var pass_new = $('.pass-new').val();
         var pass_confirm = $('.pass-confirm').val();
         if(pass_new !== pass_confirm){
            //console.log("dont match!");
            $('.warning-msg').css('display','block');
            $('.pass-confirm').addClass('warning-pass');

         }else{
            $('.warning-msg').css('display','none');
            $('.pass-confirm').removeClass('warning-pass');
         }
         
     });

     /* trip search  */

     $('.btn-search').on('click',function(){
         //alert("Viernes!");
         var destination = $('.sear-dest').val();
         //$('.search-results').text(destination);
         //console.log(destination);
         $.ajax({          
            url:'ajaxSearchValue',            
            method:'POST',  
            //dataType:'json',           
            data:{'dest':destination},
            success:function(result,status,xhr){
                //console.log(result);
                $('.search-results').html(result);
                
                //var jsonData = JSON.parse(response);
                //console.log(jsonData);
                //$('.search-results').text(data);
                
                    
                    //console.log(dest);
                //$('.search-results').text(dest);
            },
            error:function(xhr,status,error){
                /*console.log(request);
                console.log(request.status);
                console.log(error);*/
                $('.search-results').html(error);
            }
             
         });
     });

     //if(window.document.u)
     let url = window.location.pathname;
     let urlSplit = url.split("/");
     console.log(urlSplit[3] + " "+urlSplit[4]);
     if(urlSplit[3] == 'offer' && urlSplit[4] == 'index'){
        $('.div-footer').css('margin-top',80);
     }else if(urlSplit[3] == 'offer' && urlSplit[4] == 'offerSearch'){
        $('.div-footer').css('margin-top',80);
     }else if(urlSplit[4] ==  undefined){
        $('.div-footer').css('margin-top',80);
        console.log("home");
     }else if(urlSplit[3] == 'seek' && urlSplit[4] == 'index'){
        $('.div-footer').css('margin-top',80);
     }

     /* ofer index.php */
     /*
     $('.bdg-dest').click(function(){         
         $('.input-dest').css('display','block');
     });

     $('.bdg-date').click(function(){
         $('.input-date').css('display','block');
     });

     $('.bdg-seats').click(function(){
         $('.input-seats').css('display','block');
     });
     */
     
     $('#reset-search').click(function(){
        //alert("joder!"); 
        window.location.replace("http://localhost/master-php/car-sharing/offer/index");
     });

     $('.input-seats').on('change',function(){
         //alert("cagon to!");
         var destination = $('.input-dest').val();
         var date = $('.input-date').val();
         //console.log(date);
         if(destination == "" && date == "" ){
             //console.log("bloqueo");
             $('.btn-search').prop('disabled',true);
         }else{
             $('.btn-search').prop('disabled',false);
         }
     });

     
     
     $('.contact').on('click',function(){

        $('#exampleModal').modal('toggle');
        /*
         let itineraryUserId = $(this).attr("value");         
         let variables = JSON.stringify({
            userId:itineraryUserId
         });
              
         fetch("AjaxUserNameCall",{
             method:'POST',
             body:variables,
             headers:{"Content-Type":"application/json; charset=UTF-8"}
         })
         .then(response => response.json())
         .then(datos => console.log(datos));      
                
      
        */
        var userItinerary = $(this).attr('value');

         
        $.ajax({
            url:'AjaxUserNameCall',
            method:'POST',
            data:{'iduser':userItinerary},
            success:function(result,status,xhr){
                res = JSON.parse(result);
                //res = result;
                //console.log("result: " + res.name);
                console.log(res);
                //$('#contact_info').html(res.name);
                $('#contact_info').html(res);
               //$('#exampleModalLabel').html(result);               
            },
            error:function(xhr,status,error){

            }
        });
        
        $('#user_itinerary').val(userItinerary);
        
     });

     $('#answer-button').on('click',function(){
         //alert("Cojon!");
         $('#answerModal').modal('toggle');

     });

     /*let esta = document.querySelector("#answer-button");
     esta.addEventListener("click",function(){
        $('#answerModal').modal('toggle');
        //alert("mierda!");
     });*/

     
     


     



     
        
});