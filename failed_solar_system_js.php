<?php 

if (!isset($_GET['width']) || $_GET['width'] <= "") { 
        $width = "600";
} else {
        $width = $_GET['width'];
}
if (!isset($_GET['height']) || $_GET['height'] <= "") { 
        $height = "600";
} else {
        $height = $_GET['height'];
}


?>
<script type="text/javascript">

	var particle;

	var camera;
	var scene;
	var renderer;

	var mouseX = 0;
	var mouseY = 0;

	var SCREEN_WIDTH = <?php echo $width; ?>;
	var SCREEN_HEIGHT = <?php echo $height; ?>;
	var windowHalfX = <?php echo $width; ?> / 2;
	var windowHalfY = <?php echo $height; ?> / 2;

	var iW = 100;
	var iParticlesJet = 300;
	var aParticlesUp= [];
	var aParticlesDown= [];
	var iParticlesOrbit = 500;
	var aParticlesAround= [];
	var fFieldScale = 0.9;
	var fParticleSpeed = 70;

	var pointJet = function pointJet(x,y,z, Vx,Vy,Vz) {
		var fSpd,fSpd2;
		var fX,fY,fZ;
		var fVX,fVY,fVZ;
		var fP1,fP2,fP3,fP4;
		var fOff = 0.1;
		var fSx,fSy,fSz;
		var iColor = Math.random() * 0x008000 + 0x800000;
//		var iColor = Math.random() * 0x808000 + 0x800000;
//		var iColor = 0xFFFFFF*Math.random();
		//var iColor = 0xFFFFFF;
//		var oParticle = new THREE.Particle(new THREE.ColorFillMaterial(iColor, .4));
		var oParticle = new THREE.Particle(new THREE.ParticleCircleMaterial( { color: iColor } ) );
		//oParticle.size = 50;
		oParticle.scale.x =oParticle.scale.y = Math.random() * 10 + 2;
		var t;
		var reset = function reset() {
			fX = x;
			fY = y;
			fZ = z;
			fVX = Vx;
			fVY = Vy;
			fVZ = Vz;
		};
		var run = function run(t) {
			fSx = fFieldScale*fX;
			fSy = fFieldScale*fY;
			fSz = fFieldScale*fZ;
			//fP1 = PerlinSimplex.noise(t,fSx,fSy,fSz);
			//fP2 = PerlinSimplex.noise(t,fSx+fOff,fSy,fSz);
			//fP3 = PerlinSimplex.noise(t,fSx,fSy+fOff,fSz);
			//fP4 = PerlinSimplex.noise(t,fSx,fSy,fSz+fOff);
			//fP1 = 0;
			//fP2 = 1;
			//fP3 = 1;
			//fP4 = 1;
			//fVX = fParticleSpeed*(fP2-fP1);
			//fVY = fParticleSpeed*(fP3-fP1);
			//fVZ = fParticleSpeed*(fP4-fP1);
			fX = fX + fVX;
			fY = fY + fVY;
			fZ = fZ + fVZ;
			if (fX<-iW||fX>iW||fY<-iW||fY>iW) {
				reset();
			}
			oParticle.position.x = fX;
			oParticle.position.y = fY;
			oParticle.position.z = fZ;
			fSpd = getSpeed();
//					oParticle.material[0].color.setRGBA(r,g,b,Math.round(1000*fSpd/fParticleSpeed));
			//oParticle.material[0].color.setRGBA(255,255,255,Math.round(500*fSpd/fParticleSpeed));
		};
		var getSpeed = function getSpeed() {
			fSpd2 = Math.sqrt(fVX*fVX+fVY*fVY);
			return Math.sqrt(fSpd2*fSpd2+fVZ*fVZ);
		};
		var getParticle = function getParticle() {
			return oParticle;
		};
		reset();
		oParticle.position.x = fX;
		oParticle.position.y = fY;
		oParticle.position.z = fZ;
		oParticle.updateMatrix();
		return {
			 getX: function getX(){return fX}
			,getY: function getY(){return fY}
			,getZ: function getZ(){return fZ}
			,getPosition: function getPosition(){return oParticle.position}
			,run: run
			,reset: reset
			,getSpeed: getSpeed
			,getParticle: getParticle
		}
	};

