$(document).ready(function(){
			//alert(1);
			

/* COde menu starts here */			
$('#cssmenu > ul > li ul').each(function(index, element){
  var count = $(element).find('li').length;
  var content = '<span class="cnt">' + count + '</span>';
  $(element).closest('li').children('a').append(content);
});

$('#cssmenu ul ul li:odd').addClass('odd');
$('#cssmenu ul ul li:even').addClass('even');
$('#cssmenu > ul > li > a').click(function() {

  var checkElement = $(this).next();

  $('#cssmenu li').removeClass('active');
  $(this).closest('li').addClass('active'); 

  if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
    $(this).closest('li').removeClass('active');
    checkElement.slideUp('normal');
  }
  if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
    $('#cssmenu ul ul:visible').slideUp('normal');
    checkElement.slideDown('normal');
  }

  if($(this).closest('li').find('ul').children().length == 0) {
    return true;
  } else {
    return false; 
  }

});
/* COde menu end here */
			
			
			
			
			
			$('.pd_udp').css({'display':'none'});
			$('.pd_unp').toggle(function(){
				$(this).parent().find('.pd_udp').css({'display':'block'});
			},function(){
					$(this).parent().find('.pd_udp').css({'display':'none'});
			});
			$('.config_date').css({'display':'none'});
			$('.config').toggle(function(){
				$(this).parent().find('.config_date').css({'display':'block'});
			},function(){
					$(this).parent().find('.config_date').css({'display':'none'});
			});
			//$( "#dtp1" ).datepicker({ dateFormat: "yy-mm-dd" });
			//$( "#dtp1" ).datepicker();

$('.submit').click(function(){
	$('.error').remove();
	$('.error1').remove();
	$('.error2').remove();
	var a=true;
	$('.name').each(function(){
	var first_name=$(this).val();
	if(first_name == ''){
		$(this).after("<span class='error'>Please fill Name</span>");
		a=false;
	}
	});
	
	$('.password').each(function(){
	var first_name=$(this).val();
	if(first_name == ''){
		$(this).after("<span class='error'>Please fill Password</span>");
		a=false;
	}
	});
	$('.c_password').each(function(){
	var first_name=$(this).val();
	if(first_name == ''){
		$(this).after("<span class='error1'>Please fill Confirm Password</span>");
		a=false;
	}
	});
	
	
	$('.o_password').each(function(){
	var first_name=$(this).val();
	if(first_name == ''){
		$(this).after("<span class='error1'>Please fill Old Password</span>");
		a=false;
	}
	});
	
	
	$('.n_password').each(function(){
	var first_name=$(this).val();
	if(first_name == ''){
		$(this).after("<span class='error1'>Please fill New Password</span>");
		a=false;
	}
	});
	
	$('.username').each(function(){
	var first_name=$(this).val();
	if(first_name == ''){
		$(this).after("<span class='error'>Please fill Username</span>");
		a=false;
	}
	});
	$('.usertype').each(function(){
	var first_name=$(this).val();
	if(first_name == ''){
		$(this).after("<span class='error'>Please Select User Type</span>");
		a=false;
	}
	});
	
	$('.newid').each(function(){
	var first_name=$(this).val();
	if(first_name == ''){
		$(this).after("<span class='error2'>Please Fill New Id</span>");
		a=false;
	}
	});
	
	$('.date').each(function(){
	var first_name=$(this).val();
	if(first_name == ''){
		$(this).after("<span class='error2'>Please Fill Days</span>");
		a=false;
	}
	});
	
	$('.select').each(function(){
	var first_name=$(this).val();
	if(first_name == ''){
		$(this).after("<span class='error'>Select Type</span>");
		a=false;
	}
	});
	
	$('.ip').each(function(){
	var first_name=$(this).val();
	if(first_name == ''){
		$(this).after("<span class='error'>Please fill IP</span>");
		a=false;
	}
	});
	$('.port').each(function(){
	var first_name=$(this).val();
	if(first_name == ''){
		$(this).after("<span class='error'>Please fill Port</span>");
		a=false;
	}
	});
	
	$('.pdate').each(function(){
	var first_name=$(this).val();
	if(first_name == ''){
		$(this).after("<span class='error'>Please select Date</span>");
		a=false;
	}
	});
	$('.condate').each(function(){
	var first_name=$(this).val();
	if(first_name == ''){
		$(this).after("<span class='error'>Please Select Configration Date</span>");
		a=false;
	}
	});
	$('.textarea').each(function(){
	var first_name=$(this).val();
	if(first_name == ''){
		$(this).after("<span class='error'>Please fill text</span>");
		a=false;
	}
	});
/*	$('.userlist').each(function(){
	var first_name=$(this).val();
	if(first_name == ''){
		$(this).after("<span class='error'>Please Select</span>");
		a=false;
	}
	});*/
	return(a);
});						   
});