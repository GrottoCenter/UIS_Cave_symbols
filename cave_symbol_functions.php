<?php
//write HTML header
function writeHeader($title,$subtitle,$script) {
	header("Content-type: text/html");
	print "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
	print "<!DOCTYPE html PUBLIC \"-//AndiNeumann//DTD XHTML-with extended modules//EN\" \"../../resources/xhtml-extended.dtd\">\n";
	print "<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\">\n";
	print "<head>\n";
	print "<title>$title</title>\n";
	print "<meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\" />\n";
	print "<meta name=\"author\" content=\"Andreas Neumann\" />\n";
	print "<meta name=\"keywords\" content=\"UIS, cave symbols, list\" />\n";
	if ($script) {
		print "$script\n";
	}
	print "</head>\n";
	print "<body bgcolor=\"lightgrey\">\n";
	print "<h1>$title</h1>\n";
	print "<h2>$subtitle</h2>\n";
}

//extract content of a GUI-element according to language
function getGuiValue($doc,$id,$language) {
	$parentNode = $doc->getElementById($id);
	$nodeList = $parentNode->getElementsByTagName($language);
	$content = $nodeList->item(0)->nodeValue;
	return $content;
}

//extract content of a text element without escaping tags
function dumpText($doc,$id,$language) {
	$parentNode = $doc->getElementById($id);
	$nodeList = $parentNode->getElementsByTagName($language);
	$content = $doc->saveXML($nodeList->item(0));
	return $content;
}

//extract symbolName, input is dom node of name "cave_symbol"
function getSymbolName($node,$language) {
	$child = $node->firstChild;
	while ($child) {
		if ($child->nodeType == 1) {
			if ($child->nodeName == "translationsSymbolName") {
				$content = getChildContent($child,$language);
				break;
			}
		}
		$child = $child->nextSibling;
	}
	return $content;
}

//extract symbolNames for all languages, input is dom node of name "cave_symbol"
function getSymbolTranslations($node) {
	$child = $node->firstChild;
	$content = array();
	while ($child) {
		if ($child->nodeType == 1) {
			if ($child->nodeName == "translationsSymbolName") {
				$grandchild = $child->firstChild;
				while ($grandchild) {
					if ($grandchild->nodeType == 1) {
						$language = $grandchild->nodeName;
						$content[$language] = $grandchild->nodeValue;
					}
					$grandchild = $grandchild->nextSibling;
				}
			}
		}
		$child = $child->nextSibling;
	}
	return $content;
}


//extract translationsData, input is dom node of name "cave_symbol"
function getExplanations($node,$language) {
	$child = $node->firstChild;
	while ($child) {
		if ($child->nodeType == 1) {
			if ($child->nodeName == "translationsExplanations") {
				$content = getChildContent($child,$language);
				$content = str_replace("\\n","<br />",$content);
				break;
			}
		}
		$child = $child->nextSibling;
	}
	return $content;
}

//return content of a child of a node with a specific node_name
function getChildContent($node,$node_name) {
	$child = $node->firstChild;
	while ($child) {
		if ($child->nodeType == 1) {
			if ($child->nodeName == $node_name) {
				$content = $child->nodeValue;
				break;
			}
		}
		$child = $child->nextSibling;
	}
	return $content;
}

//check if a dom node has photo child nodes
function checkHasPhotos($node) {
	$child = $node->firstChild;
	while ($child) {
		if ($child->nodeType == 1) {
			if ($child->nodeName == "photos") {
				if ($child->hasChildNodes()) {
					return true;
				}
				else {
					return false;
				}
				break;
			}
		}
		$child = $child->nextSibling;
	}
}

//check if a dom node has photo child nodes
function returnPhotoData($node,$language) {
	$child = $node->firstChild;
	$photoDat = array();
	while ($child) {
		if ($child->nodeType == 1) {
			if ($child->nodeName == "photos") {
				$photoElement = $child->firstChild;
				while ($photoElement) {
					if ($photoElement->nodeType == 1) {
						$photoData = array();
						$photoData["filename"] = $photoElement->getAttribute("filename");
						$photoData["title"] = getChildContent($photoElement,$language);
						$photoData["width"] = $photoElement->getAttribute("width");
						$photoData["height"] = $photoElement->getAttribute("height");
						$photoData["photographer"] = $photoElement->getAttribute("photographer");
						$photoData["caveRegionName"] = $photoElement->getAttribute("caveRegionName");
						$photoData["year"] = $photoElement->getAttribute("year");
						array_push($photoDat,$photoData);
					}
					$photoElement = $photoElement->nextSibling;
				}
				break;
			}
		}
		$child = $child->nextSibling;
	}
	return $photoDat;
}

//write closing of HTML file
function writeHTMLEnd() {
	print "</body>\n";
	print "</html>\n";
}
?>
