<?php

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity 
 * @Table(name="departamento")
 */
class Departamento {
    
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
     * @OneToMany(targetEntity="Profesor", mappedBy="departamento" )
     */
    protected $idpd = null;
    
    public function __construct() {
        $this->idpd = new ArrayCollection();
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

    public function addIdpd($idpd){
        $this->idpd[] = $idpd;
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
     * idap almacena la referencia de dicho objeto en la relacion, os un
     * objeto que almacena el mapeado de Doctrine
     */ 
    public function getArray() {
        return array(
            "id" => $this->id, 
            "nombreDepartamento" => $this->nombre, 
            //"idap" => $this->idap, 
        );
    }
    
    /**
    * Metodo que devuelve una instancia de la clase Profesor recibiendo 
    * como parametro una cadena JSON
    *
    */
    public function jsonToObject($json){
        
        $this->nombre = $json->nombreDepartamento;
        return $this;
    }
}