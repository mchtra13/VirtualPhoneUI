<?php

namespace VirtualPhone;

class DataManager {
    private static string $dataFolder = "plugin_data/VirtualPhone/messages/";

    public static function addMessage(string $to, string $from, string $message): void {
        @mkdir(self::$dataFolder);
        $file = self::$dataFolder . strtolower($to) . ".json";
        $data = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
        $data[] = ["from" => $from, "message" => $message];
        file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));
    }

    public static function getInbox(string $playerName): array {
        $file = self::$dataFolder . strtolower($playerName) . ".json";
        return file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    }
}
