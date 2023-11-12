<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

	include_once 'inc/db_connect.php';
	function getDatesFromRange($start, $end){
	    $dates = array($start);
	    while(end($dates) < $end){
	        $dates[] = date('Y-m-d', strtotime(end($dates).' +1 day'));
	    }
	    return $dates;
		}
		function differenceInHours($startdate,$enddate){
			$starttimestamp = strtotime($startdate);
			$endtimestamp = strtotime($enddate);
			$difference = abs($endtimestamp - $starttimestamp)/3600;
			return $difference;
		}
function array_csv_download( $array, $filename = "export.csv", $delimiter=";" )
{
    header( 'Content-Type: application/csv' );
    header( 'Content-Disposition: attachment; filename="' . $filename . '";' );

    // clean output buffer
    ob_end_clean();
    
    $handle = fopen( 'php://output', 'w' );

    // use keys as column titles
    // fputcsv( $handle, array_keys( $array['0'] ) , $delimiter );

    foreach ( $array as $value ) {
        fputcsv( $handle, $value , $delimiter );
    }

    fclose( $handle );

    // flush buffer
    @ob_flush();
    
    // use exit to get rid of unexpected output afterward
    //exit();
}


function fetchRecord($dbc,$table,$fld,$data){
	 	return  mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM $table WHERE $fld='$data'"));
	 	}  
	ob_start();
	if(!empty($_REQUEST['from']) AND !empty($_REQUEST['to'])){
		$output=[];
		$from = date_create(date('Y-m-d', strtotime($_REQUEST['from'])));
        $to = date_create(date('Y-m-d', strtotime($_REQUEST['to'])));
        $diff = date_diff($from, $to);
        $days = $diff->format("%d");
        $date_range = getDatesFromRange(date('Y-m-d', strtotime($_REQUEST['from'])), date('Y-m-d', strtotime($_REQUEST['to'])));
       	$late=$sick_leave=$vacation=$medical_leave=$annual_leave =$in_time_count=$hour_shift=$leave_count=0;

		// $output.=date('M-Y',strtotime($_REQUEST['month']))."\n";
		$header=array("List of Employee","Employee work day","Late","OT","Leave Day","Sick Leave","Vacation","Medical Leave","Annual Leave");
		
			foreach ($date_range as $dr){ 
				//@$month=date('Y-m',strtotime(($_REQUEST['month'])));
				$dated=$dr;
				array_push($header,date('d',strtotime(($dr)))."\n".date('D',strtotime($dated)));
			}
			$output[]=$header;
    		if($getRoleAdmin >=1){
    		    $q=mysqli_query($dbc,"SELECT * FROM users INNER JOIN assign_user_role WHERE users.user_id=assign_user_role.user_id AND assign_user_role.user_role='employee' AND users.user_status='enable'");
    		}else{
    		 $q=mysqli_query($dbc,"SELECT * FROM users WHERE users.user_id='$fetchUser[user_id]'  AND users.user_status='enable'");   
    		}
			while($r=mysqli_fetch_assoc($q)){
				foreach ($date_range as $dr){
					$getCountAttendance=mysqli_query($dbc,"SELECT * FROM emp_attendance WHERE att_date='$dr' AND emp_id='$r[user_id]'");
					while($fetchCountAttendance=mysqli_fetch_assoc($getCountAttendance)){
						$start_time=strtotime($fetchCountAttendance['in_time']); @$poject_name=$fetchCountAttendance['project_name'];
						@$location=$fetchCountAttendance['location'];
						@$address=$fetchCountAttendance['address'];
						$open_time=(empty($getSetting['open_hour']))?strtotime("08:00:00"):strtotime($getSetting['open_hour']);
						if(!empty($fetchAttendance['out_time'])){
							$start = strtotime($fetchAttendance['in_time']);
							$end = strtotime($fetchAttendance['out_time']); 
							$totaltime = ($end - $start)  ; 
							$h = intval($totaltime / 3600);   
							$seconds_remain = ($totaltime - ($h * 3600)); 
							$m = intval($seconds_remain / 60);   
							$s = ($seconds_remain - ($m * 60)); 
						}
						$minute_allowed=empty($getSetting['minute_allowed'])?"5":$getSetting['minute_allowed'];

					if((($start_time-$open_time)/60)>$minute_allowed){
						$late++;
					} 
						if(!empty($fetchCountAttendance['in_time'])){
						 $in_time_count++;
						}
						if(!empty($fetchCountAttendance['out_time'])){
								$hour_shift+= number_format(differenceInHours(date('H:i:s',strtotime("5:00 pm")) ,$fetchCountAttendance['out_time']),2);
							}
							if(!empty($fetchCountAttendance['att_sts']) AND strtolower($fetchCountAttendance['att_sts'])=="leave"){
								$leave_count++;
							}
							if(!empty($fetchCountAttendance['att_sts']) AND strtolower($fetchCountAttendance['att_sts'])=="sick leave"){
								$sick_leave++;
							}
							if(!empty($fetchCountAttendance['att_sts']) AND strtolower($fetchCountAttendance['att_sts'])=="vacation"){
								$vacation++;
							}
							if(!empty($fetchCountAttendance['att_sts']) AND strtolower($fetchCountAttendance['att_sts'])=="medical leave"){
								$medical_leave++;
							}
							if(!empty($fetchCountAttendance['att_sts']) AND strtolower($fetchCountAttendance['att_sts'])=="annual leave"){
								$annual_leave++;
							}
					}
				}
				$data_array=$b=[];
				$data_array=array("ID#: ".$r['user_id']."\n".$r['user_fullname'],$in_time_count,$late,$hour_shift,$leave_count,$sick_leave,$vacation,$medical_leave,$annual_leave);
				foreach ($date_range as $dr){  
				// @$month=date('Y-m',strtotime(($_REQUEST['month'])));
				$dated=$dr;
				$week=(!empty($dr))?date('w',strtotime($dr)):date('w',strtotime($dr));
				$query=mysqli_query($dbc,"SELECT * FROM emp_attendance WHERE att_date='$dated' AND emp_id='$r[user_id]'");
				$getAttendance = mysqli_num_rows($query);
				$fetchAttendance=mysqli_fetch_assoc($query);
					
				if($week==0 AND $getAttendance==0){
					$data= "x";
				}else{
					if ($getAttendance==0){
						$data= "-";
					}else{
						if((($start_time-$open_time)/60)>$minute_allowed){
								$d = "LATE";
							}else{
								$d = strtoupper($fetchAttendance['att_sts']);
							}
						
						if(!empty($fetchAttendance['in_time'])){

						 $in= date('h:i A',strtotime($fetchAttendance['in_time']));
						}else{
							$in="";
						}
						if(!empty($fetchAttendance['out_time']) AND $fetchAttendance['out_time']!="" AND $fetchAttendance['out_time']!="00:00"){
							$out= date('h:i A',strtotime($fetchAttendance['out_time']));
						}else{
							$out="";
						}
						if(!empty($fetchAttendance['break_start'])){

						 $break_start= date('h:i A',strtotime($fetchAttendance['break_start']));
						}else{
							$break_start="";
						}

						if(!empty($fetchAttendance['break_end'])){

						 $break_end= date('h:i A',strtotime($fetchAttendance['break_end']));
						}else{
							$break_end="";
						}
						//	@$data=$d."\nIn Time: ".$in."\nOut Time: ".$out."\nBreak Start: ".$break_start."\nBreak End: ".$break_end."\nProject Name: ".$project_name."\nWork Address Name: ".$address."\nLocation: ".$location;
						
								@$data=$d."\nIn Time: ".$in."\nOut Time: ".$out."\nProject Name: ".$project_name."\nWork Address Name: ".$address."\nLocation: ".$location;
					}
				}
				array_push($data_array,$data);
				}//for loop
				$output[]=$data_array;
				unset($data_array);
			$late=$sick_leave=$vacation=$medical_leave=$annual_leave =$in_time_count=$hour_shift=$leave_count=0;
			}//while loop


        header("Content-Type: application/csv");
        $csv_filename = 'Attendance_Report_'.date('l-M-d-Y-h:i:s A').'.csv';
        header('Content-Disposition:attachment;filename='.$csv_filename);
        
        ob_flush(); 
        array_csv_download( $output, $csv_filename, $delimiter=";" );
			// print_r($output);

	}

	/*header('Content-Type: application/xls');
		header('Content-Disposition:attachment;filename='.uniqid().'-'.date('Y-m-d h:i:s A').'.xls'); */

		?>