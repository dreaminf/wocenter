<?php
namespace wocenter\backend\modules\notification;

use wocenter\backend\core\Modularity;

class Module extends Modularity
{

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'wocenter\backend\modules\notification\controllers';

    /**
     * @inheritdoc
     */
    public $defaultRoute = 'setting';

}
