<?php namespace App\Console\Commands;

class WnMigrationCommand extends WnCommand {

	protected $signature = 'wn:migration
        {name : Name of the resource}
        {fields : fields of the resource}
        {--table= : the table corresponding to the resource}';

	protected $description = 'Generates a model class for a RESTfull resource';

    public function handle()
    {
        $content = $this->getStub('migration')
            ->with([
                'name' => $this->argument('name'),
                'table' => $this->option('table'),
                'fields' => $this->makeFields()
            ])
            ->get();

        $this->save($content, './database/migrations/' . date('Y_m_d_His_') . $this->option('table') . '.php');

        $this->info('Migration Generated !');
    }

    public function makeFields()
    {
        $lines = [];

        foreach($this->argument('fields') as $field){
            $field['attrs'] = $this->makeAttributes($field['attrs']);
            $lines[] = $this->getStub('schema-field')->with($field)->get();
        }

        return implode(PHP_EOL, $lines);
    }

    public function makeAttributes($attrs)
    {
        if(count($attrs) < 1)
            return '';
        
        return implode('', array_map(function($attr){
            return '->' . $attr . '()';
        }, $attrs));
    }

}