<?php
function kish_pr_js() {
?>
<script type="text/javascript">
function postDataGetTextPR(urlToCall, dataToSend, functionToCallBack, resultDiv, progressDiv)
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
function showprogressPR(divID, message) {
	document.getElementById(divID).innerHTML='<img src = <?php echo get_bloginfo('wpurl')."/wp-content/plugins/kish-translate-ajax/ajax-loader.gif"; ?> >' + message;
}
function displayModePR(text, resultDiv, progressDiv) {        
		document.getElementById(progressDiv).innerHTML = '<img src = http://eref.in/ajaxmod/blank.gif align = center>';
		document.getElementById(resultDiv).innerHTML = text;
}
function getVarPR(v) {
	var retval;
	retval = document.getElementById(v).value; 
	return retval;
}
</script>
<?php
}

function addHeaderCodeKishPR() {
	echo "<script type=\"text/javascript\" src=\"" . get_bloginfo('wpurl') . "/wp-content/plugins/kish-pr/kish-ajax.js\"></script>\n";
}
function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}
function printPR() {
	$rank = new GooglePR();
	$pr = $rank->GetPR(curPageURL());
	print "<a href = \"http://kish.in/ajax-wordpress-pagerank-plugin/\" alt = \"Pagerank plugin for wordpress\" title = \"Grab This Plugin\"><img src = " .get_option('siteurl')."/wp-content/plugins/kish-pr/img/".$pr.".jpeg /></a>";
}
function printPRWithURL($url) {
	$rank = new GooglePR();
	$pr = $rank->GetPR($url);
	print "<div class =\"pr\"><a href = \"http://kish.in/ajax-wordpress-pagerank-plugin/\" alt = \"Pagerank plugin for wordpress\"><img src = " .get_option('siteurl')."/wp-content/plugins/kish-pr/img/".$pr.".jpeg /></a></div>";
}
function printPRBox($width='', $bgcolor = '', $forecolor = '') {
	print "<div class = \"prbutton\" style =\"width:".$width."px;background-color: #".$bgcolor.";font-size:9px;  font-family:Verdana; color:#".$forecolor."; padding:3px;  margin-top:3px; margin-left:5px; border:solid 1px #".$forecolor."; font-weight:bold\">";
	print "<input type=\"text\" style =\"width:".($width-10)."px;background-color: #".$bgcolor.";font-size:9px;  font-family:Verdana; color:#".$forecolor.";border:solid 1px #".$forecolor."; \" id = \"txturl\" value=\"Enter the URL..\" onclick = \"this.value=''\"/><input style =\"margin-top:3px; background-color: #".$forecolor.";font-size:9px;  font-family:Verdana; color:#".$bgcolor."; margin-left:2px; border:solid 1px #".$forecolor."; \" class = \"prbutton\" type=\"button\" id =\"prbutton\" value=\"Check PR\" onclick = \"showprogressPR('prdiv', 'Getting the Page Rank...'); postDataGetTextPR('".get_bloginfo('wpurl')."/wp-content/plugins/kish-pr/kish-pr.php' , 'req=prurl&url=' + getVarPR('txturl') + '&ok=yes', displayModePR , 'prdiv', 'prdiv')\"/>";
	print "</div><div id =\"prdiv\" style =\"width:".$width."px; height:20px; background-color: #".$bgcolor.";font-size:9px;  font-family:Verdana; color:#".$forecolor."; padding:3px;  margin-top:3px; margin-left:5px; border:solid 1px #".$forecolor."; font-weight:bold\"><a href = \"http://kish.in/ajax-wordpress-pagerank-plugin/\" title = \"Page Rank Checking Plugin Wordpres\" target = \"_blank\">PR Checking Tool</a></div></div>";

}
//Widget Function
function widget_kishPRCurPage() {
  echo $before_widget;
  echo $before_title;?><?php echo $after_title;
  if (function_exists('printPR')) printPR();
  echo $after_widget;
}

function widget_kishPRCheckTool() {
	echo $before_widget;
  echo $before_title;?><?php echo $after_title;	
  if (function_exists('printPRBox')) printPRBox();
  echo $after_widget;
}

function kishPRWidget_init()
{
  register_sidebar_widget(__('Kish PR Current Page'), 'widget_kishPRCurPage');
  register_sidebar_widget(__('Kish PR Checking Tool'), 'widget_kishPRCheckTool');
}
?>