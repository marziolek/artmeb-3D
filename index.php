<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Fotel</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
		<style>
			body {
				font-family: Monospace;
				background-color: #000;
				color: #fff;
				margin: 0px;
				overflow: hidden;
			}
			#info {
				color: black;
				position: absolute;
				top: 10px;
				width: 100%;
				text-align: center;
				z-index: 100;
				display:block;
			}
			#info a, .button { color: #f00; font-weight: bold; text-decoration: underline; cursor: pointer }
			.materials {
				position: absolute;
				right: 0;
				top: 0;
				height: 100%;
				width: 130px;
				list-style: none;
				padding: 0;
				margin: 0;
				overflow-y: auto;
			}
			.materials li {
				margin-bottom: 10px;
			}
			.materials button {
				width: 100px;
				height: 100px;
				border: none;
				background-repeat: no-repeat;
				background-position: center;
			}

			div{
				margin-right:130px;
			}
		</style>
	</head>

	<body>
		<div id="info">
			<p>Testowy model fotela i nakładanie tkanin</p>
			<label for="input-full-object">full object</label><input id="input-full-object" type="checkbox"/>
		</div>

		<ul class="materials">
			<li class="active">
				<button type="button" style="background-image: url(textures/nowe/1.jpg)" data-heightMap="textures/nowe/1-heightMap.jpg" data-image="textures/nowe/1.jpg"></button>
			</li>
			<li>
				<button type="button" style="background-image: url(textures/nowe/2.jpg)" data-heightMap="textures/nowe/2-heightMap.jpg" data-image="textures/nowe/2.jpg"></button>
			</li>
			<li>
				<button type="button" style="background-image: url(textures/nowe/3.jpg)" data-heightMap="textures/nowe/3-heightMap.jpg" data-image="textures/nowe/3.jpg"></button>
			</li>
			<li>
				<button type="button" style="background-image: url(textures/nowe/4.jpg)" data-heightMap="textures/nowe/4-heightMap.jpg" data-image="textures/nowe/4.jpg"></button>
			</li>
			<li>
				<button type="button" style="background-image: url(textures/nowe/5.jpg)" data-heightMap="textures/nowe/5-heightMap.jpg" data-image="textures/nowe/5.jpg"></button>
			</li>
			<li>
				<button type="button" style="background-image: url(textures/nowe/6.jpg)" data-heightMap="textures/nowe/6-heightMap.jpg" data-image="textures/nowe/6.jpg"></button>
			</li>

			<!-- pik -->
			<li>
				<button type="button" style="background-image: url(textures/Artmeb/pik/Aston pik_1_400x400.jpg)" data-image="textures/Artmeb/pik/Aston pik_1_400x400.jpg"></button>
				<button type="button" style="background-image: url(textures/Artmeb/pik/Aston pik_1_600x600.jpg)" data-image="textures/Artmeb/pik/Aston pik_1_600x600.jpg" data-size="600x600">600x600</button>
			</li>

			<!-- plecionka -->
			<li>
				<button type="button" style="background-image: url(textures/Artmeb/plecionka/City_T_3650_400x400.jpg)" data-image="textures/Artmeb/plecionka/City_T_3650_400x400.jpg"></button>
				<button type="button" style="background-image: url(textures/Artmeb/plecionka/City_T_3650_600x600.jpg)" data-image="textures/Artmeb/plecionka/City_T_3650_600x600.jpg" data-size="600x600">600x600</button>
			</li>
			<li>
				<button type="button" style="background-image: url(textures/Artmeb/plecionka/Gabon_769_400x400.jpg)" data-image="textures/Artmeb/plecionka/Gabon_769_400x400.jpg"></button>
				<button type="button" style="background-image: url(textures/Artmeb/plecionka/Gabon_769_600x600.jpg)" data-image="textures/Artmeb/plecionka/Gabon_769_600x600.jpg" data-size="600x600">600x600</button>
			</li>
		</ul>

		<script src="build/three.min.js"></script>
		<script src="js/loaders/OBJLoader.js"></script>
		<script src="build/Projector.js"></script>

		<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
		<script src="js/controls/OrbitControls.js"></script>
		<script>

			var container;

			var camera, scene, renderer, controls;

			var mouseX = 0, mouseY = 0;

			var windowHalfX = window.innerWidth / 2;
			var windowHalfY = window.innerHeight / 2;


			var clock = new THREE.Clock();

			//raycasting for selection init
			var mouseVector  = new THREE.Vector3(),
					projector = new THREE.Projector(),
					raycastered,pickedObject;


			init();
			animate();

			//INIT INIT INIT INIT INIT INIT INIT INIT INIT INIT INIT INIT INIT INIT INIT INIT INIT INIT INIT

			function init() {


				renderer = new THREE.WebGLRenderer( { alpha: true } );
				renderer.setClearColor( 0xFFFFFF, 1 );
				renderer.setPixelRatio( window.devicePixelRatio );
				renderer.setSize( window.innerWidth, window.innerHeight );
				container = document.createElement( 'div' );
				document.body.appendChild( container );
				container.appendChild( renderer.domElement );



				raycastered = new THREE.Raycaster();

				/* / controls */

				camera = new THREE.PerspectiveCamera( 45, window.innerWidth / window.innerHeight, 1, 2000 );
				camera.position.z = 250;
				camera.position.y = 50;
				controls = new THREE.OrbitControls( camera ,renderer.domElement);
				controls.enablePan = false;
				controls.target.set( 0, 10, 0 );



				// scene

				scene = new THREE.Scene();

				var light = new THREE.HemisphereLight( 0xffffbb, 0x080820, 1 );
				var spotLight = new THREE.DirectionalLight( 0xffffff, 0.2 );
				spotLight.position.set(0,1,0);
				scene.add( spotLight );
				scene.add( light );


				//LOAD MANAGER LOAD MANAGER LOAD MANAGER LOAD MANAGER LOAD MANAGER LOAD MANAGER LOAD MANAGER LOAD MANAGER LOAD MANAGER LOAD MANAGER

				var manager = new THREE.LoadingManager();
				manager.onProgress = function ( item, loaded, total ) {
					console.log( item, loaded, total );
				};

				var texture = new THREE.Texture();

				var onProgress = function ( xhr ) {
					if ( xhr.lengthComputable ) {
						var percentComplete = xhr.loaded / xhr.total * 100;
						console.log( Math.round(percentComplete, 2) + '% downloaded' );
					}
				};

				var onError = function ( xhr ) {
				};

				//LOAD TEXTURE LOAD TEXTURE LOAD TEXTURE LOAD TEXTURE LOAD TEXTURE LOAD TEXTURE LOAD TEXTURE LOAD TEXTURE LOAD TEXTURE LOAD TEXTURE

				var material;
				var loader = new THREE.ImageLoader( manager );
				loader.load( 'textures/nowe/1.jpg', function ( image ) {

					texture.image = image;
					texture.needsUpdate = true;
					texture.wrapS = THREE.RepeatWrapping;
					texture.wrapT = THREE.RepeatWrapping;
					texture.repeat.set( 15, 15 );

				} );

				changeMaterials(manager, loader, texture);

				//LOAD MODEL LOAD MODEL LOAD MODEL LOAD MODEL LOAD MODEL LOAD MODEL LOAD MODEL LOAD MODEL LOAD MODEL LOAD MODEL LOAD MODEL LOAD MODEL

				var loader = new THREE.OBJLoader( manager );

				loader.load( 'obj/complexSofa/sofaComplete.obj', function ( object ) {
					object.traverse( function ( child ) {

						if ( child instanceof THREE.Mesh ) {
							child.material.map = texture;
						}
					} );

					object.position.y = -10;
					object.name = "sofa";
					scene.add( object );

				}, onProgress, onError );

				//



				window.addEventListener( 'resize', onWindowResize, false );

				//selecting object on click listener
				document.addEventListener('mousedown', onMouseDown,false);
			}


			//ON RESIZE ON RESIZE ON RESIZE ON RESIZE ON RESIZE ON RESIZE ON RESIZE ON RESIZE ON RESIZE ON RESIZE ON RESIZE ON RESIZE ON RESIZE ON RESIZE ON RESIZE
			function onWindowResize() {

				windowHalfX = window.innerWidth / 2;
				windowHalfY = window.innerHeight / 2;

				camera.aspect = window.innerWidth / window.innerHeight;
				camera.updateProjectionMatrix();

				renderer.setSize( window.innerWidth, window.innerHeight );

			}

			//ANIMATE ANIMATE ANIMATE ANIMATE ANIMATE ANIMATE ANIMATE ANIMATE ANIMATE ANIMATE ANIMATE ANIMATE ANIMATE ANIMATE ANIMATE ANIMATE
			function animate() {
				controls.update();
				requestAnimationFrame( animate );
				render();
			}

			//RENDER RENDER RENDER RENDER RENDER RENDER RENDER RENDER RENDER RENDER RENDER RENDER RENDER RENDER RENDER RENDER RENDER RENDER
			function render() {
				renderer.render( scene, camera );
			}


			//MATERIAL SWITCHER MATERIAL SWITCHER MATERIAL SWITCHER MATERIAL SWITCHER MATERIAL SWITCHER MATERIAL SWITCHER MATERIAL SWITCHER

			function changeMaterials() {
				var loader = new THREE.TextureLoader(),
						newMaterial;

				$('.materials button').click( function() {
					var isFullObject = document.getElementById('input-full-object').checked,
							hasBumpMap = $(this).data('heightmap') != undefined ? true : false;

					if(hasBumpMap){
						var heightMap = loader.load($(this).data('heightmap'));
						heightMap.wrapS = heightMap.wrapT = THREE.RepeatWrapping;
					}


					loader.load($(this).data('image'), function(texture){
						texture.wrapS = THREE.RepeatWrapping;
						texture.wrapT = THREE.RepeatWrapping;

						texture.repeat.set( 15, 15 );
						if(hasBumpMap){
							newMaterial = new THREE.MeshPhongMaterial({
							map: texture,
							bumpMap: heightMap,
							bumpScale: 0.5
						});
						} else {
							newMaterial = new THREE.MeshPhongMaterial({
							map: texture
						});
						}


						if(isFullObject){
							for(var i=0; i<scene.children.length;i++){
								var child = scene.children[i];
								if(child.type == "Group"){
									for(var j=0;child.children.length;j++){
										child.children[j].material = newMaterial;
									}
								}
							}

						} else {
							if(pickedObject != undefined){
								pickedObject.material = newMaterial;
								pickedObject.scale.set(1,1,1);
								pickedObject = null;
							}
						}

					});
				});
			}

			//SELECT ON CLICK SELECT ON CLICK SELECT ON CLICK SELECT ON CLICK SELECT ON CLICK SELECT ON CLICK SELECT ON CLICK SELECT ON CLICK SELECT ON CLICK
			var scaled = false;

			function onMouseDown(event){
				event.preventDefault();
				mouseVector.x = 2* (event.clientX / window.innerWidth) - 1;
				mouseVector.y = 1 - 2 *(event.clientY / window.innerHeight);
				raycastered.setFromCamera(mouseVector.clone(),camera);
				var intersects = raycastered.intersectObjects(scene.children,true);


				if(intersects.length > 0){
					if(!scaled || pickedObject == undefined){
						intersects[0].object.scale.set(1.2,1.2,1.2);
						scaled = true;
						pickedObject = intersects[0].object;
					} else {
						intersects[0].object.scale.set(1,1,1);
						scaled = false;
						pickedObject = null;
					}
				}
			}


			window.requestAnimationFrame(render);
		</script>
	</body>
</html>
