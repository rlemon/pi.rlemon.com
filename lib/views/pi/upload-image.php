<div class="well">
	<?php if( isset( $this->error ) ): ?>
	<pre>
	<?php echo $this->error; ?>
	</pre>
	<?php endif; ?>
	<h1>Upload an image</h1>
	<form class="form-horizontal" action="/image" method="post" enctype="multipart/form-data">
		<fieldset>
			<legend>Select an Image to upload.</legend>
			<div class="control-group">
				<label class="control-label" for="image-input">Image file</label>
				<div class="controls">
					<input class="input-file" id="image-input" name="image" type="file">
					<p class="help-block">Accepted formats are PNG, JPG, and GIF. Images must be less than 2MB.</p>
				</div>
			</div>
			<div class="form-actions">
				<button type="submit" name="upload-image" class="btn btn-primary">Upload Image</button>
				<a href="/" class="btn">Cancel</a>
			</div>
		</fieldset>
	</form>
</div>
