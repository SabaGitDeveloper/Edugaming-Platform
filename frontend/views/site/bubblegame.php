<!-- <?php
$this->registerCssFile('@web/css/bubble.css', ['depends' => [\yii\web\JqueryAsset::class]]);
$this->registerJsFile('@web/js/bubble.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?> -->

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./assets/css/bubble.css" />
    <link rel="shortcut icon" href="./assets/img/favi.ico" type="image/x-icon">
    <title>Bubble Game</title>
    <style>
        * {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}

html {
  width: 100%;
  height: 100%;
  font-family: Verdana, Geneva, Tahoma, sans-serif;
  background-color: rgb(162, 244, 203);
}

body {
  width: 100%;
  height: 100%;
  font-family: Verdana, Geneva, Tahoma, sans-serif;
  background-color: rgb(162, 244, 203);
}

#main {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  margin: auto;
  width: 90%;
  height: 100%;
}

#game-menu {
  position: relative;
  overflow: hidden;
  margin: auto;
  width: 80%;
  height: 600px;
  box-shadow: 2px 5px 15px 2px;
  background-color: springgreen;
  border: 3px solid green;
  border-radius: 15px;
  -webkit-border-radius: 15px;
  -moz-border-radius: 15px;
  -ms-border-radius: 15px;
  -o-border-radius: 15px;
}
#game-menu #start-game {
  position: absolute;
  top: 0;
  left: 0;
  overflow: hidden;
  margin: auto;
  width: 100%;
  height: 600px;
  row-gap: 5%;
  background-color: springgreen;
  border: 3px solid green;
  border-radius: 15px;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  flex-direction: column;
  z-index: 99;
}
#game-menu #start-game h1 {
  font-size: 2rem;
  -webkit-text-decoration: underline dotted;
          text-decoration: underline dotted;
}
#game-menu #start-game h3 {
  font-size: 1.3rem;
  -webkit-text-decoration: italic;
          text-decoration: italic;
}
#game-menu #start-game button {
  font-family: Verdana;
  font-size: 1.6rem;
  margin-top: 10px;
  padding: 8px 15px;
  border: 2px solid black;
  color: green;
  font-weight: bolder;
  border-radius: 10px;
  -webkit-border-radius: 10px;
  -moz-border-radius: 10px;
  -ms-border-radius: 10px;
  -o-border-radius: 10px;
  box-shadow: 3px 3px 10px 3px rgb(60, 60, 60);
}
#game-menu #start-game button:hover {
  cursor: pointer;
  background-color: green;
  color: white;
}

#ptop {
  position: relative;
  height: 100px;
  width: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  background-color: green;
}

.one {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  color: white;
  padding: 5%;
  font-size: 1.7rem;
  font-weight: bolder;
}
.one #plusten {
  display: none;
  position: absolute;
  top: 10%;
  left: 5%;
  font-size: 1rem;
  padding: 0;
  margin: 0;
  color: white;
  transform: translateX(-50%);
  transform: scale(1.4);
  animation: scoreAnimation 1s ease-out;
  -webkit-transform: scale(1.4);
  -moz-transform: scale(1.4);
  -ms-transform: scale(1.4);
  -o-transform: scale(1.4);
}

.elem {
  background-color: white;
  color: green;
  font-size: 1.3rem;
  font-weight: bolder;
  padding: 5px 15px;
  margin-left: 10px;
  border-radius: 8px;
  -webkit-border-radius: 8px;
  -moz-border-radius: 8px;
  -ms-border-radius: 8px;
  -o-border-radius: 8px;
}

#btmp {
  height: auto;
  width: auto;
  color: white;
  font-weight: bolder;
  font-size: 1.6rem;
  height: auto;
  width: auto;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  margin: 20px;
  row-gap: 10px;
  -moz-column-gap: 10px;
       column-gap: 10px;
}

#bubble {
  position: relative;
  padding: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  height: 50px;
  width: 50px;
  background-color: green;
  border-radius: 50%;
  -webkit-border-radius: 50%;
  -moz-border-radius: 50%;
  -ms-border-radius: 50%;
  -o-border-radius: 50%;
}
#bubble:hover {
  background-color: rgb(3, 206, 3);
  cursor: pointer;
  border: 2px solid green;
}

#game-over {
  display: none;
  position: absolute;
  top: 25%;
  left: 5%;
  color: white;
  font-size: 1rem;
  background-color: rgb(9, 134, 19);
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  flex-basis: 100%;
  border-radius: 15px;
  border: 2px solid rgb(1, 71, 1);
  padding: 0rem 2rem;
  margin: 0;
  width: 90%;
  height: 60vh;
  z-index: 99;
  -webkit-border-radius: 15px;
  -moz-border-radius: 15px;
  -ms-border-radius: 15px;
  -o-border-radius: 15px;
}
#game-over #game-content {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  flex-direction: column;
}
#game-over #game-content h1 {
  font-size: 2.5rem;
  font-weight: bolder;
  color: rgb(255, 0, 0);
  -webkit-text-stroke: 1px white;
}
#game-over #game-content button {
  font-family: Verdana;
  font-size: 1.3rem;
  margin-top: 10px;
  padding: 8px 15px;
  border: 2px solid black;
  color: green;
  font-weight: bolder;
  border-radius: 10px;
  -webkit-border-radius: 10px;
  -moz-border-radius: 10px;
  -ms-border-radius: 10px;
  -o-border-radius: 10px;
  box-shadow: 3px 3px 10px 3px rgb(60, 60, 60);
}
#game-over #game-content button:hover {
  cursor: pointer;
  background-color: green;
  color: white;
}

