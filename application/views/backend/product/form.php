
<div class="block">

	<div class="block_head">
		<div class="bheadl"></div>
		<div class="bheadr"></div>
		
		<h2>Create user</h2>
		
	</div>	<!-- .block_head ends -->
	
	
	<div class="block_content">
	
		<p class="breadcrumb"><a href=".">Dashboard</a> &raquo; <a href=".">Manage users</a> &raquo; <strong>Create user</strong></p>
	
		
		<?php if(isset($has_error)) : ?>
		<div class="message errormsg">
			Please fix all error(s) before re-submitting.					
		</div>
		<?php endif ?>
		
		<?php echo form_open('user/create_submit')?>
		<p>
            <label for="name">Product name<span class="mustfill">*</span></label><br/>
            <?php echo form_input('product[product]', set_value('product[product]'), 'id="name" class="text large"') ?>
            <?php echo form_error('product[product]')?>
        </p>
        <p>
            <label for="code">Code<span class="mustfill">*</span></label><br/>
            <?php echo form_input('product[code]', set_value('product[code]'), 'id="code" class="text tiny"') ?>
            <?php echo form_error('product[code]')?>
        </p>
        <p>
            <label for="manufacturer_id">Manufactuer<span class="mustfill">*</span></label><br/>
            <?php echo form_dropdown('product[manufacturer_id]',$manufacturers,$values['product']['manufacturer_id'],'id="manufacturer_id"')?>
            <?php echo form_error('product[manufacturer_id]')?>
        </p>
        
        <p>
            <label for="description">Description</label><br/>
            <?php echo form_textarea('product[description]', set_value('product[description]'), 'id="description" class="text" cols="50" rows="10"') ?>
            <?php echo form_error('product[description]')?>
        </p>
        <p>
            <label for="price">Price ($)<span class="mustfill">*</span></label><br/>
            <?php echo form_input('product[price]', set_value('product[price]'), 'id="price" class="text tiny"') ?>
            <?php echo form_error('product[price]')?>
        </p>
        
        <p>
			<?php echo form_submit('submit','Save', 'class="submit"')?>
		</p>
        
        <?php echo form_hidden('product[type]', strcmp($type,'associated')?'Standalone':'Associated')?>

		<?php echo form_hidden('product[id]', set_value('product[id]'));?>
        
		<?php echo form_close()?>
		
		
	</div>		<!-- .block_content ends -->
	
	<div class="bendl"></div>
	<div class="bendr"></div>
		
</div>		<!-- .block ends -->
