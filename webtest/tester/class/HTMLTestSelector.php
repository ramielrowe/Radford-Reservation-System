<?php
class HTMLTestSelector
{
	public function getForm($files)
	{
		$result = "<form id='testSelector' action='' method='post'>";
		$result .= "<p class='listexpander testSelectorControls'><a id='runTests'>Run!</a><a id='selectAll'>Select All</a><a id='selectNone'>Select None</a></p>";
		
		$groupConunter = 0;
		foreach($files as $oneDirectory => $oneCase)
		{
			$directory = $this->getShortDirName($oneDirectory);
			$groupName = "group".$groupConunter;
			$checked = $this->getChecked($groupName);
			
			$result .= "<div class='caseContainer'>";
			$result .= "<h3>";
			$result .= "<input class='groupSelector' type='checkbox' id='$groupName' name='$groupName' $checked />";
			$result .= "<label for='$groupName'>$directory</label>";
			$result .= "</h3>";
			$result .= $this->getCases($oneCase);
			$result .= "</div>";
			
			$groupConunter++;
		}
		
		$result .= "</form>";
		
		return $result;
	}
	
	protected function getChecked($fieldName)
	{
		$result = "";
		
		if(isset($_POST[$fieldName]))
		{
			$result = "checked";
		}
		
		return $result;
	}
	
	public static function getShortDirName($name, $maxLen = 30)
	{
		$name = str_replace("../", "", $name);
		$len = strlen($name);
		
		if($len <= $maxLen)
		{
			return $name;
		}
		
		$result = "...".substr($name, $len - $maxLen, $len);
		
		return $result;
	}
	
	protected function getCases($cases)
	{
		$result = "";
		
		foreach($cases as $oneCase => $path)
		{
			$checked = $this->getChecked($oneCase);
			
			$result .= "<div class='caseSelector'>";
			$result .= "<input type='checkbox' id='$oneCase' name='$oneCase' value='$oneCase' $checked />";
			$result .= "<label for='$oneCase'>$oneCase</label>";
			$result .= "</div>";
		}
		
		return $result;
	}
	
	public static function getRunable()
	{
		$result = array();
		
		if(isset($_POST))
		{
			$result = $_POST;
		}
		
		return $result;
	} 
}