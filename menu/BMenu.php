<?Yii::import('zii.widgets.CMenu');
/*
 * <code>
 *  <?php
 *      'widgetFactory'=>array(
 *          'widgets'=>array(
 *             'BMenu'=>array(
 *                 'filesItems'=>array(
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
 *                  )
 *              )
 *          )
 *      )
 *  ?>
 * </code>
 */
class BMenu extends CMenu
{
    public $_items;
    public $template="<div class='main-menu-arrow'><div></div></div>{menu}";
    public $itemOptions=array('class'=>'main-menu-top');
    public $submenuOptions=array('class'=>'main-menu-submenu');
    public $_assetsBase;

    public function init(){
        unset($this->items);
        parent::init();
    }

    public function setFilesItems($items){

        $params=array(
            'template'=>$this->template,
            'itemOptions'=>$this->itemOptions,
            'submenuOptions'=>$this->submenuOptions
        );
        foreach ($items as $item){
            $file=Yii::getPathOfAlias($item['path']).'/'.$item['file'].'.php';
            
            if(file_exists($file))
            {
                $this->_items[]=array_merge($params,require($file));
            }
        }
    }
    public function setItems($items){
        $this->_items=$items;
    }

    public function getItems(){
        return $this->_items;
    }
}?>