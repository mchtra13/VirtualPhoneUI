<?php

namespace VirtualPhone;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use VirtualPhone\UI\PhoneUI;

class PhoneListener implements Listener {

    public function onUse(PlayerInteractEvent $event): void {
        $item = $event->getItem();
        $player = $event->getPlayer();

        if ($item->getNamedTag()->getTag("virtualphone") !== null) {
            $event->cancel();
            PhoneUI::sendMainMenu($player);
        }
    }
}
