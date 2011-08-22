$(document).ready(function(){
	$('body').removeClass('no-js');
	var a = $('li.sub input').attr('value');
	

	$('#playing input[type=submit]').not('.dropper').click(function(event){
		event.preventDefault();
		var name = $('input[name=player]').val();
		
		var xhr = $.ajax({
			url: '/admin/formsignup.php',
			data: 'player='+name,
			success: function(data){
				var b = $.trim(data), c = $('.teamPlayer').length;
				if(c>=12){
					mess = ' is a substitute';
				} else {
					mess = ' is in';
				}
				if(b === 'playing'){
					$('input.name').val('');
					location.reload();
				} else if(data === 'dupe') {
					$('div[role=enter]').append('<h2 id="dupe">Your already playing?</h2>');
					setTimeout(function(){
						$('#dupe').animate({
							opacity: 0,
							},3000, function(){
								$(this).remove();		
						});	
					},2000);
				}
			}
		});
	});

	$('.dropper').click(function(event){
		event.preventDefault();
		var name = $(this).prev('input[name=name]').val();
		
		var xhr = $.ajax({
			url: '/admin/delete.php',
			data: 'name='+name,
			success: function(data){
				if(data === 'out'){
					location.reload();
				}
			}
		});
	});

	$('#comments form input[type=submit]').live('click',function(event){
		event.preventDefault();
		var named 	= $('#commentator').val();
		var comm 	= $('#comment').val();
		if(named == ''){
			named = 'Anonymous';
		} else {
			named = $('#commentator').val();
		}

		if(comm == '' || comm=='No message?'){
			$('#comment').val('No message?').addClass('red');
			return false;
		}

		var xhr = $.ajax({
			url: '/admin/comment.php',
			data: 'name=' + named + '&comment=' + comm,
			success: function(data){
				location.reload();
			}
		});
	});


	$('h2.clickme').click(function(event){
		event.preventDefault();
		var comm = $('#comments');
		if(comm.is(':visible')){
			comm.slideUp(500); 
			$('.players').unbind('click');
			$('#commentator, #comment').val('');
		} else {
			comm.slideDown(500);
			$('.players').bind('click',function(){
				var name = $(this).attr('value');
				var firstn = name.split(' ');
				$('.text').val(name);
				$('#comment').val('Whats on your mind ' + firstn[0] + '?');
			});
		}
	})
	stoptype = 0;
	$('#commentator').keyup(function(){
		var stoptype = setTimeout(function(){
			var name = $('#commentator').val();
			var firstn = name.split(' ');
			$('#comment').val('Whats on your mind ' + firstn[0] + '?');
		},1000);
	});
	$('#commentator').keydown(function(){
		clearTimeout(stoptype);
	});
	$('#comment').focus(function(){
		$(this).val('');
	});
});