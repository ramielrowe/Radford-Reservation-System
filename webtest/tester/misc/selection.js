
this.testSelection = function()
{
	this.start = function()
	{
		var form = document.getElementById("testSelector");
		var selectors = form.getElementsByTagName("input");
		
		for (var i = 0; i < selectors.length; i++)
		{
			if(selectors[i].className == "groupSelector")
			{
				makeGroupSelector(selectors[i]);
			};
		};
		
		var selectAll = document.getElementById("selectAll");
		selectAll.onclick = this.selectAll;
		
		var selectNone = document.getElementById("selectNone");
		selectNone.onclick = this.selectNone;
		
		var runTests = document.getElementById("runTests");
		runTests.onclick = this.runTests;
	};
	
	this.runTests = function()
	{
		var form = document.getElementById("testSelector");
		form.submit();
	};
	
	this.selectNone = function()
	{
		var form = document.getElementById("testSelector");
		var selectors = form.getElementsByTagName("input");
		for (var i = 0; i < selectors.length; i++)
		{
			selectors[i].checked = false;
		};
	};
	
	this.selectAll = function()
	{
		var form = document.getElementById("testSelector");
		var selectors = form.getElementsByTagName("input");
		for (var i = 0; i < selectors.length; i++)
		{
			selectors[i].checked = true;
		};
	};
	
	this.makeGroupSelector = function(element)
	{
		element.onclick = function()
		{
			var newState = element.checked;
			var parent = element.parentNode.parentNode;
			var selectors = parent.getElementsByTagName("input");
			for (var i = 0; i < selectors.length; i++)
			{
				selectors[i].checked = newState;
			};
		};
	};
	
	start();
};

window.onload = function()
{
	testSelection();
	listexpander();
};