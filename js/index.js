$(document).ready(function(){
  var content2 = $('#cont2');
  var danger = $('.mes');

     danger.hide();
     content2.hide();

     danger.click(function(){
      danger.fadeOut('slow');
     });

      $('form[name="login"]').submit(function(){
           danger.fadeOut('slow');
           var form = $(this);
           var email = $('#mail').val();
           var pass = $('#pass').val();
           var bt = $('#bt');
           if(pass == '' || email == ''){
            fMessage('Fill in all the fields.');
        } else {
           $.ajax({
              url: 'php/index.php',
              type: 'POST',
              data:'action=login&'+form.serialize(),
              beforeSend: function(){
                  statusButton(bt,'disabled');
              },
              success: function(r){
              statusButton(bt,'enabled');
               if(r == 'wrong'){
                fMessage('Incorrect login or password.');
               } else if(r == 'online'){
                fMessage("You're online.");
               }else{
                window.location = "game.php";
               }
            }
             });
           }
           return false;
      });

      $('#link').click(function(){
        danger.hide();
        $('#cont').fadeOut('slow',function(){
          $(content2).fadeIn('fast');
        });
        return false;
      });

      $('form[name="register"]').submit(function(){
        danger.fadeOut('slow');
        var form = $(this);
        var login = $('#lg2').val();
        var email = $('#em2').val();
        var pass1 = $('#pw1').val();
        var pass2 = $('#pw2').val();
        var bt2   = $('#bt2');
        if(login == '' || email == '' || pass1 == '' || pass2 == ''){
          fMessage('Fill in all the fields.');
        } else if(pass1 != pass2){
          fMessage('Passwords do not match.');
        } else {
          $.ajax({
             url:'php/index.php',
             type:'POST',
             data:'action=register&'+form.serialize(),
             beforeSend: function(){
                statusButton(bt2,'disabled');
             },
            success : function(r){
              statusButton(bt2,'enabled');
              if(r == 'true'){
                fMessage('Successfully registered.','sucess');
              } else {
                fMessage('User already exists.');
              }
            }
          });
        }
        setTimeout(function(){
          window.location = "index.php";
        },2500);
        return false;
      });
      function fMessage(message,type){
        if(!type){
           danger.html(message);
           danger.fadeIn('fast');
           danger.removeClass('sucess');
        } else {
          danger.addClass(type);
          danger.html(message);
          danger.fadeIn('fast');       
        }
      }

      function statusButton(button, status){
        if(status == 'disabled'){
               button.removeClass('hover');
               button.addClass('disabled');
               button.html('Loading');
               button.prop('disabled', true);
        } else {
              button.removeClass('disabled');
              button.addClass('hover'); 
              button.html('Sign up');
              button.prop('disabled', false);
        }
      }
});