<?php
include "cave_symbol_functions.php";
$language = "english";

if (!$dom = domxml_open_file("guiElements.xml",DOMXML_LOAD_VALIDATING)) {
  echo "Error while parsing the document\n";
  exit;
}

//get relevant gui data
$title = getGuiValue($dom,"title",$language);
$UISworkingGroup = getGuiValue($dom,"UISworkingGroup",$language);

$script = null;
//write Header
writeHeader($title,$UISworkingGroup,$script);

print "<h3>Missing a Language? Do you want to provide feedback on our list? Do you have a interesting photo to contribute to our list?</h3>";

print "<p>Are you willing to translate the list into your language? Or do you know some person that is willing to do so? We'd like to have this list as complete as possible and therefore appreciate other persons contributing in translation.</p>\n";

print "<p>We recently introduced accompanying photos to illustrate the speleothemes in the symbols. If you have an interesting photo contribution to do, we'd be happy to integrate it in the list.</p>\n";

print "<p>Feel free to contact the authors per <a href=\"mailto:praezis@geo.unibe.ch,neumann@karto.baug.ethz.ch?subject=Symbol-List\">mail</a>. Thanks for your contributions.</p>\n";

print "<p><a href=\"index.php\">Back to Start Page</a></p></p>\n";
print "</form>\n";
?>
