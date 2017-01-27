<?php

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity 
 * @Table(name="actividad")
 */
class Actividad {
    
    /**
     * @Id
     * @Column(type="integer") @GeneratedValue
     */
    protected $id;
    
    /**
     * @ManyToOne(targetEntity="Profesor", inversedBy="idap")
     * @JoinColumn(name="idprofesor", referencedColumnName="id")
     */
    protected $idap = null;
    
    
    /**
     * @Column(type="string", length=200, nullable=false)
     */
    protected $titulo;
    
    
    /**
     * @Column(type="string", length=200, nullable=false)
     */
    protected $descripcion;
    
    /**
     * @Column(type="string", length=200, nullable=false)
     */
    protected $resumen;
    
    /**
     * @ManyToOne(targetEntity="Grupo", inversedBy="idag")
     * @JoinColumn(name="idgrupo", referencedColumnName="id")
     */
    protected $idag = null;
    
    /**
     * @Column(type="date")
     */
    protected $fecha;
    
    /**
     * @Column(type="time")
     */
    protected $hini;
    
    /**
     * @Column(type="time")
     */
    protected $hfin;
    
    public function getId() {
        return $this->id;
    }

    public function getIdProfesor(){
        return $this->idap->getId();
    }
    
    public function getDescripcion(){
        return $this->descripcion;
    }
    
    public function getResumen(){
        return $this->resumen;
    }
    
    public function getIdGrupo(){
        return $this->idag->getId();
    }
    
    public function getFecha(){
        return $this->fecha;
    }

    public function getHoraInicial(){
        return $this->hini;
    }
    
    public function getHoraFinal(){
        return $this->hfin;
    }
    
    public function getTitulo(){
        return $this->titulo;
    }
    
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /*
        Ambas funciones almacenan en la variable
        la referencia del objeto mapeador de Doctrine
    */
    public function setIdProfesor($profesor){
        
        $this->idap = $profesor;
        return $this;
    }    

    public function setIdGrupo($grupo){
        
        $this->idag = $grupo;
        return $this;
    }  

    public function setTitulo($titulo){
        $this->setTitulo = $titulo;
        return $this;
    }

    public function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
        return $this;
    }
    
    public function setResumen($resumen){
        $this->resumen = $resumen;
        return $this;
    }
    
    public function setFecha($fecha){
        $this->fecha = $fecha;
        return $this;
    }

    public function setHoraInicial($hini){
        $this->hini = $hini;
        return $this;
    }
    
    public function setHoraFinal($hfin){
        $this->hfin = $hfin;
        return $this;
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
     * 
     * Doctrine en las variables que almacenan la relacion entre las clases
     * almacena la referencia completo del objeto al que apunta, de modo que
     * para que se inicialize debemos de acceder a sus propiedades!!
     */ 
    public function getArray() {
        return array(
            "id" => $this->id, 
            "idap" => $this->idap->getId(),
            "idag" => $this->idag->getId(), 
            "titulo" => $this->titulo,
            "descripcion" => $this->descripcion, 
            "resumen" => $this->resumen, 
            "fecha" => $this->fecha, 
            "hini" => $this->hini, 
            "hfin" => $this->hfin, 
        );
    }
    
    /**
    * Metodo que devuelve una instancia de la clase Profesor recibiendo 
    * como parametro una cadena JSON
    *
    */
    public function jsonToObject($json){
        
        $this->titulo       = $json->titulo;
        $this->descripcion  = $json->descripcion;
        $this->resumen      = $json->resumen;
        $this->fecha        = date_create($json->fecha);
        $this->hini         = date_create($json->hini);
        $this->hfin         = date_create($json->hfin);
        
        return $this;
    }
    
}