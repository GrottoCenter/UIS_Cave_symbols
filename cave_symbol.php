<?php
include "cave_symbol_functions.php";
$language = $_GET["languageSelection"];

$doc = new DOMDocument();
$doc->validateOnParse = true;
$doc->load("guiElements.xml");

//get all gui data
$title = getGuiValue($doc,"title",$language);
$UISworkingGroup = getGuiValue($doc,"UISworkingGroup",$language);
$languageChoice = getGuiValue($doc,"languageChoice",$language);
$introList = getGuiValue($doc,"introList",$language);
$bibliography = getGuiValue($doc,"bibliography",$language);
$aboutAuthors = getGuiValue($doc,"aboutAuthors",$language);
$selectOneOfFollowing = getGuiValue($doc,"selectOneOfFollowing",$language);
$planSymbol = getGuiValue($doc,"planSymbol",$language);
$profileSymbol = getGuiValue($doc,"profileSymbol",$language);
$explanations = getGuiValue($doc,"explanations",$language);
$translations = getGuiValue($doc,"translations",$language);
$photos = getGuiValue($doc,"photos",$language);
$selectAllSymbols = getGuiValue($doc,"selectAllSymbols",$language);
$selectNoSymbol = getGuiValue($doc,"selectNoSymbol",$language);
$invertSelection = getGuiValue($doc,"invertSelection",$language);
$showSelectedSymbols = getGuiValue($doc,"showSelectedSymbols",$language);
$somePlatformsRequire = getGuiValue($doc,"somePlatformsRequire",$language);
$getListAsPDF = getGuiValue($doc,"getListAsPDF",$language);
$forPrinting = getGuiValue($doc,"forPrinting",$language);
$backToSymbolchoice = getGuiValue($doc,"backToSymbolchoice",$language);
$selectOtherSymbol = getGuiValue($doc,"selectOtherSymbol",$language);

$script = "<script type=\"text/javascript\">
<!--
function selectAll() {
	var selectList = document.getElementById(\"symbolChoice\");
	n = selectList.options.length;
	for(i=0;i<n;i++) {
		selectList.options[i].selected = true;
	}
}
function selectNone() {
	var selectList = document.getElementById(\"symbolChoice\");
	n = selectList.options.length;
	for(i=0;i<n;i++) {
		selectList.options[i].selected = false;
	}
}
function selectInvert() {
	var selectList = document.getElementById(\"symbolChoice\");
	n = selectList.options.length;
	for(i=0;i<44;i++) {
		if (selectList.options[i].selected == true) {
			selectList.options[i].selected = false;
		}
		else {
			selectList.options[i].selected = true;
		}
	}
}
//-->
</script>";

//write Header
writeHeader($title,$UISworkingGroup,$script);

//print form begin
print "<form action=\"cave_symbol_detail.php\">\n";
print "<table width=\"100%\"><tr><td><a href=\"cave_symbol_intro.php?languageSelection=$language\">$introList</a></td><td align=\"center\"><a href=\"cave_symbol_bibliography.php?languageSelection=$language\">$bibliography</a></td><td align=\"right\"><a href=\"cave_symbol_authors.php?languageSelection=$language\">$aboutAuthors</a></td></tr></table>\n";
print "<table width=\"100%\"><tr><td valign=\"top\" width=\"40%\">\n";
print "<p>$selectOneOfFollowing <br />\n<br />\n";
print "<select id=\"symbolChoice\" name=\"symbolChoice[]\" size=\"25\" multiple>\n";


$sDdoc = new DOMDocument();
$sDdoc->validateOnParse = true;
$sDdoc->load("symbol_data.xml");

$root = $sDdoc->documentElement;
$child = $root->firstChild;
while ($child) {
	if ($child->nodeType == 1) {
		if ($child->nodeName == "cave_symbol") {
			$value = $child->getAttribute("id");
			$content = getSymbolName($child,$language);
			print "<option value=\"$value\">$content</option>\n";
		}
	}
	$child = $child->nextSibling;
}

print "</select>\n";
print "</p><p>$somePlatformsRequire</p></td><td valign=\"top\">\n";
//print checkboxes
print "<table width=\"100%\"><tr><td><input type=\"checkbox\" name=\"planSymbol\" value=\"$planSymbol\" checked /> $planSymbol</td>\n";
print "<td><input type=\"checkbox\" name=\"profileSymbol\" value=\"$profileSymbol\" checked /> $profileSymbol</td>\n";
print "<td><input type=\"checkbox\" name=\"explanations\" value=\"$explanations\" checked /> $explanations</td>\n";
print "<td><input type=\"checkbox\" name=\"translations\" value=\"$translations\" checked /> $translations</td>\n";
print "<td><input type=\"checkbox\" name=\"photos\" value=\"$photos\" checked /> $photos</td></tr></table>\n";

//print buttons for selection inversion etc.
print "<table width=\"100%\"><tr><td><input type=\"button\" value=\"$selectAllSymbols\" onclick=\"selectAll()\" /></td>\n";
print "<td><input type=\"button\" value=\"$selectNoSymbol\" onclick=\"selectNone()\" /></td>\n";
print "<td><input type=\"button\" value=\"$invertSelection\" onclick=\"selectInvert()\" /></td></table>\n";

//print submit button
print "<input type=\"hidden\" name=\"languageSelection\" value=\"$language\" />\n";
print "<p><input type=\"submit\" value=\" $showSelectedSymbols \" /><br /><br />\n";
print "<a href=\"uis_signatures_".$language.".pdf\" target=\"_new\">$getListAsPDF</a> ($forPrinting)</p>\n";

print "</td></tr></table>\n";
print "</form>\n";

print "<p><a href=\"index.php\">$languageChoice</a></p>\n";
//close HTML
writeHTMLEnd();
?>
