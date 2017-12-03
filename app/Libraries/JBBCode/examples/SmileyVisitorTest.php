<?php

require_once("../Parser.php");
require_once("../visitors/SmileyVisitor.php");

error_reporting(E_ALL);

$parser = new \App\Libraries\JBBCode\Parser();
$parser->addCodeDefinitionSet(new \App\Libraries\JBBCode\DefaultCodeDefinitionSet());

if (count($argv) < 2) {
    die("Usage: " . $argv[0] . " \"bbcode string\"\n");
}

$inputText = $argv[1];

$parser->parse($inputText);

$smileyVisitor = new \App\Libraries\JBBCode\visitors\SmileyVisitor();
$parser->accept($smileyVisitor);

echo $parser->getAsHTML() . "\n";
