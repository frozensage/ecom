<?php echo form_open_multipart('file/commit')?>
<ul class="imglist">
</ul>

<p class="fileupload"> 
    <label>File:</label><br />
    <input type="file" id="file" name="file" /> 
    <span id="uploadmsg">Max size 3Mb</span>
</p>

<?php echo form_submit('Submit', 'submit');?>
<?php echo form_close()?>

<script class="img" type="text/x-jquery-tmpl">
<li>
	<img src="${path+filename}" width="120" height="120">
	<ul>
		<li class="view">
			<a href="${path+filename}" class="enlarge">View</a>
		</li>
		<li class="delete">
			<a href="#delete=${filename}" class="delete">Delete</a>
		</li>
	</ul>
</li>
</script>
<script type="text/javascript">

	// Style file input
	$("input[type=file]").filestyle(
	{ 
	    image: "<?php echo base_url() ?>images/upload.gif",
	    imageheight : 30,
	    imagewidth : 80,
	    width : 250
	});

	var uploader = new qq.FileUploaderBasic(
	{
		button: 	$('#file')[0],
		action:		'<?php echo site_url("file/commit")?>',
		debug:		true,
		onSubmit: 
			function(id, filename)
			{
				$('.fileupload #uploadmsg').toggleClass('loading').text('Uploading '+filename+' ...');
			},
		onComplete : 
			function(id, filename, response) 
			{
				$('.fileupload #uploadmsg').toggleClass('loading').empty();
				
				$('.imglist').append(
					$('.img').tmpl(
					{
						path: response.path, 
						filename: filename
					})
					.hide().fadeIn(500));
				
				$('.imglist a.enlarge').fancybox();
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