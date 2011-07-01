<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Login</title>
</head>
<body>
<h1>Login</h1>
<?php echo form_open('admin/login_submit')?>
<p><label for="username">Username:</label><?php echo form_input('username',set_value('username'),'id="username" class="field"')?><?php echo form_error('username')?></p>
<p><label for="password">Password:</label><?php echo form_password('password','','id="password" class="field"')?><?php echo form_error('password')?></p>
<?php echo form_submit('submit','Login')?>
<?php echo form_close()?>
</body>
</html>