<?php

namespace VirtualPhone\UI;

use jojoe77777\FormAPI\CustomForm;
use pocketmine\player\Player;
use VirtualPhone\EconomyBridge;

class TransferUI {

    public static function open(Player $player): void {
        $form = new CustomForm(function(Player $player, ?array $data): void {
            if ($data === null) return;

            [$targetName, $amount] = $data;

            if (!is_numeric($amount) || $amount <= 0) {
                $player->sendMessage("§cNominal tidak valid.");
                return;
            }

            $target = $player->getServer()->getPlayerExact($targetName);
            if ($target === null) {
                $player->sendMessage("§cPemain tidak ditemukan.");
                return;
            }

            if (EconomyBridge::getMoney($player) < $amount) {
                $player->sendMessage("§cUang kamu tidak cukup.");
                return;
            }

            EconomyBridge::reduceMoney($player, $amount);
            EconomyBridge::addMoney($target, $amount);

            $player->sendMessage("§aBerhasil mengirim $amount ke {$target->getName()}.");
            $target->sendMessage("§aKamu menerima $amount dari {$player->getName()}.");
        });

        $form->setTitle("💸 Transfer Uang");
        $form->addInput("Nama Pemain Tujuan:");
        $form->addInput("Nominal Transfer:");
        $player->sendForm($form);
    }
}
