function postDataGetText(urlToCall, dataToSend, functionToCallBack, resultDiv, progressDiv)
{ 
  var XMLHttpRequestObject = false; 

  if (window.XMLHttpRequest) {
    XMLHttpRequestObject = new XMLHttpRequest();
  } else if (window.ActiveXObject) {
    XMLHttpRequestObject = new 
     ActiveXObject("Microsoft.XMLHTTP");
  }

  if(XMLHttpRequestObject) {
    XMLHttpRequestObject.open("POST", urlToCall); 
    XMLHttpRequestObject.setRequestHeader('Content-Type', 
      'application/x-www-form-urlencoded'); 

    XMLHttpRequestObject.onreadystatechange = function() 
    { 
      if (XMLHttpRequestObject.readyState == 4 && 
        XMLHttpRequestObject.status == 200) {
          functionToCallBack(XMLHttpRequestObject.responseText, resultDiv, progressDiv); 
          delete XMLHttpRequestObject;
          XMLHttpRequestObject = null;
      } 
    }

    XMLHttpRequestObject.send(dataToSend); 
  }
}
function showprogress(divID, message) {
	document.getElementById(divID).innerHTML='<img src = http://kishoreasokan.com/images/ajax-loader.gif align = center>' + message;
}
function displayMode(text, resultDiv, progressDiv) {        
		document.getElementById(progressDiv).innerHTML = '<img src = http://eref.in/ajaxmod/blank.gif align = center>';
		document.getElementById(resultDiv).innerHTML = text;
}
function getVar(v) {
	var retval;
	retval = document.getElementById(v).value; 
	return retval;
}
