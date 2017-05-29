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
     * @return $this
     * @throws \Exception
     */
    public function maintainFileName(string $fileName)
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
    public function fileContents()
    {
        if (false === ($contents = @file_get_contents($this->fileName))) {
            throw new \Exception(sprintf('Could not get content, file `%s` for %s ', $this->fileName, __METHOD__));
        }

        return explode("\n", $contents);
    }
}