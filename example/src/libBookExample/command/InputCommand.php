<?php

declare(strict_types=1);

namespace libBookExample\command;

use cooldogedev\libBook\LibBook;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\item\WritableBook;
use pocketmine\player\Player;

final class InputCommand extends Command
{
    public function __construct()
    {
        parent::__construct("input", "Test input", null, []);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): void
    {
        if (!$sender instanceof Player) {
            return;
        }

        $sender->sendMessage("WIP");

        $handler = function (Player $player, ?WritableBook $book): void {
            if ($book === null) {
                $player->sendMessage("Cancelled");
                return;
            }

            $player->sendMessage("You wrote: " . $book->getPageText(0));
        };

        LibBook::sendInput($sender, $handler);
    }
}
