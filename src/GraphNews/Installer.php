<?php
/**
 *
 */

namespace GraphNews;
use Composer\Script\Event;
use Symfony\Component\Filesystem\Filesystem;

class Installer {

    public static function postInstall(Event $event) {
        self::install($event);
        // exit composer and terminate installation process
        exit;
    }

    public static function postUpdate(Event $event) {
        self::install($event);
        // exit composer and terminate installation process
        exit;
    }

    private static function install(Event $event){
        $paths = ["/../../var/cache","/../../var/log"];
        $filesystem = new Filesystem();
        $io = $event->getIO();
        foreach($paths as $path){
            $path = __DIR__ . $path;
            if(!$filesystem->exists($path)){
                $filesystem->mkdir($path);
                if($filesystem->exists($path)) {

                    $io->write("Create dir : ". realpath($path));
                }else{
                    $io->writeError("unable to create dir :".$path);
                    $io->writeError("Create manually". $path);
                }
            }else{
                $io->write("Nothing To do, everything Ok");
            }
        }
    }

} 