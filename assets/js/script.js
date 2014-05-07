$('.QuestPopTableJS table').hide();
$('.QuestUserTableJS table').hide();
$('#QuestLatest table').show();
$('#QuestUnanswered table').show();
$('button.formToggle').next('div').next('div').hide();

$('.aa-login').hide();

$('button#btnToLogin').click(function(){
	$('.aa-menu').hide();
	$('.aa-login').fadeIn();
});
$('button#btnToMenu').click(function(){
	$('.aa-menu').fadeIn();
	$('.aa-login').hide();
});
//$('.aa-menu').hide();

$('.overlay').click(function(){
	$(this).hide();
});
$('.messageBox').click(function(){
	$(this).hide();
});

$('button.formToggle').click(function() {
	if($(this).data('toggle') == 'toggled')
	{
		$(this).next('div').next('div').fadeOut();
		$(this).data('toggle', '');
	}	
	else
	{
		$(this).next('div').next('div').fadeIn();
		$(this).data('toggle', 'toggled');
	}
});

// The current table choice : latest, day, week or month
var popChoice = 'PopLatest';
var userChoice = 'UserUnanswered';

$('#QuestUser span').click(function(){
	$('#QuestUser .foc').removeClass('foc');
	$(this).addClass('foc');

	if(userChoice != $(this).attr('id'))
	{
		userChoice = $(this).attr('id');
		$('.QuestUserTableJS table').hide();
		switch( userChoice )
		{
			case 'UserUnanswered':
				$('#QuestUnanswered table').fadeIn();
				break;
			case 'UserQuest':
				$('#QuestUserPers table').fadeIn();
				break;
		}
	}
});

$('#QuestPop span').click(function(){
	$('#QuestPop .foc').removeClass('foc');
	$(this).addClass('foc');

	if(popChoice != $(this).attr('id'))
	{
		popChoice = $(this).attr('id');
		$('.QuestPopTableJS table').hide();
		switch( popChoice )
		{
			case 'PopLatest':
				$('#QuestLatest table').fadeIn();
				break;
			case 'PopDay':
				$('#QuestDay table').fadeIn();
				break;
			case 'PopWeek':
				$('#QuestWeek table').fadeIn();
				break;
			case 'PopMonth':
				$('#QuestMonth table').fadeIn();
				break;
		}
	}
});