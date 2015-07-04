$(document).ready(function(){

    var boxs = $('.boxs');
    var all = $('#allgame');
    var load = $('#loading');
    var mes = $('.mes');
    var win = false;
    var ver = true;
    mes.hide();
    all.hide();
  
      setTimeout(function(){
      load.fadeOut('fast');
      all.fadeIn('slow');
    },6000);

    
    mes.click(function(){
      $(this).fadeOut('fast');
    });

if(ver == true){
     Loop();  
}

    boxs.click(function(){
      if($(this).html() == ''){
        var di = $(this).attr('id');
        var divt = $(this);
          $.post('php/insert.php',{div: di},function(x){
          if(x == 'p1'){
                   $(divt).html('<b class="b1">O<b/>')
                   $(divt).css("background","#CCCCCC");
          } else if(x == 'p2'){
                  $(divt).html('X');
                  $(divt).css("background","#CCCCCC");
          }
        });
      }
    });
 

if(win == false){
  setInterval(function(){
   var value0 = $('#div0').html();
   var value1 = $('#div1').html();
   var value2 = $('#div2').html();
   var value3 = $('#div3').html();
   var value4 = $('#div4').html();
   var value5 = $('#div5').html();
   var value6 = $('#div6').html();
   var value7 = $('#div7').html();
   var value8 = $('#div8').html();
   
   if(value0 != '' && value1 !='' && value2 !='' && value0 === value1 && value1 === value2 && value2 ===value1){
      win = true;
      checkWin('div0','div1','div2');   
   } else if(value3 != '' && value4 != '' && value5 != '' && value3 === value4 && value4 === value5 && value5 === value4){
       win = true;
       checkWin('div3','div4','div5');
   } else if(value6 != '' && value7 != '' && value8 != '' && value6 === value7 && value7 === value8 && value8 === value6 ){
      win = true;
       checkWin('div6','div7','div8');
   } else if(value0 != '' && value4 != '' && value8 != '' && value0 === value4 && value4 === value8 && value8 === value0){
      win = true;
       checkWin('div0','div4','div8');
   } else if(value2 != '' && value4 != '' && value6 != '' && value2 === value4 && value4 === value6 && value6 === value2  ){
        win = true;
        checkWin('div2','div4','div6');
   } else if(value2 != '' && value5 != '' && value8 != '' && value2 === value5 && value5 === value8 && value8 === value2 ){
       win = true;
       checkWin('div2','div5','div8');
   } else if(value0 != '' && value3 != '' && value6 != '' && value0 === value3 && value3 === value6 && value6 === value0 ){ 
       win = true;
       checkWin('div0','div3','div6');
   } else if(value1 != '' && value4 != '' && value7 != '' && value1 === value4 && value4 === value7 && value7 === value1 ){
       win = true;
       checkWin('div1','div4','div7');
   } else if( value1 != '' && value2 != '' && value3 != '' && value4 != '' && value5 != '' && value6 != '' && value7 != '' && value8 != ''){
     win = true;
     checkWin('all');
   }   
 },500);
}

function checkWin(one,two,three){
    ver = false;
  $.get('php/checkwin.php',{div1:one, div2:two, div3:three}, function(x){
      ver = true;
      cleanAllDivs(); 
  });
}

function Loop(){
  $.get('php/game.php', {}, function(r){
    if(r.cod == 4){
  cleanAllDivs();
             $('#hdp2').html('');
             $('#your').html('');
             $('#score').html('');
             $('#hdp1').html('Hello, <b class="b1">'+r.online+'</b> waiting other player.');
             $('#player1').html('');
             $('#player2').html('');
               mes.html('Waiting for: <b class="b2">player 2</b>');
               mes.fadeIn('fast');

    }else if(r.cod == 3){
         cleanAllDivs();
             $('#hdp2').html('');
             $('#your').html('');
             $('#score').html('');
              $('#player1').html('');
             $('#player2').html('');
              $('#hdp1').html('Hello,<b class="b2">'+r.online+'</b> waiting other player.');
              mes.html('Waiting for: <b class="b1">player 1</b>');
        mes.fadeIn('fast');

    }else {

       for(i in r){
           
        if(i == 'me'){
            var nick = r[i].nick;
            var wins = r[i].wins;
            var defeats = r[i].defeats; 
            if(r[i].idp == 'idp1'){
              $('#hdp1').html('Hello, <b class="b1">'+nick+' </b>(Total: '+wins+' wins and '+defeats+' defeats).');
              $('#player1').html('Player one:<b class="b1">'+nick+'</b>');
            }else{
              $('#hdp1').html('Hello, <b class="b2">'+nick+' </b>(Total: '+wins+' wins and '+defeats+' defeats).');
              $('#player2').html('Player two:<b class="b2">'+nick+'</b>');
            }
        }else if(i == 'p2'){
            var nick = r[i].nick;
            var wins = r[i].wins;
            var defeats = r[i].defeats; 
           if(r.me.idp == 'idp1'){
           $('#hdp2').html('<b class="b2">'+nick+'</b> (Total: '+wins+' wins and '+defeats+' defeats).');
           $('#player2').html('Player two:<b class="b2">'+nick+'</b>');
           }else{
            $('#hdp2').html('<b class="b1">'+nick+'</b> (Total: '+wins+' wins and '+defeats+' defeats).');
            $('#player1').html('Player one:<b class="b1">'+nick+'</b>');
          }
        }else if(i == 'playing'){
          if(r[i] == 'p1'){
            $('#score').html('Playing now: <b class="b1">O<b/>');
          }else {
            $('#score').html('Playing now: <b class="b2">X<b/>');
          }
        } else{
           if(r[i] == 'p1'){
            $('#'+i).html('<b class="b1">O<b/>')
            $('#'+i).css("background","#CCCCCC");
            $('#hdp1').html('Hello, <b class="b1">'+nick+' </b>(Total: '+wins+' wins and '+defeats+' defeats).');
            mes.fadeOut('fast');
           }else if(r[i] == 'p2') {
            $('#'+i).html('<b class="b2">X<b/>')
            $('#'+i).css("background","#CCCCCC");
            mes.fadeOut('fast');
           }else{
            $('#'+i).html('')
            $('#'+i).css("background","#E8E8E8");
            mes.fadeOut('fast');
           }
        }
         
       }
    }

    setTimeout(function(){
      Loop();
    },130);

    }, 'jSON');
}

function cleanAllDivs(){
  $('.boxs').each(function(){
    $(this).html('');
    $(this).css("background","#E8E8E8")
  });
}

});// End of read the ready function.
