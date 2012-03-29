<div class="well">
	<?php if( isset( $this->filehash ) ): ?>
	<h3>Your paste is ready:</h3>
	<h2><a href="/paste/<?php echo $this->filehash; ?>" class="">http://pi.rlemon.com/paste/<?php echo $this->filehash; ?></a></h2>
	<?php endif; ?>
	<h1>Paste Upload</h1>
	<form class="form-horizontal" action="/paste" method="post">
		<fieldset>
			<legend>Paste your snippet in the area below</legend>
			<div class="control-group">
				<label class="control-label" for="input-code">Code</label>
				<div class="controls">
					<textarea class="code-input" id="input-code" name="code" rows="24"></textarea>
				</div>
			</div>
			<div class="form-actions">
				<button type="submit" name="upload-paste" class="btn btn-primary">Upload Paste</button>
				<a href="/" class="btn">Cancel</a>
			</div>
		</fieldset>
	</form>
</div>
