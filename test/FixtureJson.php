<?php
namespace li3_fixtures\test;


class FixtureJson extends Fixture {
	
	protected $_records = [];
	
	
	public function loadData($data) {
		$this->_records = $data;
	}
	
}
