<?php 

if (!isset($_GET['width']) || $_GET['width'] <= "") { 
        $width = "800";
} else {
        $width = $_GET['width'];
}
if (!isset($_GET['height']) || $_GET['height'] <= "") { 
        $height = "500";
} else {
        $height = $_GET['height'];
}


?>
<script type="text/javascript">

    var camera, scene, renderer;
    var width, height;
    init();
    setInterval( loop, 1000 / 60 );

    function init() {
	width = <?php echo $width; ?>;
	height = <?php echo $height; ?>;
//        camera = new THREE.Camera( 75, window.innerWidth / window.innerHeight, 1, 10000 );
        camera = new THREE.Camera( 75, width / height, 1, 10000 );
        camera.position.z = 1000;

        scene = new THREE.Scene();

        for (var i = 0; i < 1000; i++) {

            var particle = new THREE.Particle( new THREE.ParticleCircleMaterial( { color: Math.random() * 0x808008 + 0x808080 } ) );
            particle.position.x = Math.random() * 2000 - 1000;
            particle.position.y = Math.random() * 2000 - 1000;
            particle.position.z = Math.random() * 2000 - 1000;
            particle.scale.x = particle.scale.y = Math.random() * 10 + 5;
            scene.addObject( particle );

        }

        renderer = new THREE.CanvasRenderer();
//        renderer.setSize( window.innerWidth, window.innerHeight );
        renderer.setSize( width, height );

        document.body.appendChild( renderer.domElement );

    }

    function loop() {

        renderer.render( scene, camera );

    }

</script>
