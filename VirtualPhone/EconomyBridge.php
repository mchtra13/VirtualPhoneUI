<?php

namespace VirtualPhone;

use pocketmine\player\Player;
use cooldogedev\BedrockEconomy\BedrockEconomy;

class EconomyBridge {
    public static function getMoney(Player $player): int {
        return BedrockEconomy::getInstance()->getManager()->getPlayerBalance($player->getName());
    }

    public static function addMoney(Player $player, int $amount): void {
        BedrockEconomy::getInstance()->getManager()->addToPlayerBalance($player->getName(), $amount);
    }

    public static function reduceMoney(Player $player, int $amount): void {
        BedrockEconomy::getInstance()->getManager()->subtractFromPlayerBalance($player->getName(), $amount);
    }
}
