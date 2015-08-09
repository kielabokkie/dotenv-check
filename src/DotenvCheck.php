<?php namespace Kielabokkie;

use Symfony\Component\Console\Helper\FormatterHelper;
use Symfony\Component\Console\Output\ConsoleOutput;

class DotenvCheck
{
    public static function run()
    {
        $output = new ConsoleOutput;
        $formatter = new FormatterHelper;

        $file = fopen(".env", "r");
        $env = [];
        while (feof($file) === false) {
            $line = fgets($file);
            $lineAry = explode("=", $line);
            $key = trim($lineAry[0]);
            if (empty($key) === false) {
                $value = trim($lineAry[1]);
                $env[$key] = $value;
            }
        }

        $file = fopen(".env.example", "r");
        $envExample = [];
        while (feof($file) === false) {
            $line = fgets($file);
            $lineAry = explode("=", $line);
            $key = trim($lineAry[0]);
            if (empty($key) === false) {
                $value = trim($lineAry[1]);
                $envExample[$key] = $value;
            }
        }

        // Check which variables are missing and which ones are extra
        $envKeys = array_keys($env);
        $envExampleKeys = array_keys($envExample);
        $missing = array_diff($envExampleKeys, $envKeys);
        $extra = array_diff($envKeys, $envExampleKeys);

        if (count($missing) > 0 || count($extra) > 0) {
            $output->writeln('');
            $warning = $formatter->formatBlock('Warning: Your .env and .env.example files are not in sync.', 'bg=blue;fg=white', true);
            $output->writeln($warning);
        }

        if (count($missing) > 0) {
            $output->writeln("\n<comment>The following variables are missing from your .env file<comment>");
            foreach ($missing as $variable) {
                $output->writeln(sprintf('<info>%s=%s<info>', $variable, $envExample[$variable]));
            }
        }

        if (count($extra) > 0) {
            $output->writeln("\n<comment>The following variables are in your .env file but not in .env.example<comment>");
            foreach ($extra as $variable) {
                $output->writeln(sprintf('<info>%s=%s<info>', $variable, $env[$variable]));
            }
        }

        $output->writeln('');
    }
}
