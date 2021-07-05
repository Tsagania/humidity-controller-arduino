<?php
	class Data {
		
		private $value;
		private $time;
		
		
		function __construct($v, $t) {
			
			$this->value = $v;
			$this->time = $t;
					
		}
		
		function printInTR() {
			echo "<td> " . $this->value . "%</td>";
			echo "<td> " . $this->time . "</td>";
			
			
		}
		
		
		
		function getValue() {
			return $this->value;
		}
		
		
	}
?>