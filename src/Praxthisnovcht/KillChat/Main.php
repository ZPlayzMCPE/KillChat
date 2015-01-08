<?php
// Addon for CustomChat
namespace Praxthisnovcht\KillChat;

use pocketmine\IPlayer;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\Listener;
use Praxthisnovcht\CustomChat;

class KillChat extends PluginBase implements Listener
{

    public function onEnable()
    {
        $Name = $user->getPlayer()->getName();
        if (!(file_exists($this->plugin->getDataFolder() . "Counter/" . strtolower($Name) . ".yml"))) {
            return new Config($this->plugin->getDataFolder() . "Counter/" . strtolower($Name) . ".yml", Config::YAML, array(
                "Name" => $Name,


                "Kills" => $this->plugin->getMurderDone()->getName(),


                "Deaths" => $this->plugin->getDeathsDone()->getName(),

            ));
        } else {
            return new Config($this->plugin->getDataFolder() . "Counter/" . strtolower($Name) . ".yml", Config::YAML, array());
        }
        $this->saveDefaultConfig();
        $this->getLogger()->info("KillChat has been enabled.");
    }

    public function onDisable()
    {
        $this->getLogger()->info("KillChat has been disable.");
    }

    public function onPlayerDeath(EntityDeathEvent $event)
    {
        $entity = $event->getEntity();
        $cause = $entity->getLastDamageCause();
        $killer = $cause->getDamager();
        if ($killer instanceof Player) {
            $killer->sendMessage("You Have KILLED " . $cause . "");
            //add Kill point here
        }
        if ($cause instanceof Player) {
            //add Death point here
        }
        else {
            $this->getLogger()->info(TextFormat::BLUE . "KillChat Error");
        }
    }
}

