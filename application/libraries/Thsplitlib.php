<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Thsplitlib
{
    public function __construct(){
        log_message('Debug', 'Thsplitlib class is loaded.');
    }

    public function load(){
        // Include Thsplitlib library files
        require_once APPPATH.'third_party/Thsplitlib/segment.php';
        $segment = new Segment();
        return $segment;
    }
}