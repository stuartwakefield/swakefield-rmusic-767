<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

use \Behat\Behat\Context\BehatContext;
use \Behat\Mink\Driver\Selenium2Driver;
use \Behat\Behat\Exception\PendingException;


class FeatureContext extends BehatContext
{
    private $session;

    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters) {
        // Initialize your context here
        $this->baseUrl = $parameters["base_url"];
        $driver = new \Behat\Mink\Driver\Selenium2Driver($parameters["browser"], null);
		$driver->start();
        $this->session = $driver->getWebDriverSession();
    }

    /**
     * @Given /^I am on a web page$/
     */
    public function iAmOnAWebPage() {
    	$this->session->open($this->baseUrl);
    }

    /**
     * @When /^I submit a search$/
     */
    public function iSubmitASearch()
    {
        
    }

    /**
     * @Then /^I should be shown results$/
     */
    public function iShouldBeShownResults()
    {
        throw new PendingException();
    }

    /**
     * @Given /^there are matching brands$/
     */
    public function thereAreMatchingBrands()
    {
        throw new PendingException();
    }

    /**
     * @Given /^there are available episodes$/
     */
    public function thereAreAvailableEpisodes()
    {
        throw new PendingException();
    }

    /**
     * @Then /^I should be shown these episodes$/
     */
    public function iShouldBeShownTheseEpisodes()
    {
        throw new PendingException();
    }

    /**
     * @Given /^there are no matching brands$/
     */
    public function thereAreNoMatchingBrands()
    {
        throw new PendingException();
    }

    /**
     * @Then /^I should be shown a no results message$/
     */
    public function iShouldBeShownANoResultsMessage()
    {
        throw new PendingException();
    }

    /**
     * @When /^I enter text to search$/
     */
    public function iEnterTextToSearch()
    {
        throw new PendingException();
    }

    /**
     * @Given /^stop$/
     */
    public function stop()
    {
        throw new PendingException();
    }

    /**
     * @Then /^I should be shown these brands$/
     */
    public function iShouldBeShownTheseBrands()
    {
        throw new PendingException();
    }

}
