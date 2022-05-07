<?php
class Template
{
    protected $contents;
    protected $values = [];

    public function __construct($contents)
    {
        $this->contents = $contents;
    }

    public function set($key, $value)
    {
        $this->values[$key] = $value;
    }

    public function output()
    {
        $output = $this->contents;

        foreach ($this->values as $key => $value) {
            $tagToReplace = '{{' . $key . '}}';
            $output = str_replace($tagToReplace, $value, $output);
        }

        return $output;
    }
}
