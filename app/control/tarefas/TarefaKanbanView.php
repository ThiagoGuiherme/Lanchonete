<?php

class TarefaKanbanView extends TPage
{
    private static $database = 'lanchonete';
    private static $activeRecord = 'Tarefa';
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

            $filterVar = TSession::getValue("userid");
            $criteriaStage->add(new TFilter('system_user_id', '=', $filterVar)); 

            TTransaction::open(self::$database);
            $stages = Lista::getObjects($criteriaStage);
            $items  = Tarefa::getObjects($criteriaItem);

            if(!$stages)
            {
                $stage = new Lista();
                $stage->nome = 'Lista 1';
                $stage->ordem = 1;
                $stage->cor = '#2c3e50';
                $stage->system_user_id = TSession::getValue('userid');
                $stage->store();

                $stages = [$stage]; 
            }

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

                    $kanban->addItem($item->id, $item->lista_id, "{titulo}", " {texto} ", $item->lista->cor, $item);

                }    
            }

            $kanbanStageAction_ListaForm_onEdit = new TAction(['ListaForm', 'onEdit']);

            $kanban->addStageAction("Editar", $kanbanStageAction_ListaForm_onEdit, 'far:edit #3498db');
            $kanbanStageAction_ListaForm_onShow = new TAction(['ListaForm', 'onShow']);

            $kanban->addStageAction("Nova lista", $kanbanStageAction_ListaForm_onShow, 'fas:plus #16a085');

            $kanbanStageShortcut_TarefaForm_onShow = new TAction(['TarefaForm', 'onShow']);

            $kanban->addStageShortcut("Nova tarefa", $kanbanStageShortcut_TarefaForm_onShow, 'fas:tasks #000000');

            $kanbanItemAction_TarefaForm_onEdit = new TAction(['TarefaForm', 'onEdit']);

            $kanban->addItemAction("Editar", $kanbanItemAction_TarefaForm_onEdit, 'far:edit #3498db');
            $kanbanItemAction_TarefaKanbanView_onDeleteTarefa = new TAction(['TarefaKanbanView', 'onDeleteTarefa']);

            $kanban->addItemAction("Excluír", $kanbanItemAction_TarefaKanbanView_onDeleteTarefa, 'far:trash-alt #c0392b');

            //$kanban->setTemplatePath('app/resources/card.html');

            $kanban->setItemDropAction(new TAction([__CLASS__, 'onUpdateItemDrop']));
            $kanban->setStageDropAction(new TAction([__CLASS__, 'onUpdateStageDrop']));
            TTransaction::close();

            $container = new TVBox;

            $container->style = 'width: 100%';
            $container->class = 'form-container';
            if(empty($param['target_container']))
            {
                $container->add(TBreadCrumb::create(["Tarefas","Tarefas"]));
            }
            $container->add($kanban);

            parent::add($container);
        }
        catch(Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    }

    public static function onDeleteTarefa($param = null) 
    {
        if(isset($param['delete']) && $param['delete'] == 1)
        {
            try
            {
                $key = $param['key'];
                TTransaction::open(self::$database);

                $object = new Tarefa($key, FALSE);

                $object->delete();
                TTransaction::close();

                // Código gerado pelo snippet: "Mensagem Toast"
                TToast::show("success", "Tarefa deletada com sucesso!", "topRight", "fas fa-check");

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
            $action = new TAction(array(__CLASS__, 'onDeleteTarefa'));
            $action->setParameters($param); // pass the key paramseter ahead
            $action->setParameter('delete', 1);
            // shows a dialog to the user
            new TQuestion(AdiantiCoreTranslator::translate('Do you really want to delete ?'), $action);   
        }

            //</autoCode>

    }

    public static function onUpdateStageDrop($param)
    {
        try
        {
            TTransaction::open(self::$database);

            if (!empty($param['order']))
            {
                foreach ($param['order'] as $key => $id)
                {
                    $sequence = ++ $key;

                    $stage = new Lista($id);
                    $stage->ordem = $sequence;

                    $stage->store();

                }
            }
            TTransaction::close();
        }
        catch (Exception $e)
        {
            TTransaction::rollback();
            new TMessage('error', $e->getMessage());
        }
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

                    $item = new Tarefa($id);
                    $item->ordem = $sequence;
                    $item->lista_id = $param['stage_id'];

                    $item->store();

                    if($id == $param['key'])
                    {
                        TScript::create("$(\"div[item_id='{$param['key']}']\").css('border-top', '3px solid {$item->lista->cor}');");
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

