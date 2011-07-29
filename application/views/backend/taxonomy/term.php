<?php echo form_open($action)?>
<?php echo form_hidden('id', set_value('id', isset($saved)?$saved->id:''));?>
<?php echo form_hidden('term[vocabulary_id]',set_value('term[vocabulary_id]',isset($saved)?$saved->vocabulary_id:$vid));?>

<p>
<label for="term">Term<span class="mustfill">*</span></label><br/>
<?php echo form_input('term[term]', set_value('term[term]',isset($saved)?$saved->term:''), 'id="term" class="text"') ?>
<?php echo form_error('term[term]')?>
</p>
<!--p>
<label for="description">Description</label><br/>
<textarea id="description" name="term[description]" cols="50" rows="5"><?php echo $values['term']['description']?></textarea>
</p-->

<p>
<?php echo form_submit('submit','Save','class="submit"');?>&nbsp;
<a href="#" class="back_btn">Go back</a>
</p>

<?php echo form_close()?>