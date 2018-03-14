var titleOfPage = "Watchlist";

function generateRow(data)
{
	var fileTypeIsFolder = false;
	if(data["fileType"] === "folder")
	{
		fileTypeIsFolder = true;
	}
	var fileTypeIsFile = false;
	if(data["fileType"] === "file")
	{
		fileTypeIsFile = true;
	}
	var item = $("#storage .saveBlock").html();
	item = item.replace(/{{rowNumber}}/g, data["rowNumber"]);
	item = item.replace(/{{fileNumber}}/g, data["fileNumber"]);
	item = item.replace(/{{filePermsDisplay}}/g, data["filePermsDisplay"]);
	item = item.replace(/{{fileImage}}/g, data["fileImage"]);
	item = item.replace(/{{location}}/g, data["location"]);
	item = item.replace(/{{pattern}}/g, data["pattern"]);
	item = item.replace(/{{key}}/g, data["key"]);
	item = item.replace(/{{recursiveOptions}}/g, generateTrueFalseSelect(data["recursive"]));
	item = item.replace(/{{excludeTrimOptions}}/g, generateTrueFalseSelect(data["excludeTrim"]));
	item = item.replace(/{{typefile}}/g, displayNoneIfTrue(fileTypeIsFile));
	item = item.replace(/{{typefolder}}/g, displayNoneIfTrue(fileTypeIsFolder));
	item = item.replace(/{{FileTypeOptions}}/g, generateFileTypeSelect(data["fileType"]));
	return item;
}

function displayNoneIfTrue(selectValue)
{
	if(selectValue)
	{
		return "style=\"display: none;\"";
	}
	return "";
}

function generateFileTypeSelect(selectValue)
{
	var selectHtml = "";
	selectHtml += "<option value=\"file\" ";
	if(selectValue === "file")
	{
		selectHtml += " selected ";
	}
	selectHtml += " >File</option>";
	selectHtml += "<option value=\"folder\" ";
	if(selectValue === "folder")
	{
		selectHtml += " selected ";
	}
	selectHtml += " >Folder</option>";
	selectHtml += "<option value=\"other\" ";
	if(selectValue !== "file" && selectValue !== "folder")
	{
		selectHtml += " selected ";
	}
	selectHtml += " >Other</option>";
	return selectHtml;
}

function generateTrueFalseSelect(selectValue)
{
	var selectHtml = "";
	selectHtml += "<option value=\"true\" ";
	if(selectValue === "true")
	{
		selectHtml += " selected ";
	}
	selectHtml += " >True</option>";
	selectHtml += "<option value=\"false\" ";
	if(selectValue !== "true")
	{
		selectHtml += " selected ";
	}
	selectHtml += " >False</option>";
	return selectHtml;
}

function addFile()
{
	addRowFunction(
		{
			fileType: "file"
		}
	);
} 

function addFolder()
{
	addRowFunction(
		{
			fileType: "folder"
		}
	);
}

function addOther()
{
	addRowFunction(
		{
			fileType: "other"
		}
	);
}

function addRowFunction(data)
{
	try
	{
		var countOfWatchList = parseInt(document.getElementById("numberOfRows").value);
		countOfWatchList++;

		var fileName = ""+countOfWatchList;
		if(countOfWatchList < 10)
		{
			fileName = "0"+fileName;
		}
		var fileTypeFromData = "other";
		if("fileType" in data)
		{
			fileTypeFromData = data["fileType"];
		}
		var item = generateRow(
			{
				rowNumber: countOfWatchList,
				fileNumber: fileName,
				filePermsDisplay: "----------",
				fileImage: "",
				location: "",
				pattern: "",
				key: "Log "+countOfWatchList,
				recursive: "false",
				excludeTrim: "false",
				fileType: fileTypeFromData
			}
		);
		$(".uniqueClassForAppendSettingsMainWatchNew").append(item);
		document.getElementById("numberOfRows").value = countOfWatchList;
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

function deleteRowFunctionPopup(currentRow, keyName = "")
{
	try
	{
		if("removeFolder" in popupSettingsArray && popupSettingsArray.removeFolder === "true")
		{
			showPopup();
			document.getElementById("popupContentInnerHTMLDiv").innerHTML = "<div class='settingsHeader' >Are you sure you want to remove this file/folder?</div><br><div style='width:100%;text-align:center;padding-left:10px;padding-right:10px;'>"+keyName+"</div><div><div class='link' onclick='deleteRowFunction("+currentRow+");hidePopup();' style='margin-left:125px; margin-right:50px;margin-top:35px;'>Yes</div><div onclick='hidePopup();' class='link'>No</div></div>";
		}
		else
		{
			deleteRowFunction(currentRow);
		}
	}
	catch(e)
	{
		eventThrowException(e);
	}	
}

function deleteRowFunction(currentRow)
{
	try
	{
		var elementToFind = "rowNumber" + currentRow;
		document.getElementById(elementToFind).outerHTML = "";
		var newValue = parseInt(document.getElementById("numberOfRows").value);
		if(currentRow < newValue)
		{
			//this wasn't the last folder deleted, update others
			for(var i = currentRow + 1; i <= newValue; i++)
			{
				var updateItoIMinusOne = i - 1;
				var fileName = "";
				if(updateItoIMinusOne < 10)
				{
					fileName += "0";
				}
				fileName += updateItoIMinusOne;

				var item = generateRow(
					{
						rowNumber: updateItoIMinusOne,
						fileNumber: fileName,
						filePermsDisplay: $("#infoFile"+i).html(),
						fileImage: $("#imageFile"+i).html(),
						location: document.getElementsByName("watchListKey"+i+"Location")[0].value,
						pattern: document.getElementsByName("watchListKey"+i+"Pattern")[0].value,
						key: document.getElementsByName("watchListKey"+i)[0].value,
						recursive: document.getElementsByName("watchListKey"+i+"Recursive")[0].value,
						excludeTrim: document.getElementsByName("watchListKey"+i+"ExcludeTrim")[0].value,
						fileType: document.getElementsByName("watchListKey"+i+"FileType")[0].value
					}
				);
				//add new one
				$(".uniqueClassForAppendSettingsMainWatchNew").append(item);
				//remove old one
				$("#rowNumber"+i).remove();
			}
		}
		newValue--;
		document.getElementById("numberOfRows").value = newValue;
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
		var countOfWatchList = parseInt(document.getElementById("numberOfRows").value);
		var blankValue = false;
		for (var i = 1; i <= countOfWatchList; i++) 
		{
			if(document.getElementsByName("watchListKey"+i+"Location")[0].value === "")
			{
				blankValue = true;
				break;
			}
		}
		if(blankValue && "blankFolder" in popupSettingsArray && popupSettingsArray.blankFolder === "true")
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

