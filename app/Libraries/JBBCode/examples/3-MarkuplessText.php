<?php
require_once "/path/to/jbbcode/Parser.php";

$parser = new\App\Libraries\JBBCode\Parser();
$parser->addCodeDefinitionSet(new\App\Libraries\JBBCode\DefaultCodeDefinitionSet());

$text = "[b][u]There is [i]a lot[/i] of [url=http://en.wikipedia.org/wiki/Markup_language]markup[/url] in this";
$text .= "[color=#333333]text[/color]![/u][/b]";
$parser->parse($text);

print $parser->getAsText();
