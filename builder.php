<?php
$builder = <<<BUILDER
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<style type="text/css">

#canvas {
	background-color: #3f3f3f;
	width: 100%;
	aspect-ratio: 6/5;
	filter: brightness(0.9);
}

.container {
	max-width: 1200px;
	margin: 0 auto;
}

.visual-canvas img {
	display: none;
}

.visual-canvas.has-3d-render img {
	display: block;
	width: 100%;
	height: 100%;
	object-fit: cover;
	position: absolute;
	z-index: 1;
	top: 0px;
	left: 0px;
}

.visual-canvas.has-3d-render, .visual-canvas.has-3d-render #canvas {
	aspect-ratio: 6/5;
}

.visual-canvas.has-3d-render {
	overflow: hidden;
}

.visual-canvas.has-3d-render #canvas {

}

.row {
	display: flex;
	flex-direction: row;
	align-items: center;
	justify-content: space-between;
}

.row .column {
	max-width: 48%;
	width: 100%;
	position: relative;
}

.grain_preloader {
	display: none;
}

#pallete .single-color {
	background-color: #fff;
	padding: 25px;
	margin-bottom: 20px;
}

#pallete .single-color .color-swatch {
	float: left;
	width: 50px;
	height: 50px;
	border-radius: 120px;
	margin-right: 20px;
	position: relative;
	top: -4px;
}

#pallete .single-color h3 {
	margin-top: 4px;
	display: inline-block;
	font-size: 2em;
	font-weight: 400;
	margin-bottom: 0px;
}

#pallete .single-color input {
	background-color: #F7F7F7;
	border: none;
	font-size: 1.2em;
	padding: 10px 15px;
	float: right;
	border: 1px solid #ccc;
}

#error {
	color: #8d3d3d;
	background-color: #ffcece;
	font-weight: 700;
	text-align: center;
	padding: 10px;
	border-radius: 30px;
	margin-bottom: 20px;
}

.percent-floater {
	float: right;
	line-height: 44px;
	font-size: 1.5em;
	margin-left: 5px;
}

#color-picker {
	background-color: rgba(0,0,0,0.8);
	display: none;
	position: absolute;
	left: 0px;
	top: 0px;
	width: 100%;
	height: 100%;
	display: none;
	z-index: 1;
}

#color-picker .popup {
	background-color: #fff;
	padding: 20px;
	left: 25%;
	position: absolute;
	top: 50%;
	display: flex;
	flex-direction: column;
	width: 50%;
	transform: translateY(-50%);
	flex-flow: wrap;
}

#color-picker #close-icon {
	width: 40px;
	height: 40px;
	position: absolute;
	top: 5vw;
	right: 5vw;
}

#color-picker #close-icon:hover {
	cursor: pointer;
}

#loader {
	position: absolute;
	width: 10%;
	margin-left: 43%;
	margin-top: 33%;
	z-index: 2;
	opacity: 0;
}

.inside-swatch {
	flex-basis: 32%;
	display: flex;
	align-items: center;
	gap: 8px;
	margin: 4px 0px;
	position: relative;
}

.inside-swatch:hover {
	cursor: pointer;
}

.inside-swatch:hover:after {
	background-color: #E3E9ED;
	content: "";
	width: 100%;
	height: 115%;
	display: block;
	position: absolute;
	top: -7.5%;
	left: -2%;
	z-index: -1;
	border-radius: 10px;
}

#add_color {
	text-decoration: none;
	border-bottom: 2px solid #023B5C;
	text-align: center;
	color: #023B5C;
	font-size: 1.1em;
}

hr {
	border-color: #BBC2C7;
	border-style: solid;
	margin-top: 50px;
}

#reset {
	padding: 14px 26px 12px 26px;
	border-radius: 30px;
	background-color: #fff;
	color: #023B5C;
	font-weight: 700;
	text-decoration: none;
	display: inline-block;
	text-transform: uppercase;
	margin: 6px;
}