#photo-container {
  position: relative;
  padding: 0;
  width: 100%;
  height: 60%;
  background-image: url("../img/congragulation.gif");
  background-size: contain;
  background-position: center;
  background-repeat: no-repeat;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
}

@keyframes scoreAnimation {
  0% {
    opacity: 0;
    transform: translate(180px, 50px);
    -webkit-transform: translate(180px, 50px);
    -moz-transform: translate(180px, 50px);
    -ms-transform: translate(180px, 50px);
    -o-transform: translate(180px, 50px);
  }
  50% {
    opacity: 1;
    transform: translate(180px, 0px);
    -webkit-transform: translate(180px, 0px);
    -moz-transform: translate(180px, 0px);
    -ms-transform: translate(180px, 0px);
    -o-transform: translate(180px, 0px);
  }
  100% {
    opacity: 0;
    transform: translate(180px, -20px);
    -webkit-transform: translate(180px, -20px);
    -moz-transform: translate(180px, -20px);
    -ms-transform: translate(180px, -20px);
    -o-transform: translate(180px, -20px);
  }
}
@media screen and (max-width: 768px) {
  #game-menu {
    overflow: hidden;
    flex-basis: 100%;
  }
  #ptop {
    flex-wrap: wrap;
    row-gap: 0;
    padding: 0px 1px;
  }
  .one {
    font-size: 1rem;
    padding: 8px 10px;
  }
}/*# sourceMappingURL=bubble.css.map */

    </style>
  </head>
  <body>
    <div id="main">
      <div id="game-menu">
        <div id="ptop">
          <div class="one">
            Hit
            <div id="hitcount" class="elem">0</div>
          </div>

          <div class="one">
            Timer
            <div id="game-timer" class="elem">60</div>
          </div>

          <div class="one">
            Score
            <div id="score" class="elem">0</div>
                      <!-- //test + -->
          <div id="plusten">
            <h3>+10</h3>
          </div>
          </div>

        </div>

        <div id="game-over" style="display: none">
          <div id="photo-container"></div>
          <div id="game-content">
            <h1>Game Over!</h1>
            <h2></h2>
            <button>Play Again</button>
          </div>
        </div>

        <div id="start-game">
          <h1>Developed By Saadat Ali</h1>
          <button>PLAY</button>
          <h3>Special thanks to Sheryians</h3>
        </div>

        <div id="btmp">
          <!-- Hidden Div show after completition -->
        </div>
      </div>
    </div>
  </body>
  <script>
    function play(){
    document.getElementById("start-game").style.display = "none";


    let timer = 60;
    let score = 0;
    let rnhit = 0;
    let interval; 
    var letsgo;
    var scorepoints;
    var congragulations;
    var backgrounds;


    function backsound(){
        if (backgrounds instanceof Audio) {
            // stop the existing audio instance
            backgrounds.pause();
            backgrounds.currentTime = 0;
          }
        backgrounds = new Audio("./assets/audio/background.mp3")
        backgrounds.play();
    }

    
    


    function runTimer() {
        backsound();
        interval = setInterval(function() {
          if (timer > 0) {
            console.log(timer);
            timer--;
            document.querySelector("#game-timer").textContent = timer;
            document.getElementById("game-over").style.display = "none";
          } else {
            clearInterval(interval); // Clear the interval
            document.querySelector("#btmp").innerHTML = "";
            document.getElementById("game-over").style.display = "block"; 
      
            // stop the background audio
            backgrounds.pause();
            backgrounds.currentTime = 0;
      
            congragulations = new Audio("./assets/audio/congragulations.mp3");
            // play the audio
            congragulations.play();
            document.querySelector("#game-over h2").innerHTML = `Your Score = ${score}`;
          }
        }, 1000)
      }
      
// restart the game

    document.querySelector("#game-over button").onclick = function() {
        if (congragulations instanceof Audio) {
            // stop the existing audio instance
            congragulations.pause();
            congragulations.currentTime = 0;
          }
        resetGame(); // Reset the game state
        document.getElementById("game-over").style.display = "none";
        letsgo = new Audio("./assets/audio/letsgo.mp3");
        // play the audio
        letsgo.play();
        startgame();
    };

    function resetGame() {
        clearInterval(interval); // Clear the interval
        timer = 30;
        score = 0;
        rnhit = 0;
        document.querySelector("#game-timer").textContent = timer;
        document.querySelector("#score").textContent = score;
        document.querySelector("#hitcount").textContent = rnhit;
    }




//Calling Declration
function makeBubble(){
    let clutter = "";

    for(var i=0;i<=150;i++){
        var random = Math.floor(Math.random()*10);
       clutter +=   `<div id="bubble">${random}</div>`
    
    }
    document.getElementById("btmp").innerHTML = clutter
    
}




function hitcunt(){
    for(let i = 0;i<10;i++)
    {
        rnhit = Math.floor(Math.random()*10) 
        document.querySelector("#hitcount").textContent = rnhit;
    }
}

function showScoreAnimation() {
    var scoreAnimation = document.getElementById("plusten");
    scoreAnimation.style.display = "block";
  
    setTimeout(function() {
      scoreAnimation.style.display = "none";
    }, 1000); // Display for 1 second
  }

function incresescore(){
   document.querySelector("#btmp")
   .addEventListener("click", function(dets){
    if(timer > 0){
        let tomatch = Number(dets.target.textContent);
        if(rnhit == tomatch){

// disply Score animation and play score point sound
            showScoreAnimation()
            score += 10;
            document.querySelector("#score").textContent = score;

            // create a new audio instance
            scorepoints = new Audio("./assets/audio/score.mp3");
            // play the audio
            scorepoints.play();

            makeBubble();
            hitcunt();
        }
    }
    else{

    }

   })
}


function startgame(){
    makeBubble();
    runTimer();
    hitcunt();
    incresescore();
    backsound();

   
    // over();
}

//Calling Function
startgame();

}

