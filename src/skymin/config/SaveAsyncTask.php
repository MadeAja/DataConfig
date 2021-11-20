<?php
declare(strict_types = 1);

namespace skymin\config;

use pocketmine\Server;
use pocketmine\scheduler\AsyncTask;

use PrefixedLogger;

use function file_put_contents;
use function json_encode;
use function yaml_emit;
use const JSON_PRETTY_PRINT;
use const JSON_UNESCAPED_UNICODE;
use const YAML_UTF8_ENCODING;

final class SaveAsyncTask extends AsyncTask{
	
	private PrefixedLogger $logger;
	
	public function __construct(
		private string $path,
		private array $data,
		private int $type
	){
		$this->logger = new PrefixedLogger(Server::getInstance()->getLogger(), 'DataConfig');
	}
	
	public function onRun() :void{
		$type = $this->type;
		$path = $this->path;
		$data = (array) $this->data;
		$this->logger->debug('Starting save data at '.  $path);
		if($type === 0){
			file_put_contents($path, yaml_emit($data, YAML_UTF8_ENCODING));
			$this->setResult('Completed');
		}
		elseif($type === 1){
			file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
			$this->setResult('Completed');
		}else{
			$this->setResult('Failed');
		}
	}
	
	public function onCompletion() :void{
		$this->logger->debug($this->getResult() . ' to save Data at' . $this->path);
	}
	
}