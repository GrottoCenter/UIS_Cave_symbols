<?php
include "cave_symbol_functions.php";
//get form parameters
$language = $_GET["languageSelection"];

$doc = new DOMDocument();
$doc->validateOnParse = true;
$doc->load("guiElements.xml");

//get relevant gui data
$title = getGuiValue($doc,"title",$language);
$UISworkingGroup = getGuiValue($doc,"UISworkingGroup",$language);
$introList = getGuiValue($doc,"introList",$language);
$president = getGuiValue($doc,"president",$language);
$webprogramming = getGuiValue($doc,"webprogramming",$language);
$manyThanks = getGuiValue($doc,"manyThanks",$language);
$languageChoice = getGuiValue($doc,"languageChoice",$language);
$backToSymbolchoice = getGuiValue($doc,"backToSymbolchoice",$language);
$translationTo = getGuiValue($doc,"translationTo",$language);
$initialList = getGuiValue($doc,"initialList",$language);
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

$docText = new DOMDocument();
$docText->validateOnParse = true;
$docText->load("additional_text.xml");

$authorsText = dumpText($docText,"aboutTheAuthor",$language);

print "$authorsText\n";

print "<h4>$president:</h4>\n";
print "<p>Philipp H&auml;uselmann<br/>Giebelweg 6<br/>CH-3323 Baeriswil (Switzerland)</p><p>Tel: ++41-77-426 23 90<br/>e-mail: praezis (at) speleo (dot) ch</p>\n";

print "<h4>$webprogramming:</h4>\n";
print "<p>Andreas Neumann<br/>B&ouml;schacherstrasse 10a<br/>CH-8624 Gr&uuml;t (Switzerland)</p><p>Tel: ++41-44-944 72 66<br/>WWW: <a href=\"http://www.carto.net/neumann/\" target=\"_new\">http://www.carto.net/neumann/</a><br/>e-mail: a.neumann (at) carto (dot) net</p>\n";

print "<h4>$manyThanks:</h4>\n";

print "<ul>\n";
print "<li>J.P. Aulas</li>\n";
print "<li>Ana Boian (".$translationTo." ".$languages['romanian'].")</li>\n";
print "<li>J.C. Burgers (".$translationTo." ".$languages['dutch'].")</li>\n";
print "<li>Noyan Guner, Fatih Buyuktopcu (".$translationTo." ".$languages['turkish'].")</li>\n";
print "<li>G. Ferrari (".$translationTo." ".$languages['italian'].")</li>\n";
print "<li>Fabio Kok Geribello (".$translationTo." ".$languages['portuguese'].")</li>\n";
print "<li>V. Grandjean</li>\n";
print "<li>Ionut Iosifescu (".$translationTo." ".$languages['romanian']." - GUI elements)</li>\n";
print "<li>L. Marusic (".$translationTo." ".$languages['slovene'].")</li>\n";
print "<li>Peter Matthews</li>\n";
print "<li>I. Mercolli</li>\n";
print "<li>C. Osan (".$translationTo." ".$languages['romanian'].")</li>\n";
print "<li>N. Ruder</li>\n";
print "<li>M. & J.L. Regez</li>\n";
print "<li>Yvo Weidmann (".$initialList.")</li>\n";
print "<li>Wookey</li>\n";
print "<li>R. Zeleznjak (".$translationTo." ".$languages['croatian'].")</li>\n";
print "</ul>\n";

print "<p><a href=\"cave_symbol.php?languageSelection=$language\">$backToSymbolchoice</a>, <a href=\"index.php\">$languageChoice</a></p>\n";
print "</form>\n";
//close HTML
writeHTMLEnd();
?>
