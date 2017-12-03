<?php
require_once "/path/to/jbbcode/Parser.php";

$parser = new\App\Libraries\JBBCode\Parser();
$parser->addCodeDefinitionSet(new\App\Libraries\JBBCode\DefaultCodeDefinitionSet());

$text = "The bbcode in here [b]is never closed!";
$parser->parse($text);

print $parser->getAsBBCode();
