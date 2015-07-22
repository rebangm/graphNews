<?php
/**
 * 
 * @author: Jean-Philippe Dépigny
 * Date: 22/07/2015
 * Time: 12:05
 */

class graphNews extends Silex\Application{

    /**
     * @param array $values
     */
    public function __construct(array $values = array())
    {
        parent::__construct($values);
        //$this->register(new Config);
    }
}