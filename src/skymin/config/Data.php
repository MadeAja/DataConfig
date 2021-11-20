<?php
declare(strict_types = 1);

namespace skymin\config;

use pocketmine\Server;

use function file_exists;
use function file_get_contents;
use function json_decode;
use function yaml_parse;
use function preg_replace;

final class Data{
	
	public const YAML = 0;
	public const JSON = 1;
	
	public static function call(string $path, int $type = self::YAML) :array{
		if(!file_exists($path)){
			return [];
		}
		$content = file_get_contents($path);
		if($type === self::YAML){
			return yaml_parse(preg_replace("#^( *)(y|Y|yes|Yes|YES|n|N|no|No|NO|true|True|TRUE|false|False|FALSE|on|On|ON|off|Off|OFF)( *)\:#m", "$1\"$2\"$3:", $content));
		}
		if($type === self::JSON){
			return json_decode($content, true);
		}else{
			new \InvalidArgumentException('unknown type');
		}
	}
	
	public static function save(string $path, array $data, int $type = self::YAML) :void{
		Server::getInstance()->getAsyncPool()->submitTask(new SaveAsyncTask($path, $data, $type));
	}
	
}
