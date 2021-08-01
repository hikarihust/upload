<?php
class Json{

    private $table = '';  
    private $columns = [];

    public function __construct($table, $columns){
        $this->table = $table;
        $this->columns = $columns;
    }

    public function list(){
        return json_decode(file_get_contents($this->table), true);
    }

    public function get($id){
        $result = null;
        $items = $this->list();
        $index = array_search($id, array_column($items, 'id'));
        if ($index !== false) $result = $items[$index];
        return $result;
    }
}
