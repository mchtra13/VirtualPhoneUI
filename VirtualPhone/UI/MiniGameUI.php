<?php

namespace VirtualPhone\UI;

use jojoe77777\FormAPI\CustomForm;
use pocketmine\player\Player;
use VirtualPhone\EconomyBridge;

class MiniGameUI {

    public static function open(Player $player): void {
        $form = new CustomForm(function(Player $player, ?array $data): void {
            if ($data === null) return;

            $guess = (int)$data[0];
            $correct = rand(1, 10);

            if ($guess === $correct) {
                $reward = 1500;
                EconomyBridge::addMoney($player, $reward);
                $player->sendMessage("§a🎉 Selamat! Angkanya benar ($correct). Kamu dapat $reward uang!");
            } else {
                $player->sendMessage("§c❌ Salah! Jawaban yang benar adalah $correct. Coba lagi ya!");
            }
        });

        $form->setTitle("🧠 Tebak Angka");
        $form->addInput("Tebak angka dari 1 sampai 10:");

        $player->sendForm($form);
    }
}
