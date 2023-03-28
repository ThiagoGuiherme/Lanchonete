<?php

class dashboard extends TPage
{
    protected $form;
    private $formFields = [];
    private static $database = '';
    private static $activeRecord = '';
    private static $primaryKey = '';
    private static $formName = 'form_dashboard';

    /**
     * Form constructor
     * @param $param Request
     */
    public function __construct( $param = null)
    {
        parent::__construct();

        if(!empty($param['target_container']))
        {
            $this->adianti_target_container = $param['target_container'];
        }

        // creates the form
        $this->form = new BootstrapFormBuilder(self::$formName);
        // define the form title
        $this->form->setFormTitle("Faturamento");

        $criteria_faturamento = new TCriteria();
        $criteria_total_de_vendas = new TCriteria();
        $criteria_total_de_vendas_por_dia = new TCriteria();

        $filterVar = EstadoPedido::NOVO;
        $criteria_faturamento->add(new TFilter('pedido.estado_pedido_id', '=', $filterVar)); 

        $mes = new TCombo('mes');
        $ano = new TCombo('ano');
        $button_buscar = new TButton('button_buscar');
        $faturamento = new BIndicator('faturamento');
        $total_de_vendas = new BLineChart('total_de_vendas');
        $total_de_vendas_por_dia = new BLineChart('total_de_vendas_por_dia');


        $button_buscar->setAction(new TAction(['dashboard', 'onShow']), "Buscar");
        $button_buscar->addStyleClass('btn-primary');
        $button_buscar->setImage('fas:search #FFFFFF');

        $mes->setSize('100%');
        $ano->setSize('100%');

        $ano->addItems(TempoService::getAnos());
        $mes->addItems(TempoService::getMeses());

        $ano->setValue($param['ano']??date('Y'));
        $mes->setValue($param['mes']??date('mes'));

        $mes->enableSearch();
        $ano->enableSearch();

        $faturamento->setDatabase('lanchonete');
        $faturamento->setFieldValue("pedido.valor_total");
        $faturamento->setModel('Pedido');
        $faturamento->setTotal('sum');
        $faturamento->setColors('#2980B9', '#ffffff', '#3498DB', '#ffffff');
        $faturamento->setTitle("Faturamento", '#ffffff', '21', 'BU');
        $faturamento->setCriteria($criteria_faturamento);
        $faturamento->setIcon(new TImage('fas:shopping-basket #ffffff'));
        $faturamento->setValueSize("20");
        $faturamento->setValueColor("#ffffff", 'B');
        $faturamento->setSize('100%', 95);
        $faturamento->setLayout('horizontal', 'left');

        $total_de_vendas->setDatabase('lanchonete');
        $total_de_vendas->setFieldValue("pedido.valor_total");
        $total_de_vendas->setFieldGroup(["pedido.mes"]);
        $total_de_vendas->setModel('Pedido');
        $total_de_vendas->setTitle("Total de Vendas por Mês");
        $total_de_vendas->setTransformerLegend(function($value, $row, $data)
            {
                $meses = TempoService::getMeses();

                return $meses[$value] ?? '';
            });
        $total_de_vendas->setTransformerValue(function($value, $row, $data)
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
        });
        $total_de_vendas->setTotal('sum');
        $total_de_vendas->showLegend(false);
        $total_de_vendas->setCriteria($criteria_total_de_vendas);
        $total_de_vendas->setSize('100%', 280);
        $total_de_vendas->disableZoom();

        $total_de_vendas_por_dia->setDatabase('lanchonete');
        $total_de_vendas_por_dia->setFieldValue("pedido.valor_total");
        $total_de_vendas_por_dia->setFieldGroup(["pedido.data_pedido"]);
        $total_de_vendas_por_dia->setModel('Pedido');
        $total_de_vendas_por_dia->setTitle("Total de Vendas por Dia");
        $total_de_vendas_por_dia->setTransformerLegend(function($value, $row, $data)
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
            });
        $total_de_vendas_por_dia->setTransformerValue(function($value, $row, $data)
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
        });
        $total_de_vendas_por_dia->setTotal('sum');
        $total_de_vendas_por_dia->showLegend(true);
        $total_de_vendas_por_dia->setCriteria($criteria_total_de_vendas_por_dia);
        $total_de_vendas_por_dia->setRotateLegend('35',60);
        $total_de_vendas_por_dia->setSize('100%', 280);
        $total_de_vendas_por_dia->disableZoom();

        $row1 = $this->form->addFields([new TLabel("Mês:", null, '14px', 'B'),$mes],[new TLabel("Ano:", null, '14px', 'B'),$ano],[new TLabel(".", null, '14px', null, '100%'),$button_buscar]);
        $row1->layout = ['col-sm-3',' col-sm-3',' col-sm-3'];

        $row2 = $this->form->addFields([$faturamento]);
        $row2->layout = ['col-sm-6'];

        $row3 = $this->form->addFields([$total_de_vendas]);
        $row3->layout = [' col-sm-12'];

        $row4 = $this->form->addFields([$total_de_vendas_por_dia]);
        $row4->layout = [' col-sm-12'];

        if(!isset($param['mes']) && $mes->getValue())
        {
            $_POST['mes'] = $mes->getValue();
        }
        if(!isset($param['ano']) && $ano->getValue())
        {
            $_POST['ano'] = $ano->getValue();
        }

        $searchData = $this->form->getData();
        $this->form->setData($searchData);

        $filterVar = $searchData->mes;
        if($filterVar)
        {
            $criteria_faturamento->add(new TFilter('pedido.mes', '=', $filterVar)); 
        }
        $filterVar = $searchData->ano;
        if($filterVar)
        {
            $criteria_faturamento->add(new TFilter('pedido.ano', '=', $filterVar)); 
        }
        $filterVar = $searchData->ano;
        if($filterVar)
        {
            $criteria_total_de_vendas->add(new TFilter('pedido.ano', '=', $filterVar)); 
        }
        $filterVar = $searchData->ano;
        if($filterVar)
        {
            $criteria_total_de_vendas_por_dia->add(new TFilter('pedido.ano', '=', $filterVar)); 
        }
        $filterVar = $searchData->mes;
        if($filterVar)
        {
            $criteria_total_de_vendas_por_dia->add(new TFilter('pedido.mes', '=', $filterVar)); 
        }

        BChart::generate($faturamento, $total_de_vendas, $total_de_vendas_por_dia);

        // create the form actions

        // vertical box container
        $container = new TVBox;
        $container->style = 'width: 100%';
        $container->class = 'form-container';
        if(empty($param['target_container']))
        {
            $container->add(TBreadCrumb::create(["Caixa","Faturamento"]));
        }
        $container->add($this->form);

        parent::add($container);

    }

    public function onShow($param = null)
    {               

    } 

}

