/* Listener Object 
 * For event registration and unregistration
 */
var listener = (function() {
	function listenerAdd(elm, evt, func) {
		if( elm.addEventListener ) {
			elm.addEventListener(evt, func, false);
		} else if( elm.attachEvent ) {
			elm.attachEvent('on'+evt, func);
		}
	};
	function listenerRemove(elm, evt, func) {
		if( elm.removeEventListener ) {
			elm.removeEventListener(evt, func, false);
		} else if( elm.detachEvent ) {
			elm.detachEvent('on'+evt, func);
		}
	};
	return {
		add: listenerAdd,
		remove: listenerRemove
	};
}());

/* because it's easier to write */
var By = (function() {
	function byId(id) {
		return document.getElementById(id);
	};
	function byTag(tag, context) {
		return (context || document).getElementsByTagName(tag);
	};
	function byClass(klass, context) {
		return (context || document).getElementsByClassName(klass);
	}
	function byName(name) {
		return document.getElementsByName(name);
	};
	function byQuery(query, context) {
		return (context || document).querySelectorAll(query);
	};
	function byQueryOne(query, context) {
		return (context || document).querySelector(query);
	};
	return {
		id: byId,
		tag: byTag,
		'class': byClass,
		name: byName,
		qsa: byQuery,
		qs: byQueryOne
	};
}());
