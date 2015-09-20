<?php namespace App\Console\Commands;

class WnResourceCommand extends WnCommand {

	protected $signature = 'wn:resource 
        {table : Name of the resource\'s table}
        {fields : fields of the resource}
        {--fill= : the fillable fields of the resource}';

	protected $description = 'Generates a migration, seed, model and controller classes for a RESTfull resource';

    protected $fields = [];
    protected $fillableFields = [];

    public function handle()
    {
        $table = $this->argument('table');
        $name = ucwords(str_singular(camel_case($table)));
        $this->parse();

        $this->call('wn:model', [
            'name' => $name,
            '--fill' => $this->fillableFields
        ]);

        $this->call('wn:migration', [
            'name' => $name,
            '--table' => $table,
            'fields' => $this->fields
        ]);

        $this->info('Done !');
    }

    protected function parse()
    {
        $this->parseFields();
        $this->parseFillableFields();
    }

    protected function parseFields()
    {
        $parts = array_filter(explode(',', $this->argument('fields')), function($part){
            return trim($part) != '';
        });
        $this->fileds = [];
        foreach($parts as $part){
            $part = explode(':', $part);
            if(count($part) == 1)
                $part[1] = 'string';
            $name = array_splice($part, 0, 1)[0];
            $type = array_splice($part, 0, 1)[0];
            $this->fields[] = [
                'name' => $name,
                'type' => $type,
                'attrs' => $part
            ];
        }
    }

    protected function parseFillableFields()
    {
        $this->fillableFields = $this->option('fill');
        if($this->fillableFields == null){
            $this->fillableFields = array_map(function($field){
                return $field['name'];
            }, $this->fields);
        } else {
            $this->fillableFields = explode(',', $this->fillableFields);
        }
    }

}