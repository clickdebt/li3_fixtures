<?php
namespace li3_fixtures\extensions\adapter\test\fixtures;

use RuntimeException;
use UnexpectedValueException;

class ConnectionJson extends Connection {
	
	protected function _instantiate($name) {
		if (isset($this->_fixtures[$name])) {
			$options = array(
				'connection' => $this->_connection,
				'alters' => $this->_config['alters']
			);
			if(is_array($this->_fixtures[$name])) {
				$data = $this->_loadJson($this->_fixtures[$name]['data']);
				$this->_loaded[$name] = new $this->_fixtures[$name]['fixture']($options);
				$this->_loaded[$name]->loadData($data);
				return true;
			}
			else {
				$this->_loaded[$name] = new $this->_fixtures[$name]($options);
				return true;
			}
		} else {
			throw new UnexpectedValueException("Undefined fixture named: `{$name}`.");
		}
	}
	
	private function _loadJson($file) {
		$data = json_decode(file_get_contents($file), true);
		
		if(json_last_error() != JSON_ERROR_NONE) {
			throw new RuntimeException("Failed to parse json file `{$file}`");
		}
		
		return $data;		
	}

}

?>