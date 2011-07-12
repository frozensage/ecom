$(document).ready(function()
{
// test
	$('#nav ul>li').hover(function(){
		$(this).children('div.overlay').show();
	},function()
	{
		$(this).children('div.overlay').hide();
	}).children('div.overlay').hide();
	
	$('#nav>ul>li>a').bind('click', function()
	{
		return false;
	});
	
	if($('form').length>0)
	{
		$('form').submit(submission);
	}
	
	if($('.product').length>2)
	{
		$('.product:nth-child(3)').addClass('last');
	}
	
	$('#refined-search .form-submit').bind('click', function()
	{
		var href = "/page/products";
	
		var price = $('#by-price').val();
		var occasion = $('#by-occasion').val();
		var person = $('#by-person').val();
		
		if(price != '' && price != undefined) 
			href += '/price/' + price;
		
		if(occasion != '' && occasion != undefined) 
			href += '/occasion/' + occasion;

		if(person != '' && person != undefined) 
			href += '/person/' + person;

		if(console) console.log(href);
	
		location.href = href;
	});
	
	$('select#existing-addresses').live('change', populate_address);
	
	$('a.show-recipient-details').live('click', function()
	{
		if($(this).parent().next('.recipient-details').is(':visible'))
		{
			$(this).text('Show recipient details');	
			$(this).parent().next('.recipient-details').hide();
		}
		else
		{
			$(this).text('Hide recipient details');	
			$(this).parent().next('.recipient-details').show();
		}
		
		return false;
	});
	
});


function populate_address()
{
	var index = $(this).val();

	if(index != "")
	{
		$.post('/cart/recipient_address/'+index, function(address)
		{			
		
			$('input[name="recipient[address][postcode]"]').val(address.postcode).trigger('change');
			$('input[name="recipient[address][street]"]').val(address.street);
			$('input[name="recipient[address][state]"]').val(address.state);
			$('input[name="recipient[address][phone]"]').val(address.phone);
			
			setTimeout(function()
			{
				// give time for suburb list to populate before preselecting
				$('select[name="recipient[address][suburb]"]').val(address.suburb).trigger('change');
			}, 100);
			
		},"json");
	}
}

// submit form using ajaxSubmit
function submission()
{
	var options = {
		target: '.form-submit-status',
		beforeSubmit: prepare_submit,
		success: post_submit,
		dataType: 'json'
		}

	$(this).ajaxSubmit(options)
	
	return false;
}

// perform anything prior to submit
function prepare_submit(formData, jqForm, options)
{
	$('.error').remove();
}

// output error or redirect to another page on return of response
function post_submit(response)
{
	if(response.validation) // validation successful
	{
		window.location.replace(response.redirect);
	}
	else
	{
		$.each(response.errors, output_error);
		//$('.form-submit-status').append('<p class="error">Please fix all errors before trying again.</p>');
	}
}

// output error on page
function output_error(key, item)
{
	if(console)
	{
		console.log(item.name + '=' + item.error);
	}

	$('select[name="'+item.name+'"]:last').parent().append(item.error);	
	$('input[name="'+item.name+'"]:last').parent().append(item.error);		
}