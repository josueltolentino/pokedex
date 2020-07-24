<?php

class estuServiceDatabase implements IServiceBase{

    private $utilities;
    private $context;
  

    public function __construct($directory){

        $this->utilities = New utilities();
        $this->context = new EstudiantesContext($directory);

    }

    public function GetList(){

        $listadoEstudiantes = array();
        
        $stmt = $this->context->db->prepare("Select * from pokemon");
        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows === 0){
            return $listadoEstudiantes;
        }else{

            while($row = $result->fetch_object()){

                $estu = new estu();

                $estu->id = $row->id;
                $estu->nombre = $row->nombre;
                $estu->region = $row->region;
                $estu->tipo = $row->tipo;
                $estu->ataque = $row->ataque;
                $estu->profilePhoto = $row->profilePhoto;

                array_push($listadoEstudiantes,$estu);
            }
        }
        $stmt->close();
        return $listadoEstudiantes;
    }

    public function GetById($id){

        $estu = new estu();

        $stmt = $this->context->db->prepare("Select * from pokemon where id= ?");
        $stmt->bind_param("i",$id);
        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows === 0){
            return null;
        }else{

            while($row = $result->fetch_object()){


                $estu->id = $row->id;
                $estu->nombre = $row->nombre;
                $estu->region = $row->region;
                $estu->tipo = $row->tipo;
                $estu->ataque = $row->ataque;
                $estu->profilePhoto = $row->profilePhoto;

            }
        }

        $stmt->close();
        return $estu;
    }

    public function Add($entity){

        $stmt = $this->context->db->prepare("insert into pokemon (nombre,region,tipo,ataque) 
        values(?,?,?,?)");
        $stmt->bind_param("siis",$entity->nombre,$entity->region,$entity->tipo,$entity->ataque);
        $stmt->execute();
        $stmt->close();

        $estuId = $this->context->db->insert_id;

        if(isset($_FILES['profilePhoto'])){

            $photoFile = $_FILES['profilePhoto'];

            if($photoFile['error'] == 4){ 

                $entity->profilePhoto = "";

            }else{

                $typereplace = str_replace("image/","",$_FILES['profilePhoto']['type']);
                $type = $photoFile['type'];
                $size = $photoFile['size'];
                $name = $estuId . '.' . $typereplace;
                $tmpname =  $photoFile['tmp_name'];
    
                $success = $this->utilities->uploadImage('../assets/img/estudiantes/', $name, $tmpname, $type, $size); 
    
                if($success){
    
                    $stmt = $this->context->db->prepare("update pokemon set profilePhoto = ? where id = ?");
                    $stmt->bind_param("si",$name,$estuId);
                    $stmt->execute();
                    $stmt->close();
                }
            }
        }
    }

    public function Update($id,$entity){

        $element = $this->GetById($id);

        $stmt = $this->context->db->prepare("update pokemon set nombre = ?, region = ?, tipo = ?, ataque = ? where id = ?");
        $stmt->bind_param("siisi",$entity->nombre,$entity->region,$entity->tipo,$entity->ataque,$id);
        $stmt->execute();
        $stmt->close();

        if(isset($_FILES['profilePhoto'])){

            $photoFile = $_FILES['profilePhoto'];

            if($photoFile['error'] == 4){

                $entity->profilePhoto = $element->profilePhoto;

            }else{

            $typereplace = str_replace("image/", "",$_FILES['profilePhoto']['type']);
            $type = $photoFile['type'];
            $size = $photoFile['size'];
            $name = $id . '.' . $typereplace;
            $tmpname =  $photoFile['tmp_name'];

            $success = $this->utilities->uploadImage('../assets/img/estudiantes/',$name,$tmpname,$type,$size); 

            if($success){

                $stmt = $this->context->db->prepare("update pokemon set profilePhoto = ? where id = ?");
                $stmt->bind_param("si",$name,$id);
                $stmt->execute();
                $stmt->close();
            }

            }

        }


    }

    public function Delete($id){

        $stmt = $this->context->db->prepare("delete from pokemon where id = ?");
        $stmt->bind_param("i",$id); 
        $stmt->execute();
        $stmt->close();

    }

}

?>