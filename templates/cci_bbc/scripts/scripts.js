var _PopoutElement = new Class({
	container: null,
	body: null,
	content: null,
	headline: null,
	text: null,
	highlight: null,	
	
	contentToggle: null,
	headlineToggle: null,
	textToggle: null,
	highlightToggle: null,
	
	contentOpen: null,
	contentClose: null,
	headlineOpen: null,
	headlineClose: null,
	textOpen: null,
	textClose: null,
	highlightOpen: null,
	hightlightClose: null,
	
	options: {
		onOpen: null,
		onClose: null,
		onMouseEnter: null,
		onMouseLeave: null,
	},
	
	initialize: function(body, content, headline, text, highlight) {
		this.body		= body;
		this.content	= content;
		this.headline	= headline;
		this.text		= text;
		this.highlight	= highlight;
		
		this.contentToggle		= new Fx.Styles(this.content, {});
		this.headlineToggle		= new Fx.Styles(this.headline, {});
		this.textToggle			= new Fx.Styles(this.text, {});
		this.highlightToggle	= new Fx.Styles(this.highlight, {});
		
		this.content.addEvent('mouseenter', function() {
			this._mouseEnter();
			this.fireEvent('onMouseenter');
		}.bind(this));
		this.content.addEvent('mouseleave', function() {
			this._mouseLeave();
			this.fireEvent('onMouseleave');
		}.bind(this));
	},
	
	open: function() {
		this._stop();
	
		this.contentToggle.start(this.contentOpen);
		this.headlineToggle.start(this.headlineOpen);
		this.textToggle.start(this.textOpen);
		//this.highlightToggle.start(this.highlightOpen);
		this.highlight.setStyles(this.highlightOpen);
		
		this.fireEvent('onOpen');
	},
	setOpen: function() {
		this._stop();
	
		this.contentToggle.set(this.contentOpen);
		this.headlineToggle.set(this.headlineOpen);
		this.textToggle.set(this.textOpen);
		this.highlightToggle.set(this.highlightOpen);
		
		this.fireEvent('onOpen');
	},
	
	close: function() {
		this._stop();
	
		this.contentToggle.start(this.contentClose);
		this.headlineToggle.start(this.headlineClose);
		this.textToggle.start(this.textClose);
		//this.highlightToggle.set(this.highlightClose);
		this.highlight.setStyles(this.highlightClose);
		
		this.fireEvent('onClose');
	},
	setClose: function() {
		this._stop();
	
		this.contentToggle.set(this.contentClose);
		this.headlineToggle.set(this.headlineClose);
		this.textToggle.set(this.textClose);
		this.highlightToggle.set(this.highlightClose);
		
		this.fireEvent('onClose');
	},
	_stop: function() {
		this.contentToggle.stop();
		this.headlineToggle.stop();
		this.textToggle.stop();
		this.highlightToggle.stop();
	},	
	
	_mouseEnter: function() {
		this.open();
	},
	_mouseLeave: function() {
		// this.close();
	}
});
_PopoutElement.implement(new Options);
_PopoutElement.implement(new Events);

var Popout = new Class({
	options: {
		event: 'click',
		
		body: '.description',
		content: '.intro',
		headline: 'h2',
		text: 'p',
		highlight: '.image',
		
		contentOpen: { width: 370 },
		contentClose: { width: 210 },
		textOpen: {	opacity: 1 },
		textClose: { opacity: 0 },
		highlightOpen: { display: 'block', opacity: 1 },
		highlightClose: { display: 'none', opacity: 0 },
	},
	
	container: null,
	
	initialize: function(container, options) {
		this.container = $$(container);
		this.setOptions(options);
		
		if (!this.container || this.container.length == 0)
			return;
			
		this.container.each(function(el, index) {
			var elements	= el.getElements(this.options.body);
			var _elements 	= [];
			
			elements.each(function(body, index) {
				var content		= body.getElement(this.options.content);
				var headline 	= body.getElement(this.options.headline);
				var text		= body.getElement(this.options.text);
				var highlight 	= body.getElement(this.options.highlight);
				
				var pe = new _PopoutElement(body, content, headline, text, highlight);
				pe.contentOpen		= this.options.contentOpen;
				pe.contentClose		= this.options.contentClose;
				pe.textOpen			= this.options.textOpen;
				pe.textClose		= this.options.textClose;
				pe.highlightOpen	= this.options.highlightOpen;
				pe.highlightClose	= this.options.highlightClose;
				
				pe.addEvent('onOpen', function() {					
					for (i = 0; i < _elements.length; i++) {
						if (_elements[i] != pe)
							_elements[i].close();
					}
				});
				
				pe.addEvent('onMouseenter', function() {
					$clear(timer);
				}.bind(this));
				pe.addEvent('onMouseleave', function() {
					timer = rotate.delay(3000, this);
					_elements[active].open();
				});
				
				
				_elements.push(pe);
				if (index == 0) {
					pe.setOpen();
				} else {
					pe.setClose();
				}
			}, this);
			
			var active = 0;
			var timer = null;
			var rotate = function() {
				_elements[active].close();
				
				active++;
				if (active == _elements.length)
					active = 0;
					
				_elements[active].open();
				timer = rotate.delay(3000, this);
			};
			timer = rotate.delay(3000, this);
			
		}, this);
	}, 
});
Popout.implement(new Options);


window.addEvent('domready', function() {
	new Popout('.masthead_box');
});


// main menu spacing
window.addEvent('domready', function() {
    var menu = $$('#menu ul.menu')[0];
    var elements = menu.getChildren();

    var menuWidth = menu.getSize().size.x;
    var elementsWidth = 0;

    elements.each(function (li) {
        li.setStyles({
            'width': 'auto',
            'text-align': 'center'
        });
        elementsWidth += li.getSize().size.x;
    });

    var padding = Math.floor(menuWidth-elementsWidth)/(elements.length)
    elements.each(function (li, index) {
            li.setStyle('width', li.getSize().size.x+padding);
    });
});
