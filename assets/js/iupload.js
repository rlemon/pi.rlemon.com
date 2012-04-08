var fileUpload = function(form, callback) {
	/* vars */
	var iframe;
	/* iframe listener */
	var ilistener = function() {
		var results;
		listener.remove(this, 'load', ilistener);
		if( 'contentDocument' in this ) {
			results = this.contentDocument.body.innerHTML;
		} else if ( 'contentWindow' in this ) {
			results = this.contentWindow.document.body.innerHTML;
		} else if ( 'document' in this ) {
			results = this.document.body.innerHTML;
		} else {
			throw "i'm dead jim :/";
		}
		callback.apply(this,[results]);
		this.parentNode.removeChild(this);
	};
	
	/* create the iframe */
	form.parentNode.appendChild(FragBuilder([{"tagName": "iframe","id": "upload_iframe","name": "upload_iframe","style": {"height": "0","width": "0","border": "0", "display":"none"}}]));
	/* collect the iframe back */
	iframe = By.id('upload_iframe');
	/* set the form target */
	form.target = "upload_iframe";
	/* attach the event listener to the iframe */
	listener.add(iframe, 'load', ilistener);
	form.submit();
};
var form = document.forms['image-upload'], results = By.id('upload-results');

var clearChildren = function(element) {
	while (element.hasChildNodes()) {
		element.removeChild(element.lastChild);
	}
};

listener.add(form, 'submit', function(e) {
	e.preventDefault();
	if( results.hidden ) {
		results.hidden = false;
	}
	clearChildren(results); /* this could all be improved by holding onto the spinner and changing the src? */
	results.appendChild(FragBuilder([{"tagName": "img","src":"/assets/img/loader-bar.gif"}]));
	fileUpload(this, function(data) { 
		data = JSON.parse(data);
		clearChildren(results);
		if( 'imgsrc' in data ) {
			results.appendChild(FragBuilder([{"tagName":"a","href":data.imgsrc,"childNodes":[{"tagName":"img","src":data.imgsrc}]}]));
		} else if ( 'error' in data ) {
			results.appendChild(FragBuilder([{"textContent":data.error}]));
		} else {
			results.appendChild(FragBuilder([{"textContent":"Unknown Error"}]));
			throw "error";
		}
	});
});
