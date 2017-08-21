<?php
namespace wocenter\backend\modules\data;

use wocenter\core\ModularityInfo;

class Info extends ModularityInfo
{

    public function init()
    {
        parent::init();

        $this->name = '基础数据';
        $this->description = '提供系统所有基础数据的支持，如：区域数据、积分类型';
        $this->developer = 'WoCenter';
        $this->email = 'e-kevin@qq.com';
        $this->isSystem = true;
    }

    /**
     * @inheritdoc
     */
    public function getMenus()
    {
        return [
            [
                'name' => '系统管理',
                'items' => [
                    [
                        'name' => '基础数据',
                        'icon_html' => 'database',
                        'modularity' => 'core',
                        'show_on_menu' => true,
                        'items' => [
                            // 区域管理
                            [
                                'name' => '区域管理',
                                'url' => "/{$this->getId()}/area-region/index",
                                'show_on_menu' => true,
                                'items' => [
                                    ['name' => '列表', 'url' => "/{$this->getId()}/area-region/index", 'description' => '区域管理列表'],
                                    ['name' => '新增', 'url' => "/{$this->getId()}/area-region/create"],
                                    ['name' => '编辑', 'url' => "/{$this->getId()}/area-region/update"],
                                    ['name' => '删除', 'url' => "/{$this->getId()}/area-region/delete"],
                                    ['name' => '搜索', 'url' => "/{$this->getId()}/area-region/search"],
                                ],
                            ],
                            // 积分类型
                            [
                                'name' => '积分类型',
                                'url' => "/{$this->getId()}/score-type/index",
                                'show_on_menu' => true,
                                'items' => [
                                    ['name' => '列表', 'url' => "/{$this->getId()}/score-type/index", 'description' => '积分类型列表'],
                                    ['name' => '新增', 'url' => "/{$this->getId()}/score-type/create"],
                                    ['name' => '编辑', 'url' => "/{$this->getId()}/score-type/update"],
                                    ['name' => '删除', 'url' => "/{$this->getId()}/score-type/delete"],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }

}
