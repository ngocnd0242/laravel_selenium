<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

class ReportAprCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:apr';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Example connect selenium with chrome driver';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Create chrome option with profile and disable info bar
        $_chromeOtions = new ChromeOptions();
        $_chromeOtions->addArguments([
            'user-data-dir=' . env('CHROME_PROFILE_FOLDER'),
            'disable-infobars'
        ]);

        // Create setting store credentials and profile
        $prefs = [
            'credentials_enable_service' => true,
            'profile.password_manager_enabled' => true
        ];

        $_chromeOtions->setExperimentalOption('prefs', $prefs);
        $capabilities = DesiredCapabilities::chrome();
        $capabilities->setCapability(ChromeOptions::CAPABILITY, $_chromeOtions);

        // Create connect and make session throght selenium server
        $driver = RemoteWebDriver::create('http://localhost:4444/wd/hub/', $capabilities);

        // Load url for process
        $driver->get('http://google.com');

        // TODO : here you can process element for testing and do something :D
        // Guide here
        // https://github.com/facebook/php-webdriver/wiki/Finding-an-element
    }
}
