listener.add(By.id('permalink'), 'click', function(e) {
	this.focus();
	this.select();
});
window.onload = function() { prettyPrint(); }
