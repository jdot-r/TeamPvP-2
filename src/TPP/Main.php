<?php

namespace TPP;

use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\level\particle\Particle;
use pocketmine\level\particle\HeartParticle;
use pocketmine\math\Vector3;
use pocketmine\level\Position;
use pocketmine\level\Level;
use pocketmine\block\Block;
use pocketmine\item\Item;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityRegainHealthEvent;
use pocketmine\event\block\BlockBreakEvent;

class Main extends PluginBase implements Listener{

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info("TeamPvP Enabled !");
    }
    
    public function TeamCreate($args1, $args2, $color, $team, $sender, $p1, $p2){
      if(strtolower($args1 !== null && $args2 !== null)){
        if($p1 instanceof Player && $p2 instanceof Player){
          $p1->setNametag($color."[".$team."]§r\n§l§7» §r".$p1->getName()."§r\n§l§7» §cVie : §4".$p1->getHealth());
          $p2->setNametag($color."[".$team."]§r\n§l§7» §r".$p2->getName()."§r\n§l§7» §cVie : §4".$p2->getHealth());
          $p1->sendMessage("Tu es desormais dans la team ".$team." avec ".$p2->getName().".");
          $p2->sendMessage("Tu es desormais dans la team ".$team." avec ".$p1->getName().".");
          $sender->sendMessage("Tu viens de creer une team entre ".$p1->getName()." et ".$p2->getName().".");
        }else{
          $sender->sendMessage("L'un des 2 joueurs n'est pas en ligne.");
        }
      }else{
        $sender->sendMessage("Pour creer une team, tu dois designer 2 joueurs.");
      }
    }

    public function onCommand(CommandSender $sender, Command $command, $label, array $args){
      if($sender instanceof Player){
        if(strtolower($command->getName() == "team")){
          $p1 = $sender->getServer()->getPlayer($args[1]);
          $p2 = $sender->getServer()->getPlayer($args[2]);
          if(strtolower($args[0] == "bleu")){
            $this->TeamCreate($args[1], $args[2], "§9§l",  "Bleu", $sender, $p1, $p2);
          }
          if(strtolower($args[0] == "vert")){
            $this->TeamCreate($args[1], $args[2], "§a§l", "Vert", $sender, $p1, $p2);
          }
          if(strtolower($args[0] == "jaune")){
            $this->TeamCreate($args[1], $args[2], "§e§l", "Jaune", $sender, $p1, $p2);
          }
          if(strtolower($args[0] == "violet")){
            $this->TeamCreate($args[1], $args[2], "§5§l", "Violet", $sender, $p1, $p2);
          }
          if(strtolower($args[0] == "rose")){
            $this->TeamCreate($args[1], $args[2], "§d§l", "Rose", $sender, $p1, $p2);
          }
          if(strtolower($args[0] == "orange")){
            $this->TeamCreate($args[1], $args[2], "§6§l", "Orange", $sender, $p1, $p2);
          }
          if(strtolower($args[0] == "rouge")){
            $this->TeamCreate($args[1], $args[2], "§c§l", "Rouge", $sender, $p1, $p2);
          }
          if(strtolower($args[0] == "cyan")){
            $this->TeamCreate($args[1], $args[2], "§b§l", "Cyan", $sender, $p1, $p2);
          }
          if(strtolower($args[0] == "gris")){
            $this->TeamCreate($args[1], $args[2], "§7§l", "Gris", $sender, $p1, $p2);
          }
          if(strtolower($args[0] == "blanc")){
            $this->TeamCreate($args[1], $args[2], "§f§l", "Blanc", $sender, $p1, $p2);
          }
          if(strtolower($args[0] == "noir")){
            $this->TeamCreate($args[1], $args[2], "§0§l", "Noir", $sender, $p1, $p2);
          }
        }
      }
    }

    public function onPvP(EntityDamageEvent $event){
      if($event instanceof EntityDamageByEntityEvent){
        if($event->getEntity() instanceof Player && $event->getDamager() instanceof Player){
          $victim = $event->getEntity()->getNameTag();
          $killer = $event->getDamager()->getNameTag();
          if((strpos($victim, "[Bleu]")!== false) && (strpos($killer, "[Bleu]") !== false)){
            $event->setCancelled(true);
          }
          if((strpos($victim, "[Vert]")!== false) && (strpos($killer, "[Vert]") !== false)){
            $event->setCancelled(true);
          }
          if((strpos($victim, "[Jaune]")!== false) && (strpos($killer, "[Jaune]") !== false)){
            $event->setCancelled(true);
          }
          if((strpos($victim, "[Violet]")!== false) && (strpos($killer, "[Violet]") !== false)){
            $event->setCancelled(true);
          }
          if((strpos($victim, "[Blanc]")!== false) && (strpos($killer, "[Blanc]") !== false)){
            $event->setCancelled(true);
          }
          if((strpos($victim, "[Rouge]")!== false) && (strpos($killer, "[Rouge]") !== false)){
            $event->setCancelled(true);
          }
          if((strpos($victim, "[Orange]")!== false) && (strpos($killer, "[Orange]") !== false)){
            $event->setCancelled(true);
          }
          if((strpos($victim, "[Rose]")!== false) && (strpos($killer, "[Rose]") !== false)){
            $event->setCancelled(true);
          }
          if((strpos($victim, "[Gris]")!== false) && (strpos($killer, "[Gris]") !== false)){
            $event->setCancelled(true);
          }
          if((strpos($victim, "[Noir]")!== false) && (strpos($killer, "[Noir]") !== false)){
            $event->setCancelled(true);
          }
          if((strpos($victim, "[Cyan]")!== false) && (strpos($killer, "[Cyan]") !== false)){
            $event->setCancelled(true);
          }
        }
        $entity = $event->getEntity();
        if($entity instanceof Player){
          $pn = $entity->getNametag();
          $player = $entity->getPlayer();
          if((strpos($pn, "[Bleu]")!== false)){
            $player->setNametag("§9§l[Bleu]§r\n§l§7» §r".$player->getName()."§r\n§l§7» §cVie : §4".$player->getHealth());
          }
          if((strpos($pn, "[Rouge]")!== false)){
            $player->setNametag("    §c§l[Rouge]§r\n§l§7» §r".$player->getName()."§r\n§l§7» §cVie : §4".$player->getHealth());
          }
          if((strpos($pn, "[Violet]")!== false)){
            $player->setNametag("§5§l[Violet]§r\n§l§7» §r".$player->getName()."§r\n§l§7» §cVie : §4".$player->getHealth());
          }
          if((strpos($pn, "[Rose]")!== false)){
            $player->setNametag("§d§l[Rose]§r\n§l§7» §r".$player->getName()."§r\n§l§7» §cVie : §4".$player->getHealth());
          }
          if((strpos($pn, "[Noir]")!== false)){
            $player->setNametag("§0§l[Noir]§r\n§l§7» §r".$player->getName()."§r\n§l§7» §cVie : §4".$player->getHealth());
          }
          if((strpos($pn, "[Blanc]")!== false)){
            $player->setNametag("§f§l[Blanc]§r\n§l§7» §r".$player->getName()."§r\n§l§7» §cVie : §4".$player->getHealth());
          }
          if((strpos($pn, "[Cyan]")!== false)){
            $player->setNametag("§b§l[Bleu]§r\n§l§7» §r".$player->getName()."§r\n§l§7» §cVie : §4".$player->getHealth());
          }
          if((strpos($pn, "[Jaune]")!== false)){
            $player->setNametag("§e�l[Jaune]§r\n§l§7» §r".$player->getName()."§r\n§l§7» §cVie : §4".$player->getHealth());
          }
          if((strpos($pn, "[Orange]")!== false)){
            $player->setNametag("§6�l[Orange]§r\n§l§7» §r".$player->getName()."§r\n§l§7» §cVie : §4".$player->getHealth());
          }
          if((strpos($pn, "[Gris]")!== false)){
            $player->setNametag("§7�l[Gris]§r\n§l§7» §r".$player->getName()."§r\n§l§7» §cVie : §4".$player->getHealth());
          }
          if((strpos($pn, "[Vert]")!== false)){
            $player->setNametag("§a�l[Vert]§r\n§l§7» §r".$player->getName()."§r\n§l§7» §cVie : §4".$player->getHealth());
          }
        }
      }
    }

    public function onDeath(PlayerDeathEvent $event){
      $player = $event->getPlayer();
      $pn = $player->getNameTag();
      if(strpos($pn, "[Bleu]") !== false || strpos($pn, "[Rouge]") !== false || strpos($pn, "[Vert]") !== false || strpos($pn, "[Gris]") !== false || strpos($pn, "[Jaune]") !== false || strpos($pn, "[Cyan]") !== false || strpos($pn, "[Rose]") !== false || strpos($pn, "[Violet]") !== false || strpos($pn, "[Orange]") !== false || strpos($pn, "[Noir]") !== false || strpos($pn, "[Blanc]") !== false){
        $player->kill();
        $player->kick("Tu viens de mourir, reconnecte-toi.");
      }
    }
    
    public function onEntityRegainHealth(EntityRegainHealthEvent $event){
      if($event instanceof EntityRegainHealthEvent){
        $entity = $event->getEntity();
        if($entity instanceof Player){
          $pn = $entity->getNametag();
          $player = $entity->getPlayer();
          if((strpos($pn, "[Bleu]")!== false)){
            $player->setNametag("§9§l[Bleu]§r\n§l§7» §r".$player->getName()."§r\n§l§7» §cVie : §4".$player->getHealth());
            $player->getLevel()->addParticle(new HeartParticle(new Vector3($player->x, $player->y+3, $player->z)));
          }
          if((strpos($pn, "[Rouge]")!== false)){
            $player->setNametag("§c§l[Rouge]§r\n§l§7» §r".$player->getName()."§r\n§l§7» §cVie : §4".$player->getHealth());
          }
          if((strpos($pn, "[Violet]")!== false)){
            $player->setNametag("§5§l[Violet]§r\n§l§7» §r".$player->getName()."§r\n§l§7» §cVie : §4".$player->getHealth());
          }
          if((strpos($pn, "[Rose]")!== false)){
            $player->setNametag("§d§l[Rose]§r\n§l§7» §r".$player->getName()."§r\n§l§7» §cVie : §4".$player->getHealth());
          }
          if((strpos($pn, "[Noir]")!== false)){
            $player->setNametag("§0§l[Noir]§r\n§l§7» §r".$player->getName()."§r\n§l§7» §cVie : §4".$player->getHealth());
          }
          if((strpos($pn, "[Blanc]")!== false)){
            $player->setNametag("§f§l[Blanc]§r\n§l§7» §r".$player->getName()."§r\n§l§7» §cVie : §4".$player->getHealth());
          }
          if((strpos($pn, "[Cyan]")!== false)){
            $player->setNametag("§b§l[Bleu]§r\n§l§7» §r".$player->getName()."§r\n§l§7» §cVie : §4".$player->getHealth());
          }
          if((strpos($pn, "[Jaune]")!== false)){
            $player->setNametag("    §e�l[Jaune]§r\n§l§7» §r".$player->getName()."§r\n§l§7» §cVie : §4".$player->getHealth());
          }
          if((strpos($pn, "[Orange]")!== false)){
            $player->setNametag("    §6�l[Orange]§r\n§l§7» §r".$player->getName()."§r\n§l§7» §cVie : §4".$player->getHealth());
          }
          if((strpos($pn, "[Gris]")!== false)){
            $player->setNametag("§7�l[Gris]§r\n§l§7» §r".$player->getName()."§r\n§l§7» §cVie : §4".$player->getHealth());
          }
          if((strpos($pn, "[Vert]")!== false)){
            $player->setNametag("§a�l[Vert]§r\n§l§7» §r".$player->getName()."§r\n§l§7» §cVie : §4".$player->getHealth());
          }
        }
      }
    }
}