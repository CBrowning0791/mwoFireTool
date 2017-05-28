<html>
 <head>
  <title>MWO Skill Landing Page</title>
 </head>
 <body>
 	<?php
 	$GLOBALS['inEngineHSCooling'] = 2.0; 				//current in heat sink cooling for a double heat sink is .2 and there are 10 heatsinks in MOST engines
 	$GLOBALS['outEngineHSCooling'] = .15;				//current out of enigne heat sink cooling for adouble heat sink is .15
 	$GLOBALS['dHSCapOutOfEngine'] = 1.5;				//current heat capcity bonus for a double heat outside of the engine is 1.5
 	$GLOBALS['dhsCapInEngine'] = 20.0;					//current heat capaity for double heat sinks inside of an engine is 2.0 and there are ten of them in most engines
 	$GLOBALS['currentHeatCapPerNode'] = .03;			//current bonus per heat capacity node is 3%
 	$GLOBALS['currentHeatGenPerNode'] = .0075;			//current bonus per heat gen node is .75%
 	$GLOBALS['currentCoolDownPerNode'] = .0075;			//current bonus per cool down node is .75%
 	
 	if(isset($_POST['act']))
 	{
 		$heatCapacity = 0.0;
 		$heatGeneration = 0.0;
 		$coolDownBonus = 0.0; 
 		$heatGenerated = 0.0;
 		$fireCount = 1;
 		$timeInterval = 0;
 		$heatValue = 0;
 		$heatValue = $_POST["givenHeatValue"];	//Grabbing heat value given by user
 		$timeInterval = $_POST["givenTimeInterval"]; //Grabbint Time interval given by user
 		$heatCapacity = 30 + $dhsCapInEngine + $dHSCapOutOfEngine * $_POST["heatSinkCount"]  + ((($dhsCapInEngine + $dHSCapOutOfEngine) * $_POST["heatSinkCount"]) * $currentHeatCapPerNode); //Calculates heat capacity 
 		$heatGeneration = $_POST["heatGenNodes"] * $currentHeatGenPerNode; //calculating heat generation bonus
 		$coolDownBonus = $_POST["CoolDownNodes"] * $currentCoolDownPerNode; //calculating cool down bonus
 		do //This loop runs to calculate the number of times the user can fire, if it hits 100 times or more it assumes you can fire forever.
 		{
 			$heatGenerated = $heatGenerated + ($heatValue - ($timeInterval * $inEngineHSCooling) - ($timeInterval * $outEngineHSCooling)-($timeInterval * $inEngineHSCooling * $coolDownBonus) - ($timeInterval * $outEngineHSCooling * $coolDownBonus));
 			$fireCount++;

 		} while ($heatCapacity >= $heatGenerated && $fireCount < 100);
 		echo "You have selected: ", $_POST["heatSinkCount"], " heatsinks.";
 		echo '<br>';
 		echo "You have selected: ", $_POST["heatGenNodes"], " heat generation nodes.";
 		echo '<br>';
 		echo "You have selected: ", $_POST["heatCapNodes"], " heat containment nodes.";
 		echo '<br>';
 		echo "You have selected: ", $coolDownBonus / $currentHeatCapPerNode, " cooldown nodes.";
 		echo '<br>';
 		echo "You currently have a heat capacity of: ",  $heatCapacity, ".";
 		echo '<br>';
 		echo "Your current amount of heat generation bonus is: ", $heatGeneration, "%";
 		echo '<br>';
 		echo "Your current cooldown bonus is: ", $coolDownBonus, "%";
 		echo '<br>';
 		if($fireCount == 100) //Checks for the indefinate fire
 		{
 			echo "That means you can alpha ", $fireCount, " times.";	
 		}
 		else
 		{
 			echo "That means you can alpha indefinatly";	
 		}
 	}

 	?>
 	<br>
 	<br>
 	<form action= "mwoLandingPage.php" method = "post">
 		Heat Generated:<br>
 		<input type = "number" name = "givenHeatValue" value = "0" step = "0.10" min = "0"><br>
 		Time Interval:<br>
 		<input type="number" name="givenTimeInterval" value = "0" step = "0.01" min = "0"><br>
 		Heat Sinks:<br>
 		<input type = "number" name = "heatSinkCount" value = "0" step = "1" min = "0"><br>
 		Number of Heat Generation Nodes (.75% per): 
 		<input type = "radio" name = "heatGenNodes" value ="0" checked = "checked"> 0
 		<input type = "radio" name = "heatGenNodes" value = "1"> 1 
 		<input type = "radio" name = "heatGenNodes" value = "2"> 2 
 		<input type = "radio" name = "heatGenNodes" value = "3"> 3 
 		<input type = "radio" name = "heatGenNodes" value = "4"> 4 
 		<input type = "radio" name = "heatGenNodes" value = "5"> 5 
 		<input type = "radio" name = "heatGenNodes" value = "6"> 6 
 		<input type = "radio" name = "heatGenNodes" value = "7"> 7 
 		<input type = "radio" name = "heatGenNodes" value = "8"> 8 
 		<input type = "radio" name = "heatGenNodes" value = "9"> 9 
 		<input type = "radio" name = "heatGenNodes" value = "10"> 10 
 		<input type = "radio" name = "heatGenNodes" value = "11"> 11 
 		<input type = "radio" name = "heatGenNodes" value = "12"> 12 
 		<input type = "radio" name = "heatGenNodes" value = "13"> 13 <br> 
 		Number of Heat Containtment Nodes Nodes (3% per):
 		<input type = "radio" name = "heatCapNodes" value = "0" checked = "checked"> 0
 		<input type = "radio" name = "heatCapNodes" value = "1"> 1 
 		<input type = "radio" name = "heatCapNodes" value = "2"> 2 
 		<input type = "radio" name = "heatCapNodes" value = "3"> 3 
 		<input type = "radio" name = "heatCapNodes" value = "4"> 4 
 		<input type = "radio" name = "heatCapNodes" value = "5"> 5 <br>
 		Number of Cooldown Nodes (.75% per):
 		<input type = "radio" name = "CoolDownNodes" value = "0" checked = "checked"> 0 
 		<input type = "radio" name = "CoolDownNodes" value = "1"> 1 
 		<input type = "radio" name = "CoolDownNodes" value = "2"> 2 
 		<input type = "radio" name = "CoolDownNodes" value = "3"> 3 
 		<input type = "radio" name = "CoolDownNodes" value = "4"> 4 
 		<input type = "radio" name = "CoolDownNodes" value = "5"> 5 
 		<input type = "radio" name = "CoolDownNodes" value = "6"> 6 
 		<input type = "radio" name = "CoolDownNodes" value = "7"> 7 S
 		<input type = "radio" name = "CoolDownNodes" value = "8"> 8 
 		<input type = "radio" name = "CoolDownNodes" value = "9"> 9 
 		<input type = "radio" name = "CoolDownNodes" value = "10"> 10 
 		<input type = "radio" name = "CoolDownNodes" value = "11"> 11
 		<input type = "radio" name = "CoolDownNodes" value = "12"> 12
 		<input type = "radio" name = "CoolDownNodes" value = "13"> 13
 		<input type = "radio" name = "CoolDownNodes" value = "14"> 14
 		<input type = "radio" name = "CoolDownNodes" value = "15"> 15
 		<input type = "radio" name = "CoolDownNodes" value = "16"> 16 <br>
 		<input type="hidden" name="act" value="run">
 		<input type="submit">
 	</form>
 	

  </body>
</html>