<?php
require_once "/path/to/jbbcode/Parser.php";

$parser = new\App\Libraries\JBBCode\Parser();
$parser->addCodeDefinitionSet(new\App\Libraries\JBBCode\DefaultCodeDefinitionSet());

$text = "The default codes include: [b]bold[/b], [i]italics[/i], [u]underlining[/u], ";
$text .= "[url=http://jbbcode.com]links[/url], [color=red]color![/color] and more.";

$parser->parse($text);

print $parser->getAsHtml();
