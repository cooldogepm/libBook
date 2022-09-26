<?php

declare(strict_types=1);

namespace libBookExample;

use cooldogedev\libBook\LibBook;
use libBookExample\command\InputCommand;
use libBookExample\command\PreviewCommand;
use pocketmine\plugin\PluginBase;

final class libBookExample extends PluginBase
{
    protected function onEnable(): void
    {
        if (!LibBook::isRegistered()) {
            LibBook::register($this);
        }

        $this->getServer()->getCommandMap()->registerAll("libBookExample", [
            new PreviewCommand(),
            new InputCommand()
        ]);
    }
}
