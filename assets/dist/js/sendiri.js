//Untuk Membuat javascript memunculkan collapse pada div sidebar yang dibuka di mobile

$(window).bind("load resize",function()
{
	if ($(this).width() < 768)
	{
		$('div.sidebar-collapse').addClass('collapse')
	}
	else
	{
		$('div.sidebar-collapse').removeClass('collapse')
	}
});

