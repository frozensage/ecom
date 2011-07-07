<div class="block">
			
    <div class="block_head">
        <div class="bheadl"></div>
        <div class="bheadr"></div>
        
        <h2>Manage users</h2>
        
        <ul>
            <li class="nobg"><a href="create">Create user</a></li>
        </ul>
    </div>		<!-- .block_head ends -->
    
    <div class="block_content">
    
    <?php if ($query->num_rows()>0) : ?>
    
        <form action="" method="post">
        
            <table cellpadding="0" cellspacing="0" width="100%" class="sortable">
            
                <thead>
                    <tr>
                        <th width="10"><input type="checkbox" class="check_all"></th>
                        <th class="header" style="cursor: pointer; ">Email</th>
                        <th class="header" style="cursor: pointer; ">Updated</th>
                        <th class="header" style="cursor: pointer; ">Created</th>
                        <td>&nbsp;</td>
                    </tr>
                </thead>
                
                <tbody>
                <?php foreach($query->result() as $index=>$row): ?>
                    <tr class="<?php echo $index%2?'odd':'even'?>">
                        <td><input type="checkbox"></td>
                        <td><a href="edit/<?php echo $row->id?>"><?php echo $row->email?></a></td>
                        <td><?php echo $row->updated?></td>
                        <td><?php echo $row->created?></td>
                        <td class="delete"><a href="http://enstyled.com/adminus/original/page.html#">Edit</a> | <a href="http://enstyled.com/adminus/original/page.html#">Delete</a></td>
                    </tr>
                <?php endforeach ?>    
                </tbody>
                
            </table>
                        
            <div class="tableactions">
                <select>
                    <option>Actions</option>
                    <option>Delete</option>
                    <option>Edit</option>
                </select>
                
                <input type="submit" class="submit tiny" value="Apply to selected">
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
        
    </div>		<!-- .block_content ends -->
    
    <div class="bendl"></div>
    <div class="bendr"></div>
    
</div>