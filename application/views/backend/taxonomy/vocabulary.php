<?php echo form_open("taxonomy/vocabulary/$id"); ?>
<div id="sortable">
	<?php foreach($terms->result() as $row): ?>
		<div class="row clearfix ui-state-default ui-corner-all">
			<?php echo form_hidden("terms[]",$row->id)?>
			<div class="handler"><span class="ui-icon ui-icon-arrow-4"></span></div>
			<?php echo anchor("taxonomy/term/edit/$row->id",$row->term)?>
		</div>
	<?php endforeach ?>
</div>

<p>
<?php echo form_submit('submit','Save', 'class="submit"');?>&nbsp;
<?php echo anchor("taxonomy/term/add/$id",'Add term');?>
</p>

<?php echo form_close(); ?>


<script type="text/javascript">
// ordering
$("#sortable").sortable(
{
	handle: 'span',
	cursor: 'pointer',
	update: function(event, ui)
	{
		ui.item.addClass('has_moved');
	}
}).disableSelection();

</script>