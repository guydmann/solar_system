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

var dragging = false;
var iW = 100;
var iParticlesJet = 300;
//ONLY FOR TESTING
iParticlesJet = 100;
var aParticlesUp = [];
var aParticlesDown = [];
var iParticlesOrbit = 500;
//ONLY FOR TESTING
iParticlesOrbit = 200;
var aParticlesAround = [];
var fFieldScale = 0.9;
var fParticleSpeed = 70;

var pointJet = function pointJet(x, y, z, Vx, Vy, Vz)
{
	var fSpd, fSpd2;
	var fX, fY, fZ;
	var fVX, fVY, fVZ;
	var fSx, fSy, fSz;
	var iColor = Math.random() * 0x008000 + 0x800000;
	var oParticle = new THREE.Particle(new THREE.ParticleCircleMaterial(
	{
		color: iColor
	}));
	oParticle.scale.x = oParticle.scale.y = Math.random() * 10 + 2;
	var reset = function reset()
	{
		fX = x;
		fY = y;
		fZ = z;
		fVX = Vx;
		fVY = Vy;
		fVZ = Vz;
	};
	var run = function run(t)
	{
		fSx = fFieldScale * fX;
		fSy = fFieldScale * fY;
		fSz = fFieldScale * fZ;
		fX = fX + fVX;
		fY = fY + fVY;
		fZ = fZ + fVZ;
		if (fX < -iW || fX > iW || fY < -iW || fY > iW)
		{
			reset();
		}
		oParticle.position.x = fX;
		oParticle.position.y = fY;
		oParticle.position.z = fZ;
		fSpd = getSpeed();
	};
	var getSpeed = function getSpeed()
	{
		fSpd2 = Math.sqrt(fVX * fVX + fVY * fVY);
		return Math.sqrt(fSpd2 * fSpd2 + fVZ * fVZ);
	};
	var getParticle = function getParticle()
	{
		return oParticle;
	};
	reset();
	oParticle.position.x = fX;
	oParticle.position.y = fY;
	oParticle.position.z = fZ;
	oParticle.updateMatrix();
	return {
		getX: function getX()
		{
			return fX;
		},
		getY: function getY()
		{
			return fY;
		},
		getZ: function getZ()
		{
			return fZ;
		},
		getPosition: function getPosition()
		{
			return oParticle.position;
		},
		run: run,
		reset: reset,
		getSpeed: getSpeed,
		getParticle: getParticle
	};
};

var pointOrbit = function pointOrbit(x, y, z)
{
	var fSpd, fSpd2;
	var fX, fY, fZ;
	var fVX, fVY, fVZ;
	var fSx, fSy, fSz;
	var iColor = Math.random() * 0x008000 + 0x800000;
	var oParticle = new THREE.Particle(new THREE.ParticleCircleMaterial(
	{
		color: iColor
	}));
	oParticle.scale.x = oParticle.scale.y = Math.random() * 10 + 2;
	var reset = function reset()
	{
		fX = x;
		fY = y;
		fZ = z;
		fVX = -fY * 0.05;
		fVY = fX * 0.05;
		fVZ = 0;
	};
	var run = function run(t)
	{
		fSx = fFieldScale * fX;
		fSy = fFieldScale * fY;
		fSz = fFieldScale * fZ;

		fVX = -fY * 0.05;
		fVY = fX * 0.05;
		fVZ = 0;
		fX = fX + fVX;
		fY = fY + fVY;
		fZ = fZ + fVZ;
		//fX = fX - fY*0.01;
		//fY = fY - fX*0.01;
		//fZ = fZ + fZ;
		if (fX < -iW * 10 || fX > iW * 10 || fY < -iW * 10 || fY > iW * 10)
		{
			reset();
		}
		oParticle.position.x = fX;
		oParticle.position.y = fY;
		oParticle.position.z = fZ;
		fSpd = getSpeed();

	};
	var onClick = function onClick(t)
	{
		//mouseX = event.touches[0].pageX - windowHalfX;
		//mouseY = event.touches[0].pageY - windowHalfY;
		oParticle.scale.x = oParticle.scale.x * 2;
	}
	var getSpeed = function getSpeed()
	{
		fSpd2 = Math.sqrt(fVX * fVX + fVY * fVY);
		return Math.sqrt(fSpd2 * fSpd2 + fVZ * fVZ);
	};
	var getParticle = function getParticle()
	{
		return oParticle;
	};
	reset();
	oParticle.position.x = fX;
	oParticle.position.y = fY;
	oParticle.position.z = fZ;
	oParticle.updateMatrix();
	return {
		getX: function getX()
		{
			return fX;
		},
		getY: function getY()
		{
			return fY;
		},
		getZ: function getZ()
		{
			return fZ;
		},
		getPosition: function getPosition()
		{
			return oParticle.position;
		},
		run: run,
		reset: reset,
		getSpeed: getSpeed,
		getParticle: getParticle,
		onClick: onClick
	};
};

function onDocumentMouseMove(event)
{
	if (dragging)
	{
		mouseX = event.clientX - windowHalfX;
		mouseY = event.clientY - windowHalfY;
	}
}

function onDocumentClick(event)
{
	mouseX = event.clientX - windowHalfX;
	mouseY = event.clientY - windowHalfY;
}


function onDocumentMouseDown(event)
{
	event.preventDefault();
	dragging = true;
	mouseX = event.clientX - windowHalfX;
	mouseY = event.clientY - windowHalfY;
}

