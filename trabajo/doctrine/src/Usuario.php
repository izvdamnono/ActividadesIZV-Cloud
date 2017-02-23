<?php

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity 
 * @Table(name="usuario")
 */
class Usuario {
    
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
     * @Column(type="string", length=200, nullable=false)
     */
    protected $password;
    
    /**
    * @Column(type="text", nullable=true)
    */
    protected $token;
    
    /**
     * @ManyToOne(targetEntity="Profesor", inversedBy="idup")
     * @JoinColumn(name="idprofesor", referencedColumnName="id")
     */
    protected $idup = null;
    
    public function __construct() {
        $this->idup = new ArrayCollection();
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }
    
    public function getPassword() {
        return $this->password;
    }

    public function getToken() {
        return $this->token;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    
    public function setIdProfesor($profesor){
        
        $this->idup = $profesor;
        return $this;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }
    
    
    public function setPassword($password) {
        $password_hash = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
        $this->password = $password_hash;
        return $this;
    }
    
    public function isPasswordVerify($password, $hash) {
        return password_verify($password, $hash);
    }
    
    public function setToken($token) {
        $this->token = $token;
        return $this;
    }
    
    public function addIdup($idup){
        $this->idup[] = $idup;
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
            "nombreProfesor" => $this->nombre,
            "idpd" => $this->idpd->getArray()
            //"idap" => $this->idap, 
        );
    }
    
    /**
    * Metodo que devuelve una instancia de la clase Profesor recibiendo 
    * como parametro una cadena JSON
    *
    */
    public function jsonToObject($json){
        
        $this->nombre = $json->nombreProfesor;
        return $this;
    }
}