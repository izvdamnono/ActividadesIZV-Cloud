<?php

/**
 * @Entity 
 * @Table(name="telefono")
 * uniqueConstraints={@UniqueConstraint(name="tp_unique",columns={"idpersona","telefono"})})
 */
class Telefono {
    
    /**
     * @Id
     * @Column(type="integer") @GeneratedValue
     */
    protected $id;
    
    /**
     * @ManyToOne(targetEntity="Persona", inversedBy="telefonos")
     * @JoinColumn(name="idpersona", referencedColumnName="id")
     */
    protected $persona;
    
    /**
     * @Column(type="string", length=20, unique=false, nullable=false)
     */
    protected $telefono;
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
        return $this;
    }

    public function getPersona() {
        return $this->persona;
    }
    
    public function setPersona($persona) {
        $persona->addTelefono($this);
        $this->persona = $persona;
    }
}