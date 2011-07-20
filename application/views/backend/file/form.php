<?php echo form_open_multipart('file/commit')?>
<ul class="imglist"></ul>

<p class="fileupload"> 
    <label>File:</label><br />
    <input type="file" id="file" name="file" /> 
    <span id="uploadmsg">Max size 3MB</span>
</p>

<p>
    <?php echo form_submit('submit','Save', 'class="submit"')?> <a href="#" class="back_btn">Go back</a>
</p>

<?php echo form_close()?>

<script class="img" type="text/x-jquery-tmpl">
<li>
	<img src="<?php echo base_url()?>uploads/${file_name}" width="120" height="120">
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
						$('.fileupload').after($('<p class="error note no-left"/>').text(response.error));
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
			function(data)
			{				
				$('.imglist li img[src="'+data.path+data.filename+'"]').parents('li').fadeOut(500);
			}, 
			"json");
	});

</script>