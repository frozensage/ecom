// JavaScript Document
$(document).ready(function()
{
	if($('table.listing').length > 0)
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
		
	$("a.back_btn").click(function()
	{
		history.go(-1);
		
		return false;
	});
});

function pagination(data, selector)
{
	$(selector + " *").remove(); // clear pagination
	
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