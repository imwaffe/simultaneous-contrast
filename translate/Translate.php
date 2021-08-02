<?php
class Translate{
    protected $translations = [];

    function __construct($lang){
    	$filePath = __DIR__ . '/lang/' . $lang . '.json';
        if (file_exists($filePath)) {
            $this->translations = json_decode(file_get_contents($filePath), true);
        }
        else
            $this->__construct("en");
    }

    public function get($category, $message): string
    {
        return $this->translations[$category][$message] ?? $message;
    }
}
?>