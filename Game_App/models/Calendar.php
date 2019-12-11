<?php

	class Calendar {

		public function __construct(){


		}

		private $dayLabels = array("Sun","Mon","Tue","Wed","Thu","Fri","Sat");
		private $timeLabels = array("7:00", "8:00", "9:00", "10:00", "11:00", "12:00", "1:00", "2:00", "3:00", "4:00", "5:00", "6:00", "7:00", "8:00", "9:00", "10:00", "11:00", "12:00");
		private $datesOfTheWeek = array();
	    private $currentYear = 0;
	    private $currentMonth = 0;
	    private $currentDay = 0; 
	    private $currentDate = 0;	     
	    private $daysInMonth = 0;
	    private $firstOfMonth = 0;

	    private $year = 0;
	    private $month = 0;
	    private $date = 0;          	    	  

	    public function displayWeekCalendar($events, $admin){

	    	//See above functions
	    	$this->year = $this->getYear();
	    	$this->month = $this->getMonth();
	    	$this->date = $this->getDate();

	        $this->currentYear=$this->year;
	        $this->currentMonth=$this->month;
	        $this->daysInMonth=$this->findDaysInMonth($this->year, $this->month);
	        $this->firstOfMonth = $this->findFirstDay($this->year, $this->month);

	        $weeksInMonth = $this->weeksInMonth($this->year,$this->month);
	        $message = "'Are you sure you want to delete this booking?'";
	        $dayOfWeek = $this->GetDayOfWeek($this->date, $this->month, $this->year);
	    	$this->GetDatesOfWeek($dayOfWeek);

	    	//Handles the events
	        $Calendar = array(array(), array(), array(), array(), array(), array());
	        for($m = 0; $m <= count($this->timeLabels)-1; $m++){
				for($n = 0; $n <= 7; $n++){
					$Calendar[$m][$n] = "";
				}
			}

			foreach($events as $event){

				for($d = 0; $d < count($this->datesOfTheWeek); $d++){
					
					
					
					if($event['reservedDate'] == date('Y-m-d', strtotime($this->datesOfTheWeek[$d]))){	

				
						if(!is_array($Calendar[$this->SetTime(date('G', strtotime($event['starttime'])))][$this->GetDayOfWeek( date('d', strtotime($event['reservedDate'])), date('m', strtotime($event['reservedDate'])), date('Y', strtotime($event['reservedDate'])))])){



							$Calendar[$this->SetTime(date('G', strtotime($event['starttime'])))][$this->GetDayOfWeek( date('d', strtotime($event['reservedDate'])), date('m', strtotime($event['reservedDate'])), date('Y', strtotime($event['reservedDate'])))] = array();
						}
						array_push($Calendar[$this->SetTime(date('G', strtotime($event['starttime'])))][$this->GetDayOfWeek( date('d', strtotime($event['reservedDate'])), date('m', strtotime($event['reservedDate'])), date('Y', strtotime($event['reservedDate'])))], $event);

						if(date('G', strtotime($event['endtime'])) > 7){


							if(!is_array($Calendar[$this->SetTime(date('G', strtotime($event['endtime'])))][$this->GetDayOfWeek( date('d', strtotime($event['reservedDate'])), date('m', strtotime($event['reservedDate'])), date('Y', strtotime($event['reservedDate'])))])){

								$Calendar[$this->SetTime(date('G', strtotime($event['endtime'])))][$this->GetDayOfWeek( date('d', strtotime($event['reservedDate'])), date('m', strtotime($event['reservedDate'])), date('Y', strtotime($event['reservedDate'])))] = array();
							}
							array_push($Calendar[$this->SetTime(date('G', strtotime($event['endtime'])))][$this->GetDayOfWeek( date('d', strtotime($event['reservedDate'])), date('m', strtotime($event['reservedDate'])), date('Y', strtotime($event['reservedDate'])))], $event);

							$hours =  date('G', strtotime($event['endtime'])) - date('G', strtotime($event['starttime'])) - 1;

							for($h = 1; $h <= $hours; $h++){
								$time = date('G', strtotime($event['starttime'])) + $h;

								if(!is_array($Calendar[$this->SetTime($time)][$this->GetDayOfWeek( date('d', strtotime($event['reservedDate'])), date('m', strtotime($event['reservedDate'])), date('Y', strtotime($event['reservedDate'])))])){

									$Calendar[$this->SetTime($time)][$this->GetDayOfWeek( date('d', strtotime($event['reservedDate'])), date('m', strtotime($event['reservedDate'])), date('Y', strtotime($event['reservedDate'])))] = array();
								}
								array_push($Calendar[$this->SetTime($time)][$this->GetDayOfWeek( date('d', strtotime($event['reservedDate'])), date('m', strtotime($event['reservedDate'])), date('Y', strtotime($event['reservedDate'])))], $event);
							}
						}

					}


				}

			}

			//Create the table
	        $calendarContent = '<table id="weekCalendar" class="striped">'.
        							'<tr>'.
	        							'<td colspan="8">' . $this->createWeekNavigation($weeksInMonth)/*Top bar with buttons*/  . '</td>'.
	        						'</tr>'.
	        						'<tr>'.
	        							'<th>Time</th>'.
	        							$this->createWeekDayBar()/*Top bar with days*/ .
	        						'</tr>';
	        						for($i = 0; $i <= count($this->timeLabels)-1; $i++){

	        							$calendarContent .= '<tr>';

	        								for($j = 0; $j <= 7; $j++){

	        									if($j==0){
	        										//The sidebar with the times if more times needed increase this the i loops number and add time to array called timeLabels
	        										$calendarContent.='<td>' . $this->timeLabels[$i] . '</td>';
	        									}
	        									else if(($j == $this->GetDayOfWeek(date('j', time()), date('n', time()), date('Y', time()))+1) && $this->date == date('j', time())){
	        										//if it is today use today class
	        										$calendarContent.='<td class="today eventItem">';
	        									}
	        									else{
	        										$calendarContent.='<td class="eventItem">';
	        									}

	        									if($j != 0){
	        										if(is_array($Calendar[$i][$j-1])){
		        										foreach($Calendar[$i][$j-1] as $event){

		        											//Sets the event to the rooms color
		        											$calendarContent .= '<div class="' . $event['color'] . '">';
		        											$calendarContent .= '<div class="active';		        											
		        											$calendarContent .= '" id="' . $event['id'] . '">';
		        											$calendarContent .= '<button class="active" ';

		        											if($admin){
		        												$calendarContent .= ' onclick="revealDetails('. $event['id'] .')"';
		        											}


		        											$calendarContent .= '><p>' . $event['groupname'] . '</p></button></div></div>';
		        											$calendarContent .= '<div class="inactive" id="' . $event['id'] .'Details">
																					<div class="activeCard">
																						<div class="container">
												<h4><button  onclick="hideDetails('. $event['id'] .')">Close</button></h4>';
	$calendarContent .= '
			<form action="index.php" method="post">
				<input type="hidden" name="groupId" value="' . $event['id'] . '">
				<button class="btn waves-effect waves-light logsubmit blue" type="submit" name="action" value="editRequestForm">Edit Reservation</button>
				<button class="btn waves-effect waves-light logsubmit blue" type="submit" name="action" value="deleteRequest" onclick="return confirm('. $message .');">Delete Reservation</button>
			</form>';
																							
																						$calendarContent .= '</div> 
																					</div>';
																					
																				$calendarContent .= '</div>';
		        										}
		        									}
	        									}

	        									$calendarContent .= '</td>';

	        								}

	        							$calendarContent .= '</tr>';
	        						}      

	        					$calendarContent .= '</table>';



	        return $calendarContent;

	    }
	  
	    private function createWeekNavigation($weeksInMonth){

	  		$headerContent = "";

	  		$nextMonth = $this->currentMonth==12?1:intval($this->currentMonth)+1;
	        $nextYear = $this->currentMonth==12?intval($this->currentYear)+1:$this->currentYear;	 
	        $nextDate = $this->date . "-" . $this->month . '-' . $this->year . " +7 days";        
	        $previousMonth = $this->currentMonth==1?12:intval($this->currentMonth)-1;	         
	        $previousYear = $this->currentMonth==1?intval($this->currentYear)-1:$this->currentYear;
	        $previousDate = $this->date . "-" . $this->month . '-' . $this->year . " -7 days";

	        $headerContent .= '<div class="calendarNavBox">';
		        $headerContent .= '<a href="./?action=weekView&Year=' . date('Y', strtotime($previousDate)) . '&month=' . date('n', strtotime($previousDate)) . '&date=' . date('j', strtotime($previousDate)) . '" class="testLink">Previous</a>';
		        $headerContent .= "<div class='centerAlign' >" . date('M Y',strtotime($this->currentYear.'-'.$this->currentMonth.'-1'));
		        $headerContent .= ' | <a  href="./?action=weekView" class="testLink">Today</a></div>';
		       	$headerContent .= '<a href="./?action=weekView&Year=' . date('Y', strtotime($nextDate)) . '&month=' . date('n', strtotime($nextDate)) . '&date=' . date('j', strtotime($nextDate)) . '" class="testLink rightAlign">Next</a>';
		    $headerContent .= '</div>';

	  		return $headerContent;

	    }

	    private function createWeekDayBar(){

	    	$dayBar = "";
	    	for($u = 0; $u < count($this->datesOfTheWeek); $u++){

	    		if(($u == $this->GetDayOfWeek(date('j', time()), date('n', time()), date('Y', time()))) && $this->date == date('j', time())){
					$dayBar .= '<th class="today">';
	    		}
	    		else{
	    			$dayBar .= '<th>';
	    		}
	    	
		    		$dayBar .= $this->dayLabels[$u] . ' ';
		    		$dayBar .= date('j', strtotime($this->datesOfTheWeek[$u]));
		    	
    			$dayBar .=  '</th>';

	    	}
	    
	    	return $dayBar;

	    }

	    private function weeksInMonth($year, $month){

	    	$daysInMonths=$this->findDaysInMonth($year, $month);

	        $numOfweeks = ($daysInMonths%7==0?0:1) + intval($daysInMonths/7);
	         
	        $monthEndingDay= date('N',strtotime($year.'-'.$month.'-'.$daysInMonths));
	         	         
	        if($monthEndingDay<$this->firstOfMonth && $this->firstOfMonth != 7){
	             
	            $numOfweeks++;
	         
	        }
	         
	        return $numOfweeks;

	    }	   

		private function findDaysInMonth($year, $month){

			 return date('t',strtotime($year.'-'.$month.'-01'));

		}

		private function findFirstDay($year, $month){

			return date('N',strtotime($year.'-'.$month.'-01'));

		}

		private function getYear(){

		 	if(isset($_GET['Year'])){
	            $year = $_GET['Year'];     
	        }
	        else{
	            $year = date("Y",time());  
	        }

	        return $year;

		}

		private function getMonth(){

			if(isset($_GET['month'])){
	            $month = $_GET['month'];	         
	        }
	        else{
	            $month = date("m",time());        
	        }

	        return $month;
		}

		private function getDate(){

			if(isset($_GET['date'])){
	            $date = $_GET['date'];	         
	        }
	        else{
	            $date = date("j",time());        
	        }

	        return $date;
		}

		private function getWeek(){

			$week = floor(($this->firstOfMonth + $this->date-1)/7);

			if($this->firstOfMonth != 7){
				$week++;
			}

			return $week;		

		}

		private function adjustLabel($number){

			return $number-$this->daysInMonth;

		}

		private function getDaysInPreviousMonth(){

			if($this->month == 1){
				$days = date('t', strtotime(($this->year-1).'-'.($this->month-1).'-'.$this->date));
			}
			else{
				$days = date('t', strtotime($this->year.'-'.($this->month-1).'-'.$this->date));
			}

			return $days;
		}

		private function SetTime($time){

			$row = 0;


			//Sets row based on time
			switch($time){

				case '07':
					$row = 0;
				break;
				case '08':
					$row = 1;
				break;
				case '09':
					$row = 2;
				break;
				case '10':
					$row = 3;
				break;
				case '11':
					$row = 4;
				break;
				case '12':
					$row = 5;
				break;
				case '13':
					$row = 6;
				break;
				case '14':
					$row = 7;
				break;
				case '15':
					$row = 8;
				break;
				case '16':
					$row = 9;
				break;
				case '17':
					$row = 10;
				break;
				case '18':
					$row = 11;
				break;
				case '19':
					$row = 12;
				break;
				case '20':
					$row = 13;
				break;
			}
			return $row;
		}

		private function GetDayOfWeek($date, $month, $year){

			return date('w', strtotime($year.'-'.$month.'-'.$date));

		}

		private function GetDatesOfWeek($dayOfWeek){
			for($y = 0; $y < 7; $y++){

	    		$number = 0;
	    		$newDate = "";

	    		if($y == $dayOfWeek){
	    			$number = $this->date;
	    			$newDate = $this->year.'-'.$this->month.'-'.$number;
	    		}
	    		else{
	    			switch($y){

	    				case 0:
	    					$number = $this->date - $dayOfWeek;
	    					if($number > $this->daysInMonth){
	    						$number = $this->adjustLabel($number);
	    						if($this->month == 12){
	    							$newDate = ($this->year+1).'-'.(1).'-'.$number;
	    						}
	    						else{
	    							$newDate = $this->year.'-'.$this->month.'-'.$number;
	    						}
	    					}
	    					else if($number < 1){
	    						$number += $this->getDaysInPreviousMonth();
	    						if($this->month == 1){
	    							$newDate = ($this->year-1).'-'.(12).'-'.$number;
	    						}
	    						else{
	    							$newDate = $this->year.'-'.$this->month.'-'.$number;
	    						}
	    					}
	    					else{
	    						$newDate = $this->year.'-'.$this->month.'-'.$number;
	    					}
	    					break;
	    				case 1:
	    					$number = $this->date - $dayOfWeek+1;
	    					if($number > $this->daysInMonth){
	    						$number = $this->adjustLabel($number);
	    						if($this->month == 12){
	    							$newDate = ($this->year+1).'-'.(1).'-'.$number;
	    						}
	    						else{
	    							$newDate = $this->year.'-'.$this->month.'-'.$number;
	    						}
	    					}
	    					else if($number < 1){
	    						$number += $this->getDaysInPreviousMonth();
	    						if($this->month == 1){
	    							$newDate = ($this->year-1).'-'.(12).'-'.$number;
	    						}
	    						else{
	    							$newDate = $this->year.'-'.$this->month.'-'.$number;
	    						}
	    					}
	    					else{
	    						$newDate = $this->year.'-'.$this->month.'-'.$number;
	    					}
	    					break;
	    				case 2:
	    					$number = $this->date - $dayOfWeek+2;
	    					if($number > $this->daysInMonth){
	    						$number = $this->adjustLabel($number);
	    						if($this->month == 12){
	    							$newDate = ($this->year+1).'-'.(1).'-'.$number;
	    						}
	    						else{
	    							$newDate = $this->year.'-'.$this->month.'-'.$number;
	    						}
	    					}
	    					else if($number < 1){
	    						$number += $this->getDaysInPreviousMonth();
	    						if($this->month == 1){
	    							$newDate = ($this->year-1).'-'.(12).'-'.$number;
	    						}
	    						else{
	    							$newDate = $this->year.'-'.$this->month.'-'.$number;
	    						}
	    					}
	    					else{
	    						$newDate = $this->year.'-'.$this->month.'-'.$number;
	    					}
	    					break;
	    				case 3:
	    					$number = $this->date - $dayOfWeek+3;
	    					if($number > $this->daysInMonth){
	    						$number = $this->adjustLabel($number);
	    						if($this->month == 12){
	    							$newDate = ($this->year+1).'-'.(1).'-'.$number;
	    						}
	    						else{
	    							$newDate = $this->year.'-'.$this->month.'-'.$number;
	    						}
	    					}
	    					else if($number < 1){
	    						$number += $this->getDaysInPreviousMonth();
	    						if($this->month == 1){
	    							$newDate = ($this->year-1).'-'.(12).'-'.$number;
	    						}
	    						else{
	    							$newDate = $this->year.'-'.$this->month.'-'.$number;
	    						}
	    					}
	    					else{
	    						$newDate = $this->year.'-'.$this->month.'-'.$number;
	    					}
	    					break;
	    				case 4:
	    					$number = $this->date - $dayOfWeek+4;
	    					if($number > $this->daysInMonth){
	    						$number = $this->adjustLabel($number);
	    						if($this->month == 12){
	    							$newDate = ($this->year+1).'-'.(1).'-'.$number;
	    						}
	    						else{
	    							$newDate = $this->year.'-'.$this->month.'-'.$number;
	    						}
	    					}
	    					else if($number < 1){
	    						$number += $this->getDaysInPreviousMonth();
	    						if($this->month == 1){
	    							$newDate = ($this->year-1).'-'.(12).'-'.$number;
	    						}
	    						else{
	    							$newDate = $this->year.'-'.$this->month.'-'.$number;
	    						}
	    					}
	    					else{
	    						$newDate = $this->year.'-'.$this->month.'-'.$number;
	    					}
	    					break;
	    				case 5:
	    					$number = $this->date - $dayOfWeek+5;
	    					if($number > $this->daysInMonth){
	    						$number = $this->adjustLabel($number);
	    						if($this->month == 12){
	    							$newDate = ($this->year+1).'-'.(1).'-'.$number;
	    						}
	    						else{
	    							$newDate = $this->year.'-'.$this->month.'-'.$number;
	    						}
	    					}
	    					else if($number < 1){
	    						$number += $this->getDaysInPreviousMonth();
	    						if($this->month == 1){
	    							$newDate = ($this->year-1).'-'.(12).'-'.$number;
	    						}
	    						else{
	    							$newDate = $this->year.'-'.$this->month.'-'.$number;
	    						}
	    					}
	    					else{
	    						$newDate = $this->year.'-'.$this->month.'-'.$number;
	    					}
	    					break;
	    				case 6:
	    					$number = $this->date - $dayOfWeek+6;
	    					if($number > $this->daysInMonth){
	    						$number = $this->adjustLabel($number);
	    						if($this->month == 12){
	    							$newDate = ($this->year+1).'-'.(1).'-'.$number;
	    						}
	    						else{
	    							$newDate = $this->year.'-'.$this->month.'-'.$number;
	    						}
	    					}
	    					else if($number < 1){
	    						$number += $this->getDaysInPreviousMonth();
	    						if($this->month == 1){
	    							$newDate = ($this->year-1).'-'.(12).'-'.$number;
	    						}
	    						else{
	    							$newDate = $this->year.'-'.$this->month.'-'.$number;
	    						}
	    					}
	    					else{
	    						$newDate = $this->year.'-'.$this->month.'-'.$number;
	    					}
	    					break;
	    			}
	    		}

	    		array_push($this->datesOfTheWeek, $newDate);

	    	}
		}

	}
?>