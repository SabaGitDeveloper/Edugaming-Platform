<div class="site-my-3js-game">
    <style>
        body {
            margin: 0;
            background: #0c4a6e;
        }
    </style>
    <script src="https://unpkg.com/es-module-shims@1.6.3/dist/es-module-shims.js" async></script>
    <script type="importmap">
        {
            "imports": {
                "three": "https://unpkg.com/three@0.150.1/build/three.module.js",
                "three/addons/": "https://unpkg.com/three@0.150.1/examples/jsm/"
            }
        }
    </script>
    <script type="module">
        import * as THREE from 'three';
        import { OrbitControls } from 'three/addons/controls/OrbitControls.js';
        import { FontLoader } from 'three/addons/loaders/FontLoader.js';
        import { TextGeometry } from 'three/addons/geometries/TextGeometry.js';

        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        camera.position.set(4.61, 2.74, 8);

        const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
        renderer.shadowMap.enabled = true;
        renderer.setSize(innerWidth, innerHeight);
        document.body.appendChild(renderer.domElement);

        const controls = new OrbitControls(camera, renderer.domElement);

        class Box extends THREE.Mesh {
            constructor({ width, height, depth, color = '#00ff00', velocity = { x: 0, y: 0, z: 0 }, position = { x: 0, y: 0, z: 0 }, zAcceleration = false }) {
                const geometry = new THREE.BoxGeometry(width, height, depth);
                const material = new THREE.MeshStandardMaterial({ color: color });

                super(geometry, material);

                this.height = height;
                this.width = width;
                this.depth = depth;

                this.position.set(position.x, position.y, position.z);

                this.right = this.position.x + this.width / 2;
                this.left = this.position.x - this.width / 2;

                this.bottom = this.position.y - this.height / 2;
                this.top = this.position.y + this.height / 2;

                this.back = this.position.z - this.depth / 2;
                this.front = this.position.z + this.depth / 2;

                this.velocity = velocity;
                this.gravity = -0.002;
                this.zAcceleration = zAcceleration;
            }
            updateSides() {
                this.bottom = this.position.y - this.height / 2;
                this.top = this.position.y + this.height / 2;
                this.right = this.position.x + this.width / 2;
                this.left = this.position.x - this.width / 2;
                this.back = this.position.z - this.depth / 2;
                this.front = this.position.z + this.depth / 2;
            }
            update(ground) {
                this.updateSides();
                if (this.zAcceleration)
                    this.velocity.z += 0.0003;

                this.position.x += this.velocity.x;
                this.position.z += this.velocity.z;
                this.applyGravity(ground);
            }
            applyGravity(ground) {
                this.velocity.y += this.gravity;

                if (boxCollision({ box1: this, box2: ground })) {
                    this.velocity.y *= 0.5;
                    this.velocity.y = -this.velocity.y;
                } else
                    this.position.y += this.velocity.y;
            }
        }

        function boxCollision({ box1, box2 }) {
            const xCollision = box1.right >= box2.left && box1.left <= box2.right;
            const zCollision = box1.front >= box2.back && box1.back <= box2.front;
            const yCollision = box1.top >= box2.bottom && box1.bottom + box1.velocity.y <= box2.top;

            return zCollision && yCollision && xCollision;
        }

        const ground = new Box({ width: 10, height: 0.5, depth: 50, color: '#0369a1', position: { x: 0, y: -2, z: 0 } });
        ground.receiveShadow = true;
        scene.add(ground);

        const cube = new Box({ width: 1, height: 1, depth: 1, velocity: { x: 0, y: -0.01, z: 0 } });
        cube.castShadow = true;
        scene.add(cube);

        const light = new THREE.DirectionalLight(0xffffff, 1);
        light.position.z = 1;
        light.position.y = 3;
        light.castShadow = true;
        scene.add(light);
        scene.add(new THREE.AmbientLight(0xffffff, 0.5));

        camera.position.z = 5;

        const keys = { a: { pressed: false }, d: { pressed: false }, s: { pressed: false }, w: { pressed: false } };

        window.addEventListener('keydown', (event) => {
            switch (event.code) {
                case 'KeyA':
                    keys.a.pressed = true;
                    break;
                case 'KeyD':
                    keys.d.pressed = true;
                    break;
                case 'KeyS':
                    keys.s.pressed = true;
                    break;
                case 'KeyW':
                    keys.w.pressed = true;
                    break;
                case 'Space':
                    cube.velocity.y = 0.08;
                    break;
            }
        });

        window.addEventListener('keyup', (event) => {
            switch (event.code) {
                case 'KeyA':
                    keys.a.pressed = false;
                    break;
                case 'KeyD':
                    keys.d.pressed = false;
                    break;
                case 'KeyS':
                    keys.s.pressed = false;
                    break;
                case 'KeyW':
                    keys.w.pressed = false;
                    break;
            }
        });
<?php $questionsUrl = \yii\helpers\Url::to(['site/getquestions']);?>
        function fetchQuestions() {
            return $.ajax({
                url: '<?= $questionsUrl ?>',
                method: 'GET',
                dataType: 'json'
            });
        }
        const fontLoader = new FontLoader();
        fontLoader.load('https://threejs.org/examples/fonts/helvetiker_regular.typeface.json', 
        function (font) {
            console.log('Loaded font:', font);
            fetchQuestions().done(function (questions) {
                const question = questions[0];

                const questionText = createTextMesh(question.QuestionStatment, font);
                console.log(questions);
                scene.add(questionText);
                questionText.position.set(cube.position.x, cube.position.y + 1.5, cube.position.z);

                const option1Text = createTextMesh(question.option1, font);
                const option2Text = createTextMesh(question.option2, font);

                const optionCube1 = createOptionCube(option1Text, { x: cube.position.x - 2, y: cube.position.y, z: cube.position.z });
                const optionCube2 = createOptionCube(option2Text, { x: cube.position.x + 2, y: cube.position.y, z: cube.position.z });

                scene.add(optionCube1);
                scene.add(optionCube2);
            });
        });

        function createTextMesh(text, font) {
            const textGeometry = new TextGeometry(text, {
                font: font,
                size: 0.5,
                height: 0.1,
                curveSegments: 12,
            });
            const textMaterial = new THREE.MeshStandardMaterial({ color: 0x000000 });
            return new THREE.Mesh(textGeometry, textMaterial);
        }

        function createOptionCube(textMesh, position) {
            const cube = new Box({ width: 1, height: 1, depth: 1, color: 'red', position: position });
            cube.add(textMesh);
            textMesh.position.set(-0.5, 0.5, 0);
            return cube;
        }

        function animate() {
            const animationId = requestAnimationFrame(animate);
            renderer.render(scene, camera);

            cube.velocity.x = 0;
            cube.velocity.z = 0;
            if (keys.a.pressed) cube.velocity.x = -0.05;
            else if (keys.d.pressed) cube.velocity.x = 0.05;

            if (keys.s.pressed) cube.velocity.z = 0.05;
            else if (keys.w.pressed) cube.velocity.z = -0.05;

            cube.update(ground);
        }
        animate();
    </script>
</div>