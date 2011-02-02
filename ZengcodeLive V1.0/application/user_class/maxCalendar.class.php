<?php
class maxCalendar{
    function showCalendar($year=0,$month=0){
     $str = '';
    // Get today, reference day, first day and last day info
    if (($year == 0) || ($month == 0)){
       $referenceDay    = getdate();
    } else {
       $referenceDay    = getdate(mktime(0,0,0,$month,1,$year));
    }
    $firstDay = getdate(mktime(0,0,0,$referenceDay['mon'],1,$referenceDay['year']));
	$lastDay  = getdate(mktime(0,0,0,$referenceDay['mon']+1,0,$referenceDay['year']));
	$today    = getdate();
    
	
	// Create a table with the necessary header informations
	$str .=  '<table class="month">';
	$str .=  '  <tr><th colspan="7">'.$referenceDay['month']." - ".$referenceDay['year']."</th></tr>";
	$str .=  '  <tr class="days"><td>Mo</td><td>Tu</td><td>We</td><td>Th</td><td>Fr</td><td>Sa</td><td>Su</td></tr>';
	
	
	// Display the first calendar row with correct positioning
	$str .=  '<tr>';
	if ($firstDay['wday'] == 0) $firstDay['wday'] = 7;
	for($i=1;$i<$firstDay['wday'];$i++){
		$str .=  '<td>&nbsp;</td>';
	}
	$actday = 0;
	for($i=$firstDay['wday'];$i<=7;$i++){
		$actday++;
		if (($actday == $today['mday']) && ($today['mon'] == $month)) {
			$class = ' class="actday"';
		} else {
			$class = '';
		}
		$str .=  "<td$class>$actday</td>";
	}
	$str .=  '</tr>';
	
	//Get how many complete weeks are in the actual month
	$fullWeeks = floor(($lastDay['mday']-$actday)/7);
	
	for ($i=0;$i<$fullWeeks;$i++){
		$str .=  '<tr>';
		for ($j=0;$j<7;$j++){
			$actday++;
    		if (($actday == $today['mday']) && ($today['mon'] == $month)) {
				$class = ' class="actday"';
			} else {
				$class = '';
			}
			$str .=  "<td$class>$actday</td>";
		}
		$str .=  '</tr>';
	}
	
	//Now display the rest of the month
	if ($actday < $lastDay['mday']){
		$str .=  '<tr>';
		
		for ($i=0; $i<7;$i++){
			$actday++;
    		if (($actday == $today['mday']) && ($today['mon'] == $month)) {
				$class = ' class="actday"';
			} else {
				$class = '';
			}
			
			if ($actday <= $lastDay['mday']){
				$str .=  "<td$class>$actday</td>";
			}
			else {
				$str .=  '<td>&nbsp;</td>';
			}
		}
		
		
		$str .=  '</tr>';
	}
	
	$str .=  '</table>';
	return $str;
}

}
?>