#generate {
	padding: 14px 26px 12px 26px;
	border-radius: 30px;
	background-color: #E75A5A;
	color: #023B5C;
	font-weight: 700;
	text-decoration: none;
	display: inline-block;
	text-transform: uppercase;
	margin: 6px;
}

.delete-color-icon {
	width: 20px;
	height: 20px;
	float: right;
	margin-top: 11px;
	margin-left: 30px;
}
.delete-color-icon:hover {
	cursor: pointer;
}

.inside-swatch img {
	width: 40px;
	height: 40px;
	border-radius: 60px;
	border: 1px solid #ccc;
}

.settings {
	position: absolute;
	top: 20px;
	left: 20px;
	z-index: 2;
	background-color: #fff;
	border-radius: 50px;
	padding: 0px 20px;
}

.settings img {
	width: 30px;
	position: relative;
	top: 8px;
	opacity: 0.4;
}

.settings select {
	padding: 10px 0px;
	background-color: #fff;
	border: none;
	font-size: 1.2em;
}
.settings select:focus {
	outline: none;
}

body {
	padding: 50px 0px;
	background-color: #E3E9ED;
	font-family: Arial;
}

@media (max-width: 1000px) {
	#pallete .single-color h3 {
		font-size: 1.3em;
	}
	#pallete .single-color .color-swatch {
		width: 38px;
		height: 38px;
	}
}

