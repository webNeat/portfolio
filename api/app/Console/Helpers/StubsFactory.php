<?php namespace App\Console\Helpers;

use App\Console\Helpers\Stub;
use Illuminate\Filesystem\Filesystem;


class StubsFactory {

	protected $fs;
	protected $stubs;

	public function __construct(Filesystem $fs)
	{
		$this->fs = $fs;
		$this->stubs = [];
	}

	public function get($name)
	{
		if(! isset($this->stubs[$name]))
			$this->stubs[$name] = new Stub($this->fs->get(__DIR__ . "/../stubs/{$name}.stub"));
		return $this->stubs[$name];
	}

}