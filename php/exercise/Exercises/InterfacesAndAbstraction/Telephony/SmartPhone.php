<?php

//spl_autoload_register();

interface IBrowse
{
    public function browse(string $url) : string;
}

interface ICall
{
    public function call(string $phoneNumber) : string;
}

class SmartPhone implements ICall, IBrowse
{
    /**
     * @param string $phoneNumber
     * @return string
     * @throws Exception
     */
    public function call(string $phoneNumber): string
    {
        if(!ctype_digit($phoneNumber)){
            throw new Exception("Invalid number!\n");
        }
        return "Calling... {$phoneNumber}\n";
    }

    /**
     * @param string $url
     * @return string
     * @throws Exception
     */
    public function browse(string $url): string
    {
        if(preg_match_all("/[0-9]/", $url)){
            throw new Exception("Invalid URL!\n");
        }
        return "Browsing: {$url}!\n";
    }
}

$numbers = explode(" ", readline());
$sites = explode(" ", readline());

$phone = new SmartPhone();
foreach ($numbers as $number){
    try{
       echo $phone->call($number);
    }catch (Exception $ex){
        echo $ex->getMessage();
    }
}

foreach ($sites as $site){
    try{
       echo $phone->browse($site);
    }catch (Exception $ex){
        echo $ex->getMessage();
    }
}

