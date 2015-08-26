<?php
/**
 * @author : Rebangm <rebangm@gmail.com>
 * Date: 26/08/15
 * Time: 20:51
 */

namespace GraphNews\AdminBundle\Service\Json;


class JsonUtils {


    /**
     * output json in a pretty print
     * @param $json
     * @param string $istr
     * @return string
     * TODO create separate service for reuse
     */
    public function jsonPretty($json, $istr='  ')
    {
        $result = '';
        for($p=$q=$i=0; isset($json[$p]); $p++)
        {
            $json[$p] == '"' && ($p>0?$json[$p-1]:'') != '\\' && $q=!$q;
            if(!$q && strchr(" \t\n\r", $json[$p])){continue;}
            if(strchr('}]', $json[$p]) && !$q && $i--)
            {
                strchr('{[', $json[$p-1]) || $result .= "\n".str_repeat($istr, $i);
            }
            $result .= $json[$p];
            if(strchr(',{[', $json[$p]) && !$q)
            {
                $i += strchr('{[', $json[$p])===FALSE?0:1;
                strchr('}]', $json[$p+1]) || $result .= "\n".str_repeat($istr, $i);
            }
        }
        return $result;
    }

    /**
     * Uglify json
     * @param $json
     * @return mixed
     * TODO create separate service for reuse
     */
    public function jsonUglify($json)
    {
        return preg_replace('#\s(?=([^"]*"[^"]*")*[^"]*$)#',"",$json);
    }
} 