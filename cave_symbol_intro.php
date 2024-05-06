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
$address = getGuiValue($doc,"address",$language);
$webprogramming = getGuiValue($doc,"webprogramming",$language);
$languageChoice = getGuiValue($doc,"languageChoice",$language);
$backToSymbolchoice = getGuiValue($doc,"backToSymbolchoice",$language);

$script = null;
//write Header
writeHeader($title,$UISworkingGroup,$script);

$docText = new DOMDocument();
$docText->validateOnParse = true;
$docText->load("additional_text.xml");

$introText = dumpText($docText,"intro",$language);

print "<h4>$introList</h4>\n";

print "$introText\n";

print "<h4>$address:</h4>\n";
print "<p>Philipp H&auml;uselmann<br/>Giebelweg 6<br/>CH-3323 Baeriswil (Switzerland)</p><p>Tel: ++41-77-426 23 90<br/>e-mail: praezis (at) speleo (dot) ch</p>\n";

print "<h4>$webprogramming:</h4>\n";
print "<p>Andreas Neumann<br/>B&ouml;schacherstrasse 10a<br/>CH-8624 Gr&uuml;t (Switzerland)</p><p>Tel: ++41-44-944 72 66<br/>WWW: <a href=\"http://www.carto.net/neumann/\" target=\"_new\">http://www.carto.net/neumann/</a><br/>e-mail: a.neumann (at) carto (dot) net</p>\n";

print "<p><a href=\"cave_symbol.php?languageSelection=$language\">$backToSymbolchoice</a>, <a href=\"index.php\">$languageChoice</a></p>\n";
print "</form>\n";
//close HTML
writeHTMLEnd();
?>
