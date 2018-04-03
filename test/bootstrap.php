<?php

require_once dirname(__FILE__) . '/../vendor/autoload.php';


class File extends \SplFileObject
{

    public function getInfo($name = '')
    {
        return $this->getfilename();
    }

}