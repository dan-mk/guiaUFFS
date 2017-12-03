<?php

require_once("../Parser.php");
require_once("../visitors/TagCountingVisitor.php");

error_reporting(E_ALL);

$parser = new \App\Libraries\JBBCode\Parser();
$parser->addCodeDefinitionSet(new \App\Libraries\JBBCode\DefaultCodeDefinitionSet());

if (count($argv) < 3) {
    die("Usage: " . $argv[0] . " \"bbcode string\" <tag name to check>\n");
}

$inputText = $argv[1];
$tagName = $argv[2];

$parser->parse($inputText);

$tagCountingVisitor = new \App\Libraries\JBBCode\visitors\TagCountingVisitor();
$parser->accept($tagCountingVisitor);

echo $tagCountingVisitor->getFrequency($tagName) . "\n";
