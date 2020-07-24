<?php

class estuServiceFile implements IServiceBase
{

    private $utilities;
    public $filehandler;
    public $directory;
    public $filename;


    public function __construct($directory = "data")
    {

        $this->utilities = new utilities();
        $this->directory = $directory;
        $this->filename = "estudiantes";
        $this->filehandler = new jsonFileHandler($this->directory, $this->filename);
    }

    public function GetList()
    {

        $listadoEstudiantesDecode = $this->filehandler->ReadFile();
        $listadoEstudiantes = array();

        if ($listadoEstudiantesDecode == false) {

            $this->filehandler->SaveFile($listadoEstudiantes);

        } else {

            foreach ($listadoEstudiantesDecode as $elementDecode) {

                $element = new estu();
                $element->set($elementDecode);

                array_push($listadoEstudiantes, $element);
            }
        }

        return $listadoEstudiantes;
    }

    public function GetById($id)
    {

        $listadoEstudiantes = $this->GetList();
        $estu = $this->utilities->buscarProperty($listadoEstudiantes, 'id', $id)[0];

        return $estu;
    }

    public function Add($entity)
    {

        $listadoEstudiantes = $this->GetList();
        $estuId = 1;

        if (!empty($listadoEstudiantes)) {

            $lastEstu = $this->utilities->getlastElement($listadoEstudiantes);
            $estuId = $lastEstu->id + 1;
        }

        $entity->id = $estuId;
        $entity->profilePhoto = "";

        if (isset($_FILES['profilePhoto'])) {

            $photoFile = $_FILES['profilePhoto'];

            if ($photoFile['error'] == 4) {

                $entity->profilePhoto = "";
            } else {

                $typereplace = str_replace("image/", "", $_FILES['profilePhoto']['type']);
                $type = $photoFile['type'];
                $size = $photoFile['size'];
                $name = $estuId . '.' . $typereplace;
                $tmpname =  $photoFile['tmp_name'];

                $success = $this->utilities->uploadImage('../assets/img/estudiantes/', $name, $tmpname, $type, $size);

                if ($success) {

                    $entity->profilePhoto = $name;
                }
            }
        }


        array_push($listadoEstudiantes, $entity);

        $this->filehandler->SaveFile($listadoEstudiantes);
    }

    public function Update($id, $entity)
    {

        $element = $this->GetById($id);
        $listadoEstudiantes = $this->GetList();

        $elementIndex = $this->utilities->getIndexElement($listadoEstudiantes, 'id', $id);

        if (isset($_FILES['profilePhoto'])) {

            $photoFile = $_FILES['profilePhoto'];

            if ($photoFile['error'] == 4) {

                $entity->profilePhoto = $element->profilePhoto;
            } else {

                $typereplace = str_replace("image/", "", $_FILES['profilePhoto']['type']);
                $type = $photoFile['type'];
                $size = $photoFile['size'];
                $name = $id . '.' . $typereplace;
                $tmpname =  $photoFile['tmp_name'];

                $success = $this->utilities->uploadImage('../assets/img/estudiantes/', $name, $tmpname, $type, $size);

                if ($success) {

                    $entity->profilePhoto = $name;
                }
            }
        }

        $listadoEstudiantes[$elementIndex] = $entity;

        $this->filehandler->SaveFile($listadoEstudiantes);
    }

    public function Delete($id)
    {

        $listadoEstudiantes = $this->GetList();

        $elementIndex = $this->utilities->getIndexElement($listadoEstudiantes, 'id', $id);

        unset($listadoEstudiantes[$elementIndex]);

        $listadoEstudiantes = array_values($listadoEstudiantes);
        $this->filehandler->SaveFile($listadoEstudiantes);
    }
}
