
<div class="block small center login">

	<div class="block_head">
		<div class="bheadl"></div>
		<div class="bheadr"></div>
		
		<h2>Login</h2>
		<ul>
			<li class="nobg"><a href="http://enstyled.com/adminus/original/#">back to the site</a></li>
		</ul>
	</div>	<!-- .block_head ends -->
					
	<div class="block_content">
		<?php if(isset($has_error)) : ?>
		<div class="message errormsg">
			<?php echo validation_errors(); ?>						
		</div>
		<?php endif ?>
		
		<?php echo form_open()?>
		<p>
			<label>Email:</label> <br>
			<?php echo form_input('email',set_value('email'),'id="email" class="text"')?>
		</p>
		
		<p>
			<label>Password:</label> <br>
			<?php echo form_password('password','','id="password" class="text"')?>
		</p>
		
		<p>
			<?php echo form_submit('submit','Login', 'class="submit"')?> &nbsp; 
			<input type="checkbox" class="checkbox" checked="checked" id="rememberme"> <label for="rememberme">Remember me</label>
		</p>
		<?php echo form_close()?>
		
	</div>	<!-- .block_content ends -->
		
	<div class="bendl"></div>
	<div class="bendr"></div>
					
</div>	<!-- .login ends -->
