<?php $this->pageTitle=Yii::app()->name; 
$this->widget('zii.widgets.jui.CJuiTabs', array(
    'tabs'=>array(
        'Entrar'=>$this->renderPartial('_tabLogin',array('model'=>$model),true,true),
        'Como funciona'=>$this->renderPartial('_tabHowworks',true,true),
    ),
    // additional javascript options for the tabs plugin
    'options'=>array(
    ),
));

?>