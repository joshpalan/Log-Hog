var fileArrayKeys = Object.keys(fileArray);
var countOfWatchList = fileArrayKeys.length;
var countOfAddedFiles = 0;
var countOfClicks = 0;
var locationInsert = "newRowLocationForWatchList";
var countOfWatchListStatic = countOfWatchList;
var countOfAddedFilesStatic = countOfAddedFiles;
var countOfClicksStatic = countOfClicks;
var locationInsertStatic = locationInsert;
var titleOfPage = "Watchlist";

function addRowFunction()
{
	try
	{
		countOfWatchList++;
		countOfClicks++;

		var fileName = ""+countOfWatchList;
		if(countOfWatchList < 10)
		{
			fileName = "0"+fileName;
		}
		
		document.getElementById(locationInsert).outerHTML += "<li id='rowNumber"+countOfWatchList+"'>File #" + fileName+ ": <div style=\"width: 130px; display: inline-block; text-align: center;\">----------</div><input type='text' style='width: 480px;' name='watchListKey" + countOfWatchList + "' > <input type='text' name='watchListItem" + countOfWatchList + "' > <a class='deleteIconPosition' onclick='deleteRowFunctionPopup("+ countOfWatchList +", true, \"File #" + fileName+"\")'>"+defaultTrashCanIcon+"</a></li><div id='newRowLocationForWatchList"+countOfClicks+"'></div>";
		
		locationInsert = "newRowLocationForWatchList"+countOfClicks;
		document.getElementById("numberOfRows").value = countOfWatchList;
		countOfAddedFiles++;
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

function deleteRowFunctionPopup(currentRow, decreaseCountWatchListNum, keyName = "")
{
	try
	{
		if(popupSettingsArray.removeFolder === "true")
		{
			showPopup();
			document.getElementById("popupContentInnerHTMLDiv").innerHTML = "<div class='settingsHeader' >Are you sure you want to remove this file/folder?</div><br><div style='width:100%;text-align:center;padding-left:10px;padding-right:10px;'>"+keyName+"</div><div><div class='link' onclick='deleteRowFunction("+currentRow+","+ decreaseCountWatchListNum+");hidePopup();' style='margin-left:125px; margin-right:50px;margin-top:35px;'>Yes</div><div onclick='hidePopup();' class='link'>No</div></div>";
		}
		else
		{
			deleteRowFunction(currentRow, decreaseCountWatchListNum);
		}
	}
	catch(e)
	{
		eventThrowException(e);
	}	
}

function deleteRowFunction(currentRow, decreaseCountWatchListNum)
{
	try
	{
		var elementToFind = "rowNumber" + currentRow;
		document.getElementById(elementToFind).outerHTML = "";
		if(decreaseCountWatchListNum)
		{
			var newValue = document.getElementById("numberOfRows").value;
			if(currentRow < newValue)
			{
				//this wasn't the last folder deleted, update others
				for(var i = currentRow + 1; i <= newValue; i++)
				{
					var updateItoIMinusOne = i - 1;
					var elementToUpdate = "rowNumber" + i;
					var documentUpdateText = "<li id='rowNumber"+updateItoIMinusOne+"' >File #";
					var watchListKeyIdFind = "watchListKey"+i;
					var watchListItemIdFind = "watchListItem"+i;
					var previousElementNumIdentifierForKey  = document.getElementsByName(watchListKeyIdFind);
					var previousElementNumIdentifierForItem  = document.getElementsByName(watchListItemIdFind);
					if(updateItoIMinusOne < 10)
					{
						documentUpdateText += "0";
					}
					var nameForId = "fileNotFoundImage" + i;
					var elementByIdPreCheck = document.getElementById(nameForId);
					var elementByIdAlsoPreCheck = document.getElementById("infoFile"+i);
					if(elementByIdPreCheck !== null && elementByIdAlsoPreCheck !== null)
					{
						documentUpdateText += updateItoIMinusOne+": ";
						elementByIdAlsoPreCheck.id = "infoFile"+updateItoIMinusOne;
						documentUpdateText += elementByIdAlsoPreCheck.html();
						elementByIdPreCheck.id = "fileNotFoundImage"+updateItoIMinusOne;
						documentUpdateText += elementByIdPreCheck.html();
					}
					else
					{
						documentUpdateText += updateItoIMinusOne+": <div style=\"width: 130px; display: inline-block; text-align: center;\">----------</div>";
					}
					documentUpdateText += "<input style='width: 480px' type='text' name='watchListKey"+updateItoIMinusOne+"' value='"+previousElementNumIdentifierForKey[0].value+"'> ";
					documentUpdateText += "<input type='text' name='watchListItem"+updateItoIMinusOne+"' value='"+previousElementNumIdentifierForItem[0].value+"'>";
					documentUpdateText += " <a class='deleteIconPosition' onclick='deleteRowFunctionPopup("+updateItoIMinusOne+", true,\""+previousElementNumIdentifierForKey[0].value+"\")'>"+defaultTrashCanIcon+"</a>";
					documentUpdateText += "</li>";
					document.getElementById(elementToUpdate).outerHTML = documentUpdateText;
				}
			}
			newValue--;
			if(countOfAddedFiles > 0)
			{
				countOfAddedFiles--;
			}
			countOfWatchList--;
			document.getElementById("numberOfRows").value = newValue;
		}
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

function checkWatchList()
{
	try
	{
		var blankValue = false;
		for (var i = 1; i <= countOfWatchList; i++) 
		{
			if(document.getElementsByName("watchListKey"+i)[0].value === "")
			{
				blankValue = true;
			}
		}
		if(blankValue && popupSettingsArray.blankFolder === "true")
		{
			showNoEmptyFolderPopup();
			event.preventDefault();
			event.returnValue = false;
			return false;
		}
		else
		{
			displayLoadingPopup();
		}
	}
	catch(e)
	{
		eventThrowException(e);
	}
}
function showNoEmptyFolderPopup()
{
	try
	{
		showPopup();
		document.getElementById("popupContentInnerHTMLDiv").innerHTML = "<div class='settingsHeader' >Warning!</div><br><div style='width:100%;text-align:center;padding-left:10px;padding-right:10px;'>Please make sure there are no empty folders when saving the Watch List.</div><div><div class='link' onclick='hidePopup();' style='margin-left:175px; margin-top:25px;'>Okay</div></div>";
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

function checkIfChanges()
{
	if(	checkForChangesArray(["settingsMainWatch"]))
	{
		return true;
	}
	return false;
}

function resetWatchListVars()
{
	try
	{
		resetArrayObject("settingsMainWatch");
		countOfWatchList = countOfWatchListStatic;
		countOfAddedFiles =  countOfAddedFilesStatic;
		countOfClicks = countOfClicksStatic;
		locationInsert = locationInsertStatic;
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

function refreshSettingsWatchList()
{
	try
	{
		refreshArrayObject("settingsMainWatch");
		countOfWatchListStatic = countOfWatchList;
		countOfAddedFilesStatic = countOfAddedFiles;
		countOfClicksStatic = countOfClicks;
		locationInsertStatic = locationInsert;
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

$( document ).ready(function() 
{
	refreshSettingsWatchList();
	setInterval(poll, 100);
});
