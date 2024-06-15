<?php

namespace CLPE\Clearlagmain;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\config;
use CLPE\Command\CLPEcommand;
use CLPE\Entity\Manager;
use CLPE\Task\Creator;

/**
 * Class main
 * @package CLPE\Clearlagmain
 */
 class main extends PluginBase
 {
   /**
    * @var main
    */
    private static $instance;
    public $config;
    /**
     * @var CLPE\Entity\Manager
     */
     private $manager;
     
     function_construct()
     {
       self::$instance = $this;
       $this->manager = new Manager($this)
     }
     
     /**
      * @return main 
      */
      static function getInstance()
      {
        return self::$instance;
      }
      
      /**
       * @return Manager
       */
       function getManager()
       {
         return $this->Manager;
       }
       
       function onEnable()
       {
         @mkdir($this->getDataFolder());
        $this->config = new Config($this->getDataFolder() . "Config.yml", Config::YAML, array(
            "Clear-msg" => "§l§b»§r §aRemoved §e@count §afrom lag!",
            "PreClear-msg" => "§l§b» §r§fIn a minute you will eliminate lag!",
            "Clear-time" => 150
         ));
         new Creator();
        $this->getLogger()->info("§l§aClear§fLag§ePE" . $this->getDescription()->getVersion() . " §l§aClear§fLag§ePE §aLoaded §f By @Dream25_chanYt");
        }
        
        /**
         * @param CommandSender $s
         * @param Command $cmd
         * @param string $label
         * @param array $args
         * @return bool|CLPEcommand
         */
         function onCommand(CommandSender $s, Command $cmd, $label, array $args)
         {
           return new CLPEcommand($s, $cmd, $args);
         }
         
         function onDisable()
    {
        $this->config->save();
        $this->getLogger()->info("§l§aClear§fLag§ePE" . $this->getDescription()->getVersion() . "§cDisable");
    }
}
