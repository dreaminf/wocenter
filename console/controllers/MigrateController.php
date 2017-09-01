<?php
namespace wocenter\console\controllers;

use wocenter\helpers\FileHelper;
use wocenter\Wc;
use Yii;
use yii\console\controllers\MigrateController as BaseMigrateController;
use yii\helpers\Console;

/**
 * Class MigrateController
 * WoCenter dedicated migrate operation class
 *
 * @package wocenter\console\controllers
 */
class MigrateController extends BaseMigrateController
{

    /**
     * @inheritdoc
     */
    public $templateFile = '@wocenter/console/template.php';

    /**
     * @var string install lock file
     */
    public $installLockFile = '@common/install.lock';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // 添加已安装模块的数据库迁移目录
        $this->migrationPath = array_merge($this->migrationPath, Wc::$service->getModularity()->getLoad()->getMigrationPath());
    }

    /**
     * Install the wocenter project.
     *
     * @return int
     */
    public function actionInstall()
    {
        $installLockFile = Yii::getAlias($this->installLockFile);
        if (is_file($installLockFile)) {
            // 安装成功，请不要重复安装
            $this->stdout("====== The installation is successful. Please do not repeat the installation. ======\n", Console::FG_YELLOW);

            return self::EXIT_CODE_NORMAL;
        }

        if ($this->installMigration() == self::EXIT_CODE_ERROR) {
            return self::EXIT_CODE_ERROR;
        }

        $this->syncMenus();

        // 安装成功，欢迎使用 WoCenter
        $this->stdout("====== Installation is successful. Welcome to use WoCenter. ======\n\n", Console::FG_BLUE);

        // 创建安装锁定文件
        FileHelper::createFile($installLockFile, 'lock');

        return self::EXIT_CODE_NORMAL;
    }

    /**
     * Install the migrations
     *
     * @return int
     */
    protected function installMigration()
    {
        // 更新数据库
        $this->stdout("====== Update migration ======\n\n", Console::FG_YELLOW);

        $limit = 0;
        $migrations = $this->getNewMigrations();
        if (empty($migrations)) {
            $this->stdout("No new migrations found. Your system is up-to-date.\n", Console::FG_GREEN);

            return self::EXIT_CODE_NORMAL;
        }

        $total = count($migrations);
        $limit = (int)$limit;
        if ($limit > 0) {
            $migrations = array_slice($migrations, 0, $limit);
        }

        $n = count($migrations);
        if ($n === $total) {
            $this->stdout("Total $n new " . ($n === 1 ? 'migration' : 'migrations') . " to be applied:\n", Console::FG_YELLOW);
        } else {
            $this->stdout("Total $n out of $total new " . ($total === 1 ? 'migration' : 'migrations') . " to be applied:\n", Console::FG_YELLOW);
        }

        foreach ($migrations as $migration) {
            $this->stdout("\t$migration\n");
        }
        $this->stdout("\n");

        $applied = 0;
        foreach ($migrations as $migration) {
            if (!$this->migrateUp($migration)) {
                $this->stdout("\n$applied from $n " . ($applied === 1 ? 'migration was' : 'migrations were') . " applied.\n", Console::FG_RED);
                $this->stdout("\nMigration failed. The rest of the migrations are canceled.\n", Console::FG_RED);

                return self::EXIT_CODE_ERROR;
            }
            $applied++;
        }

        $this->stdout("\n$n " . ($n === 1 ? 'migration was' : 'migrations were') . " applied.\n", Console::FG_GREEN);
        $this->stdout("\nMigrated up successfully.\n", Console::FG_GREEN);
    }

    /**
     * Synchronize module menu data
     */
    protected function syncMenus()
    {
        // 同步菜单数据，目前只同步backend应用菜单数据
        $this->stdout("====== Synchronize module menu data ======\n\n", Console::FG_YELLOW);

        $oldAppId = Yii::$app->id;
        Yii::$app->id = 'backend';
        if (Wc::$service->getMenu()->syncMenus()) {
            $this->stdout("Menu synchronization complete.\n\n", Console::FG_GREEN);
        } else {
            $this->stdout("Menu synchronization failed.\n\n", Console::FG_RED);
        }
        Yii::$app->id = $oldAppId;
    }

}
