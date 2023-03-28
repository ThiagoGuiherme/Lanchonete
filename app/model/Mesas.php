<?php

class Mesas extends TRecord
{
    const TABLENAME  = 'mesas';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('nome');
            
    }

    /**
     * Method getPedidos
     */
    public function getPedidos()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('cliente_id', '=', $this->id));
        return Pedido::getObjects( $criteria );
    }

    public function set_pedido_estado_pedido_to_string($pedido_estado_pedido_to_string)
    {
        if(is_array($pedido_estado_pedido_to_string))
        {
            $values = EstadoPedido::where('id', 'in', $pedido_estado_pedido_to_string)->getIndexedArray('nome', 'nome');
            $this->pedido_estado_pedido_to_string = implode(', ', $values);
        }
        else
        {
            $this->pedido_estado_pedido_to_string = $pedido_estado_pedido_to_string;
        }

        $this->vdata['pedido_estado_pedido_to_string'] = $this->pedido_estado_pedido_to_string;
    }

    public function get_pedido_estado_pedido_to_string()
    {
        if(!empty($this->pedido_estado_pedido_to_string))
        {
            return $this->pedido_estado_pedido_to_string;
        }
    
        $values = Pedido::where('cliente_id', '=', $this->id)->getIndexedArray('estado_pedido_id','{estado_pedido->nome}');
        return implode(', ', $values);
    }

    public function set_pedido_cliente_to_string($pedido_cliente_to_string)
    {
        if(is_array($pedido_cliente_to_string))
        {
            $values = Mesas::where('id', 'in', $pedido_cliente_to_string)->getIndexedArray('nome', 'nome');
            $this->pedido_cliente_to_string = implode(', ', $values);
        }
        else
        {
            $this->pedido_cliente_to_string = $pedido_cliente_to_string;
        }

        $this->vdata['pedido_cliente_to_string'] = $this->pedido_cliente_to_string;
    }

    public function get_pedido_cliente_to_string()
    {
        if(!empty($this->pedido_cliente_to_string))
        {
            return $this->pedido_cliente_to_string;
        }
    
        $values = Pedido::where('cliente_id', '=', $this->id)->getIndexedArray('cliente_id','{cliente->nome}');
        return implode(', ', $values);
    }

    public function set_pedido_quantidade_to_string($pedido_quantidade_to_string)
    {
        if(is_array($pedido_quantidade_to_string))
        {
            $values = Qunatidade::where('id', 'in', $pedido_quantidade_to_string)->getIndexedArray('id', 'id');
            $this->pedido_quantidade_to_string = implode(', ', $values);
        }
        else
        {
            $this->pedido_quantidade_to_string = $pedido_quantidade_to_string;
        }

        $this->vdata['pedido_quantidade_to_string'] = $this->pedido_quantidade_to_string;
    }

    public function get_pedido_quantidade_to_string()
    {
        if(!empty($this->pedido_quantidade_to_string))
        {
            return $this->pedido_quantidade_to_string;
        }
    
        $values = Pedido::where('cliente_id', '=', $this->id)->getIndexedArray('quantidade_id','{quantidade->id}');
        return implode(', ', $values);
    }

    
}

