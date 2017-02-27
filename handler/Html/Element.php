<?php


namespace Html;


/**
 * Class Element
 * @package Html
 */
class Element
{
    /**
     * @var ElementInterface
     */
    private $data;

    /**
     * @var string
     */
    private $require;

    /**
     * @var array
     */
    private $elements = [];

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function require (string $filename)
    {
        $this->require = $filename;
    }

    /**
     * @param string $placeHolder
     * @param $content
     */
    function addElement(string $placeHolder, $content)
    {
        $this->elements[$placeHolder] = $content;
    }

    public function elements()
    {
        return $this->elements;
    }

    public function render()
    {
        // original
        ob_start();
        require $this->require;
        $content = ob_get_clean();

        // sub-0
        foreach ($this->elements as $placeHolder => $element) {

            $this->data = $element->data;

            ob_start();
            require $element->require;
            $childContent = ob_get_clean();

            if ($placeHolder != '') {
                $content = preg_replace("/$placeHolder/", $childContent, $content);
            }

            // sub-1
            if (count($element->elements)) {
                foreach ($element->elements as $subPlaceHolder => $subelement) {

                    $this->data = $subelement->data;

                    ob_start();
                    require $subelement->require;
                    $subchildContent = ob_get_clean();

                    if ($placeHolder != '') {
                        $content = preg_replace("/$subPlaceHolder/", $subchildContent, $content);
                    }

                    // sub-2
                    if (count($subelement->elements)) {
                        foreach ($subelement->elements as $sub2PlaceHolder => $sub2Element) {

                            $this->data = $sub2Element->data;

                            ob_start();
                            require $sub2Element->require;
                            $sub2childContent = ob_get_clean();

                            if ($placeHolder != '') {
                                $content = preg_replace("/$sub2PlaceHolder/", $sub2childContent, $content);
                            }
                        }
                    }
                }
            }
        }

        return $content;
    }

}