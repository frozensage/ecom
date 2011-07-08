<?php if ($query->num_rows()>0) : ?>

<form action="" method="post">

    <table cellpadding="0" cellspacing="0" width="100%" class="sortable">
    
        <thead>
            <tr>
                <th width="10"><input type="checkbox" class="check_all"></th>
                <th class="header" style="cursor: pointer; ">Supplier</th>
                <th class="header" style="cursor: pointer; ">Email</th>
                <th class="header" style="cursor: pointer; ">Phone</th>
                <th class="header" style="cursor: pointer; ">Updated</th>
                <th class="header" style="cursor: pointer; ">Created</th>
                <td>&nbsp;</td>
            </tr>
        </thead>
        
        <tbody>
        <?php foreach($query->result() as $index=>$row): ?>
            <tr class="<?php echo $index%2?'odd':'even'?>">
                <td><input type="checkbox"></td>
                <td><a href="<?php echo site_url('supplier/edit/'.$row->id)?>"><?php echo $row->supplier?></a></td>
                <td><a href="mailto:<?php echo $row->email?>"><?php echo $row->email?></a></td>
                <td><?php echo $row->phone?></td>
                <td><?php echo $row->updated?></td>
                <td><?php echo $row->created?></td>
                <td class="delete"><a href="http://enstyled.com/adminus/original/page.html#">Edit</a> | <a href="http://enstyled.com/adminus/original/page.html#">Delete</a></td>
            </tr>
        <?php endforeach ?>    
        </tbody>
        
    </table>
    
    <p><a href="<?php echo site_url('supplier/create')?>">Create more</a></p>      
                
    <div class="tableactions">
        <select>
            <option>Actions</option>
            <option>Delete</option>
            <option>Edit</option>
        </select>
        
        <?php echo form_submit('', 'Apply to selected', 'class="submit tiny"') ?>        
    </div>		<!-- .tableactions ends -->
                
    <div class="pagination right">
        <a href="http://enstyled.com/adminus/original/page.html#">«</a>
        <a href="http://enstyled.com/adminus/original/page.html#" class="active">1</a>
        <a href="http://enstyled.com/adminus/original/page.html#">2</a>
        <a href="http://enstyled.com/adminus/original/page.html#">3</a>
        <a href="http://enstyled.com/adminus/original/page.html#">4</a>
        <a href="http://enstyled.com/adminus/original/page.html#">5</a>
        <a href="http://enstyled.com/adminus/original/page.html#">6</a>
        <a href="http://enstyled.com/adminus/original/page.html#">»</a>
    </div>		<!-- .pagination ends -->
    
</form>

<?php endif // rows>0 ?>