<?php

namespace VirtualPhone\UI;

use jojoe77777\FormAPI\CustomForm;
use pocketmine\player\Player;
use pocketmine\scheduler\ClosureTask;
use pocketmine\world\sound\XpCollectSound;
use VirtualPhone\Main;

class AlarmUI {

    public static function open(Player $player): void {
        $form = new CustomForm(function(Player $player, ?array $data): void {
            if ($data === null) return;

            [$message, $delayMinutes] = $data;
            $delayMinutes = (int)$delayMinutes;

            if ($delayMinutes < 1 || $delayMinutes > 60) {
                $player->sendMessage("§cBatas waktu hanya 1–60 menit.");
                return;
            }

            $player->sendMessage("⏰ Alarm diatur! Kamu akan diingatkan dalam $delayMinutes menit.");

            Main::getInstance()->getScheduler()->scheduleDelayedTask(new ClosureTask(
                function() use ($player, $message): void {
                    $player->sendMessage("⏰ Pengingat: $message");
                    $player->getWorld()->addSound($player->getPosition(), new XpCollectSound());
                }
            ), 20 * 60 * $delayMinutes);
        });

        $form->setTitle("⏰ Buat Alarm");
        $form->addInput("Pesan yang ingin diingatkan:");
        $form->addInput("Dalam berapa menit? (1–60):");
        $player->sendForm($form);
    }
}
