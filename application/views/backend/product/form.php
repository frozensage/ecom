
<?php echo form_open('user/create_submit')?>
<p>
    <label for="name">Product name<span class="mustfill">*</span></label><br/>
    <?php echo form_input('product[product]', set_value('product[product]'), 'id="name" class="text large"') ?>
    <?php echo form_error('product[product]')?>
</p>

<ul class="imglist"></ul>

<p class="fileupload"> 
    <label>File:</label><br />
    <input type="file" id="file" name="file" /> 
    <span id="uploadmsg">Max size 3MB</span>
</p>

<p>
    <label for="code">Code<span class="mustfill">*</span></label><br/>
    <?php echo form_input('product[code]', set_value('product[code]'), 'id="code" class="text tiny"') ?>
    <?php echo form_error('product[code]')?>
</p>
<p>
    <label for="supplier_id">Supplier<span class="mustfill">*</span></label><br/>
    <?php echo form_dropdown(
        'product[supplier_id]',
        $suppliers,
        '',
        'id="supplier_id" class="styled"')?>
    <?php echo form_error('product[supplier_id]')?>
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

<?php if(strcmp($type,'associated')<>0): // show below fields if standalone product ?>
	<p>
		<label for="was">Was ($)</label><br/>
		<input id="was" type="text" name="product[was]" class="text price"
			value="<?php echo $values['product']['was']; ?>" />
		<?php echo form_error('product[was]')?>			
	</p>
	<?php foreach($taxonomy as $vocabulary=>$terms): ?>
		<p>
			<label><?php echo $vocabulary?></label>
			<?php foreach($terms as $id=>$term): ?>
				<br/>
				<?php echo form_checkbox("term_id[]", $id, in_array($id, $values['term_id']));?>
				<?php echo $term?>
			<?php endforeach ?>
			<?php echo form_error("term_id[]")?>		
		</p>
	<?php endforeach ?>

	<p>
		<label>Status</label>
		<br/>
		<?php echo form_checkbox("product[active]", "Yes", 
			isset($values['product']['active'])&&strcmp($values['product']['active'],"Yes")==0) ?>
		active
		<br/>
		<?php echo form_checkbox("product[out_of_stock]", "Yes", 
			isset($values['product']['out_of_stock'])&&strcmp($values['product']['out_of_stock'],"Yes")==0) ?> 
		out of stock
	</p>
	
	<?php /*echo form_fieldset('Options') ?>
		
		<!-- options -->
		<?php $i=0; ?>
		<?php foreach($values['options'] as $index=>$option): ?>
		<?php $i++; ?>
			
			<div class="row clearfix">
				<div class="column">
					<label>Name<span class="mustfill">*</span></label>
					<br/>
					<input name="options[<?=$i?>][option]" value="<?=$option['option']?>" class="text medium required" /></div>
				<div class="column">
					<label>Extra<span class="mustfill">*</span></label>
					<br/>
					<input name="options[<?=$i?>][price]" value="<?=$option['price']?>" class="text price required" /></div>
				<div class="column last">
					<br/>
					<a href="#" class="remove_item">remove</a></div>
			</div>
			
		<?php endforeach ?>
		
		<div class="row clearfix">
			<div class="column">
				<label>Name<span class="mustfill">*</span></label>
				<br/>
				<input name="options[0][option]" class="text medium required" /></div>
			<div class="column">
				<label>Extra ($)<span class="mustfill">*</span></label>
				<br/>
				<input name="options[0][price]" class="text price required" /></div>
			<div class="column last">
				<br/><a href="#" class="add_item">add</a></div>
		</div>
		
		<input type="hidden" id="option_index" class="index" value=<?=$i?> />
		<!-- options end -->

	<?php echo form_fieldset_close() ?>
	
	<?php echo form_fieldset('Delivery schedule') ?>

	<!-- delivery schedule -->	
	<?php $j=0; ?>
	
	<?php foreach($values['delivery_schedules'] as $index=>$delivery_schedule): ?>
		<?php $j++; ?>
		<div class="row clearfix">
			<div class="column">
				<label>Location<span class="mustfill">*</span></label><br/>
				<?php echo form_dropdown("delivery_schedules[$j][location_id]", $locations, $delivery_schedule['location_id'], array('class'=>"required"))?>
			</div>
			<div class="column">
				<label>Description<span class="mustfill">*</span></label><br/>
				<input name="delivery_schedules[<?=$j?>][description]" value="<?=$delivery_schedule['description']?>" class="text medium required" />
			</div>
			<div class="column">
				<label>Price ($)<span class="mustfill">*</span></label><br/>
				<input name="delivery_schedules[<?=$j?>][price]" value="<?=$delivery_schedule['price']?>" class="text price required" />
			</div>
			<div class="column">
				<label>Same day</label><br/>
				<?php echo form_checkbox("delivery_schedules[$j][same_day]", 'Yes', isset($delivery_schedule['same_day']));?>
			</div>
			<div class="column">
				<label>Call for quote</label><br/>
				<?php echo form_checkbox("delivery_schedules[$j][call_for_quote]", 'Yes', isset($delivery_schedule['call_for_quote']));?>
			</div>
			<div class="column">
				<label>Note</label><br/>
				<input name="delivery_schedules[<?=$j?>][note]" value="<?=$delivery_schedule['note']?>" class="text medium" />
			</div>
			<div class="column last">
				<br/><a href="#" class="remove_item">remove</a>
			</div>
		</div>
		
	<?php endforeach ?>
	
	<div class="row clearfix last">
		<div class="column">
			<label>Location<span class="mustfill">*</span></label><br/>
			<?php echo form_dropdown("delivery_schedules[0][location_id]",$locations, '', array('class'=>"required"))?>
		</div>
		<div class="column">
			<label>Description<span class="mustfill">*</span></label><br/>
			<input name="delivery_schedules[0][description]" class="text medium required" />
		</div>
		<div class="column">
			<label>Price ($)<span class="mustfill">*</span></label><br/>
			<input name="delivery_schedules[0][price]" class="text price required" />
		</div>
		<div class="column">
			<label>Same day</label><br/>
			<?php echo form_checkbox("delivery_schedules[$j][same_day]", 'Yes');?>
		</div>
		<div class="column">
			<label>Call for quote</label><br/>
			<input name="delivery_schedules[0][call_for_quote]" type="checkbox" value="Yes"/>
		</div>
		<div class="column">
			<label>Note</label><br/>
			<input name="delivery_schedules[0][note]" class="text medium" />
		</div>
		<div class="column last">
			<br/><a href="#" class="add_item">add</a>
		</div>
	</div>
	<?php */ ?>
    
	<input type="hidden" id="delivery_schedules_index" class="index" value=<?=$j?> />
	<!-- delivery schedule end -->