</style>
<body onLoad="init();">
<div class="container">
	<div class="row">
		<div class="column col-12 col-md-6">
			<div class="settings">
				<img src="eye.svg">
				<select>
					<option>Grain Tile</option>
					<option>Playground</option>
				</select>
			</div>
			<img id="loader" src="preload.gif">
			<div class="visual-canvas">
				<canvas id="canvas" crossorigin="anonymous"></canvas>
				<img src="playground4.png" alt="playground">
			</div>
		</div>
		<div class="column col-12 col-md-6">
			<h1 id="rainbow">Graininator</h1>
			<div id="pallete">
				
			</div>
			<div id="error"></div>
			<div style="width: 100%; text-align: center;">
				<a href="#" id="add_color">+ Add New Granule</a>
				<hr>
				<a href="#" id="reset">Reset</a>
				<a href="#" id="generate">Generate</a>
			</div>
		</div>
	</div>
	<div class="grain_preloader">
		<img src="img/Beige-1014/Beige-1014.png" class="beige">
		<img src="img/Beige-1014/Beige-1014-1.png" class="beige">
		<img src="img/Beige-1014/Beige-1014-2.png" class="beige">
		<img src="img/Beige-1014/Beige-1014-3.png" class="beige">
		<img src="img/Beige-1014/Beige-1014-4.png" class="beige">
		<!---->
		<img src="img/Black-9004/Black-9004.png" class="black">
		<img src="img/Black-9004/Black-9004-1.png" class="black">
		<img src="img/Black-9004/Black-9004-2.png" class="black">
		<img src="img/Black-9004/Black-9004-3.png" class="black">
		<img src="img/Black-9004/Black-9004-4.png" class="black">
		<!---->
		<img src="img/Brown-8024/Brown-8024.png" class="brown">
		<img src="img/Brown-8024/Brown-8024-1.png" class="brown">
		<img src="img/Brown-8024/Brown-8024-2.png" class="brown">
		<img src="img/Brown-8024/Brown-8024-3.png" class="brown">
		<img src="img/Brown-8024/Brown-8024-4.png" class="brown">
		<!---->
		<img src="img/Cream-1015/Cream-1015.png" class="cream">
		<img src="img/Cream-1015/Cream-1015-1.png" class="cream">
		<img src="img/Cream-1015/Cream-1015-2.png" class="cream">
		<img src="img/Cream-1015/Cream-1015-3.png" class="cream">
		<img src="img/Cream-1015/Cream-1015-4.png" class="cream">
		<!---->
		<img src="img/Dark-Red-3016/Dark-Red-3016.png" class="darkred">
		<img src="img/Dark-Red-3016/Dark-Red-3016-1.png" class="darkred">
		<img src="img/Dark-Red-3016/Dark-Red-3016-2.png" class="darkred">
		<img src="img/Dark-Red-3016/Dark-Red-3016-3.png" class="darkred">
		<img src="img/Dark-Red-3016/Dark-Red-3016-4.png" class="darkred">
		<!---->
		<img src="img/Iron-Grey-7011/Iron-Grey-7011.png" class="irongrey">
		<img src="img/Iron-Grey-7011/Iron-Grey-7011-1.png" class="irongrey">
		<img src="img/Iron-Grey-7011/Iron-Grey-7011-2.png" class="irongrey">
		<img src="img/Iron-Grey-7011/Iron-Grey-7011-3.png" class="irongrey">
		<img src="img/Iron-Grey-7011/Iron-Grey-7011-4.png" class="irongrey">
		<!---->
		<img src="img/Light-Blue-5012/Light-Blue-5012.png" class="lightblue">
		<img src="img/Light-Blue-5012/Light-Blue-5012-1.png" class="lightblue">
		<img src="img/Light-Blue-5012/Light-Blue-5012-2.png" class="lightblue">
		<img src="img/Light-Blue-5012/Light-Blue-5012-3.png" class="lightblue">
		<img src="img/Light-Blue-5012/Light-Blue-5012-4.png" class="lightblue">
		<!---->
		<img src="img/Light-Grey-7038/Light-Grey-7038.png" class="lightgrey">
		<img src="img/Light-Grey-7038/Light-Grey-7038-1.png" class="lightgrey">
		<img src="img/Light-Grey-7038/Light-Grey-7038-2.png" class="lightgrey">
		<img src="img/Light-Grey-7038/Light-Grey-7038-3.png" class="lightgrey">
		<img src="img/Light-Grey-7038/Light-Grey-7038-4.png" class="lightgrey">
		<!---->
		<img src="img/May-Green-6017/May-Green-6017.png" class="maygreen">
		<img src="img/May-Green-6017/May-Green-6017-1.png" class="maygreen">
		<img src="img/May-Green-6017/May-Green-6017-2.png" class="maygreen">
		<img src="img/May-Green-6017/May-Green-6017-3.png" class="maygreen">
		<img src="img/May-Green-6017/May-Green-6017-4.png" class="maygreen">
		<!---->
		<img src="img/Medium-Grey-7037/Medium-Grey-7037.png" class="mediumgrey">
		<img src="img/Medium-Grey-7037/Medium-Grey-7037-1.png" class="mediumgrey">
		<img src="img/Medium-Grey-7037/Medium-Grey-7037-2.png" class="mediumgrey">
		<img src="img/Medium-Grey-7037/Medium-Grey-7037-3.png" class="mediumgrey">
		<img src="img/Medium-Grey-7037/Medium-Grey-7037-4.png" class="mediumgrey">
		<!---->
		<img src="img/Orange-2008/Orange-2008.png" class="orange">
		<img src="img/Orange-2008/Orange-2008-1.png" class="orange">
		<img src="img/Orange-2008/Orange-2008-2.png" class="orange">
		<img src="img/Orange-2008/Orange-2008-3.png" class="orange">
		<img src="img/Orange-2008/Orange-2008-4.png" class="orange">
		<!---->
		<img src="img/Pink-4003/Pink-4003.png" class="pink">
		<img src="img/Pink-4003/Pink-4003-1.png" class="pink">
		<img src="img/Pink-4003/Pink-4003-2.png" class="pink">
		<img src="img/Pink-4003/Pink-4003-3.png" class="pink">
		<img src="img/Pink-4003/Pink-4003-4.png" class="pink">
		<!---->
		<img src="img/Purple-4005/Purple-4005.png" class="purple">
		<img src="img/Purple-4005/Purple-4005-1.png" class="purple">
		<img src="img/Purple-4005/Purple-4005-2.png" class="purple">
		<img src="img/Purple-4005/Purple-4005-3.png" class="purple">
		<img src="img/Purple-4005/Purple-4005-4.png" class="purple">
		<!---->
		<img src="img/Reseda-Green-6011/Reseda-Green-6011.png" class="resedagreen">
		<img src="img/Reseda-Green-6011/Reseda-Green-6011-1.png" class="resedagreen">
		<img src="img/Reseda-Green-6011/Reseda-Green-6011-2.png" class="resedagreen">
		<img src="img/Reseda-Green-6011/Reseda-Green-6011-3.png" class="resedagreen">
		<img src="img/Reseda-Green-6011/Reseda-Green-6011-4.png" class="resedagreen">
		<!---->
		<img src="img/Royal-Blue-5010/Royal-Blue-5010.png" class="royalblue">
		<img src="img/Royal-Blue-5010/Royal-Blue-5010-1.png" class="royalblue">
		<img src="img/Royal-Blue-5010/Royal-Blue-5010-2.png" class="royalblue">
		<img src="img/Royal-Blue-5010/Royal-Blue-5010-3.png" class="royalblue">
		<img src="img/Royal-Blue-5010/Royal-Blue-5010-4.png" class="royalblue">
		<!---->
		<img src="img/Sky-Blue-5015/Sky-Blue-5015.png" class="skyblue">
		<img src="img/Sky-Blue-5015/Sky-Blue-5015-1.png" class="skyblue">
		<img src="img/Sky-Blue-5015/Sky-Blue-5015-2.png" class="skyblue">
		<img src="img/Sky-Blue-5015/Sky-Blue-5015-3.png" class="skyblue">
		<img src="img/Sky-Blue-5015/Sky-Blue-5015-4.png" class="skyblue">
		<!---->
		<img src="img/White-9010/White-9010.png" class="white">
		<img src="img/White-9010/White-9010-1.png" class="white">
		<img src="img/White-9010/White-9010-2.png" class="white">
		<img src="img/White-9010/White-9010-3.png" class="white">
		<img src="img/White-9010/White-9010-4.png" class="white">
		<!---->
		<img src="img/Yellow-1012/Yellow-1012.png" class="yellow">
		<img src="img/Yellow-1012/Yellow-1012-1.png" class="yellow">
		<img src="img/Yellow-1012/Yellow-1012-2.png" class="yellow">
		<img src="img/Yellow-1012/Yellow-1012-3.png" class="yellow">
		<img src="img/Yellow-1012/Yellow-1012-4.png" class="yellow">
	</div>
