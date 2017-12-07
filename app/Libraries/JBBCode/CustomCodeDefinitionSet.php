<?php

namespace App\Libraries\JBBCode;

require_once 'CodeDefinition.php';
require_once 'CodeDefinitionBuilder.php';
require_once 'CodeDefinitionSet.php';
require_once 'validators/CssColorValidator.php';
require_once 'validators/UrlValidator.php';

/**
 * Provides a default set of common bbcode definitions.
 *
 * @author jbowens
 */
class CustomCodeDefinitionSet implements CodeDefinitionSet
{

    /** @var CodeDefinition[] The default code definitions in this set. */
    protected $definitions = array();

    /**
     * Constructs the default code definitions.
     */
    public function __construct()
    {
        /* [destaque] bold tag */
        $builder = new CodeDefinitionBuilder('destaque', '<strong>{param}</strong>');
        $this->definitions[] = $builder->build();

        $urlValidator = new \App\Libraries\JBBCode\validators\UrlValidator();

        /* [link=http://example.com] link tag */
        $builder = new CodeDefinitionBuilder('link', '<a href="{option}" target="_blank">{param}</a>');
        $builder->setUseOption(true)->setParseContent(true)->setOptionValidator($urlValidator);
        $this->definitions[] = $builder->build();

        /* [imagem=alt text] image tag */
        $builder = new CodeDefinitionBuilder('imagem', '<img width="100%" style="margin: 20px 0" src="{param}" alt="{option}" />');
        $builder->setUseOption(true)->setParseContent(false)->setBodyValidator($urlValidator);
        $this->definitions[] = $builder->build();

		/* [subtitulo=id] subtitle tag */
        $builder = new CodeDefinitionBuilder('subtitulo', '<h2 id="{option}">{param}</h2>');
		$builder->setUseOption(true);
        $this->definitions[] = $builder->build();

		/* [importante] alert tag */
        $builder = new CodeDefinitionBuilder('importante', '<div class="alert alert-danger" role="alert">{param}</div>');
        $this->definitions[] = $builder->build();
    }

    /**
     * Returns an array of the default code definitions.
     *
     * @return CodeDefinition[]
     */
    public function getCodeDefinitions()
    {
        return $this->definitions;
    }

}
