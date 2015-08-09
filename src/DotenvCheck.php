<?php namespace Kielabokkie\DotenvCheck;

use League\CLImate\CLImate;

class DotenvCheck
{
    public static function check()
    {
        $cli = new CLImate;

        $file = fopen(".env", "r");
        $env = [];
        while (feof($file) === false) {
            $line    = fgets($file);
            $lineAry = explode("=", $line);
            $key = trim($lineAry[0]);
            if (empty($key) === false) {
                $env[] = $key;
            }
        }

        $file = fopen(".env.example", "r");
        $envExample = [];
        while (feof($file) === false) {
            $line    = fgets($file);
            $lineAry = explode("=", $line);
            $key = trim($lineAry[0]);
            if (empty($key) === false) {
                $envExample[] = $key;
            }
        }

        $cli->br()->yellow('The following variables are missing from your .env file');
        $result = array_diff($envExample, $env);
        foreach ($result as $variable) {
            $cli->red(sprintf('- %s', $variable));
        }

        $cli->br()->yellow('The following variables are in your .env file but not in .env.example');
        $result = array_diff($env, $envExample);
        foreach ($result as $variable) {
            $cli->red(sprintf('- %s', $variable));
        }
    }
}
