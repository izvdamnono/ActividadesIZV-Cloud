<?php

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity 
 * @Table(name="grupo")
 */
class Grupo {
    
    /**
     * @Id
     * @Column(type="integer") @GeneratedValue
     */
    protected $id;
    
    /**
     * @Column(type="string", length=200, nullable=false)
     */
    protected $nombre;
    
    /**
     * @OneToMany(targetEntity="Actividad", mappedBy="grupo" )
     */
    protected $idag = null;
    
    public function __construct() {
        $this->idag = new ArrayCollection();
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }

    public function addIdag($idag){
        $this->idag[] = $idag;
    }
    
    //Metodo utilizado para obtener el valor JSON de un este objeto
    function getJsonData(){
        $var = get_object_vars($this);
        foreach ($var as &$value) {
            if (is_object($value) && method_exists($value,'getJsonData')) {
                $value = $value->getJsonData();
            }
        }
        return $var;
    }
    
    /**
     * Metodo que devuelve un array con todos los atributos de la clase
     * idag almacena la referencia de dicho objeto en la relacion, os un
     * objeto que almacena el mapeado de Doctrine
     */ 
    public function getArray() {
        return array(
            "id" => $this->id, 
            "nombre" => $this->nombre, 
            //"idag" => $this->idap, 
        );
    }
    
    /**
    * Metodo que devuelve una instancia de la clase Profesor recibiendo 
    * como parametro una cadena JSON
    *
    */
    public function jsonToObject($json){
        
        $this->nombre = $json->nombre;
        return $this;
    }
}