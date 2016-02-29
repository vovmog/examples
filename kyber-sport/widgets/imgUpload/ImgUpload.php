<?php
/**
 * Created by PhpStorm.
 * User: Vlad
 * Date: 12.02.2016
 * Time: 23:04
 */
namespace app\widgets\imgUpload;

use app\widgets\imgUpload\assets\AssetImageUpload;
use app\widgets\imgUpload\models\ImgUploadForm;
use Yii;
use yii\base\Widget;
use yii\widgets\InputWidget;

class ImgUpload extends InputWidget
{
    public $pathUrl = "";
    public $webUrl = "";
    public $path = "";
    public $widgetId;
    public $urlGet = "";
    public $urlUpload = "";
    public $isAvatar= false;

    public function init()
    {
        parent::init();
        $view = $this->getView();
        $asset = Yii::$container->get(AssetImageUpload::className());
        $asset = $asset::register($view);
        $this->widgetId = $this->id;
        $view->registerJs("imageWidget.widgetId='" . $this->widgetId . "';imageWidget.urlGet='" . $this->urlGet . "';imageWidget.urlUpload='" . $this->urlUpload . "';imageWidget.isAvatar='".$this->isAvatar."'");


    }

    public function run()
    {
        parent::run();
        $attr = $this->attribute;
        $img = $this->model->$attr;
        $formName = $this->model->formName();
        $inputName = $formName . "[" . $attr . "]";

        return $this->render('_imgUpload',
            [
                'isAvatar'=>$this->isAvatar,
                'model' => $this->model,
                'url' => $this->webUrl,
                'path' => Yii::getAlias($this->pathUrl),
                'widgetId' => $this->widgetId,
                'img' => $img,
                'inputName' => $inputName
            ]
        );
    }
}