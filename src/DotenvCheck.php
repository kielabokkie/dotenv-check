<?php namespace Kielabokkie;

use Symfony\Component\Console\Helper\FormatterHelper;
use Symfony\Component\Console\Output\ConsoleOutput;

class DotenvCheck
{
    /**
     * Run the dotenv checker
     */
    public static function run()
    {
        $output = new ConsoleOutput;
        $formatter = new FormatterHelper;

        $env = self::readFile('.env');
        $envExample = self::readFile('.env.example');

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
            $output->writeln("\n<comment>The following variables are missing from your .env file:<comment>");
            foreach ($missing as $variable) {
                $output->writeln(sprintf('<info>%s=%s<info>', $variable, $envExample[$variable]));
            }
        }

        if (count($extra) > 0) {
            $output->writeln("\n<comment>The following variables are in your .env file but not in .env.example:<comment>");
            foreach ($extra as $variable) {
                $output->writeln(sprintf('<info>%s=%s<info>', $variable, $env[$variable]));
            }
        }

        $output->writeln('');
    }

    /**
     * Read the file and create an array of the key value pairs
     *
     * @param  string $fileName Name of the file to be read
     * @return array            Array of variable names and their value
     */
    private static function readFile($fileName)
    {
        $file = fopen($fileName, 'r');

        $result = [];
        while (feof($file) === false) {
            $line = trim(fgets($file));

            // Ignore empty lines
            if (empty($line) === true) {
                continue;
            }

            $lineArray = explode("=", $line);
            $result[$lineArray[0]] = $lineArray[1];
        }

        return $result;
    }
}
