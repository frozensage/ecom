<?php echo form_open('')?>
<p class="fileupload"> 
    <label>File input label:</label><br /> 
    <input type="file" id="fileupload" /> 
    <span id="uploadmsg">Max size 3Mb</span> 
</p>

<div id="file-uploader">       
    <noscript>          
        <p>Please enable JavaScript to use file uploader.</p>
        <!-- or put a simple form for upload here -->
    </noscript>         
</div>

<?php echo form_close()?>

<script type="text/javascript">
	
	// Style file input
	$("input[type=file]").filestyle(
	{ 
	    image: "<?php echo base_url() ?>images/upload.gif",
	    imageheight : 30,
	    imagewidth : 80,
	    width : 250
	});

	var uploader = new qq.FileUploader(
	{
		// pass the dom node (ex. $(selector)[0] for jQuery users)
		element: document.getElementById('file-uploader'),
		// path to server-side upload script
		action: '<?php echo site_url("file/commit")?>',
		onSubmit : function(file , ext) {
					$('.fileupload #uploadmsg').addClass('loading').text('Uploading...');
					this.disable();	
				},
		onComplete : function(file, response) {
				$('.fileupload #uploadmsg').removeClass('loading').text(response);
				this.enable();
			}	
	});
</script>