<?php endif //associated ?>



<p>
    <?php echo form_submit('submit','Save', 'class="submit"')?>
</p>

<?php echo form_hidden('product[type]', strcmp($type,'associated')?'Standalone':'Associated')?>

<?php echo form_hidden('product[id]', set_value('product[id]'));?>

<?php echo form_close()?>

<script class="img" type="text/x-jquery-tmpl">
<li>
	<img src="<?php echo base_url()?>uploads/${file_name}" alt="${file_name}" width="120" height="120">
	<ul>
		<li class="view">
			<a href="<?php echo base_url()?>uploads/${file_name}" class="enlarge">View</a>
		</li>
		<li class="delete">
			<a href="#delete=${file_name}" class="delete">Delete</a>
		</li>
	</ul>
</li>
</script>
<script type="text/javascript">

// Style file input
$("input[type=file]").filestyle(
{ 
	image		: "<?php echo base_url() ?>images/upload.gif",
	imageheight : 30,
	imagewidth 	: 80,
	width 		: 250
});

new AjaxUpload('file', 
{
	action			: '<?php echo site_url("file/commit")?>',
	name			: 'file', // File upload name
	autoSubmit		: true,
	responseType	: "json",
	onChange		: function(file, extension){},
	onSubmit		: 
		function(id, filename)
		{
			$('.note').remove();
			$('.fileupload #uploadmsg').toggleClass('loading').text('Uploading...');
		},
	onComplete 		: 
		function(filename, response) 
		{					
			$('.fileupload #uploadmsg').toggleClass('loading').text('Max size 3MB');
			
			if(response.error != null)
			{
				$('.fileupload')
					.after($('<p class="error note no-left"/>').text(response.error));
			}
			else
			{					
				$('.imglist').append($('.img').tmpl(response).hide().fadeIn(500));
			
				$('.imglist a.enlarge').fancybox();
			}
		}
});

$(window).bind('hashchange', function()
{		
	$.post(
		"<?php echo site_url('file/delete')?>", 
		$.deparam.fragment(),
		function(response)
		{
			if(response.error != null)
			{
				$('.fileupload')
					.after($('<p class="error note no-left"/>').text(response.error));
			}
			else
			{
				if (window.console) console.log(response);
				
				$('.imglist li img[alt="'+response.filename+'"]')
					.parents('li').fadeOut(500);
			}
		}, 
		"json");
});

// load the spinner when ajax is loading
$('.fileupload #uploadmsg')
	.ajaxStart(function()
	{
		//$('.note').remove();
		$(this).toggleClass('loading').text('Uploading...');
	})
	.ajaxStop(function()
	{
		$(this).toggleClass('loading').text('Max size 3MB');
	});
</script>
