<?php if ($query->num_rows()>0) : ?>

<form action="" method="post">

    <table cellpadding="0" cellspacing="0" width="100%" class="sortable listing">
        <thead>
            <tr>
                <th width="10"><input type="checkbox" class="check_all"></th>
                <th id="supplier"><a href="#order_by=supplier">Supplier</a></th>
                <th id="email"><a href="#order_by=email">Email</a></th>
                <th>Phone</th>
                <th id="updated"><a href="#order_by=updated">Updated</a></th>
				<th id="created"><a href="#order_by=created">Created</a></th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        
        <tbody></tbody>
    </table>
                
    <div class="pagination"></div>		
    <!-- .pagination ends -->
    
    <p><a href="<?php echo site_url('supplier/create')?>">Create more</a></p>      
                
    <div class="tableactions">
        <select>
            <option>Actions</option>
            <option>Delete</option>
            <option>Edit</option>
        </select>
        
        <?php echo form_submit('', 'Apply to selected', 'class="submit tiny"') ?>        
    </div>		<!-- .tableactions ends -->
    
</form>

<script class="list" type="text/x-jquery-tmpl">
<tr>
    <td><input type="checkbox"></td>
    <td><a href="<?php echo site_url("supplier/edit")?>/${id}">${supplier}</a></td>
    <td><a href="mailto:${email}">${email}</a></td>
    <td>${phone}</td>
    <td>${updated}</td>
    <td>${created}</td>
    <td class="delete"><a href='#'>Edit</a> | <a href='#'>Delete</a></td>
</tr>
</script>

<script type="text/javascript">

function fetch_list(e)
{	
	$.post(
		"<?php echo site_url('supplier/results')?>", // action url
		$.deparam.fragment(), // break the url hash in a post
		function(data)
		{
			// template the returned data and add it to the table
			$('tbody').html($('.list').tmpl(data.result));
			
			// make it pretty
			$('tbody tr:odd').addClass('odd');
			$('tbody tr:even').addClass('even');
			
			// add the pagination
			pagination(data.pagination, ".pagination");
		},
		"json");
}

$(window).bind("hashchange", fetch_list);

</script>

<?php endif // rows>0 ?>