/* 
	Web TestRunner for PHPUnit
	Written by Jaume Cardona (@txau)
	This class was provided by www.becodemyfriend.com
*/

The idea is to keep every test case with the code it tests while a test runner script
collects the test case files. The runner will provide us a menu where we chose wich tests
to launch. All of this has been tested with Apache + PHP 5.3 + PHPUnit 3.5.

You'll need PHPUnit installed:

http://www.phpunit.de/manual/3.5/en/installation.html

1. Configure the absolute URL to TestRunner directory in config.php.

2. Create a test battery file, I recommend placing it alone inside a new folder naming 
it index.php. You can copy TestSamples/index.php to start with.

3. Create an array named "$testSuite", where we provide the paths to our test cases. 
I recommend using absolute paths. Ex:

$testSuite = array();
$testSuite[] = dirname(__FILE__)."/../../lib/";

Where in "lib" we'll find our code along with their tests files.

4. Our naming convention for tests files is "TestCaseClassName.php" where the name of 
the file is the same name as the class. Ex:

TestCaseMyClass.php contains the class TestCaseMyClass, wich usually extends 
PHPUnit_Framework_TestCase. You can find a sample in TestSamples/TestExample/TestCaseExample.php.

5. Configure in index.php the inclusion to testLauncher.php

include dirname(__FILE__).DIRECTORY_SEPARATOR."../TestRunner/testLauncher.php";

6. Point your browser to the URL of your index.php file, the rest is a walk int he park =)

OPTIONAL: CODE COVERAGE

note: to obtain code coverage information, you'll need PHP_CodeCoverage and Xdebug installed.

To activate the code coverage report, simply pass ?coverage as get argument. Ex:

http://localhost/myproject/tests/?coverage

Optionally you can provide a list of files and directories to be ignored by code coverage 
report the same way you provide paths to be tested. Ex:

$codeCoverageIgnoreDirectoryList = array();
$codeCoverageIgnoreDirectoryList[] = dirname(__FILE__)."/../../ignoreDir/";

$codeCoverageIgnoreFileList = array();
$codeCoverageIgnoreFileList[] = dirname(__FILE__)."/../IgnoreFile.php";
	


