<?php
include "cave_symbol_functions.php";
//get form parameters
$language = $_GET["languageSelection"];
$planSymbolF = $_GET["planSymbol"];
$profileSymbolF = $_GET["profileSymbol"];
$explanationsF = $_GET["explanations"];
$translationslF = $_GET["translations"];
$photosF = $_GET["photos"];
$symbolChoice = $_GET["symbolChoice"]; //this is now an array

$doc = new DOMDocument();
$doc->validateOnParse = true;
$doc->load("guiElements.xml");

//get relevant gui data
$title = getGuiValue($doc,"title",$language);
$UISworkingGroup = getGuiValue($doc,"UISworkingGroup",$language);
$languageChoice = getGuiValue($doc,"languageChoice",$language);
$symbol = getGuiValue($doc,"symbol",$language);
$planSymbol = getGuiValue($doc,"planSymbol",$language);
$profileSymbol = getGuiValue($doc,"profileSymbol",$language);
$backToSymbolchoice = getGuiValue($doc,"backToSymbolchoice",$language);
$explanations = getGuiValue($doc,"explanations",$language);
$translations = getGuiValue($doc,"translations",$language);
$photos = getGuiValue($doc,"photos",$language);
$photographer = getGuiValue($doc,"photographer",$language);
$cave = getGuiValue($doc,"cave",$language);
//get all languages
$languages = array();
$lanElement = $doc->getElementById("languages".$language);
$lanChild = $lanElement->firstChild;
while ($lanChild) {
	if ($lanChild->nodeType == 1) {
		$key = $lanChild->nodeName;
		$value = $lanChild->nodeValue;
		$languages[$key] = $value;
	}
	$lanChild = $lanChild->nextSibling;
}

$script = null;
//write Header
writeHeader($title,$UISworkingGroup,$script);

$sDdoc = new DOMDocument();
$sDdoc->validateOnParse = true;
$sDdoc->load("symbol_data.xml");

if (count($symbolChoice) > 0) {
//print out all symboldata
foreach ($symbolChoice as $symbolId) {
	//extract symboldata
	$symbolNode = $sDdoc->getElementById($symbolId);
	$symbolName = getSymbolName($symbolNode,$language);
	$hasProfileSymbol = $symbolNode->getAttribute("hasProfileSymbol");
	
	print "<p><table bgcolor=\"white\" width=\"100%\" cellpadding=\"10\">\n";
	print "<tr><td colspan=\"2\"><h3>".$symbol.": ".$symbolName."</h3></td></tr>\n";
	if ($hasProfileSymbol == "true") {
		print "<tr><td><h4>$planSymbol</h4></td><td><h4>$profileSymbol</h4></td></tr>\n";
		print "<tr><td><img src=\"".$symbolId."_plan.gif\" alt=\"$symbolName\" width=\"281\" height=\"142\" /></td>\n";
		print "<td><img src=\"".$symbolId."_cut.gif\" alt=\"$symbolName\" width=\"281\" height=\"142\" /></td></tr>\n";
	}
	else {
		print "<tr><td colspan=\"2\"><h4>$planSymbol</h4></td></tr>\n";	
		print "<tr><td colspan=\"2\"><img src=\"".$symbolId."_plan.gif\" alt=\"$symbolName\" width=\"281\" height=\"142\" /></td></tr>\n";
	}
	if ($explanationsF) {
		$explanation = getExplanations($symbolNode,$language);
		print "<tr><td colspan=\"2\"><h4>$explanations:</h4>\n";
		print "<p>$explanation</p></td></tr>\n";
	}
	if ($translationslF) {
		$translationArray = getSymbolTranslations($symbolNode);
		print "<tr><td colspan=\"2\"><h4>$translations:</h4><p>\n";
		foreach ($translationArray as $key => $value) {
			if ($key != $language) {
				print $languages[$key].": $value<br />\n";
			}
		}
		print "</p></td></tr>\n";		
	}
	if ($photosF) {
		if (checkHasPhotos($symbolNode)) {
			$photoData = returnPhotoData($symbolNode,$language);
			print "<tr><td colspan=\"2\"><h4>$photos:</h4>\n";
			foreach ($photoData as $photoDataArray) {
				print "<p><img src=\"photos/".$photoDataArray['filename']."\" alt=\"".$photoDataArray['title']."\" width=\"".$photoDataArray['width']."\" height=\"".$photoDataArray['height']."\" /><br />".$photoDataArray['title'];
				if ($photoDataArray['photographer']) {
					print ", $photographer: ".$photoDataArray['photographer'];
				}
				if ($photoDataArray['year']) {
					print " (".$photoDataArray['year'].")";
				}
				if ($photoDataArray['caveRegionName']) {
					print ", $cave: ".$photoDataArray['caveRegionName'];
				}
				print "</p>\n";
			}
			print "</tr>\n";
		}
	}
	print "</table></p>\n";
}
}

print "<p><a href=\"cave_symbol.php?languageSelection=$language\">$backToSymbolchoice</a>, <a href=\"index.php\">$languageChoice</a></p>\n";
print "</form>\n";
//close HTML
writeHTMLEnd();
?>
