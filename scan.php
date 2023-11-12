<?php include_once 'inc/functions.php'; 
    $location=explode(",", $getSetting["location"]);
    @$lat = (empty($location[0]))?0:$location[0];
    @$long = (empty($location[1]))?0:$location[1];
?>
 <script>
 	var dist = 0;
	var lat1=<?php echo $lat; ?>;
	var lon1=<?php echo $long; ?>;
	var storedDistance = <?php echo $getSetting['distance'] ?>;
 </script>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1, maximum-scale=1,user-scalable=no">
	<title>Attendance</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/scan.css">
	<style>
		.bg{
			background-image: url(img/saver.gif);
			background-size: cover;
			background-attachment: fixed;
			background-position: top center;
			background-repeat: no-repeat;

		}
		.fade{
			opacity: 0.2;
		}
	</style>
</head>

<body onload="init()">
  <center>

    <h2> Scan Your QR Code Identity</h2>
  </center>
	<p class="text-center" id="demo"></p>
	<div id="app">
    <input type="hidden" id="shift" value="<?=@$_REQUEST['shift']?>">
    <input type="hidden" value="<?=@$fetchUser['id']?>" id="emp_id">
		<input type="hidden" id="dist_fld" >
		<input type="hidden" placeholder="lat" id="lat" readonly>
		<input type="hidden" placeholder="lon" id="lon" readonly>
			<div class="container-fluid">
				<div id="my_camera" style="display: none;"></div>
				<div id="results" style="display: none;"> </div>
				<div class="row" id="open_camera">
					<div class="col-sm-4">
						<table class="table table-striped table-bordered table-condensed">
							<tr>
								<td>
								    <?php if(empty($_REQUEST['shift'])): ?>
								        <center>
											<p class="text-danger">Please Select your Shift before scanning card</p>
										</center>
								    <?php else: ?>
									 <center>
								       		<video facingMode="environment" playsinline  id="preview"></video>
								       	 <div id="sourceSelectPanel" style="display:none" width="180px" height="180px">
									        <label for="sourceSelect">Change video source:</label>
									        <select id="sourceSelect" style="max-width:400px">
									        </select>
									      </div>

									      <div style="display: none;">
									        <label for="decoding-style"> Decoding Style:</label>
									        <select id="decoding-style" size="1">
									          <option value="once">Decode once</option>
									          <option value="continuously">Decode continuously</option>
									        </select>
									      </div>
									 	</div>
								       </center>
								       <?php endif; ?> 
								       <?php if(!empty($_REQUEST['shift'])): ?>
                						<center>
                						    <br>
                							<p>Scan card for : <?=strtoupper(str_replace("_"," ",$_REQUEST['shift']))?></p>
                						</center>
                					<?php endif; ?>
								</td>
							</tr>
						</table>
						
					</div><!-- col -->
					<div class="col-sm-8">
					    <table class="table">
							<tr>
								<th colspan="2">Choose your shift/visit status</th>
							</tr>
							<tr>
								<th><a href="scan.php?period=<?=@$_REQUEST['period']?>&shift=check_in" class="btn btn-success btn-lg btn-block <?php if(!empty($_REQUEST['shift']) AND $_REQUEST['shift']=="check_in"){echo "";} else{echo 'fade';} ?>">Check In</a> </th>
								<th><a href="scan.php?period=<?=@$_REQUEST['period']?>&shift=break_start" class="btn btn-warning btn-lg btn-block <?php if(!empty($_REQUEST['shift']) AND $_REQUEST['shift']=="break_start"){echo "";} else{echo 'fade';} ?>">Break Start</a></th>
							</tr>
							<tr>
								<th><a href="scan.php?period=<?=@$_REQUEST['period']?>&shift=check_out" class="btn btn-danger btn-lg btn-block <?php if(!empty($_REQUEST['shift']) AND $_REQUEST['shift']=="check_out"){echo "";} else{echo 'fade';} ?>">Check Out</a></th>
								<th><a href="scan.php?period=<?=@$_REQUEST['period']?>&shift=break_end" class="btn btn-info btn-lg btn-block <?php if(!empty($_REQUEST['shift']) AND $_REQUEST['shift']=="break_end"){echo "";} else{echo 'fade';} ?>">Break End</a></th>
							</tr>
						</table>
					</div>
					<div class="col-sm-12">
					    <span id="card"></span>
					</div>
			</div><!-- row -->
			</div>
		</div>
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.js"></script>
        <link rel="stylesheet" href="css/sweetalert.css">
          <script src="js/sweetalert.js"></script>
          <script type="text/javascript" src="webcamjs/webcam.min.js"></script>
		    <script>
	
