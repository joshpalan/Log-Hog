var title = $("title").text();
var currentPage;
var logs = {};
var titles = {};
var lastLogs = {};
var fresh = true;
var flasher;
var updating = false;
var startedPauseOnNonFocus = false;
var polling = false;
var t0 = performance.now();
var t1 = performance.now();
var t2 = performance.now();
var t3 = performance.now();
var counterForPoll = 0;
var arrayOfData1 = null;
var arrayOfData2 = null;
var arrayToUpdate = [];
var arrayOfDataMain = null;
var pollTimer = null;
var dataFromUpdateCheck = null;
var timeoutVar = null;
var pollSkipCounter = 0;
var counterForPollForceRefreshAll = 0;
var filesNew;
var pausePoll = false;
var refreshPauseActionVar;
var userPaused = false;
var refreshing = false;
var percent = 0;
var pollRefreshAllBoolStatic = pollRefreshAllBool;
var firstLoad = true;
var timer;
var clearingNotifications = false;
var progressBar;

function escapeHTML(unsafeStr)
{
	try
	{
		return unsafeStr.toString()
		.replace(/&/g, "&amp;")
		.replace(/</g, "&lt;")
		.replace(/>/g, "&gt;")
		.replace(/\"/g, "&quot;")
		.replace(/\'/g, "&#39;")
		.replace(/\//g, "&#x2F;");
	}
	catch(e)
	{
		eventThrowException(e);
	}
	
}

function unescapeHTML(unsafeStr)
{
	try
	{
		return unsafeStr.toString()
		.replace(/&amp;/g, "&")
		.replace(/&lt;/g, "<")
		.replace(/&gt;/g, ">")
		.replace(/&quot;/g, "\"")
		.replace(/&#39;/g, "\'")
		.replace(/&#x2F;/g, "\/");
	}
	catch(e)
	{
		eventThrowException(e);
	}
	
}

function updateSkipCounterLog(num)
{
	try
	{
		if(enablePollTimeLogging !== "false")
		{
			document.getElementById("loggSkipCount").innerHTML = escapeHTML(num);
		}
	}
	catch(e)
	{
		eventThrowException(e);
	}

	
}

function updateAllRefreshCounter(num)
{
	try
	{
		if(enablePollTimeLogging !== "false")
		{
			document.getElementById("loggAllCount").innerHTML = escapeHTML(num);
		}
	}
	catch(e)
	{
		eventThrowException(e);
	}
	
}

function updateDocumentTitle(updateText)
{
	try
	{
		if(document.title !== "Log Hog | "+updateText)
		{
			document.title = "Log Hog | "+updateText;
		}
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

function poll()
{
	try
	{
		checkForUpdateMaybe();
		if(refreshing)
		{
			updateDocumentTitle("Refreshing");
		}
		else
		{
			updateDocumentTitle("Index");
		}
		counterForPoll++;
		if(!polling && !clearingNotifications)
		{
			pollSkipCounter = 0;
			updateSkipCounterLog(pollSkipCounter);
			polling = true;
			t0 = performance.now();
			pollTwo();
		}
		else
		{
			if(pollForceTrueBool === "true" && firstLoad !== true && !clearingNotifications)
			{
				pollSkipCounter++;
				updateSkipCounterLog(pollSkipCounter);
				if(pollSkipCounter > pollForceTrue)
				{
					pollSkipCounter = 0;
					polling = false;
					updateSkipCounterLog(pollSkipCounter);
				}
			}
			else
			{
				updateSkipCounterLog("-");
			}
		}
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

function pollTwo()
{
	try
	{
		var urlForSend = "core/php/pollCheck.php?format=json";
		var data = {currentVersion};
		$.ajax({
			url: urlForSend,
			dataType: "json",
			data,
			type: "POST",
			success(data)
			{
				if(data === false)
				{
					showPopup();
					document.getElementById("popupContentInnerHTMLDiv").innerHTML = "<div class='settingsHeader' >Log-Hog has been updated. Please Refresh</div><br><div style='width:100%;text-align:center;padding-left:10px;padding-right:10px;'>Log-Hog has been updated, and is now on a new version. Please refresh the page.</div><div><div class='link' onclick='location.reload();' style='margin-left:165px; margin-right:50px;margin-top:35px;'>Reload</div></div>";
				}
				else if(data === "update in progress")
				{
					window.location.href = "update/updateInProgress.php";
				}
				else
				{
					pollTwoPartTwo(data);
				}
			},
			failure(data)
			{
				polling = false;
			}
		});	
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

function pollTwoPartTwo(data)
{
	try
	{
		if(firstLoad)
		{
			updateProgressBar(10, "Generating File Object");
		}
		t2 = performance.now();

		//check for all update force
		var boolForAllUpdateForce = false;
		if(pollRefreshAllBool === "true")
		{
			updateAllRefreshCounter(counterForPollForceRefreshAll);
			counterForPollForceRefreshAll++;
			if(counterForPollForceRefreshAll > pollRefreshAll)
			{
				counterForPollForceRefreshAll = 0;
				boolForAllUpdateForce = true;
				updateAllRefreshCounter(counterForPollForceRefreshAll);
			}
		}
		else
		{
			updateAllRefreshCounter("-");
		}

		filesNew = Object.keys(data);

		if(arrayOfData1 === null || boolForAllUpdateForce)
		{
			arrayOfData1 = data;
			for (var i = filesNew.length - 1; i >= 0; i--)
			{
				arrayToUpdate.push(filesNew[i]);
			}
		}
		else
		{
			var arrayOfData2 = data; 
			var filesOld = Object.keys(arrayOfData1);
			arrayToUpdate = [];
			for (var i = filesNew.length - 1; i >= 0; i--)
			{
				if(filesOld.indexOf(filesNew[i]) > -1)
				{
					//file exists
					if(arrayOfData2[filesNew[i]] !== arrayOfData1[filesNew[i]])
					{
						arrayToUpdate.push(filesNew[i]);
					}
				}
				else
				{
					//file is new, add to array
					arrayToUpdate.push(filesNew[i]);
				}
			}
			
			for (var i = filesOld.length - 1; i >= 0; i--)
			{
				if(!(filesNew.indexOf(filesOld[i]) > -1))
				{
					//files old file isn't there in new file
					arrayToUpdate.push(filesOld[i]);
				}
			}
			arrayOfData1 = data;
		}
		pollThree(arrayToUpdate);
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

function pollThree(arrayToUpdate)
{
	try
	{
		if(arrayOfDataMain !== null)
		{
			for (var i = arrayToUpdate.length - 1; i >= 0; i--) 
			{
				if(arrayOfDataMain[arrayToUpdate[i]] === null)
				{
					delete arrayOfDataMain[arrayToUpdate[i]];
				}
				else
				{
					arrayOfDataMain[arrayToUpdate[i]] = null;
				}
			}
		}
		t3 = performance.now();
		if (typeof arrayToUpdate !== "undefined" && arrayToUpdate.length > 0) 
		{
			if(firstLoad)
			{
				updateProgressBar(10,arrayToUpdate[0],  "Loading file 1 of "+arrayToUpdate.length);
				getFileSingle(arrayToUpdate.length-1, arrayToUpdate.length-1);
			}
			else
			{
				var urlForSend = "core/php/poll.php?format=json";
				var data = {arrayToUpdate};
				$.ajax({
					url: urlForSend,
					dataType: "json",
					data,
					type: "POST",
					success(data)
					{
						arrayOfDataMainDataFilter(data);
						update(arrayOfDataMain);
						fresh = false;
					},
					complete()
					{
						afterPollFunctionComplete();
					}
				});	
			}
		}
		else
		{
			afterPollFunctionComplete();
		}	
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

function getFileSingle(current)
{
	try
	{
		var data = {arrayToUpdate: [arrayToUpdate[current]]};
		$.ajax({
			url: "core/php/poll.php?format=json",
			dataType: "json",
			currentFile: current,
			data,
			type: "POST",
			success(data)
			{
				arrayOfDataMainDataFilter(data);
				update(arrayOfDataMain);
			},
			complete()
			{
				var currentNew = this.currentFile;
				var updateBy = (1/arrayToUpdate.length)*60;
				updateProgressBar(updateBy, arrayToUpdate[currentNew], "Loading file "+(arrayToUpdate.length+1-currentNew)+" of "+arrayToUpdate.length);
				if(currentNew > 0)
				{
					currentNew--;
					setTimeout(function(){ getFileSingle(currentNew); }, 100);
					
				}
				else
				{
					update(arrayOfDataMain);
					fresh = false;
					afterPollFunctionComplete();
				}
			}
		});
	}
	catch(e)
	{
		eventThrowException(e);
	}	
}

function arrayOfDataMainDataFilter(data)
{
	try
	{
		var filesInner = Object.keys(data);
		if(arrayOfDataMain === null)
		{
			arrayOfDataMain = data;
		}
		else
		{
			for (var i = filesInner.length - 1; i >= 0; i--) 
			{
				arrayOfDataMain[filesInner[i]] = data[filesInner[i]];
			}
		}
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

function afterPollFunctionComplete()
{
	try
	{
		if(firstLoad)
		{
			firstLoad = false;
			document.getElementById("firstLoad").style.display = "none";
		}
		if(refreshing)
		{
			endRefreshAction();
		}
		polling = false;
		if(enablePollTimeLogging !== "false")
		{
			t1 = performance.now();
			document.getElementById("loggingTimerPollRate").innerText = "Ajax refresh took    "+addPaddingToNumber(Math.round(t2 - t0))+":"+addPaddingToNumber(Math.round(t3 - t2),2)+":"+addPaddingToNumber(Math.round(t1 - t3))+"    " + addPaddingToNumber(Math.round(t1 - t0)) + "/" + addPaddingToNumber(pollingRate) +"("+addPaddingToNumber(parseInt(pollingRate)*counterForPoll)+") milliseconds.";
			document.getElementById("loggingTimerPollRate").style.color = "";
			counterForPoll = 0;
			if(Math.round(t1-t0) > parseInt(pollingRate))
			{
				if(Math.round(t1-t0) > (2*parseInt(pollingRate)))
				{
					document.getElementById("loggingTimerPollRate").style.color = "#ff0000";
				}
				else
				{
					document.getElementById("loggingTimerPollRate").style.color = "#ffff00";
				}
				
			}
			else
			{
				document.getElementById("loggingTimerPollRate").style.color = "#00ff00";
			}
		}
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

function addPaddingToNumber(number, padding = 4)
{
	try
	{
		number = number.toString();
		while(number.length < padding)
		{
			number = "0"+number;
		}
		return number;
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

function pausePollAction()
{
	try
	{
		if(pausePoll)
		{
			userPaused = false;
			pausePoll = false;
			showPauseButton();
			if(pollTimer === null)
			{
				poll();
				startPollTimer();
			}

		}
		else
		{
			userPaused = true;
			pausePollFunction();
		}
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

function refreshAction()
{
	try
	{
		if(pollRefreshAllBoolStatic === "false")
		{
			pollRefreshAllBool = "true";
		}
		counterForPollForceRefreshAll = 1+pollRefreshAll;
		showRefreshingButton();
		refreshing = true;
		poll();
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

function endRefreshAction()
{
	try
	{
		if(pollRefreshAllBoolStatic === "false")
		{
			pollRefreshAllBool = "false";
		}
		showRefreshButton(); 
		refreshing = false;
		if(pausePoll)
		{
			updateDocumentTitle("Paused");
		}
		else
		{
			updateDocumentTitle("Index");
		}
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

function update(data) {
	try
	{
		var menu = $("#menu");
		var blank = $("#storage .menuItem").html();
		var id, shortName, item, style, folderName;
		var files = Object.keys(data);
		var stop = files.length;
		var updated = false;
		var initialized = $("#menu a").length !== 0;
		var folderNamePrev = "?-1";
		var folderNameCount = -1;
		for(var i = 0; i !== stop; i++)
		{
			if(files[i].indexOf("dataForLoggingLogHog051620170928") === -1)
			{
				var dataForCheck = data[files[i]];
				var name = files[i];
				var selectListForFilter = document.getElementsByName("searchType")[0];
				var selectedListFilterType = selectListForFilter.options[selectListForFilter.selectedIndex].value;
				var filterTextField = document.getElementsByName("search")[0].value;
				if(selectedListFilterType === "title" && (filterTextField === "" || name.indexOf(filterTextField) !== -1))
				{
					showLogByName(name);
					if(dataForCheck === "This file is empty. This should not be displayed." && hideEmptyLog === "true")
					{
						hideLogByName(name);
					}
					else
					{
						if(data[name] !== null)
						{
							folderName = name.substr(0, name.lastIndexOf("/"));
							if(folderName !== folderNamePrev || i === 0 || groupByType === "file")
							{
								folderNameCount++;
								folderNamePrev = folderName;
								if(folderNameCount >= colorArrayLength)
								{
									folderNameCount = 0;
								}
							}
							id = name.replace(/[^a-z0-9]/g, "");
							if(data[name] === "")
							{
								data[name] = "<div class='errorMessageLog errorMessageRedBG' >Error - Unknown error? Check file permissions or clear log to fix?</div>";
							}
							else if(data[name] === "This file is empty. This should not be displayed.")
							{
								data[name] = "<div class='errorMessageLog errorMessageGreenBG' > This file is empty. </div>";
							}
							else if((data[name] === "Error - File is not Readable") || (data[name] === "Error - Maybe insufficient access to read file?"))
							{
								var mainMessage = "Error - Maybe insufficient access to read file?";
								if(data[name] === "Error - File is not Readable")
								{
									mainMessage = "Error - File is not Readable";
								}
								data[name] = "<div class='errorMessageLog errorMessageRedBG' > "+mainMessage+" <br> <span style='font-size:75%;'> Try entering: <br> chown -R www-data:www-data "+name+" <br> or <br> chmod 664 "+name+" </span> </div>";
							}
							if(!(id in logs))
							{
								logs[id] = [];
							}
							logs[id]["log"] = data[name];
							if(enableLogging !== "false")
							{
								titles[id] = name + " | " + data[name+"dataForLoggingLogHog051620170928"];
							}
							else
							{
								titles[id] = name;
							}
							
							if(enableLogging !== "false")
							{
								if(id === currentPage)
								{
									$("#title").html(titles[id]);
								}
							}

							var lastLogLine = logs[id]["log"].count - 1;

							if($("#menu ." + id + "Button").length === 0) 
							{
								shortName = files[i].replace(/.*\//g, "");
								classInsert = "buttonColor"+(folderNameCount+1);
								item = blank;
								item = item.replace(/{{title}}/g, shortName);
								item = item.replace(/{{id}}/g, id);
								if(groupByColorEnabled === true)
								{
									item = item.replace(/{{class}}/g, classInsert);
								}

								var itemAdded = false;

								if(!fresh)
								{
									var moveToFrontOnUpdate = false;
									var innerCount = i;
									for (var i = filesNew.length - 1; i >= 0; i--)
									{
										if(filesNew[i] === files[i])
										{
											innerCount = i;
											break;
										}
									}
									var innerCountStatic = innerCount;
									var idCheck = files[i].replace(/[^a-z0-9]/g, "");
									if(innerCountStatic === 0)
									{
										itemAdded = tryToInsertBeforeLog(innerCountStatic, stop, idCheck, item);
										if(!itemAdded)
										{
											itemAdded = tryToInsertAfterLog(innerCountStatic, stop, idCheck, item);
										}
									}
									else
									{
										itemAdded = tryToInsertAfterLog(innerCountStatic, stop, idCheck, item);
										if(!itemAdded)
										{
											itemAdded = tryToInsertBeforeLog(innerCountStatic, stop, idCheck, item);
										}
									}
									

									
								}

								if(!itemAdded)
								{
									menu.append(item);
								}

								if(!fresh)
								{
									if(!$("#menu a." + id + "Button").hasClass("updated"))
									{
										$("#menu a." + id + "Button").addClass("updated");
									}
								}
							}

							
							if(!(id in lastLogs) || logs[id]["log"] !== lastLogs[id]["log"]) 
							{
								updated = true;
								if(id === currentPage)
								{
									$("#log").html(makePretty(logs[id]["log"]));
									if(document.getElementById(id+"Count").innerHTML !== "")
									{
										document.getElementById(id+"Count").innerHTML = "";
										document.getElementById(id+"CountHidden").innerHTML = "";
									}
								}
								else
								{
									if(!fresh)
									{
										if(!$("#menu a." + id + "Button").hasClass("updated"))
										{
											$("#menu a." + id + "Button").addClass("updated");
										}

										if(notificationCountVisible === "true")
										{
											if(id in lastLogs)
											{
												var diff = getDiffLogAndLastLog(id);
												if(diff !== "")
												{
													if(document.getElementById(id+"Count").innerHTML !== "" )
													{
														var count = document.getElementById(id+"CountHidden").innerHTML;
														diff = parseInt(count) + diff;
														if(diff > sliceSize)
														{
															diff = sliceSize;
														}
													}
												}
												var diffNew = diff;
												if(diff !== "")
												{
													diffNew = "("+diff+")";
												}
												if(document.getElementById(id+"Count").innerHTML !== diffNew)
												{
													document.getElementById(id+"CountHidden").innerHTML = diff;
													document.getElementById(id+"Count").innerHTML = diffNew;
												}
											}
										}
									}
								}
							}
							
							
							if(initialized && updated && $(window).filter(":focus").length === 0) 
							{
								if(flashTitleUpdateLog)
								{
									flashTitle();
								}
							}
							
							var buttonReference = document.getElementById("menu").getElementsByClassName(id+"Button")[0];
							var tmpText = logs[id]["log"].split("\n");
							var tmpTextLength = tmpText.length;
							tmpText = unescapeHTML(tmpText[tmpTextLength-1]);
							if(buttonReference.title !== tmpText)
							{
								buttonReference.title = tmpText;
							}
						}
						else
						{
							removeLogByName(name);
						}
					}
				}
				else
				{
					hideLogByName(name);
				}
			}
		}
		resize();
		
		//Check if a tab is active, if none... click on first in array that's visible
		if($("#menu .active").length === 0)
		{
			var arrayOfLogs = $("#menu a");
			for (var i = 0; i < arrayOfLogs.length; i++)
			{
				if(arrayOfLogs[i].style.display !== "none")
				{
					arrayOfLogs[i].onclick.apply(arrayOfLogs[i]);
					break;
				}
			}

			if($("#menu .active").length === 0)
			{
				//if still none active, none to display - add popup here
				if(document.getElementById("noLogToDisplay").style.display !== "block")
				{
					document.getElementById("noLogToDisplay").style.display = "block";
					document.getElementById("log").style.display = "none";
				}
			}
			else
			{
				if(document.getElementById("noLogToDisplay").style.display !== "none")
				{
					document.getElementById("noLogToDisplay").style.display = "none";
					document.getElementById("log").style.display = "block";
				}
			}
		}

		toggleNotificationClearButton();
		
		if(logs[currentPage] !== lastLogs[currentPage])
		{
			lastLogs[currentPage] = logs[currentPage];
			document.getElementById("main").scrollTop = $("#log").outerHeight();
		}
		
		refreshLastLogsArray();
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

function tryToInsertBeforeLog(innerCount, stop, idCheck, item)
{
	var itemToBefore = null;
	while(itemToBefore === null && innerCount < stop)
	{
		var itemCheck = $("#menu ." + idCheck + "Button");
		if(itemCheck.length !== 0) 
		{
			itemToBefore = itemCheck;
		}
		innerCount--;
	}
	if(itemToBefore !== null)
	{
		itemToBefore.before(item);
	}

	return (itemToBefore !== null);
}

function tryToInsertAfterLog(innerCount, stop, idCheck, item)
{
	var itemToBefore = null;
	while(itemToBefore === null && innerCount > 0)
	{
		var itemCheck = $("#menu ." + idCheck + "Button");
		if(itemCheck.length !== 0) 
		{
			itemToBefore = itemCheck;
		}
		innerCount++;
	}
	if(itemToBefore !== null)
	{
		itemToBefore.after(item);
	}

	return (itemToBefore !== null);
}

function toggleNotificationClearButton()
{
	try
	{
		if($("#menu .updated").length !== 0)
		{
			//there is at least one updated thing, show button for clear all notifications
			if(document.getElementById("clearNotificationsImage").style.display !== "inline-block")
			{
				document.getElementById("clearNotificationsImage").style.display = "inline-block";
			}
		}
		else
		{
			if(document.getElementById("clearNotificationsImage").style.display !== "none")
			{
				document.getElementById("clearNotificationsImage").style.display = "none";
			}
		}
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

function clearNotifications()
{
	clearingNotifications = true;
	try
	{
		if($("#menu .updated").length !== 0)
		{
			var arrayOfLogs = $("#menu a");
			for (var clearNotifCountOne = 0; clearNotifCountOne < arrayOfLogs.length; clearNotifCountOne++)
			{
				arrayOfLogs[clearNotifCountOne].classList.remove("updated");
			}
			var arrayOfCounts = $("#menu a .menuCounter");
			for (var clearNotifCountTwo = 0; clearNotifCountTwo < arrayOfCounts.length; clearNotifCountTwo++)
			{
				arrayOfCounts[clearNotifCountTwo].innerHTML = "";
			}
		}
		refreshLastLogsArray();
		document.getElementById("clearNotificationsImage").style.display = "none";
	}
	catch(e)
	{
		eventThrowException(e);
	}
	clearingNotifications = false;
}

function refreshLastLogsArray()
{
	try
	{
		var ids = Object.keys(logs);
		var stop = ids.length;
		for(var i = 0; i !== stop; ++i)
		{
			id = ids[i];
			if(!(id in lastLogs))
			{
				lastLogs[id] = [];
			}

			if(id in logs)
			{
				lastLogs[id]["log"] = logs[id]["log"];
			}
		}
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

function hideLogByName(name)
{
	try
	{
		var idOfName = name.replace(/[^a-z0-9]/g, "");
		if($("#menu ." + idOfName + "Button").length !== 0)
		{
			if($("#menu ." + idOfName + "Button").hasClass("active"))
			{
				$("#menu ." + idOfName + "Button").removeClass("active");
			}
			$("#menu ." + idOfName + "Button").hide();
		}
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

function showLogByName(name)
{
	try
	{
		var idOfName = name.replace(/[^a-z0-9]/g, "");
		if($("#menu ." + idOfName + "Button").length !== 0)
		{
			$("#menu ." + idOfName + "Button").show();
		}
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

function removeLogByName(name)
{
	try
	{
		var idOfName = name.replace(/[^a-z0-9]/g, "");
		if($("#menu ." + idOfName + "Button").length !== 0)
		{
			$("#menu ." + idOfName + "Button").remove();
		}
	}
	catch(e)
	{
		eventThrowException(e);
	}
	
}

function show(e, id) 
{
	try
	{
		$(e).siblings().removeClass("active");
		$(e).addClass("active").removeClass("updated");
		$("#log").html(makePretty(logs[id]["log"]));
		currentPage = id;
		$("#title").html(titles[id]);
		document.getElementById("main").scrollTop = $("#log").outerHeight();
		toggleNotificationClearButton();
		document.getElementById(id+"Count").innerHTML = "";
		document.getElementById(id+"CountHidden").innerHTML = "";
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

function getDiffLogAndLastLog(id)
{
	var tmpTextLog = logs[id]["log"].split("\n");
	var tmpTextLast = lastLogs[id]["log"].split("\n");
	var lengthOfLastArray = tmpTextLast.length;
	var lengthOfArray = tmpTextLog.length;
	if(lengthOfLastArray === 0)
	{
		return lengthOfArray;
	}
	else if(lengthOfLastArray > lengthOfArray)
	{
		return "";
	}
	var lastLine = tmpTextLast[lengthOfLastArray-1];
	var counter = 0;
	for (var i = lengthOfArray - 1; i >= 0; i--)
	{
		if(tmpTextLog[i] === lastLine)
		{
			//confirm the next two also
			var returnNewNum = true;
			var j = i-1;
			var lastStart = lengthOfLastArray-2;
			while(j >= 0)
			{
				if(tmpTextLog[j] !== tmpTextLast[lastStart])
				{
					returnNewNum = false;
					break;
				}
				else
				{
					j--;
					lastStart--;
				}
			}
			if(returnNewNum)
			{
				return (lengthOfArray - 1 - i);
			}
		}
	}
	return "";
}

function makePretty(text) 
{
	try
	{
		text = text.split("\n");
		text = text.join("</div><div>");
		
		return "<div>" + text + "</div>";
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

function resize() 
{
	try
	{
		var targetHeight = window.innerHeight - $("#menu").outerHeight() - $("#title").outerHeight();
		if(enablePollTimeLogging !== "false")
		{
			targetHeight -= 25;
		}
		if($("#main").outerHeight() !== targetHeight)
		{
			$("#main").outerHeight(targetHeight);
		}
		if($("#main").css("bottom") !== $("#title").outerHeight() + "px")
		{
			$("#main").css("bottom", $("#title").outerHeight() + "px");
		}
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

function flashTitle() 
{
	try
	{
		stopFlashTitle();
		$("title").text("");
		flasher = setInterval(function() {
			$("title").text($("title").text() === "" ? title : "");
		}, 1000);
	}
	catch(e)
	{
		eventThrowException(e);
	}
	
}

function stopFlashTitle() 
{
	try
	{
		clearInterval(flasher);
		$("title").text(title);
	}
	catch(e)
	{
		eventThrowException(e);
	}
	
}

function focus() 
{
	stopFlashTitle();
}

function startPollTimer()
{
	/* Dont try catch visibility  */

	if(pausePollOnNotFocus === true || pausePollOnNotFocus === "true")
	{
		pollTimer = setInterval(poll, pollingRate);
	}
	else
	{
		pollTimer = Visibility.every(pollingRate, backgroundPollingRate, function () { poll(); });
	}
}

function clearPollTimer()
{
	/* Dont try catch visibility  */
	
	if(pausePollOnNotFocus === true || pausePollOnNotFocus === "true")
	{
		clearInterval(pollTimer);
	}
	else
	{
		Visibility.stop(pollTimer);
	}
	pollTimer = null;
}

function startPauseOnNotFocus()
{
	/* Dont try catch visibility  */

	startedPauseOnNonFocus = true;
	Visibility.every(100, 1000, function () { checkIfPageHidden(); });
}

function checkIfPageHidden()
{
	try
	{
		if(isPageHidden())
		{
			//hidden
			if(!pausePoll)
			{
				pausePollFunction();
			}
			return;
		}

		//not hidden
		if(!userPaused && pausePoll)
		{
			pausePoll = false;
			showPauseButton();
			stopFlashTitle();
			if(pollTimer === null)
			{
				poll();
				startPollTimer();
			}
			return;
		}

		if(userPaused)
		{
			updateDocumentTitle("Paused");
		}
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

function pausePollFunction()
{
	try
	{
		pausePoll = true;
		showPlayButton();
		updateDocumentTitle("Paused");
		if(pollTimer !== null)
		{
			clearPollTimer();
		}
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

function isPageHidden()
{
	try
	{
		return document.hidden || document.msHidden || document.webkitHidden || document.mozHidden;
    }
	catch(e)
	{
		eventThrowException(e);
	}
}

function clearLog()
{
	try
	{
		var urlForSend = "core/php/clearLog.php?format=json";
		var title = filterTitle(document.getElementById("title").innerHTML);
		var data = {file: title};
		$.ajax({
				url: urlForSend,
				dataType: "json",
				data,
				type: "POST",
		success(data)
		{
			refreshLastLogsArray();
		},
		});
	}
	catch(e)
	{
		eventThrowException(e);
	}
}


function deleteAction()
{
	try
	{
		var urlForSend = "core/php/clearAllLogs.php?format=json";
		var data = "";
		$.ajax({
			url: urlForSend,
			dataType: "json",
			data,
			type: "POST",
			success(data)
			{

			}
		});
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

function deleteLogPopup()
{
	try
	{
		if(popupSettingsArray.deleteLog == "true")
		{
			showPopup();
			var title = filterTitle(document.getElementById("title").innerHTML);
			document.getElementById("popupContentInnerHTMLDiv").innerHTML = "<div class=\"settingsHeader\" >Are you sure you want to delete this log?</div><br><div style=\"width:100%;text-align:center;padding-left:10px;padding-right:10px;\">"+title+"</div><div><div class=\"link\" onclick=\"deleteLog();hidePopup();\" style=\"margin-left:125px; margin-right:50px;margin-top:35px;\">Yes</div><div onclick=\"hidePopup();\" class=\"link\">No</div></div>";
		}
		else
		{
			deleteLog();
		}
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

function deleteLog()
{
	try
	{
		var urlForSend = "core/php/deleteLog.php?format=json";
		var title = filterTitle(document.getElementById("title").innerHTML);
		title = title.replace(/\s/g, "");
		var data = {file: title};
		name = title;
		$.ajax({
			url: urlForSend,
			dataType: "json",
			data,
			type: "POST",
			success(data)
			{
				removeLogByName(data);
			}
		});
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

function filterTitle(title)
{
	try
	{
		if(title.substring(0, title.indexOf("|")) !== null && title.substring(0, title.indexOf("|")) !== "")
		{
			title = title.substring(0, title.indexOf("|"));
		}
		return title;
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

function installUpdates()
{
	try
	{
		displayLoadingPopup();
		//reset vars in post request
		var urlForSend = "core/php/resetUpdateFilesToDefault.php?format=json";
		var data = {status: "" };
		$.ajax(
		{
			url: urlForSend,
			dataType: "json",
			data,
			type: "POST",
			complete(data)
			{
				//set thing to check for updated files. 	
				timeoutVar = setInterval(function(){verifyChange();},3000);
			}
		});
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

function verifyChange()
{
	try
	{
		var urlForSend = "update/updateActionCheck.php?format=json";
		var data = {status: "" };
		$.ajax(
		{
			url: urlForSend,
			dataType: "json",
			data,
			type: "POST",
			success(data)
			{
				if(data == "finishedUpdate")
				{
					clearInterval(timeoutVar);
					actuallyInstallUpdates();
				}
			}
		});
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

function actuallyInstallUpdates()
{
	try
	{
		$("#settingsInstallUpdate").submit();
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

function checkForUpdateMaybe()
{
	try
	{
		if (autoCheckUpdate == true)
		{
			if(daysSinceLastCheck > (daysSetToUpdate - 1))
			{
				daysSinceLastCheck = -1;
				checkForUpdates("","Log-Hog", currentVersion, "settingsInstallUpdate", false, dontNotifyVersion);
			}
		}
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

function showPauseButton()
{
	try
	{
		document.getElementById("pauseImage").style.display = "inline-block";
		document.getElementById("playImage").style.display = "none";
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

function showPlayButton()
{
	try
	{
		document.getElementById("pauseImage").style.display = "none";
		document.getElementById("playImage").style.display = "inline-block";
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

function showRefreshButton()
{
	try
	{
		document.getElementById("refreshImage").style.display = "inline-block";
		document.getElementById("refreshingImage").style.display = "none";
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

function showRefreshingButton()
{
	try
	{
		document.getElementById("refreshImage").style.display = "none";
		document.getElementById("refreshingImage").style.display = "inline-block";
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

function updateProgressBar(additonalPercent, text, topText = "Loading...")
{
	try
	{
		if(firstLoad)
		{
			percent = percent + additonalPercent;
			progressBar.set(percent);
			$("#progressBarSubInfo").empty();
			$("#progressBarSubInfo").append(text);
			$("#progressBarMainInfo").empty();
			$("#progressBarMainInfo").append(topText);
		}
	}
	catch(e)
	{
		eventThrowException(e);
	}
}

$(document).ready(function()
{
	progressBar = new ldBar("#progressBar");
	resize();
	updateProgressBar(10, "Generating File List");
	window.onresize = resize;
	window.onfocus = focus;

	refreshAction();

	if(pausePollFromFile)
	{
		pausePoll = true;

	}
	else
	{
		startPollTimer();
	}

	if(pausePollOnNotFocus)
	{
		startPauseOnNotFocus();
	}

	checkForUpdateMaybe();


	$("#searchFieldInput").on("input", function()
	{
		update(arrayOfDataMain);
	});
});