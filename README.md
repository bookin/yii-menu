Установка и настройка
=====================
Скопировать папку **menu** в папку **components** вашего сайта.

В **config.php** сконфигурируйте виджет: 

<pre><code>'components'=>array(
    'widgetFactory'=>array(
        'widgets'=>array(
            'BMenu'=>array(
                'itemOptions'=>array(),
                'submenuOptions'=>array(),
                'template'=>'',
                'filesItems'=>array(
                    array(
                        'path'=>'application.views.product',
                        'file'=>'_menu'
                    ),
                    array(
                        'path'=>'application.views.posts',
                        'file'=>'_menu'
                    ),
                    ...
                )
            )
        )
    ),
    ...
)
</code></pre>


**itemOptions**, **submenuOptions**, **template** - являются свойствами компонента **<a href="http://www.yiiframework.com/doc/api/1.1/CMenu" target="_blank">CMenu</a>**

В **items** передается массив в котором указаны альянсы путей к php файлам (**path**), и названия этих самых файлов (**file**), в которых хранятся массивы добавляющиеся в массив **<a href="http://www.yiiframework.com/doc/api/1.1/CMenu#items-detail" target="_blank">items</a>**  компонента **<a href="http://www.yiiframework.com/doc/api/1.1/CMenu" target="_blank">CMenu</a>**

###Пример файла _menu.php 
(application.views.product._menu.php)
<pre><code><?
return array(
    'label'=>'Продукты',
    'url'=>array('/product/index'),
    'visible'=>Yii::app()->user->checkAccess('supervisor'),
    'active' => Yii::app()->controller->module->id == 'product',
    'items'=>array(
        array(
            'label'=>'Просмотр',
            'visible'=>Yii::app()->controller->module->id == 'product' ,
            'url'=>array('/product/view')
        ),
    )
);
</code></pre>


Вывод виджета
=============
Теперь в нужном месте просто вставляем код:
<pre><code> $this->widget('application.components.menu.BMenu');</code></pre>