// start the game
document.querySelector("#start-game").onclick = function() {
    play(); // Reset the game state

};
function play(){
    document.getElementById("start-game").style.display = "none";


    let timer = 30;
    let score = 0;
    let rnhit = 0;
    let interval; 
    var letsgo;
    var scorepoints;
    var congragulations;
    var backgrounds;


    function backsound(){
        if (backgrounds instanceof Audio) {
            // stop the existing audio instance
            backgrounds.pause();
            backgrounds.currentTime = 0;
          }
        backgrounds = new Audio("./assets/audio/background.mp3")
        backgrounds.play();
    }

    
    


    function runTimer() {
        backsound();
        interval = setInterval(function() {
          if (timer > 0) {
            console.log(timer);
            timer--;
            document.querySelector("#game-timer").textContent = timer;
            document.getElementById("game-over").style.display = "none";
          } else {
            clearInterval(interval); // Clear the interval
            document.querySelector("#btmp").innerHTML = "";
            document.getElementById("game-over").style.display = "block"; 
      
            // stop the background audio
            backgrounds.pause();
            backgrounds.currentTime = 0;
      
            congragulations = new Audio("./assets/audio/congragulations.mp3");
            // play the audio
            congragulations.play();
            document.querySelector("#game-over h2").innerHTML = `Your Score = ${score}`;
          }
        }, 1000)
      }
      
// restart the game

    document.querySelector("#game-over button").onclick = function() {
        if (congragulations instanceof Audio) {
            // stop the existing audio instance
            congragulations.pause();
            congragulations.currentTime = 0;
          }
        resetGame(); // Reset the game state
        document.getElementById("game-over").style.display = "none";
        letsgo = new Audio("./assets/audio/letsgo.mp3");
        // play the audio
        letsgo.play();
        startgame();
    };

    function resetGame() {
        clearInterval(interval); // Clear the interval
        timer = 30;
        score = 0;
        rnhit = 0;
        document.querySelector("#game-timer").textContent = timer;
        document.querySelector("#score").textContent = score;
        document.querySelector("#hitcount").textContent = rnhit;
    }




//Calling Declration
function makeBubble(){
    let clutter = "";

    for(var i=0;i<=150;i++){
        var random = Math.floor(Math.random()*10);
       clutter +=   `<div id="bubble">${random}</div>`
    
    }
    document.getElementById("btmp").innerHTML = clutter
    
}




function hitcunt(){
    for(let i = 0;i<10;i++)
    {
        rnhit = Math.floor(Math.random()*10) 
        document.querySelector("#hitcount").textContent = rnhit;
    }
}

function showScoreAnimation() {
    var scoreAnimation = document.getElementById("plusten");
    scoreAnimation.style.display = "block";
  
    setTimeout(function() {
      scoreAnimation.style.display = "none";
    }, 1000); // Display for 1 second
  }

function incresescore(){
   document.querySelector("#btmp")
   .addEventListener("click", function(dets){
    if(timer > 0){
        let tomatch = Number(dets.target.textContent);
        if(rnhit == tomatch){

// disply Score animation and play score point sound
            showScoreAnimation()
            score += 10;
            document.querySelector("#score").textContent = score;

            // create a new audio instance
            scorepoints = new Audio("./assets/audio/score.mp3");
            // play the audio
            scorepoints.play();

            makeBubble();
            hitcunt();
        }
    }
    else{

    }

   })
}


function startgame(){
    makeBubble();
    runTimer();
    hitcunt();
    incresescore();
    backsound();

   
    // over();
}

//Calling Function
startgame();

}

// start the game
document.querySelector("#start-game").onclick = function() {
    play(); // Reset the game state

};
</script>
</html>