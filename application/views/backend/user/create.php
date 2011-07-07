
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
			<label>Email:</label><br>
			<?php echo form_input('email',set_value('email'),'id="email" class="text small"')?>
			<span class="note error"><?php echo form_error('email')?></span>
		</p>
		
		<p>
			<label>Password:</label><br>
			<?php echo form_password('password','','id="password" class="text small"')?> 
			<span class="note error"><?php echo form_error('password')?></span>
		</p>
		
		<p>
			<label>Password confirm:</label><br>
			<?php echo form_password('password_conf','','id="password_conf" class="text small"')?>
			<span class="note error"><?php echo form_error('password_conf')?></span>
		</p>
								
		<hr>
		
		<p>
			<?php echo form_submit('submit','Create', 'class="submit"')?>
		</p>
		<?php echo form_close()?>
		
		
	</div>		<!-- .block_content ends -->
	
	<div class="bendl"></div>
	<div class="bendr"></div>
		
</div>		<!-- .block ends -->
	
</body>
</html>