var pointOrbit = function pointOrbit(x,y,z, Vx,Vy,Vz) {
		var fSpd,fSpd2;
		var fX,fY,fZ;
		var fVX,fVY,fVZ;
		var fP1,fP2,fP3,fP4;
		var fOff = 0.1;
		var fSx,fSy,fSz;
		var iColor = Math.random() * 0x008000 + 0x800000;
//		var iColor = Math.random() * 0x808000 + 0x800000;
//		var iColor = 0xFFFFFF*Math.random();
		//var iColor = 0xFFFFFF;
//		var oParticle = new THREE.Particle(new THREE.ColorFillMaterial(iColor, .4));
		var oParticle = new THREE.Particle(new THREE.ParticleCircleMaterial( { color: iColor } ) );
		//oParticle.size = 50;
		oParticle.scale.x =oParticle.scale.y = Math.random() * 10 + 2;
		var t;
		var reset = function reset() {
			fX = x;
			fY = y;
			fZ = z;
			fVX = Vx;
			fVY = Vy;
			fVZ = Vz;
		};
		var run = function run(t) {
			fSx = fFieldScale*fX;
			fSy = fFieldScale*fY;
			fSz = fFieldScale*fZ;
			//fP1 = PerlinSimplex.noise(t,fSx,fSy,fSz);
			//fP2 = PerlinSimplex.noise(t,fSx+fOff,fSy,fSz);
			//fP3 = PerlinSimplex.noise(t,fSx,fSy+fOff,fSz);
			//fP4 = PerlinSimplex.noise(t,fSx,fSy,fSz+fOff);
			//fP1 = 0;
			//fP2 = 1;
			//fP3 = 1;
			//fP4 = 1;
			//fVX = fParticleSpeed*(fP2-fP1);
			//fVY = fParticleSpeed*(fP3-fP1);
			//fVZ = fParticleSpeed*(fP4-fP1);
			//fX = fX + fVX;
			//fY = fY + fVY;
			//fZ = fZ + fVZ;
			fX = fX + fY*.001;
			fY = fY + fX*.001;
			fZ = fZ + fZ;
			//if (fX<-iW||fX>iW||fY<-iW||fY>iW) {
			//	reset();
			//}
			oParticle.position.x = fX;
			oParticle.position.y = fY;
			oParticle.position.z = fZ;
			fSpd = getSpeed();
//					oParticle.material[0].color.setRGBA(r,g,b,Math.round(1000*fSpd/fParticleSpeed));
			//oParticle.material[0].color.setRGBA(255,255,255,Math.round(500*fSpd/fParticleSpeed));
		};
		var getSpeed = function getSpeed() {
			fSpd2 = Math.sqrt(fVX*fVX+fVY*fVY);
			return Math.sqrt(fSpd2*fSpd2+fVZ*fVZ);
		};
		var getParticle = function getParticle() {
			return oParticle;
		};
		reset();
		oParticle.position.x = fX;
		oParticle.position.y = fY;
		oParticle.position.z = fZ;
		oParticle.updateMatrix();
		return {
			 getX: function getX(){return fX}
			,getY: function getY(){return fY}
			,getZ: function getZ(){return fZ}
			,getPosition: function getPosition(){return oParticle.position}
			,run: run
			,reset: reset
			,getSpeed: getSpeed
			,getParticle: getParticle
		}
	};

	function init() {
	
		//container = document.createElement('div');
		//document.body.appendChild(container);				
	
		camera = new THREE.Camera( 75, window.innerWidth / window.innerHeight, 1, 10000 );
		camera.position.z = 1000;

		scene = new THREE.Scene();
		
		renderer = new THREE.CanvasRenderer();
		renderer.setSize(SCREEN_WIDTH, SCREEN_HEIGHT);
		
		document.body.appendChild( renderer.domElement );
		
		for (var i = 0; i < iParticlesJet; i++) {
			var oPoint = pointJet(0,0,0,(Math.random()-.5)*.5,(Math.random()-.5)*.5,3);
			oPoint.reset();
			particle = oPoint.getParticle();
			scene.addObject(particle);
			aParticlesUp.push(oPoint);
		}
		for (var i = 0; i < iParticlesJet; i++) {
			var oPoint = pointJet(0,0,0,(Math.random()-.5)*.5,(Math.random()-.5)*.5,-3);
			oPoint.reset();
			particle = oPoint.getParticle();
			scene.addObject(particle);
			aParticlesDown.push(oPoint);
		}
		var radius = 600;
		var radius_sqr = radius * radius ;
		for (var i = 0; i < iParticlesOrbit; i++) {
			
			var xtemp = (Math.random()-.5)*radius_sqr;
			var ytemp =(Math.random()-.5)*radius *radius;
			while ((xtemp*xtemp)+(ytemp*ytemp)>(radius_sqr)) {
				xtemp = (Math.random()-.5)*radius_sqr;
				ytemp =(Math.random()-.5)*radius_sqr;
			}
			var oPoint = pointOrbit(xtemp,ytemp,0,0,0,0);
			oPoint.reset();
			particle = oPoint.getParticle();
			scene.addObject(particle);
			aParticlesAround.push(oPoint);
		}
		document.body.appendChild( renderer.domElement );
		//container.appendChild(renderer.domElement);

		/*stats = new Stats();
		stats.domElement.style.position = 'absolute';
		stats.domElement.style.top = '0px';
		container.appendChild(stats.domElement);*/
		
		document.addEventListener('mousemove', onDocumentMouseMove, false);
		document.addEventListener('touchstart', onDocumentTouchStart, false);
		document.addEventListener('touchmove', onDocumentTouchMove, false);
	}

	init();
	setInterval( loop, 40 );

	function onDocumentMouseMove(event) {
	
		mouseX = event.clientX - windowHalfX;
		mouseY = event.clientY - windowHalfY;
	}
	
	function onDocumentTouchStart(event) {
	
		if(event.touches.length == 1) {
		
			event.preventDefault();

			mouseX = event.touches[0].pageX - windowHalfX;
			mouseY = event.touches[0].pageY - windowHalfY;
		}
	}

	function onDocumentTouchMove(event) {
	
		if(event.touches.length == 1) {
		
			event.preventDefault();
			
			mouseX = event.touches[0].pageX - windowHalfX;
			mouseY = event.touches[0].pageY - windowHalfY;
		}
	}

	var i,t;
	var aCheck;
	var fCheckScale = .3;
	var fCamScale = .2;
	var oParticle, oPosition, x,y,z, xyz, w;
	w = 2*iW*fCheckScale;
	function loop() {
		t = millis()*.0001;
		aCheck = [];
		i = iParticlesJet;
		while (--i>=0) {
			oParticle = aParticlesUp[i];
			oPosition = oParticle.getPosition();
			x = Math.round((oPosition.x+iW)*fCheckScale);
			y = Math.round((oPosition.y+iW)*fCheckScale);
			z = Math.round((oPosition.z+iW)*fCheckScale);
			xyz = z*w*w + y*w + x;					

			if (aCheck[xyz]) {
				oParticle.reset();
			} else {
				aCheck[xyz] = true;
				oParticle.run(t);
			}
		}

		aCheck = [];
		i = iParticlesJet;
		while (--i>=0) {
			oParticle = aParticlesDown[i];
			oPosition = oParticle.getPosition();
			x = Math.round((oPosition.x+iW)*fCheckScale);
			y = Math.round((oPosition.y+iW)*fCheckScale);
			z = Math.round((oPosition.z+iW)*fCheckScale);
			xyz = z*w*w + y*w + x;					

			if (aCheck[xyz]) {
				oParticle.reset();
			} else {
				aCheck[xyz] = true;
				oParticle.run(t);
			}
		}
				aCheck = [];
		i = iParticlesOrbit;
		while (--i>=0) {
			oParticle = aParticlesAround[i];
			oPosition = oParticle.getPosition();
			x = Math.round((oPosition.x+iW)*fCheckScale);
			y = Math.round((oPosition.y+iW)*fCheckScale);
			z = Math.round((oPosition.z+iW)*fCheckScale);
			xyz = z*w*w + y*w + x;					

			if (aCheck[xyz]) {
				oParticle.reset();
			} else {
				aCheck[xyz] = true;
				oParticle.run(t);
			}
		}
		camera.position.x += ( 5*mouseX - camera.position.x) * fCamScale;
		camera.position.y += (-5*mouseY - camera.position.y) * fCamScale;
		camera.updateMatrix();
		renderer.render( scene, camera );
	}



</script>
