<?php 

class utilities{
    

   public $region= [1=>'Seleccione una region', 2=>'Kanto', 3=>'Johto', 4=>'Hoenn', 
    5=>'Aura', 6=>'Sinnoh'];

    public $tipo = [1=>'Seleccione un tipo', 2=>'Fuego', 3=>'Planta', 4=>'Agua', 
    5=>'Bicho', 6=>'Nomal',7=>'Veneno',8=>'Electrico',9=>'Tierra',10=>'Hada',
    11=>'Lucha',12=>'Psiquico'];
    
   public function GetLastElement($list){
        $countList = count($list);
        $lastElement = $list[$countList - 1];
    
        return $lastElement;
    }
    
    public function buscarProperty($list, $property, $value){
    
    $filter = [];
    
    foreach($list as $item){
    
        if($item->$property == $value){
            array_push($filter, $item);
        }
    }
    
    return $filter;
    
    }
    
    
   public function getIndexElement($list, $property, $value){
    
        $index = 0;
        
        foreach($list as $key => $item){
        
            if($item->$property == $value){
                $index = $key;
            }
        }
        
        return $index;
        
        }

    public function uploadImage($directory,$name,$tmpFile,$type,$size){

        $isSuccess = false;

        if( ($type == "image/gif") 
         || ($type == "image/jpeg") 
         || ($type == "image/jpg") 
         || ($type == "image/JPG") 
         || ($type == "image/pjpeg") && ($size < 1000000) ){

            if(!file_exists($directory)){

                mkdir($directory,0777,true);

                if(!file_exists($directory)){

                    $this->uploadFile($directory . $name, $tmpFile);

                    $isSuccess = true;
                }

            }else{

                    $this->uploadFile($directory .$name,$tmpFile);
                    $isSuccess = true;
            }

            

        }else{
            $isSuccess = false;
        }

        return $isSuccess;

    }

    private function uploadFile($name,$tmpFile){

        if(file_exists($name)){
            unlink($name);
            }

            move_uploaded_file($tmpFile,$name);
       
    }

}


?>