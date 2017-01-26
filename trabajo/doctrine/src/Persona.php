<?php

use Doctrine\Common\Collections\ArrayCollection;
//import -> paquetes
//use -> namespaces

/**
 * @Entity 
 * @Table(name="persona")
 */
class Persona {
    
    /**
     * @Id
     * @Column(type="integer") @GeneratedValue
     */
    protected $id;
    
    /**
     * @Column(type="string", length=200, unique=true, nullable=false)
     */
    protected $nombre;
    
    /**
     * @OneToMany(targetEntity="Telefono", mappedBy="persona")
     */
    protected $telefonos = null;
    
    public function __construct() {
        $this->telefonos = new ArrayCollection();
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

    public function addTelefono($telefono){
        $this->telefonos[] = $telefono;
    }
    
    public function getTelefonos(){
        return $this->telefonos;
    }
}