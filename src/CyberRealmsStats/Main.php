<?php

namespace CyberRealmsStats;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\scheduler\CallbackTask;

class Main extends PluginBase implements Listener {
 	private $timer, $EconomyS;
 
 	public function onEnable() {
 		$this->getServer()->getPluginManager()->registerEvents($this, $this);
 		$this->EconomyS = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");
 		$this->getServer()->getScheduler()->scheduleRepeatingTask(new CallbackTask(array($this, "CyberRealmsStats")), 10);
		$this->getLogger()->info("§a Enabled by FahmiCyber v1.0 !");
 		$this->timer = 0;
 	}
 
 	public function CyberRealmsStats() {
 		foreach($this->getServer()->getOnlinePlayers() as $players) {
 			$Name = $players->getPlayer()->getName();
 			$Money = $this->EconomyS->mymoney($Name);
 			$Online = count(Server::getInstance()->getOnlinePlayers());
 			$Full = $this->getServer()->getMaxPlayers();
 			$players->sendTip(" §b« §1Cyber§2Realms§4Stats§b »\n §eHello:§b $Name !\n §aUang:§f $Money §2$\n §cOnline:§6 $Online §e/§6 $Full");
 		}
 	}

	public function onDisable() {
		$this->getLogger()->info("§4Disabled !");
	}
}