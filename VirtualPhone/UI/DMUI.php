<?php

namespace VirtualPhone\UI;

use jojoe77777\FormAPI\CustomForm;
use pocketmine\player\Player;
use VirtualPhone\DataManager;

class DMUI {

    public static function open(Player $player): void {
        $form = new CustomForm(function(Player $player, ?array $data): void {
            if ($data === null) return;
            [$targetName, $message] = $data;

            $target = $player->getServer()->getPlayerExact($targetName);
            if ($target === null) {
                $player->sendMessage("§cPemain tidak ditemukan.");
                return;
            }

            // Simpan pesan
            DataManager::addMessage($targetName, $player->getName(), $message);

            $target->sendMessage("§a📨 Pesan baru dari §e" . $player->getName() . ": §f" . $message);
            $player->sendMessage("§aPesan dikirim ke $targetName.");
        });

        $form->setTitle("📨 Kirim Pesan");
        $form->addInput("Nama Pemain Tujuan:");
        $form->addInput("Isi Pesan:");
        $player->sendForm($form);
    }

    public static function showInbox(Player $player): void {
        $inbox = DataManager::getInbox($player->getName());

        $form = new CustomForm(function(Player $player, ?array $data): void {});
        $form->setTitle("📥 Inbox");

        if (empty($inbox)) {
            $form->addLabel("Tidak ada pesan masuk.");
        } else {
            foreach ($inbox as $msg) {
                $form->addLabel("📨 Dari §e{$msg['from']}\n§f{$msg['message']}");
            }
        }

        $player->sendForm($form);
    }
}
