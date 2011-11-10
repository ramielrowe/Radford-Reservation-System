<?php
class CodeCoverageReport
{
	public function report($CodeCoverage)
	{
		$summary = $CodeCoverage->getSummary();
		$result = "<ul class='listexpander'>\n<li><h2>Files</h2><ul>";
		
		$totalCoverage = 0;
		$totalFiles = 0;
		foreach($summary as $file => $report)
		{
			$coverage = $this->getCoverage($file, $report);
			$percent = $coverage["percent"];
			$class = $this->getResultDescription($percent);
			
			$result .= "<li>\n";
			$result .= "<h3>$file</h3>\n";
			$result .= "<div class='result$class'>$percent%</div>\n";
			$result .= $coverage["contents"];
			$result .= "</li>\n";
			
			$totalFiles++;
			$totalCoverage += $percent;
		}
		
		$result .= "</ul></li></ul><hr/>\n";
		
		if($totalFiles > 0)
		{
			$totalCoverage = number_format(($totalCoverage/$totalFiles), 0);
		}
		
		$result = $this->getCaption($totalCoverage).$result;
		
		return $result;
	}
	
	protected function getCaption($coverage)
	{
		$result = "<hr/><div class='coverageCaption'>\n";
		$result .= "<h1>Code Coverage</h1>\n";
		$class = $this->getResultDescription($coverage);
		$result .= "<div class='legend'>";
		$result .= "<div class='deadCode'>Dead code</div>";
		$result .= "<div class='coveredCode'>Covered</div>";
		$result .= "<div class='uncoveredCode'>Uncovered</div>";
		$result .= "</div>\n";
		$result .= "<div class='result$class'>$coverage%</div>\n";
		$result .= "</div>";
		
		return $result;
	}
	
	protected function getResultDescription($coverage)
	{
		$result = "poor";
		if($coverage > 50)
		{
			$result = "medium";
		}
		
		if($coverage > 80)
		{
			$result = "high";
		}
		
		return $result;
	}
	
	protected function getCoverage($file, $report)
	{
		$result = array("contents" => "", "percent" => 0);
		$source = file($file);
		$totalLines = 0;
		$notCoveredLines = 0;
		
		foreach($source as $lineNumber => $code)
		{
			$class = "nonExecutableCode";
			
			$deadCode = (isset($report[$lineNumber]) AND is_scalar($report[$lineNumber]) AND ($report[$lineNumber] == -2));
			if($deadCode)
			{
				$class = "coveredCode";
			}
			
			$notCovered = (isset($report[$lineNumber]) AND is_scalar($report[$lineNumber]) AND ($report[$lineNumber] == -1));
			
			if($notCovered)
			{
				$class = "uncoveredCode";
				$notCoveredLines++;
				$totalLines++;
			}
			
			$covered = (isset($report[$lineNumber]) AND is_array($report[$lineNumber]));
			if($covered)
			{
				$class = "coveredCode";
				$totalLines++;
			}
			
			$code = $this->cleanCode($code);
			$result["contents"] .= "<span class='$class'>$code</span><br/>";
		}
		
		$percentNotCovered = 100;
		if($totalLines != 0)
		{
			$percentNotCovered = (($notCoveredLines*100)/$totalLines);
		}
		$percentCovered = ((100 - $percentNotCovered));
		
		$result["percent"] = number_format($percentCovered, 0); 
		$result["contents"] = "<ul><li><pre class='code'>".$result["contents"]."</pre></li></ul>";
		
		return $result;
	}
	
	protected function cleanCode($code)
	{
		$result = str_replace("&", "&amp;", $code);
		$result = str_replace(";", "&#59;", $result); 
		$result = str_replace("<", "&lt;", $result);
		$result = str_replace(">", "&gt;", $result);
	
		return $result;
	}
}