<?php
include "cave_symbol_functions.php";
$language = "english";

$doc = new DOMDocument();
$doc->validateOnParse = true;
$doc->load("guiElements.xml");

//get relevant gui data
$title = getGuiValue($doc,"title",$language);
$UISworkingGroup = getGuiValue($doc,"UISworkingGroup",$language);

$script = null;
//write Header
writeHeader($title,$UISworkingGroup,$script);

print "<form action=\"cave_symbol.php\">\n";
print "<p>Please select one of the following languages:\n";
print "<select name=\"languageSelection\">\n";

$introListNode = $doc->getElementById("introList");
$child = $introListNode->firstChild;
while ($child) {
	if ($child->nodeType == 1) {
		print "<option>".$child->nodeName."</option>";
	}
	$child = $child->nextSibling;
}

print "</select>\n";
print "<input type=\"submit\" value=\" Go \">\n";
print "</p>\n";
print "<p><img src=\"title_graphics.png\" width=\"600\" height=\"583\" alt=\"Title Graphics\" /></p>\n";
print "<p><a href=\"missing_a_language.php\">Missing a Language? Feedback to the list? Having a good photo contribution about a Speleotheme?</a></p>\n";
print "</form>\n";
?>
