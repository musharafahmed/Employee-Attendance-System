<?php 
	define('DB_NAME', 'lmqrxvmy_attendance');
	define('DB_USER', 'lmqrxvmy_attendance');
	define('DB_PASSWORD', 'developer@cgit.pk');
	define('DB_HOST', 'localhost');
@$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	if(!$dbc){
		echo mysqli_connect_error();
		exit();
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
    ob_flush();
    
    // use exit to get rid of unexpected output afterward
    //exit();
} 
	function fetchRecord($dbc,$table,$fld,$data){
	 	return  mysqli_fetch_assoc(mysqli_query($dbc,"SELECT * FROM $table WHERE $fld='$data'"));
	 	} 
 if(!empty($_REQUEST['action']) AND $_REQUEST['action']=="date_wise"){
				$from = date('Y-m-d',strtotime($_REQUEST['from']));
				$to = date('Y-m-d',strtotime($_REQUEST['to']));
				$para='action=date_wise&from='.$from."&to=".$to;
				$getAttendance=mysqli_query($dbc,"SELECT * FROM emp_attendance
				WHERE att_date BETWEEN '$from' AND '$to'");
			}else{
				$date = date('Y-m-d');
				$para='action=current&date='.$date;
				$getAttendance=mysqli_query($dbc,"SELECT * FROM emp_attendance 
				WHERE att_date LIKE '%$date%' ORDER BY att_add_date DESC");
			}
			$array[]=array("Name", "Dated" ,"In Time", "Out Time","Break Start","Break End","Total Break Time","Overall Time,Location");
			
			while($fetchAttendance=mysqli_fetch_assoc($getAttendance)){
				$fetchUserData = fetchRecord($dbc,"users","user_id",$fetchAttendance['emp_id']);
						$start = strtotime($fetchAttendance['in_time']); 

						$end = strtotime($fetchAttendance['out_time']); 
						$totaltime = ($end - $start)  ; 
						$h = intval($totaltime / 3600);   
						$seconds_remain = ($totaltime - ($h * 3600)); 
						$m = intval($seconds_remain / 60);   
						$s = ($seconds_remain - ($m * 60)); 

						$start_break = strtotime($fetchAttendance['break_start']); 

						$end_break = strtotime($fetchAttendance['break_end']); 
						$totaltime_break = ($end_break - $start_break)  ; 
						$h_break = intval($totaltime_break / 3600);   
						$seconds_remain_break = ($totaltime_break - ($h_break * 3600)); 
						$m_break = intval($seconds_remain_break / 60);   
						$s_break = ($seconds_remain_break - ($m_break * 60)); 
						

					@$in_time=empty($fetchAttendance['in_time'])?"-":date('h:i A',strtotime($fetchAttendance['in_time']));
					$break_start=empty($fetchAttendance['break_start'])?"-":date('h:i A',strtotime($fetchAttendance['break_start']));
					$break_end=empty($fetchAttendance['break_end'])?"-":date('h:i A',strtotime($fetchAttendance['break_end']));
					if(empty($fetchAttendance['out_time'])){
						$total= "Not Checked Out";
					}else{ 
					 $total=$h."h ".$m."m ".$s."s";
					 } 
					 if(empty($fetchAttendance['break_end'])){
						$total_break= "-";
					}else{ 
					 $total_break=$h_break."h ".$m_break."m ".$s_break."s";
					 } 
				 $array[]=array($fetchUserData['user_fullname'], date('l, d-M-Y',strtotime($fetchAttendance['att_add_date'])) ,$in_time, (empty($fetchAttendance['out_time']))?'Not Checked Out':date('h:i A',strtotime($fetchAttendance['out_time'])),$break_start,$break_end,$total_break, $total,$fetchAttendance['location']);
				}
				header("Content-Type: application/csv");
        $file_name = 'Attendance_Report_'.date('l-M-d-Y-h:i:s A').'.csv';
        header('Content-Disposition:attachment;filename='.$csv_filename);

				// $file_name=uniqid().'-'.date('Y-m-d h:i:s A').'.csv';
        @ob_flush();
				array_csv_download( $array, $file_name , $delimiter=";" );
  ?>