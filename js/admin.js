$(document).ready(function()
{

	$("input#per_page").blur(function()
	{
		var per_page = $(this).val();
		
		$.bbq.pushState({per_page: per_page});	

	});

	$("thead a").each(function()
	{
		$(this).click(function()
		{
			var href = $.deparam.fragment($(this).attr('href'));
			var hash = $.deparam.fragment();
							
			// if order_by of this column already exists in hash then toggle direction
			if(href.order_by === hash.order_by)
			{
				if(hash.direction === 'desc')
					hash.direction = 'asc';
				
				else hash.direction = 'desc';
			}				
			// else remove direction state
			else
			{
				hash.order_by = href.order_by
				delete hash.direction;
			}		
			
			// trigger has change event
			$.bbq.pushState(hash,2);
						
			return false;
		});
	});
	
	if($('table.listing').length > 0)
		$(window).trigger("hashchange");
		
	$("a.back_btn").click(function()
	{
		history.go(-1);
		
		return false;
	});
	
	// add/remove items
	$('.add_item').bind('click',add_item);
	$('.remove_item').bind('click',remove_item);	

});

function pagination(data, selector)
{
	$(selector + " *").remove(); // clear pagination
	
	var html = '<p>Displaying ' + data.start_row + ' - ' + data.end_row + ' of ' + data.total_rows + ' result(s).</p>';
	
	$(selector).prepend(html);
	
	if(data.total_pages > 1)
	{
		$(selector).append('<ul>');
	
		for(var i=1; i<=data.total_pages; i++)
		{
			if(i == data.current_page)
				$(selector + ' ul').append('<li class="current-page">' + i + '</li>');

			else
				$(selector + ' ul').append('<li><a href="#current_page='+i+'">' + i + '</a></li>');
		}
		
		$(selector + " li a").bind("click", function()
		{
			var page = $.deparam.fragment($(this).attr('href'));
			
			$.bbq.pushState(page);
			
			return false;
		});
	}
	else
	{
		$.bbq.removeState('current_page');
	}
	
	//console.log(data.total_pages);
}

/*
|---------------------------------------------------------------
| add_item()
|---------------------------------------------------------------
|
| Duplicate the last item in the list
| Replace the last item's name ...[0] to the new index, 
| Replace the "add" link with "remove" link in the last item
| Clear the cloned item's fields
| Add the cloned item to after the last item, thus becoming the new last item
|
*/
function add_item()
{	
	var row = $(this).parents('.row');
			
	//if any text fields are empty, give warning and do not add a new field
	if(row.find('.required[value=""]').length>0)
	{
		alert('All required(*) fields must be filled');
		return false;
	}
	
	var objIndex = $(this).parents('fieldset').find('.index');
	var cloned = row.clone(true);
	var new_index = parseInt(objIndex.val())+1;

	objIndex.val(new_index); //update the index
	
	row.find('div:last a').replaceWith('<a href="#" class="remove_item">remove</a>');
	row.find('a.remove_item').bind('click',remove_item);
	row.find('input, select').each(function()
	{
		$(this).attr('name', $(this).attr('name').replace(0,new_index));
	});

	cloned.find('input, select').clearInputs();
	row.after(cloned);
	
	return false;
}

function remove_item()
{
	$(this).parents('.row').remove();
	
	return false;
}	

