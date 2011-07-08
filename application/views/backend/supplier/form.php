
<?php echo form_open('supplier/save')?>
<?php echo form_hidden('id', set_value('id', isset($saved)?$saved->id:''));?>
<p>
    <label for="supplier">Supplier<span class="mustfill">*</span></label><br/>
    <?php echo form_input('supplier[supplier]', set_value('supplier[supplier]', isset($saved)?$saved->supplier:''), 'id="supplier" class="text"') ?>
    <?php echo form_error('supplier[supplier]')?>
</p>
<p>
    <label for="email">Email<span class="mustfill">*</span></label><br/>
    <?php echo form_input('supplier[email]', set_value('supplier[email]', isset($saved)?$saved->email:''), 'id="email" class="text"') ?>
    <?php echo form_error('supplier[email]')?>
</p>
<p>
    <label for="phone">Phone</label><br/>
    <?php echo form_input('supplier[phone]', set_value('supplier[phone]', isset($saved)?$saved->phone:''), 'id="phone" class="text small"') ?>
    <?php echo form_error('supplier[phone]')?>
</p>

<p>
    <?php echo form_submit('submit','Save', 'class="submit"')?> <a href="#" class="back_btn">Go back</a>
</p>
<?php echo form_close()?>

