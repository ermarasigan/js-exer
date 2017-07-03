<!DOCTYPE html>
<html>
<head>
	<title>Javascript Exercise</title>
	<style type="text/css">
		
		body {
		  background: #666;
		  margin: 0;
		}

		canvas {
		  position: absolute;
		  bottom: 10%;
		  left: 50%;
		  transform: translateX(-50%);
		}

		#bg {
			width: 100vw; 
			height: 100vh;
			
			/*background: url("img/omi.gif");*/
			background: url("img/stream.gif");
			background-repeat: no-repeat;
			background-size: cover;
			/*background-position: center;*/
			background-position: 20%;
		}



	</style>

	<!-- Ukulele tab generator by pianosnake-->
	<script src="dist/webcomponents-lite.min.js"></script>
	<link rel="import" href="dist/uke-chord.html">
</head>
<body>

	<div id="bg"  >
		<div id="test"></div>
		

		<textarea id="myTextarea" rows="4" cols="50" style="font-family: sans-serif;"
		placeholder="Type chords and lyrics in alternate lines (c l c l)"></textarea>
		<br>
		<input id="bpm" type="number" min=0 placeholder="bpm">
		<button type="button" onclick="previewLyrics()">Preview</button>

		<button id='togglebtn' class='btn btn-default btn-lg' type='submit' onclick='toggleLyrics();'>Play</button><br>

		<br>
		<!-- <input id="bpm" type="text" placeholder="Type a chord"> -->
		<!-- <div id="test2" style="background:red; width: 50px; height: 50px"></div> -->
		<!-- <button type="submit" onclick="genTabs()">Generate uke tabs</button> -->

		<form action="" method="post">
			<input type="text" name="chord" placeholder="insert chord"><br>
			<input type="submit" name="convert">
		</form>

		<?php
			$tabs=[	 'C'		=> '00003'
					,'C7'		=> '00001'
					,'Cm'		=> '00333'
					,'Cm7'		=> '03333'
					,'Cdim'		=> '02323'
					,'Caug'		=> '01003'
					,'C6'		=> '00000'
					,'CM7'		=> '00002'	
					,'Cmaj7'	=> '00002'
					,'C9'		=> '00201'

					,'C#'		=> '01114'
					,'C#7'		=> '01112'
					,'C#m'		=> '01103'
					,'C#m7'		=> '04444'
					,'C#dim'	=> '00101'
					,'C#aug'	=> '02110'
					,'C#6'		=> '01111'
					,'C#M7'		=> '01113'
					,'C#maj7'	=> '01113'
					,'C#9'		=> '01312'

					,'Db'		=> '01114'
					,'Db7'		=> '01112'
					,'Dbm'		=> '01103'
					,'Dbm7'		=> '04444'
					,'Dbdim'	=> '00101'
					,'Dbaug'	=> '02110'
					,'Db6'		=> '01111'
					,'DbM7'		=> '01113'
					,'Dbmaj7'	=> '01113'
					,'Db9'		=> '01312'

					,'D'		=> '02220'
					,'D7'		=> '02223'
					,'Dm'		=> '02210'
					,'Dm7'		=> '02213'
					,'Ddim'		=> '01212'
					,'Daug'		=> '03221'
					,'D6'		=> '02222'
					,'DM7'		=> '02224'
					,'Dmaj7'	=> '02224'
					,'D9'		=> '02423'

					,'D#'		=> '03331'
					,'D#7'		=> '03334'
					,'D#m'		=> '03321'
					,'D#m7'		=> '03324'
					,'D#dim'	=> '02323'
					,'D#aug'	=> '02114'
					,'D#6'		=> '03333'
					,'D#M7'		=> '03330'
					,'D#maj7'	=> '03330'
					,'D#9'		=> '00333'

					,'Eb'		=> '03331'
					,'Eb7'		=> '03334'
					,'Ebm'		=> '03321'
					,'Ebm7'		=> '03324'
					,'Ebdim'	=> '02323'
					,'Ebaug'	=> '02114'
					,'Eb6'		=> '03333'
					,'EbM7'		=> '03330'
					,'Ebmaj7'	=> '03330'
					,'Eb9'		=> '00333'

					,'E'		=> '04442'
					,'E7'		=> '01202'
					,'Em'		=> '00432'
					,'Em7'		=> '00202'
					,'Edim'		=> '00101'
					,'Eaug'		=> '01003'
					,'E6'		=> '01020'
					,'EM7'		=> '01302'
					,'Emaj7'	=> '01302'
					,'E9'		=> '01222'

					,'F'		=> '02010'
					,'F7'		=> '02301'
					,'Fm'		=> '01013'
					,'Fm7'		=> '01313'
					,'Fdim'		=> '01212'
					,'Faug'		=> '02110'
					,'F6'		=> '02213'
					,'FM7'		=> '02423'
					,'Fmaj7'	=> '02423'
					,'F9'		=> '02333'

					,'F#'		=> '03121'
					,'F#7'		=> '03424'
					,'F#m'		=> '02120'
					,'F#m7'		=> '02424'
					,'F#dim'	=> '02323'
					,'F#aug'	=> '04322'
					,'F#6'		=> '03324'
					,'F#M7'		=> '00111'
					,'F#maj7'	=> '00111'
					,'F#9'		=> '01101'

					,'Gb'		=> '03121'
					,'Gb7'		=> '03424'
					,'Gbm'		=> '02120'
					,'Gbm7'		=> '02424'
					,'Gbdim'	=> '02323'
					,'Gbaug'	=> '04322'
					,'Gb6'		=> '03324'
					,'GbM7'		=> '00111'
					,'Gbmaj7'	=> '00111'
					,'Gb9'		=> '01101'

					,'G'		=> '00232'
					,'G7'		=> '00212'
					,'Gm'		=> '00231'
					,'Gm7'		=> '00211'
					,'Gdim'		=> '00101'
					,'Gaug'		=> '04332'
					,'G6'		=> '00202'
					,'GM7'		=> '00222'
					,'Gmaj7'	=> '00222'
					,'G9'		=> '02212'

					,'G#'		=> '33121'
					,'G#7'		=> '01323'
					,'G#m'		=> '01342'
					,'G#m7'		=> '00322'
					,'G#dim'	=> '01212'
					,'G#aug'	=> '01003'
					,'G#6'		=> '01313'
					,'G#M7'		=> '01333'
					,'G#maj7'	=> '01333'
					,'G#9'		=> '03323'

					,'Ab'		=> '33121'
					,'Ab7'		=> '01323'
					,'Abm'		=> '01342'
					,'Abm7'		=> '00322'
					,'Abdim'	=> '01212'
					,'Abaug'	=> '01003'
					,'Ab6'		=> '01313'
					,'AbM7'		=> '01333'
					,'Abmaj7'	=> '01333'
					,'Ab9'		=> '03323'

					,'A'		=> '02100'
					,'A7'		=> '00100'
					,'Am'		=> '02000'
					,'Am7'		=> '00433'
					,'Adim'		=> '02323'
					,'Aaug'		=> '02114'
					,'A6'		=> '02424'
					,'AM7'		=> '01100'
					,'Amaj7'	=> '01100'
					,'A9'		=> '00102'

					,'A#'		=> '03211'
					,'A#7'		=> '01211'
					,'A#m'		=> '03111'
					,'A#m7'		=> '01111'
					,'A#dim'	=> '00101'
					,'A#aug'	=> '03221'
					,'A#6'		=> '00211'
					,'A#M7'		=> '03210'
					,'A#maj7'	=> '03210'
					,'A#9'		=> '01213'

					,'Bb'		=> '03211'
					,'Bb7'		=> '01211'
					,'Bbm'		=> '03111'
					,'Bbm7'		=> '01111'
					,'Bbdim'	=> '00101'
					,'Bbaug'	=> '03221'
					,'Bb6'		=> '00211'
					,'BbM7'		=> '03210'
					,'Bbmaj7'	=> '03210'
					,'Bb9'		=> '01213'

					,'B'		=> '04322'
					,'B7'		=> '02322'
					,'Bm'		=> '04222'
					,'Bm7'		=> '02222'
					,'Bdim'		=> '01212'
					,'Baug'		=> '04332'
					,'B6'		=> '01322'
					,'BM7'		=> '03322'
					,'Bmaj7'	=> '03322'
					,'B9'		=> '02324'

					,'D7#5'		=> '03223'
					,'Cm6'		=> '02333'
					,'Dsus4'	=> '00230'
					,'A7sus4'	=> '00200'
					,'Cadd9'	=> '00203'
					
					];
			if(isset($_POST['convert'])){
				$chord = ucfirst($_POST['chord']);

				if(isset($tabs[$chord])){
					$pos = substr($tabs[$chord],0,1)	;
					$tab = substr($tabs[$chord],1,4)	;
					echo "<uke-chord frets='$tab' size='L'  position=$pos name='$chord'  style='background: white; padding-right: 20px; margin: 10px'></uke-chord>";
				} else {
					echo 'invalid';
				}
			}


		?>

		<br>

		

	<!-- 	<uke-chord id='chord1' frets='2100' size='L'  position=0 name='A'  style='background: white; padding-right: 20px; margin: 10px'></uke-chord>
 -->
		<canvas id="draw-pad" width="700" height="200">
		</canvas>
	</div>

	

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="js/jquery.min.js"></script>

	<script type="text/javascript">


		function genTabs(){
			
			// $('#chord1').attr('frets','1311');

			// var fret = $('#chord1').attr('frets');
			// console.log(fret);

			$('#test2').css('background','pink');
			console.log('yey');
		}

		chords=[];
		lyrics=[];

		$(document).ready(function() {
		    $("#togglebtn").hide();
		});

		function previewLyrics() {
		    // var x = document.getElementById("myTextarea").value;
		    // document.getElementById("demo").innerHTML = x;
		    var lines = [];
		    chords=[];
			lyrics=[];
		    
		    var ctr=0;
		    $.each($('#myTextarea').val().split(/\n/), function (i, line) {
		    	console.log(ctr);
		        // if (line) {
		        // 	console.log(line)
		        //     lines.push(line);
		            
		        // } else {
		        //     lines.push("");
		        // }
		        if(ctr%2==0){
		            chords.push(line);
		        } else {
		        	lyrics.push(line);
		        }
		        ctr++;
		    });
		    // console.log(lines);
		    console.log(chords);
		    console.log(lyrics);

		    if(chords>''&&lyrics>''){

		     $("#togglebtn").show();
		    } else {
		     $("#togglebtn").hide();
		    }

		}



		// var ords=['null'
		// 	,'first'
		// 	,'second'
		// 	,'third'
		// 	,'fourth'
		// 	,'fifth'
		// 	,'sixth'
		// 	,'seventh'
		// 	,'eighth'
		// 	,'ninth'
		// 	,'tenth'
		// 	,'eleventh'
		// 	,'twelfth'
		// 	];

		// var gifts=['null'
		// 	,'a partridge in a pear tree'
		// 	,'Two Turtle Doves'
		// 	,'Three French Hens'
		// 	,'Four Calling Birds'
		// 	,'Five Gold Rings'
		// 	,'Six Geese a-Laying'
		// 	,'Seven Swans a-Swimming'
		// 	,'Eight Maids a-Milking'
		// 	,'Nine Ladies Dancing'
		// 	,'Ten Lords a-Leaping'
		// 	,'Eleven Pipers Piping'
		// 	,'Twelve Drummers Drumming'
		// 	];

		// var l=0;
		// var lyrics=[];

		// for(i=1;i<13;i++){
		// 	l++;
		// 	lyrics[l] = "On the " + ords[i] + " day of Christmas";
		// 	// console.log(lyrics[l]);

		// 	l++;
		// 	lyrics[l] = "my true love sent to me: ";
		// 	// console.log(lyrics[l]);

		// 	for (j=i; j>0; j--){
		// 		if(i>1 && j==1){
		// 			l++;
		// 			lyrics[l] = "and " + gifts[j];
		// 			// console.log(lyrics[l]);
		// 		} else {
		// 			l++;
		// 			lyrics[l] = gifts[j];
		// 			// console.log(lyrics[l]);
		// 		}
		// 	}
		// }

		// lyrics=['Mary had a little lamb'
		// 		,'little lamb, little lamb'
		// 		,'Mary had a little lamb'
		// 		,'Its fleece as white as snow'
		// ]

		// lyrics=['When your legs don\'t work like they'
		// 	,'used to before'
		// 	,'And I can\'t sweep you off of your' 
		// 	,'feet'
		// 	,'Will your mouth still'
		// 	,'remember the taste of my love'
		// 	,'Will your eyes still'
		// 	,'smile from your cheeks'
		// 	,'And darling I will '
		// 	,'be loving you \'til we\'re 70'
		// 	,'And baby my heart '
		// 	,'could still fall as hard at 23'
		// 	,'And I\'m thinking \'bout how people fall in love in mysterious ways'
		// 	,'Maybe just the touch of a hand'
		// 	,'Oh me I fall in love with you every single day'
		// 	,'And I just wanna tell you I am'
		// 	,'So honey now'
		// 	,'Take me into your loving arms'
		// 	,'Kiss me under the light of a thousand stars'
		// 	,'Place your head on my beating heart'
		// 	,'I\'m thinking out loud'
		// 	,'Maybe we found love right where we are'
		// ];

		// lyrics=['Wise   men \t say, \t \t only \t'
		// ,'fools   rush \t in, \t \t but'
		// ,'I \t can\'t \t help \t falling in'
		// ,'love with you \t \t'
		// ,' '
		// ,'你不乖有时'
		// ,'还会作怪'
		// ,'但你不坏'
		// ,'只是不装可爱'
		// ]

		// chords=['D \t\t\t\t\t\t\t F#m \t\t\t\t\t\t\t Bm'
		// ,'G             D \t\t\t\t\t A \t\t\t\t\t\ G'
		// ,'A \t\t\t\t\t Bm \t\t\t\t\t G'
		// ,'D \t\t\t\t\t A \t\t\t\t\t D' 
		// ]

		// shim layer with setTimeout fallback
		window.requestAnimFrame = (function(){
		  return  window.requestAnimationFrame       ||
		          window.webkitRequestAnimationFrame ||
		          window.mozRequestAnimationFrame    ||
		          function( callback ){
		            window.setTimeout(callback, 1000 / 60);
		          };
		})();

		// beats per minute
		// var bpm=78;
		// var bpm = 42;
		// var bpm=122;
		

		var canvas = document.getElementById('draw-pad');
		var context = canvas.getContext('2d');
		var x = 10; //canvas.width / 2;
		// var y = canvas.height / 2;
		var y = 170;
		// var txt = 'On the first day of Christmas';
		// var l=0;
		// var txt = lyrics[l];
		var w = 0;
		var clearH = 200;
		var clearY = 0;
		var clearX = 8;

		context.font = 'bold 50px sans-serif';
		// textAlign aligns text horizontally relative to placement
		context.textAlign = 'left';
		// context.textAlign = 'center';
		// textBaseline aligns text vertically relative to font style
		context.textBaseline = 'middle';
		context.lineWidth = 4;
		context.strokeStyle = 'black';

		function runText() {
		  // console.log('Run text', w, l);
		  // if (w > 700) {
		  if (w>=(1+2/bpm)*context.measureText(txt).width){
		    // context.clearRect(clearX, clearY, w, clearH);
		    context.clearRect(clearX, clearY, 2*w, clearH);
		    console.log(lyrics[l],context.measureText(txt).width);
		    l++;
		    if(l<lyrics.length){
		    	txt=lyrics[l];
		    } 
		    else {
		    	txt='';
		    }
		    w = 0;
		  }

		  if (w === 0) {
		    context.fillStyle = 'lightblue';
		    context.strokeText(txt, x, y);
		    context.fillText(txt, x, y);
		    context.fillStyle = 'red';
		  }
		  
		  context.save();
		  context.beginPath();
		  context.clearRect(clearX, clearY, w, clearH);
		  context.rect(clearX, clearY, w, clearH);
		  context.clip();
		  context.strokeStyle = 'white';
		  context.strokeText(txt, x, y);
		  context.fillText(txt, x, y);
		  context.restore();


		  
		  
		  // w += (context.measureText(txt).width/bpm);
		  w += ((context.measureText(txt).width * bpm) / (240 * fps));
		  // console.log(w);

		  if (l < lyrics.length) {


		  	// chords
		  context.fillStyle = 'darkblue';
		    context.strokeText(chords[l], x, 100);
		    context.fillText(chords[l], x, 100);
		    context.fillStyle = 'red';

			// requestAnimFrame(runText);
			globalID = requestAnimFrame(runText);
			} else {
				var toggle = document.getElementById('togglebtn');
				toggle.innerHTML = 'Restart';
			}
		}

		function stopText(){
			cancelAnimationFrame(globalID);
		}

		function toggleLyrics() {
			// Call function to run text animation
			// l=1;
			// w=0;
			var toggle = document.getElementById('togglebtn');
			bpm=$('#bpm').val();
			switch(toggle.innerHTML) {
			    case 'Play':
			    	l=0;
			    	txt=lyrics[l];
			        runText();
					toggle.innerHTML = 'Pause'; 
			        break;
			    case 'Pause':
			        stopText();
					toggle.innerHTML = 'Play';
			        break;
			    case 'Restart':
			    	l=0;
			    	txt=lyrics[l];
			    	runText();
			    	toggle.innerHTML = 'Pause'; 
			    default:
			        break;
			}

		}

		// Compute frames per second
		function step(timestamp) {
			// console.log(time);
		    var time2 = new Date;
		    fps   = 1000 / (time2 - time);
		    time = time2;
			
		    document.getElementById('test').innerHTML = fps;
		    window.requestAnimationFrame(step);
		}

		var time = new Date;
		if (window.requestAnimationFrame(step)){
			console.log('yey');
		}


		


		
	</script>

</body>
</html>