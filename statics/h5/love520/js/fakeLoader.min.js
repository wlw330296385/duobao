(function(b) {
	b.fn.fakeLoader = function(m) {
		var f = b.extend({
			timeToHide: 1200,
			pos: "fixed",
			top: "0px",
			left: "0px",
			width: "100%",
			height: "100%",
			zIndex: "999",
			bgColor: "#2ecc71",
			spinner: "spinner7",
			test:"天知道科技",
			imagePath: ""
		}, m);
		var g = '<div class="fl spinner6"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>';
		var d = b(this);
		var c = {
			position: f.pos,
			width: f.width,
			height: f.height,
			top: f.top,
			left: f.left
		};
		d.css(c);
		d.each(function() {
			var n = f.spinner;
			switch (n) {
				case "spinner6":
					d.html(g);
					break;	
			}
			if (f.imagePath != "") {
				d.html('<div class="fl"><img src="' + f.imagePath + '"></div>');
				a()
			}
		});
		
		setTimeout(function() {
			b(d).fadeOut()
		}, f.timeToHide);
		return this.css({
			backgroundColor: f.bgColor,
			zIndex: f.zIndex
		})
	};

	function a() {
		var c = b(window).width();
		var e = b(window).height();
		var d = b(".fl").outerWidth();
		var f = b(".fl").outerHeight();
		b(".fl").css({
			position: "absolute",
			left: (c / 2) - (d / 2),
			top: (e / 2) - (f / 2)
		})
	}
	b(window).load(function() {
		a();
		b(window).resize(function() {
			a()
		})
	})
}(jQuery));