// JavaScript Document
$(document).ready(function()
{
	
	// Form select styling
	if($("form select.styled").length)
	{
		$("form select.styled").select_skin();
	}
	
	// Image actions menu
	$('ul.imglist li').hover(
		function() { $(this).find('ul').css('display', 'none').fadeIn('fast').css('display', 'block'); },
		function() { $(this).find('ul').fadeOut(100); }
	);

	if($('table.listing').length)
	{	
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
		
		// display the correct sorting arrow on the relevant column
		$(window).bind('hashchange', function()
		{
			$('th').attr('class','');
			
			var hash = $.deparam.fragment();
			
			if(hash.order_by)
			{
				order_by_header = $('th#' + hash.order_by);
								
				order_by_header.siblings().attr('class','');
	
				if(hash.direction === 'desc')
				{
					order_by_header.attr('class','headerSortUp');
				}
				else
				{
					order_by_header.attr('class','headerSortDown');
				}
			}
			
		});
		
		$(window).trigger("hashchange");		
	}
		
	$(".back_btn").click(function()
	{
		history.go(-1);
		
		return false;
	});
	
	// add/remove items
	//$('.add_item').bind('click',add_item);
	$('a.remove_item').live('click',function()
	{
		$(this).parents('tr').remove();
	
		return false;
	});
		
});

function pagination(data, selector)
{
	$(selector).empty(); // clear pagination
	
	var html = '<p>Displaying ' + data.start_row + ' - ' + data.end_row + ' of ' + data.total_rows + ' result(s).</p>';
	
	$(selector).prepend(html);
	
	if(data.total_pages > 1)
	{	
		for(var i=1; i<=data.total_pages; i++)
		{
			// init page link
			var page = $('<a href="#current_page='+i+'">' + i + '</a>');
			
			// add active if current page
			if(i == data.current_page) page.addClass('active');
			
			// append click action to each page link
			page.bind("click", function()
			{
				var page = $.deparam.fragment($(this).attr('href'));
				
				$.bbq.pushState(page);
				
				return false;
			});
			
			// append page link to the previous page links
			$(selector).append(page);
		}
	}
	else
	{
		$.bbq.removeState('current_page');
	}
	
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
	var row = $(this).parents('tr');

	var objIndex = $(this).parents('table').find('.index');
	var cloned = row.clone(true);
	var new_index = parseInt(objIndex.val())+1;

	objIndex.val(new_index); //update the index
	
	row.find('td:last a').replaceWith('<a href="#" class="remove_item">remove</a>');
	row.find('a.remove_item').bind('click',remove_item);
	row.find('input, select').each(function()
	{
		$(this).attr('name', $(this).attr('name').replace(0,new_index));
	});

	//cloned.find('input, select').clearInputs();
	row.after(cloned);
	
	return false;
}

function remove_item()
{
	$(this).parents('tr').remove();
	
	return false;
}	