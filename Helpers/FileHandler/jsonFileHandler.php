<?php

require_once 'IFileHandler.php';

class jsonFileHandler implements IFileHandler
{

    public $directory;
    public $filename;

    function __construct($directory, $filename){

        $this->directory = $directory;
        $this->filename = $filename;
    }

    function CreateDirectory()
    {

        if (!file_exists($this->directory)) {
            mkdir($this->directory, 0777, true);
        }
    }

    function SaveFile($value)
    {

        $this->CreateDirectory($this->directory);
        $path = $this->directory . "/" . $this->filename . ".json";

        $serializeData = json_encode($value);

        $file = fopen($path, "w+");
        fwrite($file, $serializeData);
        fclose($file);
    }

    function ReadFile(){

        $this->CreateDirectory($this->directory);
        $path = $this->directory . "/" . $this->filename . ".json";

        if (file_exists($path)) {
            $file = fopen($path, "r");
            $contents = fread($file,filesize($path));
            fclose($file);
            return json_decode($contents); 
        }else{
            return false;
        }
    }

    function ReadConfiguration(){

        $path = $this->directory . "/" . $this->filename . ".json";

        if (file_exists($path)) {
            $file = fopen($path, "r");
            $contents = fread($file,filesize($path));
            fclose($file);
            return json_decode($contents); 
        }else{
            return false;
        }
    }
}
