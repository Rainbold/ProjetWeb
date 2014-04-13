$('.QuestTable table').hide();
$('#QuestLatest table').show();

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
		$('.QuestTable table').hide();
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