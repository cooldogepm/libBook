<?php

declare(strict_types=1);

namespace libBookExample\command;

use cooldogedev\libBook\LibBook;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\item\VanillaItems;
use pocketmine\player\Player;

final class PreviewCommand extends Command
{
    public function __construct()
    {
        parent::__construct("preview", "Test preview", null, []);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void
    {
        if (!$sender instanceof Player) {
            return;
        }

        $item = VanillaItems::WRITTEN_BOOK();
        $item->setTitle("Test Title");
        $item->setAuthor("cooldogedev");
        $item->setPageText(0, "Test Page 1");
        $item->setPageText(1, "Test Page 2");

        LibBook::sendPreview($sender, $item);
    }
}
