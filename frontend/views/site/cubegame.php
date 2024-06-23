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

                this.velocity = velocity instanceof THREE.Vector3 ? velocity : new THREE.Vector3(velocity.x, velocity.y, velocity.z);
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
            //console.log('Box1:', { right: box1.right, left: box1.left, front: box1.front, back: box1.back, top: box1.top, bottom: box1.bottom });
            //console.log('Box2:', { right: box2.right,left: box2.left, front: box2.front, back: box2.back, top: box2.top, bottom: box2.bottom });
            console.log('Collisions:', { xCollision, yCollision, zCollision });
            return zCollision && yCollision && xCollision;
        }

        const ground = new Box({ width: 15, height: 0.5, depth: 50, color: '#0369a1', position: { x: 0, y: -2, z: 0 } });
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

<?php $questionsUrl = \yii\helpers\Url::to(['site/getquestions']); ?>
        function fetchQuestions() {
            return $.ajax({
                url: '<?= $questionsUrl ?>',
                method: 'GET',
                dataType: 'json'
            });
        }

<?php $optionsUrl = \yii\helpers\Url::to(['site/getoptions']); ?>
        function fetchOptions(index) {
            return $.ajax({
                url: '<?= $optionsUrl ?>',
                method: 'GET',
                data: { index: index },
                dataType: 'json'
            });
        }

        const fontLoader = new FontLoader();
        let optionCubes = [];
        let questionText;
        let currentQuestionIndex = 0;
        let score = 0;
        let questions = [];
        let gamePaused = false;
        let startTime = Date.now();
        let total=0;

        function loadNewQuestionAndOptions(font,animationId) {
            fetchQuestions().done(function (questions) {
                total=questions.length;
                console.log("total quesitons:",total);
                if (questions.length > 0 && currentQuestionIndex < questions.length) {
                    const question = questions[currentQuestionIndex];
                    console.log(question.QuestionStatement);

                    if (questionText) {
                        cube.remove(questionText);
                        questionText.geometry.dispose();
                        questionText.material.dispose();
                        renderer.renderLists.dispose();
                        console.log("Removed old question text");
                    }

                    questionText = createTextMesh(question.QuestionStatement, font);
                    cube.add(questionText);
                    console.log("Added new question text");
                    questionText.position.set(-1.5,1.5,0);
                    renderer.render(scene, camera);

                    fetchOptions(question.QuestionNo).done(function (options) {
                        if (options.length > 0) {
                            optionCubes.forEach(option =>{ 
                                scene.remove(option.cube);
                                option.cube.geometry.dispose();
                                option.cube.material.dispose();
                                renderer.renderLists.dispose();
                                console.log("Removed old option cubes");
                            });

                            optionCubes = options.map((option, index) => {
                                const optionText = createTextMesh(option.option_text, font);
                                console.log(option.option_text);
                                const optionCube = createOptionCube(optionText, {
                                    x: cube.position.x - 4 + index * 2,
                                    y: cube.position.y,
                                    z: ground.position.z - ground.depth / 2
                                });
                                optionCube.velocity.set(0, 0, 0.03);
                                scene.add(optionCube);
                                console.log("Added new option cubes");
                                renderer.render(scene, camera);
                                return { cube: optionCube, text: optionText, correct: option.option_type=="correct" };
                            });
                            gamePaused = false;
                            //requestAnimationFrame(animate);
                        } else {
                            console.error("No options fetched");
                        }
                    }).fail(function (jqXHR, textStatus, errorThrown) {
                        console.error("Error fetching options:", textStatus, errorThrown);
                    });
                } else {
                    console.log("All questions answered");
                    //cancelAnimationFrame(animationId);
                    saveScore();
                }
            }).fail(function (jqXHR, textStatus, errorThrown) {
                console.error("Error fetching questions:", textStatus, errorThrown);
            });
        }

        fontLoader.load('https://threejs.org/examples/fonts/helvetiker_regular.typeface.json', function (font) {
            console.log('Loaded font:', font);
            loadNewQuestionAndOptions(font);

            /*function animateOptions() {
                
            }*/

            function animate() {
                const animationId = requestAnimationFrame(animate);
                renderer.render(scene, camera);

                if (gamePaused) return;

                cube.velocity.x = 0;
                cube.velocity.z = 0;
                if (keys.a.pressed) cube.velocity.x = -0.05;
                else if (keys.d.pressed) cube.velocity.x = 0.05;

                if (keys.s.pressed) cube.velocity.z = 0.05;
                else if (keys.w.pressed) cube.velocity.z = -0.05;

                cube.update(ground);

                //animateOptions();
                optionCubes.forEach(option => {
                    option.cube.position.add(option.cube.velocity);

                    if (option.cube.position.z > ground.position.z + ground.depth / 2) {
                        option.cube.position.set(
                            Math.random() * 8 - 4,
                            cube.position.y,
                            ground.position.z - ground.depth / 2
                        );
                    }
                    option.cube.update(ground);
                    if (boxCollision({ box1: cube, box2: option.cube })) {
                        console.log('Collision detected!');
                        gamePaused = true;
                        //cancelAnimationFrame(animationId);
                        //optionCubes.forEach(opt => opt.cube.velocity.set(0, 0, 0));
                        if (option.correct) {
                            score++;
                        }
                        console.log(score);
                        currentQuestionIndex++;
                        loadNewQuestionAndOptions(font,animationId);
                        
                    }else{
                        console.log("no collision");
                    }
                });
            }
            console.log("called animate");
            animate();
        });

        function createTextMesh(text, font) {
            if (!text) {
                console.error("Invalid text for createTextMesh:", text, font);
                return;
            }
            if (!font) {
                console.error("Invalid font for createTextMesh:", text, font);
                return;
            }
            const textGeometry = new TextGeometry(text, {
                font: font,
                size: 0.15,
                height: 0.001,
                curveSegments: 12 // Balance between performance and visual quality
            });
            const textMaterial = new THREE.MeshStandardMaterial({ color: 0x000000 });
            return new THREE.Mesh(textGeometry, textMaterial);
        }

        function createOptionCube(textMesh, position) {
            const opcube = new Box({ width: 1, height: 1, depth: 1, color: 'red', position: position });
            opcube.add(textMesh);
            opcube.castShadow=true;
            textMesh.position.set(0, 1.5, 0);
            return opcube;
        }
        function saveScore(){
            const endTime = Date.now();
            const timeSpent = Math.round((endTime - startTime) / 1000); // Time in seconds
            const accuracy = Math.round((score / total) * 100); // Percentage of correct answers
            console.log(timeSpent);
            console.log(accuracy);

            $.ajax({
                url: 'index.php?r=site/save-score',
                method: 'POST',
                data: {
                    score: score,
                    accuracy: accuracy,
                    speed: timeSpent,
                },
                success: function (response) {
                    if (response.status === 'success') {
                        console.log('Score saved successfully');
                    } else {
                        console.error('Error saving score:', response.errors);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX error:', status, error);
                }
            });
            console.log("score saved");
        }
    </script>
</div>
