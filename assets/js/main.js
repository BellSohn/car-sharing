$(document).ready(function(){
    
    $('.to-login').on('click',function(){      
       $('#exampleModalCenter').slideFadeToggle();
    });
    
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
         var click = e.target;
         
         if(click != a && $('.menu-options').css('display','block')){             
             $('.menu-options').css('display','none');
         }         
     });

     /*password restore */

     $('.pass-confirm').on('change',function(){         
         var pass = $('.pass-field').val();
         var pass_new = $('.pass-new').val();
         var pass_confirm = $('.pass-confirm').val();
         if(pass_new !== pass_confirm){
            
            $('.warning-msg').css('display','block');
            $('.pass-confirm').addClass('warning-pass');

         }else{
            $('.warning-msg').css('display','none');
            $('.pass-confirm').removeClass('warning-pass');
         }
         
     });

     /* trip search  */

     $('.btn-search').on('click',function(){
         
         var destination = $('.sear-dest').val();        
         
         $.ajax({          
            url:'ajaxSearchValue',            
            method:'POST',  
            //dataType:'json',           
            data:{'dest':destination},
            success:function(result,status,xhr){
                
                $('.search-results').html(result);                                      
                                
            },
            error:function(xhr,status,error){                
                $('.search-results').html(error);
            }
             
         });
     });

     
     let url = window.location.pathname;
     let urlSplit = url.split("/");
     
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
     
     $('#reset-search').click(function(){        
        window.location.replace("http://localhost/master-php/car-sharing/offer/index");
     });

     $('.input-seats').on('change',function(){
         
         var destination = $('.input-dest').val();
         var date = $('.input-date').val();
         
         if(destination == "" && date == "" ){             
             $('.btn-search').prop('disabled',true);
         }else{
             $('.btn-search').prop('disabled',false);
         }
     });

     
     
     $('.contact').on('click',function(){

        $('#exampleModal').modal('toggle');       
        var userItinerary = $(this).attr('value');

         
        $.ajax({
            url:'AjaxUserNameCall',
            method:'POST',
            data:{'iduser':userItinerary},
            success:function(result,status,xhr){
                res = JSON.parse(result);                              
                $('#contact_info').html(res);               
            },
            error:function(xhr,status,error){

            }
        });
        
        $('#user_itinerary').val(userItinerary);
        
     });

     $('#answer-button').on('click',function(){         
         $('#answerModal').modal('toggle');

     });

     

     
     


     



     
        
});
