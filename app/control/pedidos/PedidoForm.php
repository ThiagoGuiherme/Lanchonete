<?php

class PedidoForm extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = 'lanchonete';
    private static $activeRecord = 'Pedido';
    private static $primaryKey = 'id';
    private static $formName = 'form_Pedido';

    use BuilderMasterDetailFieldListTrait;

    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param )
    {
        parent::__construct();

        if(!empty($param['target_container']))
        {
            $this->adianti_target_container = $param['target_container'];
        }

        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);
        // define the form title
        $this->form->setFormTitle("Cadastro de pedido");


        $id = new TEntry('id');
        $cliente_id = new TDBCombo('cliente_id', 'lanchonete', 'Mesas', 'id', '{nome}','nome asc'  );
        $data_pedido = new TDate('data_pedido');
        $pedido_item_pedido_id = new THidden('pedido_item_pedido_id[]');
        $pedido_item_pedido___row__id = new THidden('pedido_item_pedido___row__id[]');
        $pedido_item_pedido___row__data = new THidden('pedido_item_pedido___row__data[]');
        $pedido_item_pedido_produto_tipo_produto_id = new TDBCombo('pedido_item_pedido_produto_tipo_produto_id[]', 'lanchonete', 'TipoProduto', 'id', '{nome}','nome asc'  );
        $pedido_item_pedido_produto_id = new TCombo('pedido_item_pedido_produto_id[]');
        $pedido_item_pedido_quantidade = new TDBCombo('pedido_item_pedido_quantidade[]', 'lanchonete', 'Qunatidade', 'id', '{quantidade}','quantidade asc'  );
        $pedido_item_pedido_valor = new TNumeric('pedido_item_pedido_valor[]', '2', ',', '.' );
        $pedido_item_pedido_valor_total = new TNumeric('pedido_item_pedido_valor_total[]', '2', ',', '.' );
        $this->produtos = new TFieldList();
        $valor_dinheiro = new TNumeric('valor_dinheiro', '2', ',', '.' );
        $troco = new TEntry('troco');

        $this->produtos->addField(null, $pedido_item_pedido_id, []);
        $this->produtos->addField(null, $pedido_item_pedido___row__id, ['uniqid' => true]);
        $this->produtos->addField(null, $pedido_item_pedido___row__data, []);
        $this->produtos->addField(new TLabel("Tipo produto", null, '14px', 'B'), $pedido_item_pedido_produto_tipo_produto_id, ['width' => '30%']);
        $this->produtos->addField(new TLabel("Produto", null, '14px', 'B'), $pedido_item_pedido_produto_id, ['width' => '30%']);
        $this->produtos->addField(new TLabel("Qtd", null, '14px', 'B'), $pedido_item_pedido_quantidade, ['width' => '8%']);
        $this->produtos->addField(new TLabel("Valor", null, '14px', 'B'), $pedido_item_pedido_valor, ['width' => '10%']);
        $this->produtos->addField(new TLabel("Valor total", null, '14px', 'B'), $pedido_item_pedido_valor_total, ['width' => '10%','sum' => true]);

        $this->produtos->width = '100%';
        $this->produtos->setFieldPrefix('pedido_item_pedido');
        $this->produtos->name = 'produtos';
        $this->produtos->class .= ' table-responsive';

        $this->criteria_produtos = new TCriteria();

        $this->form->addField($pedido_item_pedido_id);
        $this->form->addField($pedido_item_pedido___row__id);
        $this->form->addField($pedido_item_pedido___row__data);
        $this->form->addField($pedido_item_pedido_produto_tipo_produto_id);
        $this->form->addField($pedido_item_pedido_produto_id);
        $this->form->addField($pedido_item_pedido_quantidade);
        $this->form->addField($pedido_item_pedido_valor);
        $this->form->addField($pedido_item_pedido_valor_total);

        $this->produtos->setRemoveAction(null, 'fas:times #EA0000', "Excluír");

        $pedido_item_pedido_produto_tipo_produto_id->setChangeAction(new TAction([$this,'onChangepedido_item_pedido_produto_tipo_produto_id']));
        $pedido_item_pedido_produto_id->setChangeAction(new TAction([$this,'onChangeProduto']));
        $pedido_item_pedido_quantidade->setChangeAction(new TAction([$this,'onExitQuantidade']));

        $valor_dinheiro->setExitAction(new TAction([$this,'onTroco']));

        $cliente_id->addValidation("Cliente id", new TRequiredValidator()); 
        $data_pedido->addValidation("Data do pedido", new TRequiredValidator()); 
        $pedido_item_pedido_produto_id->addValidation("Produto", new TRequiredListValidator()); 
        $pedido_item_pedido_valor->addValidation("Valor", new TRequiredListValidator()); 
        $pedido_item_pedido_valor_total->addValidation("Valor total", new TRequiredListValidator()); 

        $id->setEditable(false);
        $data_pedido->setMask('dd/mm/yyyy');
        $data_pedido->setValue(date('d/m/Y'));
        $data_pedido->setDatabaseMask('yyyy-mm-dd');

        $id->setSize(100);
        $troco->setSize('100%');
        $data_pedido->setSize(110);
        $cliente_id->setSize('100%');
        $valor_dinheiro->setSize('100%');
        $pedido_item_pedido_valor->setSize('100%');
        $pedido_item_pedido_produto_id->setSize('100%');
        $pedido_item_pedido_quantidade->setSize('100%');
        $pedido_item_pedido_valor_total->setSize('100%');
        $pedido_item_pedido_produto_tipo_produto_id->setSize('100%');

        $row1 = $this->form->addFields([new TLabel("Id:", null, '14px', null, '100%'),$id]);
        $row1->layout = ['col-sm-6'];

        $row2 = $this->form->addFields([new TLabel("Mesa:", '#000000', '16px', 'B', '100%'),$cliente_id],[new TLabel("Data do pedido:", '#030303', '16px', 'B', '100%'),$data_pedido]);
        $row2->layout = ['col-sm-3','col-sm-6'];

        $row3 = $this->form->addContent([new TFormSeparator("Produtos", '#333333', '19', '#eeeeee')]);
        $row4 = $this->form->addFields([$this->produtos]);
        $row4->layout = ['col-sm-12'];

        $row5 = $this->form->addFields([new TLabel("Valor em Dinheiro:", null, '14px', 'B'),$valor_dinheiro],[new TLabel("Troco:", null, '14px', 'B'),$troco]);
        $row5->layout = [' col-sm-6','col-sm-6'];

        // create the form actions
        $btn_onsave = $this->form->addAction("Salvar", new TAction([$this, 'onSave'],['static' => 1]), 'fas:save #ffffff');
        $this->btn_onsave = $btn_onsave;
        $btn_onsave->addStyleClass('btn-primary'); 

        $btn_onclear = $this->form->addAction("Limpar formulário", new TAction([$this, 'onClear']), 'fas:eraser #dd5a43');
        $this->btn_onclear = $btn_onclear;

        parent::setTargetContainer('adianti_right_panel');

        $btnClose = new TButton('closeCurtain');
        $btnClose->class = 'btn btn-sm btn-default';
        $btnClose->style = 'margin-right:10px;';
        $btnClose->onClick = "Template.closeRightPanel();";
        $btnClose->setLabel("Fechar");
        $btnClose->setImage('fas:times');

        $this->form->addHeaderWidget($btnClose);

        parent::add($this->form);

        $style = new TStyle('right-panel > .container-part[page-name=PedidoForm]');
        $style->width = '800px !important';   
        $style->show(true);

    }

    public static function onChangepedido_item_pedido_produto_tipo_produto_id($param)
    {
        try
        {

            $field_id = explode('_', $param['_field_id']);
            $field_id = end($field_id);

            if (!empty($param['key']))
            { 
                $criteria = TCriteria::create(['tipo_produto_id' => $param['key']]);
                TDBCombo::reloadFromModel(self::$formName, 'pedido_item_pedido_produto_id_'.$field_id, 'lanchonete', 'Produto', 'id', '{nome}', 'nome asc', $criteria, TRUE); 
            } 
            else 
            { 
                TCombo::clearField(self::$formName, 'pedido_item_pedido_produto_id_'.$field_id); 
            }  

        }
        catch (Exception $e)
        {
            new TMessage('error', $e->getMessage());
        }
    } 

    public static function onTroco($param = null) 
    {
        try 
        {

         // Código gerado pelo snippet: "Cálculos com campos"
        $field_id = explode('_', $param['_field_id']);
        $field_id = end($field_id);
        $field_data = json_decode($param['_field_data_json']);

        $valor_dinheiro = (double) str_replace(',', '.', str_replace('.', '', $param['valor_dinheiro']));
        $pedido_item_pedido_valor_total = (double) str_replace(',', '.', str_replace('.', '', $param['pedido_item_pedido_valor_total'][$field_data->row]));

        $troco = $valor_dinheiro - $pedido_item_pedido_valor_total ;
        $object = new stdClass();
        $object->troco = number_format($troco, 2, ',', '.');
        TForm::sendData(self::$formName, $object);
        // -----
        }

        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }
    }

    public static function onChangeProduto($param = null) 
    {
        try 
        {
            $field_data = json_decode($param['_field_data_json']);

            $pedido_item_pedido_valor = $param['pedido_item_pedido_valor'][$field_data->row];

            if(!empty($param['key']) && !$pedido_item_pedido_valor)
            {
                TTransaction::open(self::$database);

                $produto = Produto::find($param['key']);

                if($produto)
                {
                    $field_id = explode('_', $param['_field_id']);
                    $field_id = end($field_id);

                    $object = new stdClass();
                    $object->{"pedido_item_pedido_valor_{$field_id}"} = number_format($produto->valor, 2, ',', '.');

                    TForm::sendData(self::$formName, $object);
                    // -----
                }

                TTransaction::close();
                // -----    
            }

        }
        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }

    }

    public static function onExitQuantidade($param = null) 
    {
        try 
        {
            //code here
  // Código gerado pelo snippet: "Cálculos com campos"
            $field_id = explode('_', $param['_field_id']);
            $field_id = end($field_id);
            $field_data = json_decode($param['_field_data_json']);

            $pedido_item_pedido_quantidade = (double) str_replace(',', '.', str_replace('.', '', $param['pedido_item_pedido_quantidade'][$field_data->row]));
            $pedido_item_pedido_valor = (double) str_replace(',', '.', str_replace('.', '', $param['pedido_item_pedido_valor'][$field_data->row]));

            if($pedido_item_pedido_quantidade && $pedido_item_pedido_valor)
            {
                $pedido_item_pedido_valor_total = $pedido_item_pedido_quantidade * $pedido_item_pedido_valor ;
                $object = new stdClass();
                $object->{"pedido_item_pedido_valor_total_{$field_id}"} = number_format($pedido_item_pedido_valor_total, 2, ',', '.');
                TForm::sendData(self::$formName, $object);
                // -----    
            }

        }

        catch (Exception $e) 
        {
            new TMessage('error', $e->getMessage());    
        }

    }

    public function onSave($param = null) 
    {
        try
        {
            TTransaction::open(self::$database); // open a transaction

            /**
            // Enable Debug logger for SQL operations inside the transaction
            TTransaction::setLogger(new TLoggerSTD); // standard output
            TTransaction::setLogger(new TLoggerTXT('log.txt')); // file
            **/

            $messageAction = null;

            $this->form->validate(); // validate form data

            $object = new Pedido(); // create an empty object 

            $data = $this->form->getData(); // get form data as array
            $object->fromArray( (array) $data); // load the object with data

            if(!$data->id)
            {
                $object->estado_pedido_id = EstadoPedido::NOVO;

                $pedido = Pedido::select('max(ordem) as ordem')->where('estado_pedido_id', '=', $object->estado_pedido_id)->first();
                if($pedido)
                {
                    $object->ordem = $pedido->ordem + 1;
                }
            }

            $data_pedido = new DateTime($object->data_pedido);

            $object->mes = $data_pedido->format('m');
            $object->ano = $data_pedido->format('Y');
            $object->valor_total = 0;

            $object->store(); // save the object 

            $messageAction = new TAction(['PedidoKanbanView', 'onShow']);   

            if(!empty($param['target_container']))
            {
                $messageAction->setParameter('target_container', $param['target_container']);
            }

            $pedido_item_pedido_items = $this->storeItems('PedidoItem', 'pedido_id', $object, $this->produtos, function($masterObject, $detailObject){ 

                $masterObject->valor_total += $detailObject->valor_total;

            }, $this->criteria_produtos); 

            $object->store();

            // get the generated {PRIMARY_KEY}
            $data->id = $object->id; 

            $this->form->setData($data); // fill form data
            TTransaction::close(); // close the transaction

            /**
            // To define an action to be executed on the message close event:
            $messageAction = new TAction(['className', 'methodName']);
            **/

            new TMessage('info', "Registro salvo", $messageAction); 

                        TScript::create("Template.closeRightPanel();");
            TForm::sendData(self::$formName, (object)['id' => $object->id]);

        }
        catch (Exception $e) // in case of exception
        {
            //</catchAutoCode> 

            new TMessage('error', $e->getMessage()); // shows the exception error message
            $this->form->setData( $this->form->getData() ); // keep form data
            TTransaction::rollback(); // undo all pending operations
        }
    }

    public function onEdit( $param )
    {
        try
        {
            if (isset($param['key']))
            {
                $key = $param['key'];  // get the parameter $key
                TTransaction::open(self::$database); // open a transaction

                $object = new Pedido($key); // instantiates the Active Record 

                $this->produtos_items = $this->loadItems('PedidoItem', 'pedido_id', $object, $this->produtos, function($masterObject, $detailObject, $objectItems){ 

                    //code here

                }, $this->criteria_produtos); 

                $this->form->setData($object); // fill the form 

                if($this->produtos_items)
                {
                    $fieldListData = new stdClass();
                    $fieldListData->pedido_item_pedido_produto_tipo_produto_id = [];
                    $fieldListData->pedido_item_pedido_produto_id = [];

                    foreach ($this->produtos_items as $item) 
                    {
                        if(isset($item->produto->tipo_produto_id))
                        {
                            $value = $item->produto->tipo_produto_id;

                            $fieldListData->pedido_item_pedido_produto_tipo_produto_id[] = $value;
                        }
                        if(isset($item->produto_id))
                        {
                            $value = $item->produto_id;

                            $fieldListData->pedido_item_pedido_produto_id[] = $value;
                        }
                    }

                    TScript::create('tjquerydialog_block_ui(); tform_events_stop( function() {tjquerydialog_unblock_ui()} );');

                    TForm::sendData(self::$formName, $fieldListData);
                }

                TTransaction::close(); // close the transaction 
            }
            else
            {
                $this->form->clear();
            }
        }
        catch (Exception $e) // in case of exception
        {
            new TMessage('error', $e->getMessage()); // shows the exception error message
            TTransaction::rollback(); // undo all pending operations
        }
    }

    /**
     * Clear form data
     * @param $param Request
     */
    public function onClear( $param )
    {
        $this->form->clear(true);

        $this->produtos->addHeader();
        $this->produtos->addDetail( new stdClass );

        $this->produtos->addCloneAction(null, 'fas:plus #56EE04', "Novo Pedido");

    }

    public function onShow($param = null)
    {
        $this->produtos->addHeader();
        $this->produtos->addDetail( new stdClass );

        $this->produtos->addCloneAction(null, 'fas:plus #56EE04', "Novo Pedido");

    } 

}

