<?php
/**
 * 
 * @author: Jean-Philippe Dépigny
 * Date: 24/07/2015
 * Time: 13:34
 */

namespace GraphNews\Controller;



use Silex\Controller;
use Symfony\Component\VarDumper\VarDumper;

class BaseController extends Controller {

    public function __construct(){

    }

    public function dump($dump){
        VarDumper::dump($dump);
    }

}