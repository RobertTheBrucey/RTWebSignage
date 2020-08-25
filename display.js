var imgSrc = [];
var lastModTime = [];

function checkImage(screenID, elementId) //iFrame must have the ID "modFrame + screenID"
{
	imgSrc[screenID] = "./images/" + screenID + ".gif";
	var modFrame = document.getElementById('modFrame' + screenID);
	modFrame.onload = function() {
		var doc = modFrame.contentDocument? modFrame.contentDocument: modFrame.contentWindow.document;
		var newModTime = doc.getElementById("modified").innerHTML;
		if (newModTime != lastModTime[screenID])
		{
			var imgObj = elementId;
			var imastring = "" + imgSrc[screenID] + "?cache=" + newModTime
			if (imgObj.nodeName == "IMG") {
				imgObj.src = imastring;
			}
			if (imgObj.nodeName == "DIV") {
				imgObj.style.backgroundImage = 'url(' + imastring + ')';
			}
			lastModTime[screenID] = newModTime;
		}
	}
	modFrame.src = "screenQuery.php?screenID=" + screenID;
}

function init()
{
	var url_string = window.location.href; //window.location.href
	var url = new URL(url_string);
	var screenID = url.searchParams.get("screenID");
	if (isNaN(screenID)) {
		screenID = 1;
	}
	imgSrc[screenID] = "images/" + screenID + ".gif";

	var refreshTime = url.searchParams.get("refresh");
	if (refreshTime <= 1 || isNaN(refreshTime))
	{
		refreshTime = 3000;
	}
	else
	{
		refreshTime *= 1000;
	}
	
	var imgObj = document.getElementById('myImage');
	var imastring = "" + imgSrc[screenID];
	imgObj.style.backgroundImage = 'url(' + imastring + ')';
	setInterval(function(){checkImage(screenID,imgObj)}, refreshTime);
}