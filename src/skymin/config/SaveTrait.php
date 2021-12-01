<?php
declare(strict_types = 1);

namespace skymin\config;

use function file_put_contents;
use function json_encode;
use function yaml_emit;
use const JSON_PRETTY_PRINT;
use const JSON_UNESCAPED_UNICODE;
use const YAML_UTF8_ENCODING;

trait SaveTrait{
	
	private function save(int $type, string $path, array $data) :bool{
		if($type === 0){
			file_put_contents($path, yaml_emit($data, YAML_UTF8_ENCODING));
			return true;
		}elseif($type === 1){
			file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
			return true;
		}else{
			return false;
		}
	}
	
}