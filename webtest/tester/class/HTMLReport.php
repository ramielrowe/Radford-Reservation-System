<?php
class HTMLReport
{	
	public function report(SimpleXMLElement $xml)
	{
		$result = "<hr/><h1>Tests</h1>";
		$overallResult = $this->getOverallFeedback($xml);
		
		global $testRunnerURL;
		
		$img = "";
		if($overallResult == "all_pass")
		{
			$img = "<img src='".$testRunnerURL."/misc/win.gif' title='#win'/>";
		}
		
		if($overallResult == "some_fails")
		{
			$img = "<img src='".$testRunnerURL."misc/fail.gif' title='#fail'/>";
		}
		
		$result .= "<div id='overallFeedback' class='$overallResult'><span>$overallResult</span>$img</div>";
		$result .= $this->printXML($xml);
		
		return $result;
	}
	
	protected function getOverallFeedback($xml)
	{
		$result = "no_feedback";
		if(isset($xml->{"testsuite"}))
		{
			$numberOfTests = (string)$xml->{"testsuite"}['tests'];
			
			if($numberOfTests > 0)
			{
				$result = "all_pass";
			}
			
			if($this->hasFailed($xml->{"testsuite"}))
			{
				$result = "some_fails";
			}
		}
		
		return $result;
	}
	
	protected function clearName($name)
	{
		return HTMLTestSelector::getShortDirName(str_replace("../", "", $name), 25);
	}
	
	protected function printXML(SimpleXMLElement $xml, $output = "")
	{
		$elementId = "";
		if(empty($output))
		{
			$elementId = " class='listexpander'";
		}
		
		if(isset($xml->{"testsuite"}))
		{
			$output .= "<ul $elementId>\n";
			
			foreach($xml->{"testsuite"} as $testSuite)
			{
				$numberOfTests = (string)$testSuite['tests'];
				if($numberOfTests == 0)
				{
					continue;
				}
				
				$output .= "<li class='suite'>\n";
				$output .= "<h2>".$this->clearName((string)$testSuite['name'])."</h2>\n";
				$output .= $this->printSuiteExtraInfo($testSuite);
				$output = $this->printXML($testSuite, $output);
				$output .= "</li>\n";
			}
			$output .= "</ul>\n";
		}
		
		if(isset($xml->{"testcase"}))
		{
			$output .= "<ul>\n";
			foreach($xml->{"testcase"} as $assertion)
			{
				$output .= $this->printAssertion($assertion);
			}
			$output .= "</ul>\n";
		}
		
		return $output;
	}
	
	protected function printAssertion(SimpleXMLElement $assertion)
	{
		$fail = (isset($assertion->{"failure"}));
		$error = (isset($assertion->{"error"}));
		$class = "passed";
		$feedback = "";
		
		if($fail)
		{
			$feedback .= $assertion->{"failure"};
			$class = "failed";
		}
		
		if($error)
		{
			$feedback .= $assertion->{"error"};
			$class = "failed";
		}
		
		$output = "";
		$output .= "<li class='assertion $class'>";
		$output .= "<h3>";
		$output .= (string)$assertion['name'];
		$output .= "</h3>";
		$output .= $this->printAssertionExtraInfo($assertion);
		$output .= "<div class='result$class'>$class</div>";
		
		if(!empty($feedback))
		{
			$feedback = htmlspecialchars($feedback);
			$output .= "<pre>$feedback</pre>";
		}
		
		$output .= "</li>\n";
		
		return $output;
	}
	
	protected function printSuiteExtraInfo(SimpleXMLElement $item)
	{
		$class = "passed";
		
		/*$errors = $item["errors"];
		$failures = $item["failures"];
		
		$failed = (($errors != 0) OR ($failures != 0));
		
		if($failed)
		{
			$class = "failed";
		}*/
		
		if($this->hasFailed($item))
		{
			$class = "failed";
		}
		
		$output = "";
		$output .= "<div class='extraInfo'>";
		$output .= "<span>tests:&nbsp;".(string)$item['tests']."</span>";
		$output .= "<span>time:&nbsp;".(string)$item['time']."s</span>";
		$output .= "<span>assertions:&nbsp;".(string)$item['assertions']."</span>";
		$output .= "</div>";
		$output .= "<div class='result$class'>$class</div>";
		
		return $output;
	}
	
	protected function hasFailed(SimpleXMLElement $item)
	{
		$result = false;
		$errors = $item["errors"];
		$failures = $item["failures"];
		
		$failed = (($errors != 0) OR ($failures != 0));
		
		if($failed)
		{
			$result = true;
		}
		
		return $result;
	}
	
	protected function printAssertionExtraInfo(SimpleXMLElement $item)
	{
		$output = "";
		$output .= "<div class='extraInfo'>";
		$output .= "<span>time:&nbsp;".(string)$item['time']."s</span>";
		$output .= "<span>assertions:&nbsp;".(string)$item['assertions']."</span>";
		$output .= "</div>";
		
		return $output;
	}
}