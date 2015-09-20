<?php namespace App\Console\Commands;

class WnModelCommand extends WnCommand {

	protected $signature = 'wn:model
        {name : Name of the resource}
        {--fill= : the fillable fields of the resource}';

	protected $description = 'Generates a model class for a RESTfull resource';

    protected $fields = [];

    public function handle()
    {
        $name = $this->argument('name');

        $content = $this->getStub('model')
            ->with([
                'name' => $name,
                'fillable_fields' => $this->getFillableFields()
            ])
            ->get();

        $this->save($content, './app/Http/Models/' . $name . '.php');

        $this->info('Model Generated !');
    }

    protected function getFillableFields()
    {
        $fillable = $this->option('fill');
        return implode(', ', array_map(function($item){
            return '"' . $item . '"';
        }, $fillable));
    }

}