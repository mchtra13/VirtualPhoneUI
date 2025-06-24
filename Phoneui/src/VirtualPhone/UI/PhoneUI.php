<?php

namespace VirtualPhone\UI;

use jojoe77777\FormAPI\SimpleForm;
use pocketmine\player\Player;

class PhoneUI {
    public static function sendMainMenu(Player $player): void {
        $form = new SimpleForm(function(Player $player, ?int $data): void {
            if ($data === null) return;

            match ($data) {
                0 => DMUI::open($player),
                1 => DMUI::showInbox($player),
                2 => TransferUI::open($player),
                3 => SlotMachineUI::open($player),
                4 => ProfileUI::open($player),
                5 => MiniGameUI::open($player),
                6 => AlarmUI::open($player),
            };
        });

        $form->setTitle("📱 Virtual Phone");
        $form->addButton("📨 Kirim Pesan");
        $form->addButton("📬 Lihat Inbox");
        $form->addButton("💸 Transfer Uang");
        $form->addButton("🎰 Slot Machine");
        $form->addButton("📊 Profil");
        $form->addButton("🧩 Mini Games");
        $form->addButton("⏰ Alarm");

        $player->sendForm($form);
    }
}
