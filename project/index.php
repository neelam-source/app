<style>
table.calendar		{ border-left:1px solid #999; }
tr.calendar-row	{  }
td.calendar-day	{ min-height:80px; font-size:11px; position:relative; } * html div.calendar-day { height:80px; }
td.calendar-day:hover	{ background:#eceff5; }
td.calendar-day-np	{ background:#eee; min-height:180px; } * html div.calendar-day-np { height:80px; }
td.calendar-day-head { background:#ccc; font-weight:bold; text-align:center; width:120px; padding:5px; border-bottom:1px solid #999; border-top:1px solid #999; border-right:1px solid #999; }
/* div.day-number		{ background:#999; padding:5px; color:s#fff; font-weight:bold; float:right; margin:-5px -5px 0 0; width:20px; text-align:center; } */
/* button.Nextbutton	{
     align-items: left;
     width:50px;
     font-weight:bold;
     } */

/* shared */
td.calendar-day, td.calendar-day-np { width:100px; padding:5px; border-bottom:1px solid #999; border-right:px solid #999; }
</style>
<script>
function savetask(){
    // const d = new Date();
    // alert(d);
    //  var day = d.getDay();
    // alert(day);

    var task=$("#task").val();
    var sd=$("#startingdate").val();
    var ed=$("#enddate").val();
       alert(task);
    // alert(sd);
    // alert(ed);
    var input = document.getElementById( 'startingdate' ).value;
   var strdate = new Date( input );
    // alert(strdate);
    if ( !!strdate.valueOf() ) {
    day = strdate.getDate()+1;
    alert(day);
   }
    //end date day
    var enddate = new Date( ed );
    // alert(enddate);
    if ( !!enddate.valueOf() ) {
    endday = enddate.getDate()+1;
    alert(endday);
  }   
  document.getElementById("emptytd").innerHTML += 
              "";
    // const edate = document.getElementById('enddate');
    // console.log('endDate value: ', edate.value);
}
// function nextmonth(){
// alert('nextmonth');
// }
</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>draw_calendar</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script async src="https://docs.opencv.org/master/opencv.js" type="text/javascript"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<?php
/* draws a calendar */
function draw_calendar($month,$year){
	/* draw table */
	$calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';
    //button
	$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">
    <button id=taskbutton data-toggle="modal" data-target="#exampleModal">Task</button></td>
    <td class="calendar-day-head">
    <button id=nextbutton data-toggle="modal" onclick="nextmonth()">Next</button></td></tr>';
	/* table headings */
	$headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));

	$july = date('M-d-Y',mktime(0,0,0,$month,21,$year));
    echo $july;echo '<br>';

    // echo $running_day; //5
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
    // echo $days_in_month;
	$days_in_this_week = 1;
	$day_counter = 1;
	$dates_array = array();

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np" id="emptytd"> </td>';
		$days_in_this_week++;
	endfor;


	/* showing month days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		$calendar.= '<td class="calendar-day" >';
			/* add day number */
			$calendar.= '<div class="day-number">'.$list_day.'</div>';
			/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
			$calendar.= str_repeat('<p> </p>',2);
	       $calendar.= '</td>';
		 if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	/* finish the rest of the days in the week */
	if($days_in_this_week <=7):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np"> </td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';

	/* end the table */
	$calendar.= '</table>';
	
	/* all done, return result */
	return $calendar;
}

/* sample usages */
// echo '<h2>July 2022</h2>';
echo draw_calendar(7,2022);

//  function nextm(){
//  echo 'hii';
//  echo '<table border="2">';
//   echo '<tr>';
//   echo  '<td></td>';
//   echo  '</tr>';
//  echo '</table>';
 
// }
?>
<form id="calendarform">
<!-- Modal -->
<div class="modal" id="exampleModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><b>Modal title</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <b>Task:</b><input type="text" id="task" name="task" placeholder="enter Task here" required><br><br>
        <b>Starting Date:</b><input type="date" id="startingdate" name="startingdate" placeholder="enter startng date" required><br><br>
        <b>End Date:</b><input type="date" id="enddate" name="enddate" placeholder="enter End date" required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="savetask()">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
</form>
</body>
</html>
