
<?php echo form_open('product/save')?>

<?php echo form_hidden('id', set_value('id', isset($saved)?$saved->id:''));?>
<?php echo form_hidden('product[type]', strcmp($type,'associated')?'Standalone':'Associated')?>

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
        <?php echo form_input('product[was]', set_value('product[was]'), 'id="price" class="text tiny"') ?>
    	<?php echo form_error('product[was]')?>		
	</p>
	<?php foreach($taxonomy as $vocabulary=>$terms): ?>
		<p>
			<label><?php echo $vocabulary?></label>
			<?php foreach($terms as $id=>$term): ?>
				<br/>
				<?php echo form_checkbox("term_id[]", $id);?>
				<?php echo $term?>
			<?php endforeach ?>
			<?php echo form_error("term_id[]")?>		
		</p>
	<?php endforeach ?>
	
    <!-- options -->
   
    <hr />
    
    <table cellpadding="0" cellspacing="0" class="extras" id="options">
        <thead>
            <tr>
                <th>Name</th>
                <th colspan="2">Price ($)</th>
            </tr>
        </thead>
        <tbody>
        	<?php $i=0; ?>
			<?php if($options = $this->input->post('options')) : ?>
				<?php foreach($options as $index=>$option): ?>
                <tr>
                    <td> 
                        <?php echo form_input("options[$i][option]", set_value("options[$index][option]"), 'class="text"')?><br/>
                        <?php echo form_error("options[$index][option]")?>
                    </td>
                    <td>
                        <?php echo form_input("options[$i][price]", set_value("options[$index][price]"), 'class="small text"')?><br/>
                        <?php echo form_error("options[$index][price]")?>
                    </td>
                    <td><a href="#" class="remove_this">Remove</a></td>
                </tr>
                <?php $i++; ?>
                <?php endforeach ?>
            <?php endif ?>
        	<tr>
                <td> 
                    <?php echo form_input("options[$i][option]",'','class="text"')?>
                </td>
                <td>
                    <?php echo form_input("options[$i][price]",'','class="small text"')?>
                </td>
                <td><a href="#" class="add_item">Add</a></td>
            </tr>
        </tbody>
        <input type="hidden" class="index" value="<?php echo $i?>" />
    </table>
   	
    <!-- options end -->
    
	<?php /* ?>

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
		
	<?php endforeach */?>
	
    <hr />
    
    <table cellpadding="0" cellspacing="0" class="extras" id="delivery_schedules">
    	<thead>
        	<tr>
                <th>Location</th>
                <th>Description</th>
                <th>Price ($)</th>
                <th>Same day</th>
                <th>Call for quote</th>
                <th colspan="2">Note</th>
            </tr>
		</thead>
        <tbody>
			<?php if($delivery_scheules = $this->input->post('delivery_schedules')): ?>
                
                <?php $i = 1; ?>
                
                <?php foreach($delivery_scheules as $delivery_schedule): ?>
                <tr>
                    <td>
                        <?php echo form_dropdown("delivery_schedules[$i][location_id]", $locations, '', 'id="location_id" class="styled"');?>
                    </td>
                    <td>
                        <?php echo form_input("delivery_schedules[$i][description]", set_value("delivery_schedules[$i][description]"), 'class="text"')?><br/>
                        <?php echo form_error("delivery_schedules[$i][description]")?>
                    </td>
                    <td>
                        <?php echo form_input("delivery_schedules[$i][price]", set_value("delivery_schedules[$i][price]"), 'class="text small"')?><br/>
                        <?php echo form_error("delivery_schedules[$i][price]")?>
                    </td>
                    <td>
                        <?php echo form_checkbox("delivery_schedules[$i][same_day]", 'Yes', set_value("delivery_schedules[$i][same_day]"), 'class="checkbox"');?>
                    </td>
                    <td>
                        <?php echo form_checkbox("delivery_schedules[$i][call_for_quote]", 'Yes', set_value("delivery_schedules[$i][call_for_quote]"), 'class="checkbox"')?>
                    </td>
                    <td>
                        <?php echo form_input("delivery_schedules[$i][note]", set_value("delivery_schedules[$i][note]"), 'class="text"')?>
                    </td>
                    <td><a href="#" class="remove_item">Remove</a></td>
                </tr>	
                <?php endforeach ?>
            <?php endif ?>
        	<tr>
            	<td>
               		<?php echo form_dropdown('delivery_schedules[0][location_id]', $locations, '', 'id="location_id" class="styled"');?>
                </td>
                <td>
					<?php echo form_input('delivery_schedules[0][description]', set_value('delivery_schedules[0][description]'), 'class="text"')?><br/>
                </td>
                <td>
                	<?php echo form_input('delivery_schedules[0][price]', set_value('delivery_schedules[0][price]'), 'class="text small"')?><br/>
                </td>
                <td>
                	<?php echo form_checkbox("delivery_schedules[0][same_day]", 'Yes', set_value('delivery_schedules[0][same_day]'), 'class="checkbox"');?>
                </td>
                <td>
                	<?php echo form_checkbox('delivery_schedules[0][call_for_quote]', 'Yes', set_value('delivery_schedules[0][call_for_quote]'), 'class="checkbox"')?>
                </td>
                <td>
                	<?php echo form_input('delivery_schedules[0][note]', set_value('delivery_schedules[0][note]'), 'class="text"')?>
                </td>
                <td></td>
        	</tr>
        </tbody>
    </table>
    
    <p><a href="#" class="add_schedule">add another</a></p>
	
    <!-- delivery schedule end -->

<?php endif //associated ?>

<hr/>

<p>
    <?php echo form_submit('submit','Save', 'class="submit"')?>
</p>

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

$('a.add_item').click(add_item);

// Style file input
$("input[type=file]").filestyle(
{ 
	image		: "<?php echo base_url() ?>images/upload.gif",
	imageheight : 30,
	imagewidth 	: 80,
	width 		: 250
});

// AJAX file upload
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

// AJAX file delete
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
