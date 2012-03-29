
<footer class="clearfix">
	<p class="pull-left">© Robert Lemon 2012 - <a href="http://rlemon.com">rlemon.com</a> 
	<p class="pull-right">stay current | <a href="http://blog.rlemon.com">blog</a> | <a href="http://twitter.com/thegreatrupert">twitter</a> | <a href="http://github.com/rlemon">github</a> </p>
</footer>
</div>

<script type="text/javascript" src="/assets/google-code-prettify/prettify.js"></script>
<?php if( isset( $this->scripts ) ): ?>
<?php foreach($this->scripts as $script): ?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php endforeach; ?>
<?php endif; ?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-30454567-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</body>
</html>
