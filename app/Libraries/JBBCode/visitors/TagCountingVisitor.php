<?php

namespace App\Libraries\JBBCode\visitors;

/**
 * This visitor traverses parse graph, counting the number of times each
 * tag name occurs.
 *
 * @author jbowens
 * @since January 2013
 */
class TagCountingVisitor implements \App\Libraries\JBBcode\NodeVisitor
{
    protected $frequencies = array();

    public function visitDocumentElement(\App\Libraries\JBBCode\DocumentElement $documentElement)
    {
        foreach ($documentElement->getChildren() as $child) {
            $child->accept($this);
        }
    }

    public function visitTextNode(\App\Libraries\JBBCode\TextNode $textNode)
    {
        // Nothing to do here, text nodes do not have tag names or children
    }

    public function visitElementNode(\App\Libraries\JBBCode\ElementNode $elementNode)
    {
        $tagName = strtolower($elementNode->getTagName());

        // Update this tag name's frequency
        if (isset($this->frequencies[$tagName])) {
            $this->frequencies[$tagName]++;
        } else {
            $this->frequencies[$tagName] = 1;
        }

        // Visit all the node's childrens
        foreach ($elementNode->getChildren() as $child) {
            $child->accept($this);
        }

    }

    /**
     * Retrieves the frequency of the given tag name.
     *
     * @param string $tagName the tag name to look up
     *
     * @return integer
     */
    public function getFrequency($tagName)
    {
        if (!isset($this->frequencies[$tagName])) {
            return 0;
        } else {
            return $this->frequencies[$tagName];
        }
    }

}
