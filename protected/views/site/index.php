<?php $this->pageTitle=Yii::app()->name; 
$this->widget('zii.widgets.jui.CJuiTabs', array(
    'tabs'=>array(
        Yii::t('interface', 'Login')=>$this->renderPartial('_tabLogin',array('model'=>$model),true,true),
        Yii::t('interface', 'How works')=>$this->renderPartial('_tabHowworks',true,true),
    ),
    // additional javascript options for the tabs plugin
    'options'=>array(
    ),
));

?>