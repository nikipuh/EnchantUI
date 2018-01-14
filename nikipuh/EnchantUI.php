<?php
namespace nikipuh;
use pocketmine\{Player, Server};
use pocketmine\plugin\PluginBase;
use pocketmine\utils\{TextFormat};
use pocketmine\item\Item;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\event\Listener;
use pocketmine\command\{Command, CommandSender, CommandExecutor, ConsoleCommandSender};
use pocketmine\entity\{Entity, Effect};
use pocketmine\event\player\{PlayerMoveEvent, PlayerJoinEvent, PlayerQuitEvent, PlayerExhaustEvent, PlayerInteractEvent, PlayerDropItemEvent};
use jojoe77777\FormAPI;
use onebone\economyapi\EconomyAPI;

class EnchantUI extends PluginBase implements Listener{
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args): bool{
        $player = $sender->getPlayer();
        switch ($cmd->getName()){
            case "enchant":
                $this->mainFrom($player);
                break;
        }
        return true;
    }
    public function mainFrom($player){
        $plugin = $this->getServer()->getPluginManager();
        $formapi = $plugin->getPlugin("FormAPI");
        $form = $formapi->createSimpleForm(function (Player $event, array $args){
            $result = $args[0];
            $player = $event->getPlayer();
            if($result === null){
            }
            switch($result){
                case 0: //Waffe
      $item = $player->getInventory()->getItemInHand();
      $enchantment = Enchantment::getEnchantment(mt_rand(9, 14))->setLevel((int)rand(1,2));;
      $money = EconomyAPI::getInstance()->myMoney($player);
		if($money < 10000){
		$player->sendMessage("Du hast nicht genug Geld!");
		}else{
			EconomyAPI::getInstance()->reduceMoney($player, 10000);
			$item->addEnchantment($enchantment);
            $player->getInventory()->setItemInHand($item);
			$player->sendMessage("Dein Item wurde verzaubert!");
		}
                    return;
                case 1://Werkzeug
      $item = $player->getInventory()->getItemInHand();
      $enchantment = Enchantment::getEnchantment(mt_rand(15, 18))->setLevel((int)rand(1,3));;
      $money = EconomyAPI::getInstance()->myMoney($player);
		if($money < 5000){
		$player->sendMessage("Du hast nicht genug Geld!");
		}else{
			EconomyAPI::getInstance()->reduceMoney($player, 5000);
			$item->addEnchantment($enchantment);
            $player->getInventory()->setItemInHand($item);
			$player->sendMessage("Dein Item wurde verzaubert!");
		}
                    return;
                case 2:
                    $item = $player->getInventory()->getItemInHand();
      $enchantment = Enchantment::getEnchantment(mt_rand(0, 5))->setLevel((int)rand(1,4));;
      $money = EconomyAPI::getInstance()->myMoney($player);
		if($money < 10000){
		$player->sendMessage("Du hast nicht genug Geld!");
		}else{
			EconomyAPI::getInstance()->reduceMoney($player, 10000);
			$item->addEnchantment($enchantment);
            $player->getInventory()->setItemInHand($item);
			$player->sendMessage("Dein Item wurde verzaubert!");
		}
                    return;
                    case 3: //Bogen
                    $item = $player->getInventory()->getItemInHand();
      $enchantment = Enchantment::getEnchantment(mt_rand(19, 22))->setLevel((int)rand(1,2));;
      $money = EconomyAPI::getInstance()->myMoney($player);
		if($money < 7500){
		$player->sendMessage("Du hast nicht genug Geld!");
		}else{
			EconomyAPI::getInstance()->reduceMoney($player, 7500);
			$item->addEnchantment($enchantment);
            $player->getInventory()->setItemInHand($item);
			$player->sendMessage("Dein Item wurde verzaubert!");
		}
                    return;
            }
        });
        $form->setTitle(TextFormat::WHITE . "Verzauberungen");
        $name = $player->getName();
        $eco = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
        $money = $eco->myMoney($name);
        $form->setContent("Dein Geld: $money\n§cBitte gehe sicher dass du das richtige Item in der Hand hast!\nWenn du einen Button drückst wird dein Item mit einer zufällige Verzauberung und zufälliger Stärke verzaubert.");
        $form->addButton(TextFormat::WHITE."§0Waffen verzaubern: 10.000 Taler");
        $form->addButton(TextFormat::WHITE."§0Werkzeuge verzaubern: 5.000 Taler");
        $form->addButton(TextFormat::WHITE."§0Rüstungsteile verzaubern: 10.000 Taler");
        $form->addButton(TextFormat::WHITE."§0Bogen verzaubern: 7.500 Taler");
        $form->sendToPlayer($player);
    }
    }
