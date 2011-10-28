<?php

/*

Radford Reservation System
Author: Andrew Melton

Filename: /lib/html_functions.php

Purpose: 
	This file contains all functions for generating html.
	
Known Bugs/Fixes:

	None
	
*/

function getEquipmentTypesDropDown($name, $size){

	return getEquipmentTypesDropDownSelected($name, $size, null);

}

function getEquipmentTypesDropDownSelected($name, $size, $selectedvalue){

	$types = getConfigVar("equipment_types");
	
	$options = "";
	
	foreach($types as $type){
	
		if($selectedvalue == $type){
			$options = $options . "<option value=\"".$type."\" selected=\"selected\">".$type."</option>";
		}else{
			$options = $options . "<option value=\"".$type."\">".$type."</option>";
		}
	
	}
	
	$dropdown = "<select name=\"".$name."\" size=\"".$size."\">".$options."</select>";
	
	return $dropdown;

}

?>