<?php
/**
 * 
 * @author: Jean-Philippe Dépigny
 * Date: 24/07/2015
 * Time: 13:34
 */

namespace GraphNews\Controller;




use Symfony\Component\VarDumper\VarDumper;

class BaseController{


    public function dump($dump){
        VarDumper::dump($dump);
    }
}