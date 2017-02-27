<?php


namespace Html;


class Composite
{
    private $headContent;

    /**
     * Elements that holds data (or callback to data) when render() was invoked.
     * @var array
     */
    private $elements = [];

    public function __construct()
    {

    }

    public function setHeadContent(\Html\Element $head)
    {
        $this->headContent = $head;
    }

    public function addElement($element)
    {
        $this->elements[] = $element;
    }

    public function render()
    {
        $renderBody = function() {
            $elements = '';
            foreach($this->elements as $element) {
                $elements .= $element->render();
            }
            return $elements;
        };

        return sprintf('<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
%s 
%s
</html>',
            sprintf('<head>%s</head>', $this->headContent->render()),
            sprintf('%s', $renderBody())
        );
    }

}