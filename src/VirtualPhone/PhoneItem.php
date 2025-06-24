<?php

namespace VirtualPhone;

use pocketmine\item\ItemFactory;
use pocketmine\item\ItemIds;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;
use pocketmine\nbt\tag\CompoundTag;

class PhoneItem {
    public static function register(): void {
        // Buat phone sebagai nether star dengan NBT tag khusus
        ItemFactory::getInstance()->registerCustomItem(
            VanillaItems::NETHER_STAR()->setCustomName("§r§l§aVirtual Phone")
                ->setNamedTag(CompoundTag::create()->setString("virtualphone", "1")),
            true
        );
    }

    public static function giveTo(Player $player): void {
        $item = VanillaItems::NETHER_STAR()->setCustomName("§r§l§aVirtual Phone");
        $item->getNamedTag()->setString("virtualphone", "1");

        $inventory = $player->getInventory();
        $inventory->setItem($inventory->getSize() - 1, $item); // slot terakhir
    }
}
