<?php

if(isset($_GET['loginoption'])){

	$loginoption = $_GET['loginoption'];

}
else{

	$loginoption= "login";

}

$loginpage = "";
$errormessage = "";

if($loginoption == RES_ERROR_LOGIN_NO_USER){

	$errormessage = "No such student id<br><br>";

}
else if($loginoption == RES_ERROR_LOGIN_USER_PASS){

	$errormessage = "Incorrect student id or password<br><br>";

}

$url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

$loginpage = $loginpage . "
	
		<center><h3>Welcome!</h3>
		<font color=\"#FF0000\">".$errormessage."</font></center>
	
		<form action=\"./processlogin.php\" method=\"POST\" name=\"loginform\">
		<input type=\"hidden\" name=\"redir\" value=\"$url\">
			<table class=\"login\">
				<tr>
					<td colspan=2 class=\"header\">User Login</td>
				</tr>
				<tr>
					<td class=\"centeredcellbold\">Student ID</td>
					<td class=\"centeredcell\"><input type=\"text\" name=\"id\"></td>
				</tr>
				<tr>
					<td class=\"centeredcellbold\">Password</td>
					<td class=\"centeredcell\"><input type=\"password\" name=\"pass\"></td>
				</tr>
				<tr>
					<td colspan=2 class=\"centeredcellbold\"><input type=\"submit\" value=\"Login\"></td>
				</tr>
			</table>
		
		</form>
		<center><h3>Pickup/Dropoff Times</h3></center>
		<table class=\"pickuptimes\">
			<tr>
				<td class=\"header\">Monday</td>
				<td class=\"header\">Tuesday</td>
				<td class=\"header\">Wednesday</td>
				<td class=\"header\">Thursday</td>
				<td class=\"header\">Friday</td>
			</tr>
			<tr>
				<td class=\"centeredcellbold\">10am-12pm</td>
				<td class=\"centeredcellbold\">10am-12pm</td>
				<td class=\"centeredcellbold\">9am-12pm</td>
				<td class=\"centeredcellbold\">11am-12pm</td>
				<td class=\"centeredcellbold\">10am-12pm</td>
			</tr>
			<tr>
				<td class=\"centeredcellbold\">-</td>
				<td class=\"centeredcellbold\">1pm-2pm</td>
				<td class=\"centeredcellbold\">2pm-4pm</td>
				<td class=\"centeredcellbold\">1pm-2pm</td>
				<td class=\"centeredcellbold\">-</td>
			</tr>
			<tr>
				<td class=\"centeredcellbold\">-</td>
				<td class=\"centeredcellbold\">3pm-4pm</td>
				<td class=\"centeredcellbold\">-</td>
				<td class=\"centeredcellbold\">3pm-4pm</td>
				<td class=\"centeredcellbold\">-</td>
			</tr>

		</table>
	
	</center>

";

echo $loginpage;

?>