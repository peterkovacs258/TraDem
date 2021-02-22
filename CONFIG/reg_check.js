$(document).ready(function () {
//////VALIDATION\\\\\\\\
var error_email=false;
var error_pwd=false;
var error_pwdc=false;
var error_phone=false;
var error_irsz=false;



$('#reg_email').on('blur',function(){
    console.log('a');
    $('#email_error').hide();
var email=$.trim($('#reg_email').val().toLowerCase());
if(email=="")
{   $('#email_error').html('Üres mező');
       $('#reg_email').addClass("inputhiba"); 
    $('#email_error').show(); 
    error_email=true;
    }else if(!isEmail(email)){
    $('#email_error').html('Nem megfelelő email formátum!');
   $('#reg_email').addClass("inputhiba"); 
   $('#email_error').show(); 
    error_email=true;
    }
    else{ 
        $('#email_error').hide();
        $('#reg_email').removeClass("inputhiba");
        $('#reg_email').addClass("inputsiker"); 

        
         error_email=false;

        }	
});
function isEmail(email) {
	return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
}

$('#reg_pwd').on('blur',function(){
    var number = /([0-9])/;

    var pwd=$('#reg_pwd').val();
    if(pwd.length<5){
    $('#pwd_error').html('Leglább 5 karakter!');
   $('#reg_pwd').addClass("inputhiba"); 
   $('#pwd_error').show();    
   error_pwd=true;
    }
    else if(!pwd.match(number)||!pwd.match(/[A-Z]/)||!pwd.match(/[a-z]/)){
        $('#pwd_error').html('Tartalmaznia kell kis,nagybetűt, számot');
   $('#reg_pwd').addClass("inputhiba"); 
   $('#pwd_error').show();
      error_pwd=true;
    }
    else{
        $('#reg_pwd').removeClass("inputhiba"); 
        $('#reg_pwd').addClass("inputsiker"); 
   $('#pwd_error').hide(); 
      error_pwd=false;

    }
   
});
$('#reg_pwdc').on('blur',function(){
var pwdc=$(this).val();
var pwd=$('#reg_pwd').val();
if(pwdc!=pwd)
{  $('#pwdc_error').html('A két jelszónak egyeznie kell!');
   $('#reg_pwdc').addClass("inputhiba"); 
   $('#pwdc_error').show(); 
   error_pwdc=true;}
   else
   {
        $('#reg_pwdc').removeClass("inputhiba"); 
        $('#reg_pwdc').addClass("inputsiker"); 
   $('#pwdc_error').hide(); 
   error_pwdc=false;
   }

});

        
    $('#reg_phone').on('blur',function(){
        var phone=$(this).val();
            var phone_pattern = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/; 
    if(!phone_pattern.test(phone))
    {
        $('#phone_error').html('Nem telefon formátum!');
   $('#reg_phone').addClass("inputhiba"); 
   $('#phone_error').show();
   error_phone=true;
    }
    else{
         $('#reg_phone').removeClass("inputhiba"); 
        $('#reg_phone').addClass("inputsiker"); 
   $('#phone_error').hide(); 
   error_phone=false;
    }
        });
        
     ////// IRÁNYÍTÓ SZÁM ALAPJÁN MEGYE BETÖLTÉSE (reg.php)
  $(document).on('blur','#reg_irsz',function(){
     let irszdata=$(this).val();     
     if(irszdata.length!=4)
     {
         $('#irsz_error').html('Nem megfelelő hossz!');
         $('#reg_irsz').addClass("inputhiba"); 
         $('#irsz_error').show();
     }
     else
     {
     $.ajax({
         url:'keresirsz.php',
         method:'POST',
         data:{irsz:irszdata},
         success: function(data){
             var done=$.trim(data);
            $('#reg_city').val(done);
            $('#reg_irsz').removeClass("inputhiba"); 
            $('#reg_irsz').addClass("inputsiker"); 
            $('#irsz_error').hide();
            $('#reg_city').attr('readonly',true);
            error_irsz=false;
            
         },
         statusCode:{
             501: function(){
                $('#irsz_error').html('Nem találtam ilyen irányítószámot!!!');
                $('#reg_irsz').addClass("inputhiba"); 
                $('#irsz_error').show();
                error_irsz=true;
             }
         },
         error:function()
         {
             $('#irsz_error').html('Nem találtam ilyen irányítószámot!!!');
                $('#reg_irsz').addClass("inputhiba"); 
                $('#irsz_error').show();
                errorirsz=true;
             
         }
        
     });
 }

  });      
        
 $("#reg_form").submit(function() {											
		if(error_pwd == false && error_pwdc == false && error_phone == false && error_email == false
                        &&error_irsz==false) {
			return true;
                        
		} else {
			return false;	
		}

	});
    
});