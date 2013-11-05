<?
/*
 * @property array $items
 * <code>
 *  <?php
 *      'widgetFactory'=>array(
 *          'widgets'=>array(
 *              'BMenu'=>array(
 *                  'items'=>array(
 *                      'idItem'=>array(
 *                          'path'=>'application.views.performer',
 *                          'file'=>'_menu'
 *                      ),
 *                      'idItem'=>array(
 *                          'path'=>'application.views.performer',
 *                          'file'=>'_menu'
 *                      ),
 *                      'idItem'=>array(
 *                          'path'=>'application.views.performer',
 *                          'file'=>'_menu'
 *                      ),
 *                      ...
 *                 )
 *                )
 *          )
 *      )
 *  ?>
 * </code>
 */
class BMenu extends CWidget
{
    
    public $_items;
    public $template='<div class="main-menu-arrow"><div></div></div>{menu}';
    public $itemOptions=array('class'=>'main-menu-top');
    public $submenuOptions=array('class'=>'main-menu-submenu');
    public $_assetsBase;

    
    public function run()
    {
        $this->publishAssets();
        $this->render('menu', array(
            'items'=>$this->items
        ));
    }
    
    protected function publishAssets() {
        $path=$this->assetsBase;
    }
    
    public function setItems($items){

        $params=array(
            'template'=>$this->template,
            'itemOptions'=>$this->itemOptions,
            'submenuOptions'=>$this->submenuOptions
        );
        foreach ($items as $item){
            $file=Yii::getPathOfAlias($item['path']).'/'.$item['file'].'.php';
            if(file_exists($file))
            {
                $this->_items[]=array_merge(require($file), $params);
            }
        }
    }
    public function getItems(){
        return $this->_items;
    }
    
    //отдаем путь до assets
    public static function getAssetsPath()
    {
        return dirname(__FILE__) . '/assets';
    }

    //отдаем полный путь до папки assets с файлами модуля
    public function getPublishedUrl()
    {
        return Yii::app()->assetManager->getPublishedUrl($this->assetsPath);
    }

    //публикуем файлы из папки assets и возвращаем путь до нее
    public function getAssetsBase()
    {
        if ($this->_assetsBase === null) {
            $assets = $this->assetsPath;
            $this->_assetsBase = Yii::app()->assetManager->publish(
                $assets,
                false,
                -1,
                YII_DEBUG
            );
        }
        return $this->_assetsBase;
    }
}?>