<div class="row">
	<p class="clearfix">
		<a href="<?php echo $_SERVER['REQUEST_URI'];?>/raw" class="label label-info pull-right" target="_blank">view raw</a>
	</p>
	<pre class="prettyprint linenums"><code><?php echo preg_replace(array('/\</','/\>/'),array('&lt;','&gt;'),$this->paste_content); ?></code></pre>
</div>
