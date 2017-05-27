<?php


namespace App\Service;


class File
{
    /**
     * @var string
     */
    private $fileName = '';

    /**
     * @param string $fileName
     * @return string
     * @throws \Exception
     */
    public function maintainUnit(string $fileName)
    {
        if (!file_exists($fileName)) {
            throw new \Exception(sprintf('Not found, file `%s` for %s ', $fileName, __METHOD__));
        }
        $this->fileName = $fileName;
        return $this;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function get()
    {
        if (false === ($contents = @file_get_contents($this->fileName))) {
            throw new \Exception(sprintf('Could not get content, file `%s` for %s ', $this->fileName, __METHOD__));
        }

        return explode("\n", $contents);
    }
}