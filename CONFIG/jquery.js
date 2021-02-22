$(document).ready(function () {

  ///Email szerkesztése (personal.php)
 $('#EMszerkeszt').on('click',function(){
    $('#EMszerkesztInput').val('');
    $('#EMszerkesztInput').attr('readonly',false);
    $(this).hide();
    $('#EMszerkeszt2').show();
  });
  $('#EMszerkeszt2').on('click',function(){
    let id=$(this).data('azonosito'); 
    let email=$('#EMszerkesztInput').val();
    if(email.length<3)
Swal.fire({
  icon: 'error',
  title: 'Oops',
  text: 'Nem megfelelő email cím',
  footer: 'Az email cím nem érte el a szükséges hosszúságot'
});    else{
     $.ajax({

            url: 'szerkemail.php',
            type: 'POST',
            data: {uid:id,eemail:email},
            
            success:function(){
               Swal.fire('Sikeresen megvátoztattad az email címedet!','','success');
                $('#EMszerkeszt2').hide();
                 $('#EMszerkesztInput').attr('readonly',true);
                 $('#EMszerkeszt').show();
                },
                 statusCode: {
                 501: function() {
                     Swal.fire("Már létezik ilyen email az adatbázisban!","","error")
                 }
                   },
              error:function()
            {
Swal.fire('Nem sikerült elküldeni az adatokat.')
            }
         });
    }
  });
  ///Profilkép megváltoztatása (personal.php)
  $('#customFile').on('change',function(){
     $('#buttonProfilMentes').show();
  });
  ////Saját csere törlése
  $('.btnTorles').on('click',function(){
    let csid=$(this).data('csid');
Swal.fire({
  title: 'Biztos törölni szeretnéd a hírdetés?',
  text: "Törlés után a hírdetés már nem megtekinthető",
  icon: 'warning',
  showCancelButton: true,
  cancelButtonText: "Mégse",
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Igen,töröljük'
}).then((result) => {
  if (result.value) {
    $.ajax({
         url : 'deletetrade.php',
         method: 'POST',
         data : {id:csid},
         success: function(){
             Swal.fire(
            'Sikeresen törölted a hirdetést',
            '"Oké" a folytatáshoz','success')
             .then((result) => {
         if (result.value) {location.reload();} }) ;  
},
         statusCode:{
             404: function(){Swal.fire('A keresett oldal nem található','Nyomj okét a folytatáshoz')},
             502: function(){Swal.fire('Hiba!')}
     
         }
    
     });
  }
})   
         
  });
  
    ///Personal Card megtekintése, és törlése(personal.php)
  $('.btnMegtekintes').on('click',function(){
      let id=$(this).data('csid');
      window.location="details.php?item="+id;
  })
  
  
  ///PasswordSzerkesztés (passwordChange.php)
  $('#PWszerkeszt').on('click',function(){
     window.location = "passwordChange.php";
  });
  
  
  /////Cserék feloldása kattintásra (personal.php)
$(document).on('click','#SajatCserekShow',function(){
val=$(this).val();
if(val==1)
{$('#cserekHide').show();val=2;}else
{$('#cserekHide').hide();val=1;}
$('#SajatCserekShow').val(val);
});
  
  //// ALKATEGÓRIÁK BETÖLTÉSE  FŐKATEGÓRIÁK ALAPJÁN (tradeAll.php)
  $(document).on('change','#kategoriaid',function(){

     let kategoriakid=$(this).val();

     $.ajax({
            url: 'keresalkategoria.php',
            type: 'post',
            data: {kategoriaid:kategoriakid},
            dataType: 'json',
            success:function(response){
                $(".alkategoriak").empty();
            var len = response.length;
                for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var name = response[i]['name'];

                    $(".alkategoriak").append(' <option id="alkategoriaid" value="'+id+'">'+name+'</option>');
                    $("#alkategoriaDIV").show();
                }
            
            },error:function()
            {
                                    $("#alkategoriaDIV").hide();

            }
         });
  
    });
      //// ALKATEGÓRIÁK BETÖLTÉSE  FŐKATEGÓRIÁK ALAPJÁN (tradeAll.php)



  $(document).on('change','#kategoriaid2',function(){

     let kategoriakid=$(this).val();
     $.ajax({
            url: 'keresalkategoria.php',
            type: 'post',
            data: {kategoriaid:kategoriakid},
            dataType: 'json',
            success:function(response){
                $(".alkategoriak2").empty();
            var len = response.length;
                for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var name = response[i]['name'];

                    $(".alkategoriak2").append(' <option id="alkategoriaid2" value="'+id+'">'+name+'</option>');
                    $("#alkategoriaDIV2").show();
                }
            
            },error:function()
            {
                                    $("#alkategoriaDIV").hide();

            }
         });
  
    });
    
    //// RÉSZLETEKRE KATTINTÁS UTÁN DETAILS.PHP BETÖLTÉSE (tradeAll.php)
          $(document).on('click', '#reszletek', function () {
        let azon = $(this).data('azonosito');
        //az = $(this).attr('data-azonosito')
        window.location = "details.php?item=" + azon;
    });
  
    

    
   /////SCROLLDOWN\\\\
$("#kovetkezodiv").click(function() {
   
    if(($('#kategoriaid').val()!=0)){   
    $("#divmasodik").css('display','block');
     $('html,body').animate({
        scrollTop: $("#kovetkezodiv").offset().top},
        'slow');
    }
    else
    {Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: 'Kötelező kategóriát választani'
});}
});

//Érték darabokra bontása


});