</div>
<div id="color-picker">
	<div class="popup">

	</div>
	<img id="close-icon" src="close.svg" alt="close">
</div>
<script>
	var colors = {
		beige: {
			pallete: "swatch/Beige1014.jpg",
			gain1: "img/Beige-1014/Beige-1014-1.png",
			gain2: "img/Beige-1014/Beige-1014-2.png",
			gain3: "img/Beige-1014/Beige-1014-3.png",
			gain4: "img/Beige-1014/Beige-1014-4.png",
			gain5: "img/Beige-1014/Beige-1014.png",
			class: "beige",
			name: "Beige"
		},
		black: {
			pallete: "swatch/Black9004.jpg",
			gain1: "img/Black-9004/Black-9004-1.png",
			gain2: "img/Black-9004/Black-9004-2.png",
			gain3: "img/Black-9004/Black-9004-3.png",
			gain4: "img/Black-9004/Black-9004-4.png",
			gain5: "img/Black-9004/Black-9004.png",
			class: "black",
			name: "Black"
		},
		brown: {
			pallete: "swatch/Brown8024.jpg",
			gain1: "img/Brown-8024/Brown-8024-1.png",
			gain2: "img/Brown-8024/Brown-8024-2.png",
			gain3: "img/Brown-8024/Brown-8024-3.png",
			gain4: "img/Brown-8024/Brown-8024-4.png",
			gain5: "img/Brown-8024/Brown-8024.png",
			class: "brown",
			name: "Brown"
		},
		cream: {
			pallete: "swatch/Cream1015.jpg",
			gain1: "img/Cream-1015/Cream-1015-1.png",
			gain2: "img/Cream-1015/Cream-1015-2.png",
			gain3: "img/Cream-1015/Cream-1015-3.png",
			gain4: "img/Cream-1015/Cream-1015-4.png",
			gain5: "img/Cream-1015/Cream-1015.png",
			class: "cream",
			name: "Cream"
		},
		darkred: {
			pallete: "swatch/DarkRed3016.jpg",
			gain1: "img/Dark-Red-3016/Dark-Red-3016-1.png",
			gain2: "img/Dark-Red-3016/Dark-Red-3016-2.png",
			gain3: "img/Dark-Red-3016/Dark-Red-3016-3.png",
			gain4: "img/Dark-Red-3016/Dark-Red-3016-4.png",
			gain5: "img/Dark-Red-3016/Dark-Red-3016.png",
			class: "darkred",
			name: "Dark Red"
		},
		irongrey: {
			pallete: "swatch/IronGrey7011.jpg",
			gain1: "img/Iron-Grey-7011/Iron-Grey-7011-1.png",
			gain2: "img/Iron-Grey-7011/Iron-Grey-7011-2.png",
			gain3: "img/Iron-Grey-7011/Iron-Grey-7011-3.png",
			gain4: "img/Iron-Grey-7011/Iron-Grey-7011-4.png",
			gain5: "img/Iron-Grey-7011/Iron-Grey-7011.png",
			class: "irongrey",
			name: "Iron Grey"
		},
		lightblue: {
			pallete: "swatch/LightBlue5012.jpg",
			gain1: "img/Light-Blue-5012/Light-Blue-5012-1.png",
			gain2: "img/Light-Blue-5012/Light-Blue-5012-2.png",
			gain3: "img/Light-Blue-5012/Light-Blue-5012-3.png",
			gain4: "img/Light-Blue-5012/Light-Blue-5012-4.png",
			gain5: "img/Light-Blue-5012/Light-Blue-5012.png",
			class: "lightblue",
			name: "Light Blue"
		},
		lightgrey: {
			pallete: "swatch/LightGrey7038.jpg",
			gain1: "img/Light-Grey-7038/Light-Grey-7038-1.png",
			gain2: "img/Light-Grey-7038/Light-Grey-7038-2.png",
			gain3: "img/Light-Grey-7038/Light-Grey-7038-3.png",
			gain4: "img/Light-Grey-7038/Light-Grey-7038-4.png",
			gain5: "img/Light-Grey-7038/Light-Grey-7038.png",
			class: "lightgrey",
			name: "Light Grey"
		},
		maygreen: {
			pallete: "swatch/MayGreen6017.jpg",
			gain1: "img/May-Green-6017/May-Green-6017-1.png",
			gain2: "img/May-Green-6017/May-Green-6017-2.png",
			gain3: "img/May-Green-6017/May-Green-6017-3.png",
			gain4: "img/May-Green-6017/May-Green-6017-4.png",
			gain5: "img/May-Green-6017/May-Green-6017.png",
			class: "maygreen",
			name: "May Green"
		},
		mediumgrey: {
			pallete: "swatch/MediumGrey7037.jpg",
			gain1: "img/Medium-Grey-7037/Medium-Grey-7037-1.png",
			gain2: "img/Medium-Grey-7037/Medium-Grey-7037-2.png",
			gain3: "img/Medium-Grey-7037/Medium-Grey-7037-3.png",
			gain4: "img/Medium-Grey-7037/Medium-Grey-7037-4.png",
			gain5: "img/Medium-Grey-7037/Medium-Grey-7037.png",
			class: "mediumgrey",
			name: "Medium Grey"
		},
		orange: {
			pallete: "swatch/Orange2008.jpg",
			gain1: "img/Orange-2008/Orange-2008-1.png",
			gain2: "img/Orange-2008/Orange-2008-2.png",
			gain3: "img/Orange-2008/Orange-2008-3.png",
			gain4: "img/Orange-2008/Orange-2008-4.png",
			gain5: "img/Orange-2008/Orange-2008.png",
			class: "orange",
			name: "Orange"
		},
		pink: {
			pallete: "swatch/Pink4003.jpg",
			gain1: "img/Pink-4003/Pink-4003-1.png",
			gain2: "img/Pink-4003/Pink-4003-2.png",
			gain3: "img/Pink-4003/Pink-4003-3.png",
			gain4: "img/Pink-4003/Pink-4003-4.png",
			gain5: "img/Pink-4003/Pink-4003.png",
			class: "pink",
			name: "Pink"
		},
		purple: {
			pallete: "swatch/Purple4005.jpg",
			gain1: "img/Purple-4005/Purple-4005-1.png",
			gain2: "img/Purple-4005/Purple-4005-2.png",
			gain3: "img/Purple-4005/Purple-4005-3.png",
			gain4: "img/Purple-4005/Purple-4005-4.png",
			gain5: "img/Purple-4005/Purple-4005.png",
			class: "purple",
			name: "Purple"
		},
		resedagreen: {
			pallete: "swatch/ResedaGreen6011.jpg",
			gain1: "img/Reseda-Green-6011/Reseda-Green-6011-1.png",
			gain2: "img/Reseda-Green-6011/Reseda-Green-6011-2.png",
			gain3: "img/Reseda-Green-6011/Reseda-Green-6011-3.png",
			gain4: "img/Reseda-Green-6011/Reseda-Green-6011-4.png",
			gain5: "img/Reseda-Green-6011/Reseda-Green-6011.png",
			class: "resedagreen",
			name: "Resenda Green"
		},
		royalblue: {
			pallete: "swatch/RoyalBlue5010.jpg",
			gain1: "img/Royal-Blue-5010/Royal-Blue-5010-1.png",
			gain2: "img/Royal-Blue-5010/Royal-Blue-5010-2.png",
			gain3: "img/Royal-Blue-5010/Royal-Blue-5010-3.png",
			gain4: "img/Royal-Blue-5010/Royal-Blue-5010-4.png",
			gain5: "img/Royal-Blue-5010/Royal-Blue-5010.png",
			class: "royalblue",
			name: "Royal Blue"
		},
		skyblue: {
			pallete: "swatch/SkyBlue5015.jpg",
			gain1: "img/Sky-Blue-5015/Sky-Blue-5015-1.png",
			gain2: "img/Sky-Blue-5015/Sky-Blue-5015-2.png",
			gain3: "img/Sky-Blue-5015/Sky-Blue-5015-3.png",
			gain4: "img/Sky-Blue-5015/Sky-Blue-5015-4.png",
			gain5: "img/Sky-Blue-5015/Sky-Blue-5015.png",
			class: "skyblue",
			name: "Sky Blue"
		},
		white: {
			pallete: "swatch/White9010.jpg",
			gain1: "img/White-9010/White-9010-1.png",
			gain2: "img/White-9010/White-9010-2.png",
			gain3: "img/White-9010/White-9010-3.png",
			gain4: "img/White-9010/White-9010-4.png",
			gain5: "img/White-9010/White-9010.png",
			class: "white",
			name: "White"
		},
		yellow: {
			pallete: "swatch/Yellow1012.jpg",
			gain1: "img/Yellow-1012/Yellow-1012-1.png",
			gain2: "img/Yellow-1012/Yellow-1012-2.png",
			gain3: "img/Yellow-1012/Yellow-1012-3.png",
			gain4: "img/Yellow-1012/Yellow-1012-4.png",
			gain5: "img/Yellow-1012/Yellow-1012.png",
			class: "yellow",
			name: "Yellow"
		},
	}

	var ctx;

	function init() {
		ctx = canvas.getContext('2d');
		//i dont know why, but it needs to be drawn twice to initialize it
		//redraw when hit generate button
		checkPercentagesAndGenerate($(".settings select").val());
		$("#generate").click(function() {
			checkPercentagesAndGenerate($(".settings select").val());
		});
		$("#add_color, #close-icon").click(function() {
			$("#color-picker").toggle();
		});
		$("#reset").click(function() {
			$("#pallete").html("");
			//default colors	
			addColor(colors.skyblue);
			addColor(colors.yellow);
			checkPercentagesAndGenerate($(".settings select").val());
		});
		$(".settings select").on("change", function() {
			document.getElementById("loader").style.opacity = 1;
			setTimeout(() => {
				checkPercentagesAndGenerate($(this).val());
				checkPercentagesAndGenerate($(this).val());
			}, 50);
			
		});
		//$(".loader").hide();
		$("#rainbow").click(function() {
			$("#reset").click();
			//addColor(colors.beige);
			addColor(colors.cream);
			addColor(colors.lightblue);
			addColor(colors.mediumgrey);
			addColor(colors.purple);
			addColor(colors.black);
			addColor(colors.darkred);
			//addColor(colors.lightgrey);
			addColor(colors.orange);
			addColor(colors.resedagreen);
			addColor(colors.white);
			addColor(colors.brown);
			addColor(colors.irongrey);
			addColor(colors.maygreen);
			addColor(colors.pink);
			addColor(colors.royalblue);
			setInterval(function() {
				checkPercentagesAndGenerate();
			}, 100);
			//$(".visual-canvas").append(cloneCanvas(document.getElementById("canvas")));
		});
		for (var key in colors) {
			var obj = colors[key];
			//console.log(colors[key].name);
			$(".popup").append("<div class='inside-swatch' onclick='addColor(colors." + colors[key].class + ");'><img src='" + colors[key].pallete +  "'> <span>" + colors[key].name + "</span></div>");
		}
	}

	function getRandomInt(max) {
		return Math.floor(Math.random() * max);
	}

	// function cloneCanvas(oldCanvas) {
	//     // create new canvas
	//     var newCanvas = document.createElement('canvas');
	//     var context = newCanvas.getContext('2d');

	//     // set newCanvas size to be the same as oldCanvas
	//     newCanvas.width = oldCanvas.width;
	//     newCanvas.height = oldCanvas.height;

	//     // draws old canvas on new one
	//     context.drawImage(oldCanvas, 0, 0);

	//     return newCanvas;
	// }

	var TO_RADIANS = Math.PI/180; 
	function drawCustomImage(image, x, y, w, h, angle) { 
		// save the current co-ordinate system 
		// before we screw with it
		ctx.save(); 

		// move to the middle of where we want to draw our image
		ctx.translate(x, y);

		// rotate around that point, converting our 
		// angle from degrees to radians 
		ctx.rotate(angle * TO_RADIANS);

		// draw it up and to the left by half the width
		// and height of the image 
		ctx.drawImage(image, -(image.width/2), -(image.height/2), w, h);

		// and restore the co-ords to how they were when we began
		ctx.restore();
		//$(".loader").hide(); 
	}

	function animate() {
		var displayWidth  = canvas.clientWidth;
		var displayHeight = canvas.clientHeight;
	}

	function keyAction() {
		document.onkeypress = function (e) {
			e = e || window.event;
			if (e.keyCode == 32) { //space
				
			}
		};
	}
	window.addEventListener('load', keyAction);

	function addColor(color) {
		if (typeof color == "undefined") {
			console.log("NOT A VALID COLOR");
			return;
		}
		$("#error").hide();
		var colorClass = color.class;
		var colorName = color.name;
		var colorPallet = color.pallete;
		$("#pallete").append("<div class='single-color' id='" + colorClass + "'><img src='" + colorPallet + "' class='color-swatch'><h3 class='color-name'>" + colorName + "</h3><img class='delete-color-icon' src='red-close.svg' alt='close icon'><span class='percent-floater'>%</span><input type='number' class='color-number' value='50' max='100' min='1' step='1'></div>");
		//close popup
		$("#color-picker").hide();

		//count colors to automatically get suggested percents
		$("#pallete input[type='number']").each(function () {
			$(this).val(100 / $("#pallete input[type='number']").length);
		});
		$(".delete-color-icon").click(function() {
			$(this).parent().remove();
			//count colors to automatically get suggested percents
			$("#pallete input[type='number']").each(function () {
				$(this).val(100 / $("#pallete input[type='number']").length);
			});
		});
	}

	function resize(canvas) {
		// Lookup the size the browser is displaying the canvas.
		var displayWidth  = canvas.clientWidth;
		var displayHeight = canvas.clientHeight;
		
		// Check if the canvas is not the same size.
		if (canvas.width  != displayWidth ||
			canvas.height != displayHeight) {
			// Make the canvas the same size
			canvas.width  = displayWidth;
			canvas.height = displayHeight;
		}
	}

	function draw(odds, render) {
		if (odds != undefined) {

			var displayWidth  = canvas.clientWidth;
			var displayHeight = canvas.clientHeight;

			//settings 6-4, 3-3 for small
			var grainSize = 6;
			var grainSizeScaleUp = 4;

			if (render != "Grain Tile") {
				grainSize = 0.5;
				grainSizeScaleUp = 4;
				$(".visual-canvas").addClass("has-3d-render");
			} else {
				grainSize = 6;
				grainSizeScaleUp = 4;
				$(".visual-canvas").removeClass("has-3d-render");
			}

			//clear screen
			ctx.clearRect(0,0, displayWidth, displayHeight);

			var x = 0, y = 0;
			
			//figure out how many grains wide it should have based on width of canvas and the set size
			var grainsWide = displayWidth / grainSize;

			var grains = [];
			var oddsPicker = [];

			//get grains from boxes
			for (var i = $(".single-color").length - 1; i >= 0; i--) {
				grains.push($(".single-color")[i].id);
				//add in the values of chance depending on odds
				for (var i2 = odds[i]; i2 > 0; i2--) {
					oddsPicker.push($(".single-color")[i].id);
				}
			}
			
			//vertically add rows
			for (var i = 0; i < grainsWide; i++) {
				//row of grains
				for (var i2 = 0; i2 < grainsWide; i2++) {
					var randomRotate = getRandomInt(360);
					drawCustomImage(document.getElementsByClassName(oddsPicker[getRandomInt(oddsPicker.length)])[getRandomInt(4)], grainSize * i2, y, grainSize * grainSizeScaleUp, grainSize * grainSizeScaleUp, randomRotate);
					x += grainSize;
				}
				y += grainSize;
			}
		}
		//just for responsiveness
		resize(canvas);
		//get the size for responsivess
		animate();

		document.getElementById("loader").style.opacity = 0;
	}

	//just for responsiveness
	resize(canvas);
	//get the size for responsivess
	animate();

	//default colors	
	addColor(colors.skyblue);
	addColor(colors.yellow);


	function checkPercentagesAndGenerate(render) {
		var total = 0;
		var odds = [];
		//get all percentages
		$("#pallete input[type='number']").each(function () {
			total += Number($(this).val());
			odds.push(~~Number($(this).val()));
		});
		if (total == 100) {
			$("#error").hide();
			draw(odds, render);
		} else {
			$("#error").show();
			if (!odds.length) {
				$("#error").html("You need to add some colors!");
			} else {
				$("#error").html("Values must add up to 100%!");
			}
		}
	}
</script>
BUILDER;
echo $builder;
echo "fish";
?>