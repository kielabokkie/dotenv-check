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

        // Check which variables are missing and which ones are extra
        $missing = array_diff($envExample, $env);
        $extra = array_diff($env, $envExample);

        if (count($missing) > 0 || count($extra) > 0) {
            $output->writeln('');
            $warning = $formatter->formatBlock('Warning: Your .env and .env.example are not in sync.', 'bg=blue;fg=white', true);
            $output->writeln($warning);
        }

        if (count($missing) > 0) {
            $output->writeln("\n<comment>The following variables are missing from your .env file<comment>");
            foreach ($missing as $variable) {
                $output->writeln(sprintf('<info>- %s<info>', $variable));
            }
        }

        if (count($extra) > 0) {
            $output->writeln("\n<comment>The following variables are in your .env file but not in .env.example<comment>");
            foreach ($extra as $variable) {
                $output->writeln(sprintf('<info>- %s<info>', $variable));
            }
        }

        $output->writeln('');
    }
}
