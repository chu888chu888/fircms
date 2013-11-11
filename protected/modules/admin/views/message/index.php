<?php
/* @var $this MessageController */
/* @var $model Message */

$this->breadcrumbs=array(
    '信息'=>array('index'),
	'查看信息',
);

$this->menu=array(
    array('label'=>'发信息', 'url'=>array('send')),
    array('label'=>'查看信息', 'url'=>array('index')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#message-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<?php echo CHtml::link('高级搜索','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'message-grid',
    //'cssFile'=>Yii::app()->theme->baseUrl."/css/grid.css",
    'summaryText'=>false,
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'name'=>'id',
            'header'=>'#',
            'htmlOptions'=>array('width'=>50),
        ),
        array(
            'name'=>'from_user_id',
            'htmlOptions'=>array('width'=>50),
        ),
        array('name'=>'status',
            'htmlOptions'=>array('width'=>160),
            'value'=>'$data->statusLookup()',
            'filter'=>Message::getAllStatus()),
        array('name'=>'content','value'=>'Fircms::truncate_utf8_string($data->content,50)'),
        array('name'=>'create_time','type'=>'datetime'),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
            'template' => '{update},{delete}',


        ),

	),
)); ?>