var x = document.getElementById("demo");





 </script>



 
<script type="text/javascript" src="js/zxing.js"></script>
  <script type="text/javascript">
  $(function(){
				getLocation();
			})
  function distance(lat1=<?php echo @$lat; ?>, lon1=<?php echo @$long; ?>, lat2, lon2, unit) {
	var radlat1 = Math.PI * lat1/180
	var radlat2 = Math.PI * lat2/180
	var theta = lon1-lon2
	var radtheta = Math.PI * theta/180
	var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
	if (dist > 1) {
		dist = 1;
	}
	dist = Math.acos(dist)
	dist = dist * 180/Math.PI
	dist = dist * 60 * 1.1515
	if (unit=="K") { dist = dist * 1.609344 }
	if (unit=="N") { dist = dist * 0.8684 }
	return dist
	// document.getElementById('heading').innerHTML=dist;

}
var x = document.getElementById("demo");

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
       
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    var latlon = position.coords.latitude+","+position.coords.longitude;
    $("#lat").val(position.coords.latitude);
    $("#lon").val(position.coords.longitude);
    dist=distance(<?php echo @$lat; ?>, <?php echo @$long ?>, position.coords.latitude, position.coords.longitude, 'K');
    $("#dist_fld").val(dist*1000);
    

}

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            x.innerHTML = "Location service is off by your device."
            break;
        case error.POSITION_UNAVAILABLE:
            x.innerHTML = "Location information is unavailable."
            break;
        case error.TIMEOUT:
            x.innerHTML = "The request to get user location timed out."
            break;
        case error.UNKNOWN_ERROR:
            x.innerHTML = "An unknown error occurred."
            break;
    }
}
function idleLogout() {
		    var t;
		    window.onload = resetTimer;
		    window.onmousemove = resetTimer;
		    window.onmousedown = resetTimer;  // catches touchscreen presses as well      
		    window.ontouchstart = resetTimer; // catches touchscreen swipes as well 
		    window.onclick = resetTimer;      // catches touchpad clicks as well
		    window.onkeypress = resetTimer;   
		    window.addEventListener('scroll', resetTimer, true); // improved; see comments

		    function yourFunction() {
		        // your function for too long inactivity goes here
		        // e.g. window.location.href = 'logout.php';
		    videoElem=document.getElementById('preview');
		     let stream = videoElem.srcObject;
		  let tracks = stream.getTracks();

		  tracks.forEach(function(track) {
		    track.stop();
		  });

		 	 videoElem.srcObject = null;
		        $("#camera_btn").removeClass('hidden');
		        $("#open_camera").addClass('hidden');
		         $('body').addClass('bg');

		    }

		    function resetTimer() {
		        clearTimeout(t);
		        t = setTimeout(yourFunction,60000*5);  // time is in milliseconds
		    }
		}
		//idleLogout();
		    configure();
		    // Configure a few settings and attach camera
		    function configure(){

		      Webcam.set({
		        width: 320,
		        height: 240,
		        image_format: 'jpeg',
		        jpeg_quality: 90
		      });
		      Webcam.attach( '#my_camera' );
		    }
		    // A button for taking snaps
		    

		  

    function take_snapshot() {
      // play sound effect
        // preload shutter audio clip
     

    var shutter = new Audio();
    shutter.autoplay = false;
    shutter.src = navigator.userAgent.match(/Firefox/) ? 'shutter.ogg' : 'shutter.mp3';
      shutter.play();

     

      // take snapshot and get image data
      Webcam.snap( function(data_uri) {
        // display results in page
        document.getElementById('results').innerHTML = 
          '<img id="imageprev" src="'+data_uri+'"/>';
      } );

      Webcam.reset();

    }

    function saveSnap(id=""){
      // Get base64 value from <img id='imageprev'> source
      var base64image =  document.getElementById("imageprev").src;

       Webcam.upload( base64image, 'upload.php?emp_id='+id, function(code, text) {
         console.log('Save successfully');
         console.log(text);
         // alert('Pic has been saved');
         Webcam.reset();
         configure();
            });

    }
    function decodeOnce(codeReader, selectedDeviceId=undefined) {
      codeReader.decodeFromInputVideoDevice(selectedDeviceId, 'preview').then((result) => {
        var str = result.text.split('|');
        console.log(result)
        if (result.text) {
            getLocation();
            var location=$("#lat").val()+","+$("#lon").val();
	       var beep = new Audio();
		    beep.autoplay = false;
		    beep.src = navigator.userAgent.match(/Firefox/) ? 'beep.ogg' : 'beep.mp3';
		    beep.play();
		      // 	if(Number(dist)>storedDistance){
			       // 		$("#preview").show();
			       // 	$("#card").html('<img src="img/cross.png" width="80" height="80" class="img img-responsive center-block" alt=""><h3 class="text-center alert alert-info">'+(dist).toFixed(2)+' meters away</h3>');
			       // 				setTimeout(function(){
				     	// 		$(".alert").show().fadeOut(800,function(){
				     	// 			$("#card").html('');	
				     	// 		});
				     	// 	},3000);
			       // }else{
			       	$("#preview").show();
				     $.ajax({
				     	url:"attendance.php?d=card",
				     	type:'post',
				     	dataType:'text',
				     	data:{emp_id:result.text,shift:$("#shift").val(),location:location},
				     	success:function(response){
				     		$("#card").html(response);
                             swal({
                                      title: "Attendance Update",
                                      html: true,
                                      text: response,
                                      type: "success",
                                      showCancelButton: false,
                                      confirmButtonClass: "btn-danger",
                                      confirmButtonText: "Close",
                                      closeOnConfirm: true,
                                      allowOutsideClick: "true" 
                                    },
                                    function(){
                                     init()
                                    });
				     		setTimeout(function(){
				     			$(".alert").show().fadeOut(800,function(){
				     			   
				     				$("#card").html('');	
				     			});
				     		take_snapshot();
				      		saveSnap(result.text);
				      		 console.log(result.text);
				      		  init();
				     		},5000);
				     	}

				     });
			       // }
			      
          
        }else{
        swal({
              title: "Alert!",
              text: "Invalid QR Code",
              type: "error",
              showCancelButton: false,
              confirmButtonClass: "btn-danger",
              confirmButtonText: "Try Again",
              closeOnConfirm: true
            },
            function(){
             init()
            });
        }
       
      }).catch((err) => {
        console.log(err)
        // document.getElementById('result').textContent = err
      })
    }
    function decodeContinuously(codeReader, selectedDeviceId=undefined) {
    	 getLocation();
      codeReader.decodeFromInputVideoDeviceContinuously(selectedDeviceId, 'preview', (result, err) => {
        if (result) {
          // properly decoded qr code
          console.log('Found QR code!', result.text)
          
          // document.getElementById('result').textContent = result.text
        }

        if (err) {
          if (err instanceof ZXing.NotFoundException) {
            console.log('No QR code found.')
          }

          if (err instanceof ZXing.ChecksumException) {
            console.log('A code was found, but it\'s read value was not valid.')
          }

          if (err instanceof ZXing.FormatException) {
            console.log('A code was found, but it was in a invalid format.')
          }
        }
      })
    }

    function init(){
      // window.addEventListener('load', function () {
      let selectedDeviceId=undefined;
      const codeReader = new ZXing.BrowserQRCodeReader()
      console.log('ZXing code reader initialized')

      codeReader.getVideoInputDevices()
        .then((videoInputDevices) => {
          const sourceSelect = document.getElementById('sourceSelect')
          // selectedDeviceId = videoInputDevices[0].deviceId
          selectedDeviceId = undefined
          if (videoInputDevices.length >= 1) {
            videoInputDevices.forEach((element) => {
              const sourceOption = document.createElement('option')
              sourceOption.text = element.label
              sourceOption.value = element.deviceId
              sourceSelect.appendChild(sourceOption)
            })

            sourceSelect.onchange = () => {
              // selectedDeviceId = sourceSelect.value;
              selectedDeviceId = undefined
            };

            const sourceSelectPanel = document.getElementById('sourceSelectPanel')
            sourceSelectPanel.style.display = 'none'
          }
            const decodingStyle = document.getElementById('decoding-style').value;

            if (decodingStyle == "once") {
              decodeOnce(codeReader, selectedDeviceId);
            } else {
              decodeContinuously(codeReader, selectedDeviceId);
            }
        })
        .catch((err) => {
          console.error(err)
        })
    // })
    }
  </script>

</body>
</html>
