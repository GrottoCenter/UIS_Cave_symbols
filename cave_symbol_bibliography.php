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
$bibliography = getGuiValue($doc,"bibliography",$language);
$languageChoice = getGuiValue($doc,"languageChoice",$language);
$backToSymbolchoice = getGuiValue($doc,"backToSymbolchoice",$language);

$script = null;
//write Header
writeHeader($title,$UISworkingGroup,$script);

print "<h4>$bibliography:</h4>\n";

print "<ul>\n";
print "<li>D&eacute;riaz P. (1991): Compte-rendu de la Rencontre Internationale de Topographie. - Actes du 9e Congr&egrave;s National de la SSS, Charmey 1991.</li>\n";
print "<li>Fabre et al. (1978): Signes sp&eacute;l&eacute;ologiques conventionnels. - UIS / AFK.</li>\n";
print "<li>M&uuml;ller R. (1980): Symbole f&uuml;r H&ouml;hlenpl&auml;ne. - Beitr&auml;ge zur H&ouml;hlen- und Karstkunde in S&uuml;dwestdeutschland, 22, 1980.</li>\n";
print "<li>Grossenbacher Y. (1992): H&ouml;hlenvermessung. - SGH-Kurs Nr. 4</li>\n";
print "</ul>\n";

print "<p><a href=\"cave_symbol.php?languageSelection=$language\">$backToSymbolchoice</a>, <a href=\"index.php\">$languageChoice</a></p>\n";
print "</form>\n";
//close HTML
writeHTMLEnd();
?>
