<div id="header">
	<div class="hdrl"></div>
	<div class="hdrr"></div>
	
	<h1><a href="http://enstyled.com/adminus/original/page.html#">Adminus</a></h1>
	
	<ul id="nav">
		<li><a href="http://enstyled.com/adminus/original/page.html#">Dashboard</a></li>
		<li class="active"><a href="http://enstyled.com/adminus/original/page.html#">Pages</a>
			<ul>
				<li><a href="http://enstyled.com/adminus/original/page.html#">List pages</a></li>
				<li><a href="http://enstyled.com/adminus/original/page.html#">Add page</a></li>
				<li><a href="http://enstyled.com/adminus/original/page.html#">More actions</a>
					<ul>
						<li><a href="http://enstyled.com/adminus/original/page.html#">Some action</a></li>
						<li><a href="http://enstyled.com/adminus/original/page.html#">Some action</a></li>
						<li><a href="http://enstyled.com/adminus/original/page.html#">Some action</a>
							<ul>
								<li><a href="http://enstyled.com/adminus/original/page.html#">Some action</a></li>
								<li><a href="http://enstyled.com/adminus/original/page.html#">Some action</a></li>
								<li><a href="http://enstyled.com/adminus/original/page.html#">Some action</a></li>
							</ul>
						</li>
					</ul>
				</li>
			</ul>
		</li>
		<li><a href="http://enstyled.com/adminus/original/page.html#">Posts</a></li>
		<li><a href="http://enstyled.com/adminus/original/page.html#">Media</a>
			<ul>
				<li><a href="http://enstyled.com/adminus/original/page.html#">List media</a></li>
				<li><a href="http://enstyled.com/adminus/original/page.html#">Add media</a></li>
				<li><a href="http://enstyled.com/adminus/original/page.html#">Something else</a></li>
			</ul>
		</li>
		<li class="nobg"><a href="http://enstyled.com/adminus/original/page.html#">Users</a></li>
	</ul>
	
	<p class="user">Hello, <a href="http://enstyled.com/adminus/original/page.html#">John</a> | <a href="http://enstyled.com/adminus/original/index.html">Logout</a></p>
</div>		<!-- #header ends -->


<div class="block">

	<div class="block_head">
		<div class="bheadl"></div>
		<div class="bheadr"></div>
		
		<h2>Forms</h2>
		
		<form action="" method="post">
			<input type="text" class="text" value="Search">
		</form>
	</div>	<!-- .block_head ends -->
	
	
	<div class="block_content">
	
		<p class="breadcrumb"><a href="http://enstyled.com/adminus/original/page.html#">Parent page</a> » <a href="http://enstyled.com/adminus/original/page.html#">Sub page</a> » <strong>Form page</strong> (breadcrumb)</p>
	
		
		<?php if(isset($has_error)) : ?>
		<div class="message errormsg">
			Please fix all error(s) before re-submitting.					
		</div>
		<?php endif ?>
		
		
		<?php echo form_open('user/create_submit')?>
		<p>
			<label>Email:</label><br>
			<?php echo form_input('username',set_value('username'),'id="username" class="text small"')?>
			<span class="note error"><?php echo form_error('username')?></span>
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