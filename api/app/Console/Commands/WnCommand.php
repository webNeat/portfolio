<?php namespace App\Console\Commands;

use App\Console\Helpers\StubsFactory;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

abstract class WnCommand extends Command {

    protected $files;
	protected $stubs;

	public function __construct(Filesystem $files)
	{
        parent::__construct();
        
        $this->files = $files;
        $this->stubs = new StubsFactory($files);
    }

    protected function getStub($name)
    {
        return $this->stubs->get($name);
    }

    protected function save($content, $path)
    {
        $this->makeDirectory($path);
        $this->files->put($path, $content);
    }

    protected function makeDirectory($path)
    {
        if (!$this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }
    }

}