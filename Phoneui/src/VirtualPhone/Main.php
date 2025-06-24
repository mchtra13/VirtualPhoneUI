<?php

namespace VirtualPhone;

use pocketmine\plugin\PluginBase;
use VirtualPhone\PhoneItem;
use VirtualPhone\PhoneListener;

class Main extends PluginBase {

    public static Main $instance;

    public function onEnable(): void {
        self::$instance = $this;

        $this->getServer()->getPluginManager()->registerEvents(new PhoneListener(), $this);
        PhoneItem::register();
    }

    public static function getInstance(): Main {
        return self::$instance;
    }
}
