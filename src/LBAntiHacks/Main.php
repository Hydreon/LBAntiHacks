<?php

namespace LBAntiHacks;

use AntiHack\AntiHack;
use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\utils\TextFormat;
use pocketmine\plugin\PluginBase;
use pocketmine\command\CommandSender;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\event\player\PlayerRespawnEvent;

/**
 * Main antihacks plugin class
 */
class Main extends PluginBase implements Listener {

    /**
     * Loads the plugin
     *
     * @return null
     */
    public function onLoad() {
        $this->getLogger()->info(TextFormat::WHITE . "Loaded");
    }

    /**
     * Enables the plugin
     *
     * @return null
     */
    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->saveDefaultConfig();
        $this->reloadConfig();

        /**
         * Disable the plugin if it's disabled in the plugin
         */
        if($this->getConfig()->get('lbantihacks') == false) {
            $this->setEnabled(false);
            return;
        }

        AntiHack::enable($this);

        /**
         * Initalize the AntiHack listener
         * @type AntiHack
         */
        $this->antihack = AntiHack::getInstance();

        $this->getLogger()->info(TextFormat::DARK_GREEN . "Enabled");
    }

    /**
     * Handles the commands sent to the plugin
     *
     * @param  CommandSender $sender  The person issuing the command
     * @param  Command       $command The command object
     * @param  string        $label   The command label
     * @param  array         $args    An array of arguments
     * @return boolean                True allows the command to go through, false sends an error
     */
    public function onCommand(CommandSender $sender, Command $command, $label, array $args) {
        $subcommand = strtolower(array_shift($args));
        switch ($subcommand) {
            default:
                return true;
        }
    }

    /**
     * Disables the plguin
     *
     * @return null
     */
    public function onDisable() {
        $this->getConfig()->save();

        $this->getLogger()->info(TextFormat::DARK_RED . "Disabled");
    }
}
