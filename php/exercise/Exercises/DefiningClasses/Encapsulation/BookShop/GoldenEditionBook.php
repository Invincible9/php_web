<?php

class GoldenEditionBook extends Book
{
    public function IncreasePrice(){
       return parent::getPrice() * 1.3;
    }

}