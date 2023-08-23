<?php

namespace zk408\lang;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

use pocketmine\utils\Config;
use pocketmine\event\player\PlayerJoinEvent;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;

use pocketmine\Player;

class Main extends PluginBase implements Listener {
    
    public function onEnable() {
        @mkdir($this->getDataFolder());
        $this->database = new Config($this->getDataFolder() . "Lang.yml", Config::YAML);
        
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    
    public function onJoin(PlayerJoinEvent $event){
        $player = $event->getPlayer();
        if($this->database->exists(strtolower($player->getName()))){
            // Do nothing
        }else{
            $this->database->set(strtolower($player->getName()), "english");
            $this->database->save();
        }
    }
    
    public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){
        if($cmd->getName() == "setlang"){           
            if(!$sender instanceof Player){
                return $sender->sendMessage("§cOnly for players");
             }
             
             if(empty($args)){
                 return $sender->sendMessage("/setlang (lang)");
              }
              
              if(isset($args[0])){
                  if($args[0] == "eng"){
                      $sender->sendMessage("§aYour lang has been set to §fEnglish");
                      $this->database->set(strtolower($sender->getName()), "english");
                  return true;
                  }            
                  if($args[0] == "tag"){
                      $sender->sendMessage("§aYour lang has been set to §fTagalog");
                      $this->database->set(strtolower($sender->getName()), "tagalog");
                  return true;
                  }
                  if($args[0] == "pt"){                                          
                      $sender->sendMessage("§aYour lang has been set to §fPortuguese");  
                      $this->database->set(strtolower($sender->getName()), "portuguese");
                  return true;
                  }
                  if($args[0] == "rus"){
                      $sender->sendMessage("§aYour lang has been set to §fRussian");
                      $this->database->set(strtolower($sender->getName()), "russian");
                  return true;
                  }      
              }
         }
         if($cmd->getName() == "getlang"){
             return $sender->sendMessage("§aYour lang: §f{$this->getPlayerLanguage($sender)}");
         }
    }         
    
    public function getPlayerLanguage(Player $player){
       return $this->database->get(strtolower($player->getName()));
    }       
}
