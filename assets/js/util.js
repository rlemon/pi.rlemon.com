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

/* stripped down FragBuilder */
var FragBuilder = (function() {
    var applyStyles = function(element, style_object) {
        for (var prop in style_object) {
            element.style[prop] = style_object[prop];
        }
    };
    var generateFragmentFromJSON = function(json) {
        var tree = document.createDocumentFragment();
        json.forEach(function(obj) {
            if (!('tagName' in obj) && 'textContent' in obj) {
                tree.appendChild(document.createTextNode(obj['textContent']));
            } else if ('tagName' in obj) {
                var el = document.createElement(obj.tagName);
                delete obj.tagName;
                for (part in obj) {
                    var val = obj[part];
                    switch (part) {
                    case ('textContent'):
                        el.appendChild(document.createTextNode(val));
                        break;
                    case ('style'):
                        applyStyles(el, val);
                        break;
                    case ('childNodes'):
                        el.appendChild(generateFragmentFromJSON(val));
                        break;
                    default:
                        if (part in el) {
                            el[part] = val;
                        }
                        break;
                    }
                }
                tree.appendChild(el);
            } else {
                throw "Error: Malformed JSON Fragment";
            }
        });
        return tree;
    };
    return generateFragmentFromJSON;
}());
