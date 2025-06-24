<?php

namespace VirtualPhone\UI;

use jojoe77777\FormAPI\SimpleForm;
use pocketmine\player\Player;
use pocketmine\scheduler\ClosureTask;
use VirtualPhone\Main;
use VirtualPhone\EconomyBridge;

class SlotMachineUI {
    private static array $symbols = ["🍒", "🍋", "🔔", "💎", "7️⃣"];

    public static function open(Player $player): void {
        $form = new SimpleForm(function(Player $player, ?int $data): void {
            if ($data === null) return;

            // Efek loading spin (delay 2 detik)
            $player->sendMessage("🎰 Mesin sedang berputar...");

            Main::getInstance()->getScheduler()->scheduleDelayedTask(new ClosureTask(function () use ($player): void {
                $slot1 = self::$symbols[array_rand(self::$symbols)];
                $slot2 = self::$symbols[array_rand(self::$symbols)];
                $slot3 = self::$symbols[array_rand(self::$symbols)];

                $result = "$slot1 | $slot2 | $slot3";
                $message = "🎰 Hasil:\n$result\n\n";

                if ($slot1 === $slot2 && $slot2 === $slot3) {
                    $reward = 10000;
                    $message .= "🎉 JACKPOT! Kamu menang $reward!";
                    EconomyBridge::addMoney($player, $reward);
                } elseif ($slot1 === $slot2 || $slot1 === $slot3 || $slot2 === $slot3) {
                    $reward = 2500;
                    $message .= "✨ Lumayan! Kamu menang $reward!";
                    EconomyBridge::addMoney($player, $reward);
                } else {
                    $message .= "😢 Tidak menang. Coba lagi ya!";
                }

                $player->sendMessage($message);
            }), 40); // 2 detik
        });

        $form->setTitle("🎰 Slot Machine");
        $form->addButton("Putar Sekarang!");
        $player->sendForm($form);
    }
}
