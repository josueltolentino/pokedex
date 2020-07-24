<?php



class EstudiantesContext{

      public $db;
      private $fileHandler;

      function __construct($directory)
      {
          
        $this->fileHandler = new jsonFileHandler($directory,"configuration");
        $configuration = $this->fileHandler->ReadConfiguration();
        $this->db = new mysqli("127.0.0.1","root","",
        "pokedex");

        if($this->db->connect_error){
            exit('Error conecting to database');
        }

      }

}

?>