function onDocumentMouseUp(event)
{
	event.preventDefault();
	dragging = false;
	mouseX = event.clientX - windowHalfX;
	mouseY = event.clientY - windowHalfY;
}

function onDocumentTouchStart(event)
{

	if (event.touches.length == 1)
	{

		event.preventDefault();

		mouseX = event.touches[0].pageX - windowHalfX;
		mouseY = event.touches[0].pageY - windowHalfY;
	}
}

function onDocumentTouchMove(event)
{

	if (event.touches.length == 1)
	{

		event.preventDefault();

		mouseX = event.touches[0].pageX - windowHalfX;
		mouseY = event.touches[0].pageY - windowHalfY;
	}
}


function init()
{
	camera = new THREE.Camera(75, window.innerWidth / window.innerHeight, 1, 10000);
	camera.position.z = 1000;
	scene = new THREE.Scene();
	renderer = new THREE.CanvasRenderer();
	renderer.setSize(SCREEN_WIDTH, SCREEN_HEIGHT);

	var oPoint;
	//SETUP THE UP JET
	for (var i = 0; i < iParticlesJet; i++)
	{
		oPoint = pointJet(0, 0, 0, (Math.random() - 0.5) * 0.5, (Math.random() - 0.5) * 0.5, 3);
		oPoint.reset();
		particle = oPoint.getParticle();
		scene.addObject(particle);
		aParticlesUp.push(oPoint);
	}
	//SETUP THE DOWN JET
	for (var i = 0; i < iParticlesJet; i++)
	{
		oPoint = pointJet(0, 0, 0, (Math.random() - 0.5) * 0.5, (Math.random() - 0.5) * 0.5, -3);
		oPoint.reset();
		particle = oPoint.getParticle();
		scene.addObject(particle);
		aParticlesDown.push(oPoint);
	}
	//SETUP THE ORBITAL PLANE
	var radius = 600;
	var radius_sqr = radius * radius;
	for (var i = 0; i < iParticlesOrbit; i++)
	{

		var xtemp = (Math.random() - 0.5) * radius_sqr;
		var ytemp = (Math.random() - 0.5) * radius * radius;
		while ((xtemp * xtemp) + (ytemp * ytemp) > (radius_sqr))
		{
			xtemp = (Math.random() - 0.5) * radius_sqr;
			ytemp = (Math.random() - 0.5) * radius_sqr;
		}
		oPoint = pointOrbit(xtemp, ytemp, 0);
		oPoint.reset();
		particle = oPoint.getParticle();
		scene.addObject(particle);
		aParticlesAround.push(oPoint);
	}
	document.body.appendChild(renderer.domElement);
	//container.appendChild(renderer.domElement);
	/*stats = new Stats();
	 stats.domElement.style.position = 'absolute';
	 stats.domElement.style.top = '0px';
	 container.appendChild(stats.domElement);*/

	document.addEventListener('mouseup', onDocumentClick, false);
	document.addEventListener('mouseup', onDocumentMouseUp, false);
	document.addEventListener('mousedown', onDocumentMouseDown, false);
	document.addEventListener('mousemove', onDocumentMouseMove, false);
	document.addEventListener('touchstart', onDocumentTouchStart, false);
	document.addEventListener('touchmove', onDocumentTouchMove, false);
}

init();
setInterval(loop, 40);

var i, t;
var aCheck;
var fCheckScale = .3;
var fCamScale = .2;
var oParticle, oPosition, x, y, z, xyz, w;
w = 2 * iW * fCheckScale;

function loop()
{
	//RUN THE UP JET
	aCheck = [];
	i = iParticlesJet;
	while (--i >= 0)
	{
		oParticle = aParticlesUp[i];
		oPosition = oParticle.getPosition();
		x = Math.round((oPosition.x + iW) * fCheckScale);
		y = Math.round((oPosition.y + iW) * fCheckScale);
		z = Math.round((oPosition.z + iW) * fCheckScale);
		xyz = z * w * w + y * w + x;

		if (aCheck[xyz])
		{
			oParticle.reset();
		}
		else
		{
			aCheck[xyz] = true;
			oParticle.run(t);
		}
	}
	//RUN THE DOWN JET
	aCheck = [];
	i = iParticlesJet;
	while (--i >= 0)
	{
		oParticle = aParticlesDown[i];
		oPosition = oParticle.getPosition();
		x = Math.round((oPosition.x + iW) * fCheckScale);
		y = Math.round((oPosition.y + iW) * fCheckScale);
		z = Math.round((oPosition.z + iW) * fCheckScale);
		xyz = z * w * w + y * w + x;

		if (aCheck[xyz])
		{
			oParticle.reset();
		}
		else
		{
			aCheck[xyz] = true;
			oParticle.run(t);
		}
	}
	//RUN THE ORBITAL PLANE
	aCheck = [];
	i = iParticlesOrbit;
	while (--i >= 0)
	{
		oParticle = aParticlesAround[i];
		oPosition = oParticle.getPosition();
		x = Math.round((oPosition.x + iW) * fCheckScale);
		y = Math.round((oPosition.y + iW) * fCheckScale);
		z = Math.round((oPosition.z + iW) * fCheckScale);
		xyz = z * w * w + y * w + x;

		if (aCheck[xyz])
		{
			oParticle.reset();
		}
		else
		{
			aCheck[xyz] = true;
			oParticle.run(t);
		}
	}
	camera.position.x += (5 * mouseX - camera.position.x) * fCamScale;
	camera.position.y += (-5 * mouseY - camera.position.y) * fCamScale;
	camera.updateMatrix();
	renderer.render(scene, camera);
}


</script>
