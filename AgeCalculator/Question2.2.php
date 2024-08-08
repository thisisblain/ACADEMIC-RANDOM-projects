<!DOCTYPE html>
<html>

<head>
    <style type="text/css">
#btnSubmit {width: 100px;
     background-color:#0179fc ; /*blue, basically */
    color: white;
width: 150px;


}
.container {display: flex;
	
}
.dobBoxes{ margin-right: 20px;

}
.monthsBox{margin-right: 20px;

}
#btnSubmit{margin-top: 20px;

}
.output{background-color: #f7f7f7;
	margin-top: 20px;

}

</style>
</head>

<body>

		<h1>Age Calculator</h1>

		<div class="container">
	  
	  <div class="dobBoxes">
		<form action="Question2.2.php" method="post" class="form">
		   
				<select style="width:250px" name="day" class="form-day"> 
				<option value="" disablee selected hidden>Date</option>

				    <?php
					for($i=1;$i<=31;$i++)
					{
					echo "<option value='$i'>$i</option>";
					}

					?>
				 
			    </select>
			    </div>

			    <div class="monthsBox">
				<select style="width:250px" name="month" class="form-control">
				<option value="" disablee selected hidden>Month</option>
					<?php
					for($i=1;$i<=12;$i++)
					{
					echo "<option value='$i'>$i</option>";
					}
					?>
			    </select>
			    </div>

			    <div class="yearsBox">
				<select style="width: 250px" name="year" class="form-control">
				<option value="" disablee selected hidden>Year</option>
				 	<?php $year = date('Y'); ?>
					    <?php
						for($i=1900;$i<=$year;$i++)
						{
						echo "<option value='$i'>$i</option>";
						}
					?>
			    </select>
		        
					
                    </div>
        
					</div>
	       
	      	<input id="btnSubmit" type="submit" name="submit" class="btnSub " value="Click to calculate age">
	      	
	     
	          
		</form> 
	 
	   <div class="output">
	   <?php
		if(isset($_POST['submit'])) {

			$day=$_POST['day'];
			$month=$_POST['month'];
			$year=$_POST['year'];
		 
			$dob=$day.'-'.$month.'-'.$year;

			$bday=new DateTime($dob);
			
			$age=$bday->diff(new DateTime);
			 
			$today=date('Y-m-d'); 
			
			echo '<br />';
			echo '<b>Your Birth date: </b>';
			echo $dob;
			echo '<br>';
			echo '<b>Your Age : </b> ';
			echo $age->y;
			echo ' Years, ';
			echo $age->m;
			echo ' Months, ';
			echo $age->d;
			echo ' Days';
		}
	   ?>
	  

            	
		</form>

</div>
	</div>
</body>





</html>
