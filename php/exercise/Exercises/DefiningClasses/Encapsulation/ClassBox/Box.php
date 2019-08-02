<?php

class Box
{
    /**
     * @var float
     */
    private $length;

    /**
     * @var float
     */
    private $width;

    /**
     * @var float
     */
    private $height;

    public function __construct(float $length, float $width, float $height)
    {
        $this->setLength($length);
        $this->setWidth($width);
        $this->setHeight($height);
    }

    /**
     * @return float
     */
    public function getLength(): float
    {
        return $this->length;
    }

    /**
     * @return float
     */
    public function getWidth(): float
    {
        return $this->width;
    }

    /**
     * @return float
     */
    public function getHeight(): float
    {
        return $this->height;
    }

    /**
     * @param float $length
     */
    private function setLength(float $length)
    {
        $this->length = $length;
    }

    /**
     * @param float $width
     */
    private function setWidth(float $width)
    {
        $this->width = $width;
    }

    /**
     * @param float $height
     */
    private function setHeight(float $height)
    {
        $this->height = $height;
    }

    private function getVolume() : float
    {
        $result = $this->getLength() * $this->getWidth() * $this->getHeight();
        return $result;
    }

    private function getLateralSurfaceArea(){
        $result = (2 * $this->getLength() * $this->getHeight()) +
            (2 * $this->getWidth() * $this->getHeight());
        return $result;
    }

    private function getSurfaceArea(){
        $result = (2 * $this->getLength() * $this->getWidth()) +
            (2 * $this->getLength() * $this->getHeight()) +
            (2 * $this->getWidth() * $this->getHeight());
        return $result;
    }


    public function __toString()
    {
       $volume = number_format($this->getVolume(), 2, '.', '');
       $lateralSurfaceArea = number_format($this->getLateralSurfaceArea(), 2,
                '.', '');
       $surfaceArea = number_format($this->getSurfaceArea(), 2,
           '.', '');

       return "Surface Area – {$surfaceArea}\nLateral Surface Area – {$lateralSurfaceArea}\nVolume - {$volume}\n";
    }

}




