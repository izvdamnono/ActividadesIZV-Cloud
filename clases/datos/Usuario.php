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
    
    //Metodo utilizado para generar el array del usuario para generar su token
    function toArray() {
        
        return array( 'id'          => $this->id,
                      'username'    => $this->nombre,
                      'password'    => $this->password,
                      'dateRequest' => date("Y-m-d")
                    );
    }
    
}