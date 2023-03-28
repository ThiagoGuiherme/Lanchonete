<?php

class PedidoKanbanView extends TPage
{
    private static $database = 'lanchonete';
    private static $activeRecord = 'Pedido';
    private static $primaryKey = 'id';

    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        try
        {
            parent::__construct();

            $kanban = new TKanban;
            $kanban->setItemDatabase(self::$database);

            $criteriaStage = new TCriteria();
            $criteriaItem = new TCriteria();

            $criteriaStage->setProperty('order', 'ordem asc');
            $criteriaItem->setProperty('order', 'ordem asc');

            $filterVar = "F";
            $criteriaItem->add(new TFilter('deletado', '=', $filterVar)); 

            TTransaction::open(self::$database);
            $stages = EstadoPedido::getObjects($criteriaStage);
            $items  = Pedido::getObjects($criteriaItem);

            if($stages)
            {
                foreach ($stages as $key => $stage)
                {

                    $kanban->addStage($stage->id, "{nome}", $stage);

                }    
            }

            if($items)
            {
                foreach ($items as $key => $item)
                {

                    $item->valor_total = call_user_func(function($value, $object, $row) 
                    {
                        if(!$value)
                        {
                            $value = 0;
                        }

                        if(is_numeric($value))
                        {
                            return "R$ " . number_format($value, 2, ",", ".");
                        }
                        else
                        {
                            return $value;
                        }
                    }, $item->valor_total, $item, null);

                    $item->data_pedido = call_user_func(function($value, $object, $row) 
                    {
                        if(!empty(trim($value)))
                        {
                            try
                            {
                                $date = new DateTime($value);
                                return $date->format('d/m/Y');
                            }
                            catch (Exception $e)
                            {
                                return $value;
                            }
                        }
                    }, $item->data_pedido, $item, null);

                    $kanban->addItem($item->id, $item->estado_pedido_id, "Pedido: #{id} ", "<dl class='dl-horizontal'>
  <dt>Valor total</dt>
  <dd>{valor_total}</dd>
  <dt>Data pedido</dt>
  <dd>{data_pedido}</dd>
  <dt>Cliente</dt>
  <dd>{cliente->nome}</dd>
</dl>", $item->estado_pedido->cor, $item);

                }    
            }

            $kanbanStageAction_PedidoForm_onShow = new TAction(['PedidoForm', 'onShow']);

            $kanban->addStageAction("Novo Pedido", $kanbanStageAction_PedidoForm_onShow, 'fas:cart-plus #475EA7');

            $kanbanStageShortcut_PedidoForm_onShow = new TAction(['PedidoForm', 'onShow']);

            $kanban->addStageShortcut("Novo Pedido", $kanbanStageShortcut_PedidoForm_onShow, 'fas:cart-plus #2945B9');

            $kanbanItemAction_PedidoForm_onEdit = new TAction(['PedidoForm', 'onEdit']);

            $kanban->addItemAction("Adicionar Lanches/Bebidas", $kanbanItemAction_PedidoForm_onEdit, 'fas:edit #0E00F9');
            $kanbanItemAction_PedidoKanbanView_onDelete = new TAction(['PedidoKanbanView', 'onDelete']);

            $kanban->addItemAction("Finalizar Pedido", $kanbanItemAction_PedidoKanbanView_onDelete, 'fas:check-circle #F41700');

            //$kanban->setTemplatePath('app/resources/card.html');

            $kanban->setItemDropAction(new TAction([__CLASS__, 'onUpdateItemDrop']));
            TTransaction::close();

            $container = new TVBox;

            $container->style = 'width: 100%';
            $container->class = 'form-container';
            if(empty($param['target_container']))
            {
                $container->add(TBreadCrumb::create(["Pedidos","Pedidos"]));
            }
            $container->add($kanban);

            parent::add($container);
        }
        catch(Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }

    public static function onDelete($param = null) 
    {

            if(isset($param['delete']) && $param['delete'] == 1)
            {
                try
                {
                    $key = $param['key'];
                    TTransaction::open(self::$database);

                    $object = new Pedido($key, FALSE);

                    $object->deletado = 'T';

                    $object->store();
                    TTransaction::close();

                    // Código gerado pelo snippet: "Mensagem Toast"
                    TToast::show("success", "Pedido deletado com sucesso!", "topRight", "fas fa-check");

                    TScript::create("$(\"div[item_id='{$key}']\").remove();");
                }
                catch (Exception $e) // in case of exception
                {
                    // shows the exception error message
                    new TMessage('error', $e->getMessage());
                    // undo all pending operations
                    TTransaction::rollback();
                }
            }
            else
            {
                // define the delete action
                $action = new TAction(array(__CLASS__, 'onDelete'));
                $action->setParameters($param); // pass the key paramseter ahead
                $action->setParameter('delete', 1);
                // shows a dialog to the user
                new TQuestion(AdiantiCoreTranslator::translate('Do you really want to delete ?'), $action);   
            }

            //</autoCode>

        ////////////////////////////////////////////////////////////

    }

    /**
     * Update item on drop
     */
    public static function onUpdateItemDrop($param)
    {
        try
        {
            TTransaction::open(self::$database);

            if (!empty($param['order']))
            {
                foreach ($param['order'] as $key => $id)
                {
                    $sequence = ++$key;

                    $item = new Pedido($id);
                    $item->ordem = $sequence;
                    $item->estado_pedido_id = $param['stage_id'];

                    $item->store();

                    if($id == $param['key'])
                    {
                        TScript::create("$(\"div[item_id='{$param['key']}']\").css('border-top', '3px solid {$item->estado_pedido->cor}');");
                    }

                }

                TTransaction::close();
            }
        }
        catch (Exception $e)
        {
            TTransaction::rollback();
            new TMessage('error', $e->getMessage());
        }
    }
    public function onShow($param = null)
    {

    } 

}

