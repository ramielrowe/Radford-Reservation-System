<?php 
	ini_set("display_errors", 1);
	ini_set("error_reporting", E_ALL);
	
	require_once dirname(__FILE__).DIRECTORY_SEPARATOR."config.php";
	require_once "PHPUnit/Autoload.php";
	require_once "class/TestRunner.php";
	
	$includeCoverage = false;
	if(isset($_GET["coverage"]))
	{
		$includeCoverage = true;
	}

	$runner = new TestRunner(false);
	
	if(isset($testSuite))
	{
		foreach($testSuite as $onePath)
		{
			$runner->readFolder($onePath);
		}
	}
	
	if(isset($codeCoverageIgnoreDirectoryList))
	{
		foreach($codeCoverageIgnoreDirectoryList as $oneDirectory)
		{
			$runner->codeCoverageIgnoreDirectory($oneDirectory);
		}
	}
	
	if(isset($codeCoverageIgnoreFileList))
	{
		$runner->codeCoverageIgnoreFiles($codeCoverageIgnoreFileList);
	}
	
	/*$testRunnerURL = "http://localhost/~txau/blank/test2/TestRunner/";*/	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Test Runner</title>
	<link rel="stylesheet" href="<?php echo $testRunnerURL ?>misc/style.css" type="text/css"></link> 
	<script type="text/javascript" src="<?php echo $testRunnerURL ?>misc/folding.js"></script>
	<script type="text/javascript" src="<?php echo $testRunnerURL ?>misc/selection.js"></script>
</head>

<body>
	
<?php
	$runner->run();
	echo $runner->getTestSelector();
?>

<div id="testResultsContainer">
	<?php echo $runner->getReport(); ?>
</div>

</body>
</html>
