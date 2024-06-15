<?php
use yii\web\View;

// Register necessary JavaScript and CSS files
$this->registerCssFile('@web/css/styles.css');
$this->registerJsFile('@web/js/mainp.js', ['position' => View::POS_END]);

// Begin HTML content
$this->beginPage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drag and Drop</title>
    <style>
        	html {
		font-size: 10px;
	  }
	  
	  body {
		font-family: Arial, sans-serif;
		font-size: 1.5rem;
		line-height: 1.5rem;
		padding: 10px 20px;
	  }
	  
	  h1,
	  h2,
	  h3,
	  h4,
	  h5,
	  h6 {
		font-weight: 600;
		line-height: 1.4;
		margin: 1.5rem 0;
	  }
	  
	  h1 {
		font-size: 2.8rem;
		margin: .85rem 0rem;
		text-align: center;
	  }
	  
	  h2 {
		font-size: 2.8rem;
		margin: 2.1rem 0rem;
	  }
	  
	  h3 {
		font-size: 2.1rem;
		margin: 1.57rem 0rem;
		text-align: center;
	  }
	  
	  h4 {
		font-size: 1.8rem;
	  }
	  
	  h5 {
		font-size: 1.3rem;
	  }
	  
	  h6 {
		font-size: 1.0rem;
	  }
	  
	  p {
		margin: 0rem 0rem 2.4rem 0rem;
		line-height: 150%;
		text-align: center;
	  }
	  
	  ul,
	  ol {
		margin-left: 25px;
		margin-bottom: 15px;
		line-height: 150%;
	  }
	  /*clearfixes*/
	  
	  .cf:before,
	  .cf:after {
		content: " ";
		display: table;
	  }
	  
	  .cf:after {
		clear: both;
	  }
	  
	  *,
	  *:before,
	  *:after {
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
	  }
	  
	  article,
	  aside,
	  details,
	  figcaption,
	  figure,
	  footer,
	  header,
	  hgroup,
	  menu,
	  nav,
	  section,
	  div {
		margin: 0;
	  }
	  
	  div {
		margin: 0rem;
	  }
	  
	  .page {
		max-width: 690px;
		margin: 0px auto;
	  }
	  
	  
	  /*drag and drop styles*/
	  .dnd-image-drag .container {
		float: left;
		margin: 0 10px 20px 10px;
	  }
	  
	  .dnd-image-drag .gallery-list {
		width: 320px;
		min-height: 317px;
		background: #eee;
		border: solid 1px #ccc;
		padding: 5px 0 5px 5px;
	  }
	  
	  .dnd-image-drag .gallery-list .drag {
		width: 150px;
		display: inline-block;
		height: 150px;
		border: solid 1px #ccc;
		cursor: -webkit-grab;
		cursor: -moz-grab;
		border: solid 1px transparent;
	  }
	  
	  .dnd-image-drag .gallery-list .drag.drag-active {
		border: solid 1px #2c3e50;
	  }
	  
	  .dnd-image-drag .gallery-painting {
		width: 320px;
		background: #eee;
		background-position: center center;
		background-size: cover;
		border: solid 1px #ccc;
		padding: 5px 0 5px 5px;
	  }
	  
	  .dnd-image-drag .gallery-painting .drop {
		position: relative;
		height: 150px;
		width: 150px;
		display: inline-block;
		background: rgba(50, 50, 50, 0.7);
		border: solid 1px transparent;
		overflow: hidden;
	  }
	  
	  .dnd-image-drag .gallery-painting .drop.drop-active {
		border: solid 1px #f1c40f;
	  }
	  
	  .dnd-image-drag .gallery-painting .drop.correct {
		border: solid 1px #32ce74;
	  }
	  
	  .dnd-image-drag .gallery-painting .drop.incorrect {
		border: solid 1px #c0392b;
	  }
	  
	  .dnd-image-drag .gallery-painting .drop img {
		max-width: 100%;
		height: auto;
	  }
	  
	  .reset-button {
		background: #eee;
		border: solid 1px #ccc;
		padding: 12px 15px;
		display: block;
		cursor: pointer;
		margin: 0 auto;
		min-width: 100px;
		clear: both;
	  }
	  
	  .message-container {
		clear: both;
	  }
	  
	  .ie-message {
		display: none;
		padding: 15px;
		background: #e74c3c;
		color: #fff;
		border: dashed 2px #c0392b;
		margin-bottom: 15px;
	  }
	  
	  .p {
		font-size: 15px;
		padding-top: 150px;
		clear: both;
	  }
    </style>
</head>
<body>

<article class="page">
    <article class="main">
        <article class="dnd-image-drag cf">
      <div class="container">
        <h3>Drag the puzzle pieces below</h3>
        <div class="inner gallery-list cf">
          <img draggable="true" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/123941/ie_big_image_2.jpg" class="drag" value="2" />
          <img draggable="true" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/123941/ie_big_image_3.jpg" class="drag" value="3" />
          <img draggable="true" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/123941/ie_big_image_1.jpg" class="drag" value="1" />
          <img draggable="true" src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/123941/ie_big_image_4.jpg" class="drag" value="4" />
        </div>
      </div>

      <div class="container">
        <h3>Drop puzzle pieces here</h3>
        <div class="inner gallery-painting cf">
          <div class="drop" value="1"></div>
          <div class="drop" value="2"></div>
          <div class="drop" value="3"></div>
          <div class="drop" value="4"></div>
        </div>
      </div>
      
      <div class="message-container"></div>
 
      <button class="reset-button">Reset Puzzle</button>
      <h4 class="ie-message">You appear to be on Internet Explorer. IE doesn't support the 'text/html' type (only the 'text' and 'URL' types) so jQuery will be used to copy the dragged item instead of the API (instead of copying the HTML)</h4>
       

    </article>
