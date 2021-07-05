<?php
	class Average {
		
		private $avg;
		private $time;
		
		
		function __construct($a, $t) {
			
			$this->avg = $a;
			$this->time = $t;
					
		}
		
		function printAverage() {
			echo "<td> " . $this->avg . "%</td>";
			echo "<td> " . $this->time . "</td>";
			
			
		}
		
		
		
		function getAverage() {
			return $this->avg;
		}
		
		
	}
?>