<?php
require_once "HTMLTestSelector.php";
require_once "HTMLReport.php";

class TestRunner
{
	public $listener;
	public $result;
	public $suite;
	public $report;
	protected $includeCoverage = false;
	
	public $files = array();
	public $codeCoverageIgnoreFileList = array();
	public $codeCoverageIgnoreDirectoryList = array();
	
	const TEST_CASE_PREFIX = "TestCase*";
	
	public function __construct($includeCoverage = false)
	{
		$this->suite = new PHPUnit_Framework_TestSuite;
		$this->suite->setBackupGlobals(false);
		$this->suite->setName("Test Runner");
		$this->listener = new PHPUnit_Util_Log_JUnit;
		$this->result = new PHPUnit_Framework_TestResult();
		$this->result->addListener($this->listener);
		$this->setIncludeCoverage($includeCoverage);
	}
	
	protected function importCodeCoverage()
	{	
		require_once "CodeCoverageReport.php";
		require_once 'PHP/CodeCoverage/Report/HTML.php';
	}
	
	protected function setCodeCoverageIgnores()
	{
		$codeCoverageFilter = PHP_CodeCoverage_Filter::getInstance();
		$codeCoverageFilter->addDirectoryToBlacklist(dirname(__FILE__));
		
		foreach($this->codeCoverageIgnoreDirectoryList as $oneDirectory)
		{
			$codeCoverageFilter->addDirectoryToBlacklist($oneDirectory);
		}
		
		$codeCoverageFilter->addFilesToBlackList($this->codeCoverageIgnoreFileList);
	}
	
	public function setIncludeCoverage($bool = true)
	{
		$this->includeCoverage = $bool;
		//$this->result->collectCodeCoverageInformation($bool);
	}
	
	public function getFiles()
	{
		return $this->files;
	}
	
	public function getTestSelector()
	{
		$files = $this->getFiles();
		$form = new HTMLTestSelector();
		
		return $form->getForm($files);
	}
	
	protected function getRunable()
	{
		return HTMLTestSelector::getRunable();
	}
	
	public function run()
	{
		$result = "";
		
		foreach($this->files as $oneDirectory => $testCollection)
		{
			$suite = new PHPUnit_Framework_TestSuite();
			$suite->setBackupGlobals(false);
			$suite->setName($oneDirectory);
			$this->includeCases($testCollection, $suite);
			$this->suite->addTestSuite($suite);
		}
		
		if($this->includeCoverage)
		{
			$this->importCodeCoverage();
			$this->setCodeCoverageIgnores();
		}
		
		$this->suite->run($this->result);
		$xml = new SimpleXMLElement($this->listener->getXML());
		$casesReport = new HTMLReport();
	   	$result .= $casesReport->report($xml);
	   	
		if($this->includeCoverage)
		{
			$CodeCoverage = $this->result->getCodeCoverage();
			$coverageReport = new CodeCoverageReport();
			$result .= $coverageReport->report($CodeCoverage);
			
			//$writer = new PHP_CodeCoverage_Report_HTML;
			//$writer->process($CodeCoverage, dirname(__FILE__).'/tmp/');
		}
		
		$this->report = $result;
	}

	public function getReport()
	{
		return $this->report;
	}
	
	protected function includeCases($testCollection, $suite)
	{
		$runable = $this->getRunable();
		foreach($testCollection as $oneCase => $file)
		{
			if(in_array($oneCase, $runable))
			{
				require_once($file);
				$testCase = new ReflectionClass($oneCase);
				$suite->addTestSuite($testCase);
			}
		}
	}
	
	public function readFolder($path)
	{
		$canonicalizedPath = self::canonicalizePath($path);
		$files = glob($canonicalizedPath."*");
		$testCases = glob($canonicalizedPath.self::TEST_CASE_PREFIX);
		$hasCases = (sizeof($testCases) > 0);
		
		if($hasCases)
		{
			foreach($testCases as $oneCase)
			{
				$this->addTest($oneCase);
			}
		}
		
		foreach($files as $oneFile)
		{
			if(is_dir($oneFile))
			{
				$this->readFolder($oneFile);
			}
		}
	}
	
	public function codeCoverageIgnoreDirectory($path)
	{
		$this->codeCoverageIgnoreDirectoryList[] = $path;
	}
	
	public function codeCoverageIgnoreFile($path)
	{
		$this->codeCoverageIgnoreFileList[] = $path;
	}
	
	public function codeCoverageIgnoreFiles(array $files)
	{
		$this->codeCoverageIgnoreFileList = array_merge($files, $this->codeCoverageIgnoreFileList);
	}
	
	protected function addTest($path)
	{
		$fileInfo = pathinfo($path);
		$classname = $fileInfo["filename"];
		
		if(!isset($this->files[$fileInfo["dirname"]]))
		{
			$this->files[$fileInfo["dirname"]] = array();
		}
		$this->files[$fileInfo["dirname"]][$classname] = $path;
	}
	
	protected function canonicalizePath($path)
	{
		$result = self::absolutePath($path);
		$result = self::addFinalSlash($result);
	
		return $result;
	}
	
	protected function addFinalSlash($path)
	{
		$result = $path;
		
		$lastCharacter = substr($path, strlen($path)-1, 1);
		
		if($lastCharacter != DIRECTORY_SEPARATOR)
		{
			$result .= DIRECTORY_SEPARATOR;
		}
		
		return $result;
	}
	
	protected function absolutePath($path)
	{
		$result = $path;
		
		if(!self::isAbsolutePath($path))
		{
			$result = dirname(__FILE__).DIRECTORY_SEPARATOR.$path;
		}
		
		return $result;
	}
	
	protected function isAbsolutePath($path)
	{
		preg_match("/^[a-z]:\\|^\//i", $path, $rootMatch);
		$result = !is_null($rootMatch);
		
		return $result;
	}
}
?>
