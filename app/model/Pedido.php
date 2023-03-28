<?php

class Pedido extends TRecord
{
    const TABLENAME  = 'pedido';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $estado_pedido;
    private $cliente;
    private $quantidade;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('estado_pedido_id');
        parent::addAttribute('cliente_id');
        parent::addAttribute('data_pedido');
        parent::addAttribute('valor_total');
        parent::addAttribute('mes');
        parent::addAttribute('ano');
        parent::addAttribute('ordem');
        parent::addAttribute('deletado');
        parent::addAttribute('quantidade_id');
            
    }

    /**
     * Method set_estado_pedido
     * Sample of usage: $var->estado_pedido = $object;
     * @param $object Instance of EstadoPedido
     */
    public function set_estado_pedido(EstadoPedido $object)
    {
        $this->estado_pedido = $object;
        $this->estado_pedido_id = $object->id;
    }

    /**
     * Method get_estado_pedido
     * Sample of usage: $var->estado_pedido->attribute;
     * @returns EstadoPedido instance
     */
    public function get_estado_pedido()
    {
    
        // loads the associated object
        if (empty($this->estado_pedido))
            $this->estado_pedido = new EstadoPedido($this->estado_pedido_id);
    
        // returns the associated object
        return $this->estado_pedido;
    }
    /**
     * Method set_mesas
     * Sample of usage: $var->mesas = $object;
     * @param $object Instance of Mesas
     */
    public function set_cliente(Mesas $object)
    {
        $this->cliente = $object;
        $this->cliente_id = $object->id;
    }

    /**
     * Method get_cliente
     * Sample of usage: $var->cliente->attribute;
     * @returns Mesas instance
     */
    public function get_cliente()
    {
    
        // loads the associated object
        if (empty($this->cliente))
            $this->cliente = new Mesas($this->cliente_id);
    
        // returns the associated object
        return $this->cliente;
    }
    /**
     * Method set_qunatidade
     * Sample of usage: $var->qunatidade = $object;
     * @param $object Instance of Qunatidade
     */
    public function set_quantidade(Qunatidade $object)
    {
        $this->quantidade = $object;
        $this->quantidade_id = $object->id;
    }

    /**
     * Method get_quantidade
     * Sample of usage: $var->quantidade->attribute;
     * @returns Qunatidade instance
     */
    public function get_quantidade()
    {
    
        // loads the associated object
        if (empty($this->quantidade))
            $this->quantidade = new Qunatidade($this->quantidade_id);
    
        // returns the associated object
        return $this->quantidade;
    }

    /**
     * Method getPedidoItems
     */
    public function getPedidoItems()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('pedido_id', '=', $this->id));
        return PedidoItem::getObjects( $criteria );
    }

    public function set_pedido_item_pedido_to_string($pedido_item_pedido_to_string)
    {
        if(is_array($pedido_item_pedido_to_string))
        {
            $values = Pedido::where('id', 'in', $pedido_item_pedido_to_string)->getIndexedArray('id', 'id');
            $this->pedido_item_pedido_to_string = implode(', ', $values);
        }
        else
        {
            $this->pedido_item_pedido_to_string = $pedido_item_pedido_to_string;
        }

        $this->vdata['pedido_item_pedido_to_string'] = $this->pedido_item_pedido_to_string;
    }

    public function get_pedido_item_pedido_to_string()
    {
        if(!empty($this->pedido_item_pedido_to_string))
        {
            return $this->pedido_item_pedido_to_string;
        }
    
        $values = PedidoItem::where('pedido_id', '=', $this->id)->getIndexedArray('pedido_id','{pedido->id}');
        return implode(', ', $values);
    }

    public function set_pedido_item_produto_to_string($pedido_item_produto_to_string)
    {
        if(is_array($pedido_item_produto_to_string))
        {
            $values = Produto::where('id', 'in', $pedido_item_produto_to_string)->getIndexedArray('nome', 'nome');
            $this->pedido_item_produto_to_string = implode(', ', $values);
        }
        else
        {
            $this->pedido_item_produto_to_string = $pedido_item_produto_to_string;
        }

        $this->vdata['pedido_item_produto_to_string'] = $this->pedido_item_produto_to_string;
    }

    public function get_pedido_item_produto_to_string()
    {
        if(!empty($this->pedido_item_produto_to_string))
        {
            return $this->pedido_item_produto_to_string;
        }
    
        $values = PedidoItem::where('pedido_id', '=', $this->id)->getIndexedArray('produto_id','{produto->nome}');
        return implode(', ', $values);
    }

    
}

