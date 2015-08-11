<?php
/**
 * 
 * @author: Jean-Philippe Dépigny <jdepigny.ext@orange.com>
 * Date: 24/07/2015
 * Time: 14:02
 */

namespace GraphNews;
use Silex\Application;

class GraphNewsApplication extends Application {
    use Application\TwigTrait;
    use Application\MonologTrait;
    use Application\UrlGeneratorTrait;
}