<?php

class Lista extends TRecord
{
    const TABLENAME  = 'lista';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $system_user;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('system_user_id');
        parent::addAttribute('nome');
        parent::addAttribute('cor');
        parent::addAttribute('ordem');
            
    }

    /**
     * Method set_system_users
     * Sample of usage: $var->system_users = $object;
     * @param $object Instance of SystemUsers
     */
    public function set_system_user(SystemUsers $object)
    {
        $this->system_user = $object;
        $this->system_user_id = $object->id;
    }

    /**
     * Method get_system_user
     * Sample of usage: $var->system_user->attribute;
     * @returns SystemUsers instance
     */
    public function get_system_user()
    {
    
        // loads the associated object
        if (empty($this->system_user))
            $this->system_user = new SystemUsers($this->system_user_id);
    
        // returns the associated object
        return $this->system_user;
    }

    /**
     * Method getTarefas
     */
    public function getTarefas()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('lista_id', '=', $this->id));
        return Tarefa::getObjects( $criteria );
    }

    public function set_tarefa_lista_to_string($tarefa_lista_to_string)
    {
        if(is_array($tarefa_lista_to_string))
        {
            $values = Lista::where('id', 'in', $tarefa_lista_to_string)->getIndexedArray('id', 'id');
            $this->tarefa_lista_to_string = implode(', ', $values);
        }
        else
        {
            $this->tarefa_lista_to_string = $tarefa_lista_to_string;
        }

        $this->vdata['tarefa_lista_to_string'] = $this->tarefa_lista_to_string;
    }

    public function get_tarefa_lista_to_string()
    {
        if(!empty($this->tarefa_lista_to_string))
        {
            return $this->tarefa_lista_to_string;
        }
    
        $values = Tarefa::where('lista_id', '=', $this->id)->getIndexedArray('lista_id','{lista->id}');
        return implode(', ', $values);
    }

    
}

