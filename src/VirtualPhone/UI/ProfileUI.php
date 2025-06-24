<?php

namespace VirtualPhone\UI;

use jojoe77777\FormAPI\CustomForm;
use pocketmine\player\Player;
use VirtualPhone\EconomyBridge;

class ProfileUI {

    public static function open(Player $player): void {
        $money = EconomyBridge::getMoney($player);
        $name = $player->getName();
        $online = $player->isOnline() ? "🟢 Online" : "🔴 Offline";
        $rank = $player->hasPermission("owner") ? "👑 Owner" : "👤 Player"; // contoh rank (bisa pakai LuckPerms API jika tersedia)

        $form = new CustomForm(function(Player $player, ?array $data): void {});
        $form->setTitle("📊 Profil Kamu");

        $form->addLabel("§7Nama: §b$name");
        $form->addLabel("§7Status: §a$online");
        $form->addLabel("§7Uang: §6$money");
        $form->addLabel("§7Rank: §d$rank");

        $player->sendForm($form);
    }
}
