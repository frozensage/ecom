
<?php echo form_open('user/create')?>
<p>
    <label>Email:</label><br>
    <?php echo form_input('email',set_value('email'),'id="email" class="text small"')?>
    <?php echo form_error('email')?>
</p>

<p>
    <label>Password:</label><br>
    <?php echo form_password('password','','id="password" class="text small"')?> 
    <?php echo form_error('password')?>
</p>

<p>
    <label>Password confirm:</label><br>
    <?php echo form_password('password_conf','','id="password_conf" class="text small"')?>
    <?php echo form_error('password_conf')?>
</p>
                        
<hr/>

<p>
    <?php echo form_submit('submit','Create', 'class="submit"')?>
</p>

<?php echo form_close()?>