<?php namespace App\Console\Helpers;

use Illuminate\Filesystem\Filesystem;


class Stub {

	protected $template;

	protected $data;

	protected $compiled;

	protected $dirty;

	public function __construct($template)
	{
		$this->template = $template;
		$this->compiled = '';
		$this->data = [];
		$this->dirty = false;
	}

	public function clean()
	{
		$this->data = [];
		$this->dirty = false;
		return $this;
	}

	public function with($data = [])
	{
		if($data)
			$this->dirty = true;
		foreach ($data as $key => $value) {
			$this->data[$key] = $value;
		}
		return $this;
	}

	public function get()
	{
		if($this->dirty){
			$this->compile();
			$this->dirty = false;
		}
		return $this->compiled;
	}

	public function compile()
	{
		$this->compiled = $this->template;
		foreach($this->data as $key => $value){
			$this->compiled = str_replace('{{' . $key . '}}', $value, $this->compiled);
		}
		return $this;
	}

}