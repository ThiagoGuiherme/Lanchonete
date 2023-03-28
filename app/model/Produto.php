<?php

class Produto extends TRecord
{
    const TABLENAME  = 'produto';
    const PRIMARYKEY = 'id';
    const IDPOLICY   =  'serial'; // {max, serial}

    private $tipo_produto;

    

    /**
     * Constructor method
     */
    public function __construct($id = NULL, $callObjectLoad = TRUE)
    {
        parent::__construct($id, $callObjectLoad);
        parent::addAttribute('tipo_produto_id');
        parent::addAttribute('nome');
        parent::addAttribute('valor');
            
    }

    /**
     * Method set_tipo_produto
     * Sample of usage: $var->tipo_produto = $object;
     * @param $object Instance of TipoProduto
     */
    public function set_tipo_produto(TipoProduto $object)
    {
        $this->tipo_produto = $object;
        $this->tipo_produto_id = $object->id;
    }

    /**
     * Method get_tipo_produto
     * Sample of usage: $var->tipo_produto->attribute;
     * @returns TipoProduto instance
     */
    public function get_tipo_produto()
    {
    
        // loads the associated object
        if (empty($this->tipo_produto))
            $this->tipo_produto = new TipoProduto($this->tipo_produto_id);
    
        // returns the associated object
        return $this->tipo_produto;
    }

    /**
     * Method getPedidoItems
     */
    public function getPedidoItems()
    {
        $criteria = new TCriteria;
        $criteria->add(new TFilter('produto_id', '=', $this->id));
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
    
        $values = PedidoItem::where('produto_id', '=', $this->id)->getIndexedArray('pedido_id','{pedido->id}');
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
    
        $values = PedidoItem::where('produto_id', '=', $this->id)->getIndexedArray('produto_id','{produto->nome}');
        return implode(', ', $values);
    }

    
}

