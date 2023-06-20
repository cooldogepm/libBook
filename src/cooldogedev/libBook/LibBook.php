<?php

declare(strict_types=1);

namespace cooldogedev\libBook;

use Closure;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;
use pocketmine\item\WritableBookBase;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\convert\TypeConverter;
use pocketmine\network\mcpe\protocol\InventoryTransactionPacket;
use pocketmine\network\mcpe\protocol\types\BlockPosition;
use pocketmine\network\mcpe\protocol\types\inventory\ItemStack;
use pocketmine\network\mcpe\protocol\types\inventory\ItemStackWrapper;
use pocketmine\network\mcpe\protocol\types\inventory\UseItemTransactionData;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use RuntimeException;

final class LibBook
{
    protected static bool $registered = false;

    public static function register(PluginBase $plugin): void
    {
        if (LibBook::$registered) {
            throw new RuntimeException("Tried to register LibBook twice");
        }

        LibBook::$registered = true;
    }

    protected static function useItem(Player $player, Item $item): void
    {
        $item->setCustomName(""); // sometimes it shows up as a popup

        $oldItem = $player->getInventory()->getItemInHand();

        $player->getInventory()->setItemInHand($item);
        $player->getNetworkSession()->getInvManager()->syncSlot(
            $player->getInventory(),
            $player->getInventory()->getHeldItemIndex(),
            TypeConverter::getInstance()->coreItemStackToNet($item)
        );

        $player->getNetworkSession()->sendDataPacket(InventoryTransactionPacket::create(
            0,
            [],
            UseItemTransactionData::new(
                [],
                UseItemTransactionData::ACTION_CLICK_AIR,
                new BlockPosition(0, 0, 0),
                0,
                0,
                ItemStackWrapper::legacy(ItemStack::null()),
                Vector3::zero(),
                Vector3::zero(),
                0
            )
        ));

        $player->getInventory()->setItemInHand($oldItem);
    }

    public static function sendPreview(Player $player, WritableBookBase $book): void
    {
        LibBook::useItem($player, $book);
    }

    /**
     * TODO: Implement this
     */
    public static function sendInput(Player $player, Closure $handler): void
    {
        $item = VanillaItems::WRITABLE_BOOK();
        $item->setPageText(0, "");
        $item->setPageText(1, "");

        LibBook::useItem($player, $item);
    }

    public static function isRegistered(): bool
    {
        return LibBook::$registered;
    }
}
