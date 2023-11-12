
<?php 
include_once 'inc/functions.php';
/*
	When employee scan the card thro the infront of camera
*/
	if (isset($_REQUEST['emp_id']) AND !empty($_REQUEST['emp_id']) AND !empty($_REQUEST['shift'])) {
	    // Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
			# Common Headers 
			$headers .= 'From: '.@$getSetting['company_name'].' <noreply@'.@$getSetting['company_name'].'.com>'; 
	       	# code...
			$flag=0;

			$img='';
			$att_date = date('Y-m-d');
			$att_sts = 'present';
			$emp_id= $_REQUEST['emp_id'];
			@$admin_id = $fetchUser['user_id'];
			@$location = isset($_REQUEST['location'])?$_REQUEST['location']:'';
			$description = 'Attendance Marked by QR Scan at '.date('D, d-M-Y h:i:s a');
			$shift=str_replace("_", " ", $_REQUEST['shift']);
	    	$site_url=$dir = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
	 			$site_url=str_replace("attendance.php?d=card", "/", $site_url);
			
			$img= '<h5 class="alert alert-info">Attendance Marked<img src="'.$site_url.'img/check.gif" class="img img-responsive pull-right" alt="" id="check_img" style="height:40px;width: 40px;border-radius: 100%;margin-top:-10px"></h5>';
			$countUser=mysqli_num_rows(mysqli_query($dbc,"SELECT * FROM users WHERE user_id='$emp_id'"));
			$q=mysqli_query($dbc,"SELECT * FROM emp_attendance WHERE emp_id='$emp_id' AND att_date='$att_date'");
	    	if($countUser==0){
	    	    echo $img= '<center><h4 class="alert alert-danger">User not found <img src="'.$site_url.'img/cross.png" class="img img-responsive pull-right" alt="" id="check_img" style="height:40px;width: 40px;border-radius: 100%;margin-top:-10px"></h4></center>';
	    	    $flag=0;
	    	}else{
	    	    	if (mysqli_num_rows($q)>=1) {
	    		$fetchEmpLast  =mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM emp_attendance WHERE emp_id='$emp_id' AND att_date='$att_date' ORDER BY att_id DESC LIMIT 1"));
						
						$start = strtotime($fetchEmpLast['in_time']); 
						$end = strtotime(date("H:i:s")); 
						$totaltime = ($end - $start)  ; 
						$h = intval($totaltime / 3600);   
						$seconds_remain = ($totaltime - ($h * 3600)); 
						$m = intval($seconds_remain / 60);   
						$s = ($seconds_remain - ($m * 60)); 
						$remaining_emp=60-$m;

	    		// if($h>0){
	    			$time=$in_time = $out_time = date('H:i:s');
	    			if (!empty($fetchEmpLast['in_time']) AND !empty($fetchEmpLast['out_time'])) {
	    				# code...
	    				$img= '<h4 class="alert alert-danger">You have already marked attendance<img src="'.$site_url.'img/cross.png" class="img img-responsive pull-right" alt="" id="check_img" style="height:40px;width: 40px;border-radius: 100%;margin-top:-10px"></h4>';

	    			}else{
	    				if(empty($fetchEmpLast['in_time']) AND $_REQUEST['shift']=="check_in" ){
			    			 mysqli_query($dbc,"UPDATE emp_attendance SET in_time='$in_time' WHERE att_id='$fetchEmpLast[att_id]'");
			    			 $flag=1;
			    		}
			    		if(!empty($fetchEmpLast['in_time']) AND $_REQUEST['shift']=="check_in"){
			    			 echo $img= '<center><h4 class="alert alert-danger">You are already CHECKED IN<img src="'.$site_url.'img/cross.png" class="img img-responsive pull-right" alt="" id="check_img" style="height:40px;width: 40px;border-radius: 100%;margin-top:-10px"></h4></center>';
			    		}
			    		
		    			if (empty($fetchEmpLast['out_time']) AND $_REQUEST['shift']=="check_out") {
			    			# code...
			    			 mysqli_query($dbc,"UPDATE emp_attendance SET out_time='$out_time' WHERE att_id='$fetchEmpLast[att_id]'");
			    			 $flag=1;
			    		}
			    		if (!empty($fetchEmpLast['out_time']) AND $_REQUEST['shift']=="check_out") {
			    			# code...
			    			 echo $img= '<center><h4 class="alert alert-danger">You have Already CHECKED OUT<img src="'.$site_url.'img/cross.png" class="img img-responsive pull-right" alt="" id="check_img" style="height:40px;width: 40px;border-radius: 100%;margin-top:-10px"></h4></center>';
			    		}
			    		if (empty($fetchEmpLast['break_start']) AND $_REQUEST['shift']=="break_start") {
			    			# code...
			    			 mysqli_query($dbc,"UPDATE emp_attendance SET break_start='$time' WHERE att_id='$fetchEmpLast[att_id]'");
			    			 $flag=1;
			    		}
			    		if (!empty($fetchEmpLast['break_start']) AND $_REQUEST['shift']=="break_start") {
			    			echo $img= '<center><h4 class="alert alert-danger">Break is Already Started<img src="'.$site_url.'img/cross.png" class="img img-responsive pull-right" alt="" id="check_img" style="height:40px;width: 40px;border-radius: 100%;margin-top:-10px"></h4></center>';
			    			 
			    		}
			    		if (empty($fetchEmpLast['break_end']) AND $_REQUEST['shift']=="break_end") {
			    			# code...
			    			 mysqli_query($dbc,"UPDATE emp_attendance SET break_end='$time' WHERE att_id='$fetchEmpLast[att_id]'");
			    			 $flag=1;
			    		}
			    		if (!empty($fetchEmpLast['break_end']) AND $_REQUEST['shift']=="break_end") {
			    			# code...
			    			echo $img= '<center><h4 class="alert alert-danger">Break is Already Ended<img src="'.$site_url.'img/cross.png" class="img img-responsive pull-right" alt="" id="check_img" style="height:40px;width: 40px;border-radius: 100%;margin-top:-10px"></h4></center>';
			    		}
			    		


	    			}//when attendance marked in and out
		    		
	    		// }else{
	    		// 	$img= '<h4 class="alert alert-info">Make Difference of 1 Hour <br><br>Time Left: '.abs($remaining_emp).'<img src="img/cross.png" class="img img-responsive pull-right" alt="" id="check_img" style="height:40px;width: 40px;border-radius: 100%;margin-top:-10px"></h4>';
	    		// }

	    	}else{
	    		if($_REQUEST['shift']!='check_in'){
	    			echo $img= '<center><h4 class="alert alert-danger">You can not mark attendance until checked In<img src="'.$site_url.'img/cross.png" class="img img-responsive pull-right" alt="" id="check_img" style="height:40px;width: 40px;border-radius: 100%;margin-top:-10px"></h4></center>';
	    		}else{
	    			$in_time = date('H:i:s');
			    	if (mysqli_query($dbc,"INSERT INTO emp_attendance(att_date,att_sts,emp_id,location,description,admin_id,in_time) VALUES('$att_date','$att_sts','$emp_id','$location','$description','$admin_id','$in_time')")) {
			    		$flag=1;

				   		}else{
				   			$flag=0;
							$msg = mysqli_error($dbc);
							$sts="danger";
				    	} 
	    		}//first entry with check in shift
	    	
	    	}//num rows
	    	}//when user found
	    
	    	
	    	
	    	 if (isset($_REQUEST['d']) AND $_REQUEST['d']=="card" AND $flag==1) {
	    	# code...
	    	 	// echo mysqli_error($dbc);
	    	@$id = $_REQUEST['emp_id'];
			$fetchUserCard = fetchRecord($dbc,"users",'user_id',$id);
			$emp_card_email='<div style="margin:auto;width: 600px; min-height: 400px;padding: 10px;background: #fff;box-shadow: 10px 10px gray">
 	<h2>Attendance Details</h2>
 	<strong>Shift: </strong>'.$shift.' <br>
 	<strong>Date/Time: </strong>'.date("d-M-Y",strtotime($att_date)).' '.date("h:i A",strtotime($in_time)).' <br>
 	<strong>Location: </strong>'.$location.' <br>
 	<hr>
 	<h2>Employee Details</h2>
 	
 		<img src="'.$site_url.'img/uploads/'.$fetchUserCard['user_pic'].'" alt="" class="img img-responsive center-block" width="100" height="100">
 		<br>
 		<strong>Name: </strong> '.$fetchUserCard['user_fullname'].' <br>
 		<strong>Emp ID #: </strong> '.$fetchUserCard['user_id'].' <br>
 		<strong>ABN #: </strong> '.$fetchUserCard['user_cnic'].' <br>
 		<strong>Position: </strong> '.$fetchUserCard['designation'].'
 </div>';
			$emp_card='<table class="table" align="center" style="width:85%">
						<tr>
							<th>
								<table border="0" class="table" width="100%">
									<tr>
										<thc colspan="2">
											'.$img.'
										</th>
									</tr>
									<tr>
										<th><img src="'.$site_url.'img/uploads/'.$fetchUserCard['user_pic'].'" alt="" class="img img-responsive center-block" width="100" height="100">
										<p class="text-center">'.$fetchUserCard['user_fullname'].'</p>
										</th>
										<th style="line-height: 12px">
											<p>Emp ID #: '.$fetchUserCard['user_id'].'</p>
											<p>ABN #: '.$fetchUserCard['user_cnic'].'</p>
											<p>Email : '.$fetchUserCard['user_email'].'</p>
											<p>Mobile No : '.$fetchUserCard['user_phone'].'</p>
											<p>Position : '.$fetchUserCard['designation'].'</p>

										</th>
									</tr>
								</table>
							</th><!-- one -->
						</tr>
					</table>';
						$subject = "Attendance ".strtoupper($shift)." at ".$att_date;
		            	$img_email = '<img src="'.$site_url.'img/uploads/'.(@$getSetting['logo']).'" width="120" height="120" class="img img-responsive center-block" alt="">';
					$body="<center>".$img_email .'<br><h2>Your attendance details</h2></center><br>'.$emp_card_email.'<br><br>Best Regards';
					
			echo $emp_card;
			
			//mail('info@andrew@kingpainting.com.au',$subject,$body,$headers);
			//mail($fetchUserCard['user_email'],$subject,$body,$headers);
	   	 }//isset
	    }//if isset
	    else{
	    	//echo "<br>No Student Found";
	    }

	   ?>