<link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">
<style>

.floatLeft { width: 50%; float: left; }
.floatRight {width: 50%; float: right; }
.container { overflow: hidden; }
caption {font-size:150%; font-weight:bold;}


table {
  font-family: Verdana;
  font-size: 14px;
  border-collapse: collapse;
  width: 600px;
}

td, th {
  padding: 10px;
  text-align: left;
  margin: 0;
}

tbody tr:nth-child(2n){
  background-color: #eee;
}

th {
  position: sticky;
  top: 0;
  background-color: #333;
  color: white;
  font-size:150%; 
  width:150;
}
</style>
<?php
	include "Data.php";
	include "Average.php";
	
	class DataList {
		//Create arrays for values and averages
		var $values = array();
		var $averages = array();
		
		
		function loadFromDB () {
			// Connection to database
			$link = mysqli_connect("localhost","root", "", "myarduinodb");				
			// Check if the connection is established correctlly
			if (mysqli_connect_errno()) {
				echo "<h1 style='color: red'> Connection error </h1>";
				exit;
			}
			$sql1 = "select * from arduino";
			// Testing statement for checking the syntax of the query: 
			// echo $sql;
			$results1 = mysqli_query($link, $sql1);
			while ($row = mysqli_fetch_assoc($results1)) {	
				// Get the values for each measurement
				$value = $row['value'];
				$time = $row['time1'];
				
				// Create an object of type Data, based on the previous values
				$d = new Data($value, $time);
				// Add the object Data in the array stored as an attribute
				$this->values[count($this->values)] = $d;
			}
			$sql2 = "select * from average";
			// Testing statement for checking the syntax of the query: 
			// echo $sql;
			$results2 = mysqli_query($link, $sql2);
			while ($row = mysqli_fetch_assoc($results2)) {	
				// Get the averages for each day
				$average = $row['average'];
				$day = $row['day'];
				
				// Create an object of type Average, based on the previous values
				$a = new Average($average, $day);
				// Add the object Data in the array stored as an attribute
				$this->averages[count($this->averages)] = $a;
			}
		}
		//
		function getResults () {
			echo "<div class='container'>";
			echo "<div class='floatLeft'>";
			echo "<table border ='1'>
			        <caption>Available Values</caption>
					<tr valign='center' height='30px'>
						<th> Drought Level </th>
						<th> Time </th>
						
					</tr>";
			for ($i=0; $i<count($this->values); $i++) {
				echo "<tr valign='center' height='30px'>";
				$this->values[$i]->printInTR();
				echo "</tr>";
			}
			echo "</table>";
			echo "</div>";
			echo "<div class='floatRight'>";
			echo "<table border ='1' >
			        <caption>Available Averages</caption>
					<tr valign='center' height='30px'>
						<th> Average</th>
						<th>Day</th>
						
					</tr>";
			for ($i=0; $i<count($this->averages); $i++) {
				echo "<tr valign='center' height='30px'>";
				$this->averages[$i]->printAverage();
				echo "</tr>";
			}
			echo "</table>";
			echo "</div>";
			echo "</div>";
			//echo "<h2> Average Value: " . $this->getAverage() . " </h2>";
		}
		
		
		
		/*
		function getAverage() {
			$total = 0;
			for ($i=0; $i<count($this->values); $i++) {
				$total = ($total + $this->values[$i]->getValue());
				$average = $total/count($this->values);	
			}
			return $average;	
		} 
		*/
		
		
		
		

		
	}
?>