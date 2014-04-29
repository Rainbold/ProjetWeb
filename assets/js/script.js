$('.QuestTableJS table').hide();
$('#QuestLatest table').show();

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



// The current table choice : latest, day, week or month
var popChoice = 'PopLatest';

$('#QuestPop span').click(function(){
	$('.foc').removeClass('foc');
	$(this).addClass('foc');

	if(popChoice != $(this).attr('id'))
	{
		popChoice = $(this).attr('id');
		$('.QuestTableJS table').hide();
		switch( popChoice )
		{
			case 'PopLatest':
				$('#QuestLatest table').fadeIn();
				break
			case 'PopDay':
				$('#QuestDay table').fadeIn();
				break
			case 'PopWeek':
				$('#QuestWeek table').fadeIn();
				break
			case 'PopMonth':
				$('#QuestMonth table').fadeIn();
				break
		}
	}
});