<?php

namespace App;


use phpGPX\phpGPX;

class GPXStart extends phpGPX
{
    private $filename;
    private $strgpx = '';
    private $gpx;
    private $file;
    private $track;
    /**
     * @param string $filename
     */
    public function __construct($filename)
    {
        $this->filename = $filename;
        $this->gpx = new phpGPX();
        $this->file = $this->gpx->load($filename);
        $this->track = $this->file->tracks[0];
    }

    public function GetFile():\phpGPX\Models\GpxFile {
        try {
            return $this->file;
        }catch (\Exception $err){
            echo $err;
        }
        return $this->file;
    }
    // первый трэк в файле
    public function GetTrack(){
        return $this->track;
    }
    //заголовок трека
    public function GetTitle(){
        return $this->track->name;
    }
    //содержимое файла в виде строки
    public function GetContent(){
        try {
            $s = file_get_contents($this->filename);
        }catch(\Exception $err){

        }
        return $s;
    }

    // время начала записи файла
    public function GetTimeStart(){

        return $this->file->metadata->time;
    }
    // хэш функция содержимого файла GPX
    public function GetHashGPX(){
        return hash('sha512',$this->GetContent());
    }

    public function GetIdTrack(){
        $points = $this->track->getPoints();
        $acc = "";
        for($i=0;$i<5;$i++){
            $point = $points[$i];
            $acc = $acc.$point->time->format('c').$point->latitude.$point->longitude."\n";
        }
        return hash('md5',$acc);
    }
}
