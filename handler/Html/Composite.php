<?php


namespace Html;


class Composite
{
    private const HTML = <<<HTML
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
%s 
%s
</html>
HTML;

    private const HEAD = '<head>%s</head>';
    private const BODY = '%s';

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

        return sprintf(self::HTML,
            sprintf(self::HEAD, $this->headContent->render()),
            sprintf(self::BODY, $renderBody())
        );
    }

}