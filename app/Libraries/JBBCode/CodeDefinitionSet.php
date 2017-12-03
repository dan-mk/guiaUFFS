<?php

namespace App\Libraries\JBBCode;

require_once 'CodeDefinition.php';

use\App\Libraries\JBBCode\CodeDefinition;

/**
 * An interface for sets of code definitions.
 *
 * @author jbowens
 */
interface CodeDefinitionSet
{

    /**
     * Retrieves the CodeDefinitions within this set as an array.
     * @return CodeDefinition[]
     */
    public function getCodeDefinitions();

}
