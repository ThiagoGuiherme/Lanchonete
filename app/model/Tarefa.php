<?php

class Tarefa extends TRecord
{
    const TABLENAME  = 'tarefa';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $lista;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('lista_id');
        parent::addAttribute('titulo');
        parent::addAttribute('texto');
        parent::addAttribute('ordem');
            
    }

    /**
     * Method set_lista
     * Sample of usage: $var->lista = $object;
     * @param $object Instance of Lista
     */
    public function set_lista(Lista $object)
    {
        $this->lista = $object;
        $this->lista_id = $object->id;
    }

    /**
     * Method get_lista
     * Sample of usage: $var->lista->attribute;
     * @returns Lista instance
     */
    public function get_lista()
    {
    
        // loads the associated object
        if (empty($this->lista))
            $this->lista = new Lista($this->lista_id);
    
        // returns the associated object
        return $this->lista;
    }

    
}