</article>

<!-- Ensure jQuery is included before the JavaScript code -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    jQuery(document).ready(function($) {

var drag_items = $('.dnd-image-drag .drag');
var drop_items = $('.dnd-image-drag').find('.drop');

//set up drag and drop event listeners
function setUpEventListeners() {

  drag_items.each(function() {
    var thisDrag = $(this);
    thisDrag[0].addEventListener('dragstart', dragStart);
    thisDrag[0].addEventListener('drag', drag);
    thisDrag[0].addEventListener('dragend', dragEnd);
  });

  drop_items.each(function() {
    var thisDrop = $(this);

    thisDrop[0].addEventListener('dragenter', dragEnter);
    thisDrop[0].addEventListener('dragover', dragOver);
    thisDrop[0].addEventListener('dragleave', dragLeave);
    thisDrop[0].addEventListener('drop', drop);

  });

}
setUpEventListeners();

var dragItem;

//called as soon as the draggable starts being dragged
//used to set up data and options
function dragStart(event) {

  drag = event.target;
  dragItem = event.target;

  //set the effectAllowed for the drag item
  event.dataTransfer.effectAllowed = 'copy';

  var imageSrc = $(dragItem).prop('src');
  var imageHTML = $(dragItem).prop('outerHTML');

  //check for IE (it supports only 'text' or 'URL')
  try {
    event.dataTransfer.setData('text/uri-list', imageSrc);
    event.dataTransfer.setData('text/html', imageHTML);
  } catch (e) {
    event.dataTransfer.setData('text', imageSrc);
  }

  $(drag).addClass('drag-active');

}

//called as the draggable enters a droppable 
//needs to return false to make droppable area valid
function dragEnter(event) {

  var drop = this;

  //set the drop effect for this zone
  event.dataTransfer.dropEffect = 'copy';
  $(drop).addClass('drop-active');

  event.preventDefault();
  event.stopPropagation();

}

//called continually while the draggable is over a droppable 
//needs to return false to make droppable area valid
function dragOver(event) {
  var drop = this;

  //set the drop effect for this zone
  event.dataTransfer.dropEffect = 'copy';
  $(drop).addClass('drop-active');

  event.preventDefault();
  event.stopPropagation();
}

//called when the draggable was inside a droppable but then left
function dragLeave(event) {
  var drop = this;
  $(drop).removeClass('drop-active');
}

//called continually as the draggable is dragged
function drag(event) {

}

//called when the draggable has been released (either on droppable or not)
//may be called on invalid or valid drop
function dragEnd(event) {

  var drag = this;
  $(drag).removeClass('drag-active');

}

//called when draggable is dropped on droppable 
//final process, used to copy data or update UI on successful drop
function drop(event) {

  drop = this;
  $(drop).removeClass('drop-active');

  var dataList, dataHTML, dataText;

  //collect our data (based on what browser support we have)
  try {
    dataList = event.dataTransfer.getData('text/uri-list');
    dataHTML = event.dataTransfer.getData('text/html');
  } catch (e) {;
    dataText = event.dataTransfer.getData('text');
  }

  //we have access to the HTML
  if (dataHTML) {
    $(drop).empty();
    $(drop).prepend(dataHTML);
    var drag = $(drop).find('.drag');
  }
  //only have access to text (old browsers + IE)
  else {
    $(drop).empty();
    $(drop).prepend($(dragItem).clone());
    var drag = $(drop).find('.drag');
  }

  //check if this element is in the right spot
  checkCorrectDrop(drop, drag);
  //see if the final image is complete
  checkCorrectFinalImage();

  event.preventDefault();
  event.stopPropagation();
}

//check to see if this dropped item is in the correct spot
function checkCorrectDrop(drop, drag) {

  //check if this drop is correct
  var imageValue = $(drag).attr('value');
  var dropValue = $(drop).attr('value');

  if (imageValue == dropValue) {
    $(drop).removeClass('incorrect').addClass('correct');
    //make the dropped item no longer draggable (removing the attr)
    $(drag).attr('draggable', 'false');

    //hide the original drag item (set during dragStart), we don't need it anymore
    $(dragItem).hide();

  } else {
    $(drop).removeClass('correct').addClass('incorrect');
  }

}

//checks to see if the dropped images are in the correct locations
function checkCorrectFinalImage() {

  var correctItems = drop_items.filter('.correct');
  if (correctItems.length == drop_items.length) {
    $('.message-container').empty();
    $('.message-container').append('<h3>You solved the puzzle!</h3>');
    $('.message-container').append('<p>Thanks for putting Internet Explorer back together again!</p>');
  } else {
    $('.message-container').empty();
  }
}

//Reset the drop containers
$('.reset-button').on('click', function() {
  $('.dnd-image-drag').find('.drop').children('img').remove();
  $('.dnd-image-drag').find('.drop').removeClass('correct incorrect');
  $('.message-container').empty();
  $('.dnd-image-drag .drag').show();
});

// check for ie
var userAgent = window.navigator.userAgent;
if (userAgent.indexOf('MSIE') != -1) {
  $('.ie-message').show();
}

});
</script>
<?php
// End HTML content
$this->endPage();
?>
</body>
</html>