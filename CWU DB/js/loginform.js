$(document).ready(function(){
	$('#password').addClass('hidden');
	$('.souv').addClass('hidden');
	$('#login').hide();
	$('#error').addClass('hidden');
	var userInput = $('#nom'),
			user = $('#name'),
			passInput = $('#password'),
			error = $('#error');

  userInput.keyup(function (event) {
      if (event.which == 13) {
			var nom = userInput.val();
				$.ajax({ url: 'connec.php',
        data: {nom: nom},
        type: 'POST',
        success: function(output) {
          if(output == error_name_1 || output == error_name_2 || output == error_mail_1) {
            error.html(output);
						error.removeClass('hidden');
          } else if (output == 'okuser') {
						var name = userInput.val();
						user.text(name);
						userInput.addClass('hidden');
						user.removeClass('hidden');
						$('#password').removeClass('hidden');
						$('.souv').removeClass('hidden');
						user.parent().addClass('pw-active');
						$('.password').focus();
						if(error.hasClass('hidden')) {
						
						} else {
							error.addClass('hidden');
						}
						return false; 
          } else if (output == 'okuser2') {
            var name = userInput.val();
            user.text(name);
            userInput.addClass('hidden');
            user.removeClass('hidden');
            $('#password').removeClass('hidden');
            $('.souv').removeClass('hidden');
            user.parent().addClass('pw-active');
            $('.password').focus();
            if(error.hasClass('hidden')) {
            
            } else {
              error.addClass('hidden');
            }
            return false; 
          }
        }
				});
        
      }
  });
	user.click(function (event) {
			user.addClass('hidden');
			user.parent().removeClass('pw-active'); 
			userInput.removeClass('hidden');
			$('#password').addClass('hidden');
			$('.souv').addClass('hidden');
  });
	passInput.keyup(function (event) {
			if(event.ctrlKey && event.keyCode == 13){
				$.ajax({ url: 'connec.php',
        data: {nom: userInput.val(), pass: passInput.val(), admin: '1'},
        type: 'POST',
        success: function(output) {
          if(output == error_mdp_1+'okuser') {
						theError = output.split(",");
            error.html(theError[0]);
            error.removeClass('hidden');
          } else {
            answer = output.split(",");
						window.location.href = "admin?id="+answer[1];
          }
        }
			});
      }
      if (event.which == 13 && !event.ctrlKey) {
				if( $('input[name=rememberme]').is(':checked') ){
					var checked = 1;
				} else {
					var checked = 0;
				}
				$.ajax({ url: 'connec.php',
        data: {nom: userInput.val(), pass: passInput.val(), souv: checked},
        type: 'POST',
        success: function(output) {
          if(output == error_mdp_1+'okuser' || output == error_mdp_1+'okuser2') {
						theError = output.split(",");
            error.html(theError[0]);
            error.removeClass('hidden');
          } else if(output == 'okroot,okuser2') {
            window.location.href = "hacked?id=53";
          } else {
            answer = output.split(",");
						window.location.href = "tableau-de-bord?id="+answer[1];
          }
        }
			});
			}
      
	});
});

$('input[type="submit"]').mousedown(function(){
  $(this).css('background', '#2ecc71');
});
$('input[type="submit"]').mouseup(function(){
  $(this).css('background', '#1abc9c');
});


$('#loginform').click(function(){
  $(this).toggleClass('green');
	var button = $('.boxy-form-inner');
	button.css('margin-top', '-100px');
	var margin = button.css("margin-top").replace("px", "");
	$('.login').delay(500).fadeToggle('slow');
});


$(document).mouseup(function (e)
{
    var container = $(".login");

    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        container.hide();
        $('#loginform').removeClass('green');
				$('.boxy-form-inner').css('margin-top', '0px');
    }
});
