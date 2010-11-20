// method
Function.prototype.method = function(name,func) {
	if (!this.prototype[name]) {
		this.prototype[name] = func;
		return this;
	}
};

// trace
if (!this.trace) {
	var trace = function trace(o) {
		if (window.console&&window.console.log) {
			var sTrace = "";
			if (arguments.length===1&&typeof(o)!=='string') {
				sTrace += o+"\n";
				for (var prop in o) {
					if (true) {
						sTrace += "\t"+prop+":\t"+String(o[prop]).split("\n")[0]+"\n";
					}
				}
			} else {
				for (var s in arguments) {
					if (typeof(arguments[s])!='function') {
						sTrace += " "+String(arguments[s]);
					}
				}
			}
			window.console.log(sTrace);
			return sTrace;
		}
	};
}

// grace
if (!this.grace) {
	var grace = function grace(o) {
		var sTrace = trace.apply(this,arguments);
		document.write(sTrace.replace(/\n/gi,"<br/>").replace(/\t/gi,"&nbsp; &nbsp; ")+"<br/>");
		return sTrace;
	};
}

// int
if (!this.int) {
	var int = function(i) {
		return Math.round(i);
	};
}

// millis
if (!this.millis) {
	var millis = function() {
		return new Date().getTime();
	};
}

// addChild
if (!this.addChild) {
	var addChild = function(p,s) {
		var m = document.createElement(s);
		p.appendChild(m);
		return m;
	};
}

// FastRng
if (!this.Prng) {
	var Prng = function() {
		var iMersenne = 2147483647;
		var rnd = function(seed) {
			if (arguments.length) {
				that.seed = arguments[0];
			}
			that.seed = that.seed*16807%iMersenne;
			return that.seed;
		};
		var that = {
			seed: 123,
			rnd: rnd,
			random: function(seed) {
				if (arguments.length) {
					that.seed = arguments[0];
				}
				return rnd()/iMersenne;
			}
		};
		return that;
	}();
}

// Color
if (!this.Color) {
	var Color = function () {
		var i,s,r,g,b,a,c;
		var i2hex = function i2hex(i){
			s = i.toString(16);
			return (s.length===1?"0":"")+s;
		};
		return {
			rgba2hex: function(r,g,b,a) {
				return i2hex(r)+i2hex(g)+i2hex(b)+i2hex(a);
			}
			,rgb2hex: function(r,g,b) {
				return i2hex(r)+i2hex(g)+i2hex(b);
			}

			,hex2rgb: function(s) {
				s = s.replace(/#/gi,"");
				i = s.length;
				if (i===8) {
					r = s.substr(0,2);
					g = s.substr(2,2);
					b = s.substr(4,2);
				 	a = s.substr(4,2);
				} else if (i===6) {
					r = s.substr(0,2);
					g = s.substr(2,2);
					b = s.substr(4,2);
				} else if (i===4) {
					r = s.substr(0,1);
					g = s.substr(1,1);
					b = s.substr(2,1);
				 	a = s.substr(3,1);
					r = r+r;
					g = g+g;
					b = b+b;
					a = a+a;
				} else {
					r = s.substr(0,1);
					g = s.substr(1,1);
					b = s.substr(2,1);
					r = r+r;
					g = g+g;
					b = b+b;
				}
				return i===8||i===4?{r:r,g:g,b:b,a:a}:{r:r,g:g,b:b};
			}
			,even: function(c1,c2) {
				return 1;
			}
		};
	}();
}
