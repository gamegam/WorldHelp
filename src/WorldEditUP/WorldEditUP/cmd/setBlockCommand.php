<?php

namespace WorldEditUP\WorldEditUP\cmd;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use WorldEditUP\WorldEditUP\Main;
use pocketmine\math\Vector3;
use pocketmine\block\VanillaBlocks;

class setBlockCommand extends Command{

	public function __construct(){
		parent::__construct("setblock", "setBlock create");
		$this->setPermission('up.cmd');
	}
	public function execute(CommandSender $p, string $label, array $args): bool{
		if (! $this->testPermission($p)){
			return true;
		}
		if (! $p instanceof Player){
			$p->sendMessage("§cTo use this command, you must connect to the server.");
			return true;
		}
		$pos = $p->getPosition();
		$x = $pos->getX();
		$y = $pos->getY();
		$z = $pos->getZ();
		if (!isset($args[0]) and !isset($args[1]) and !isset($args[2])){
			$p->sendMessage("/setBlock [x] [y] [z] [BlockName]]");
			return false;
		}
		if ($args[0] == "~"){
			$blockX = $x;
		}
		if ($args[1] == "~"){
			$blockY = $y;
		}
		if ($args[2] == "~"){
			$blockz = $z;
		}
		$bx = $blockX ?? $args[0];
		$by = $blockY ?? $args[1];
		$bz = $blockz ?? $args[2];
		if (!is_numeric($bx) and !is_numeric($by) and !is_numeric($bz)){
			$p->sendMessage("Please enter in numbers!");
			return true;
		}
		if (!isset($args[3])){
			$p->sendMessage("/setBlock [x] [y] [z] [BlockName]]");
			return true;
		}
		
		$name = strtolower($args[3]);
		$block = VanillaBlocks::$name() ?? "AIR";
		$p->getWorld()->setBlock(new Vector3($bx, $by, $bz), $block);
		$p->sendMessage("block installed");
		return true;
    }
}
