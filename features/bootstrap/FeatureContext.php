<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

use \Behat\Behat\Context\BehatContext;
use \Behat\Mink\Driver\Selenium2Driver;
use \Behat\Behat\Exception\PendingException;

/**
 * 
 */
class FeatureContext extends BehatContext {
	
    private $session;
	private $search = "chris";

    public function __construct(array $parameters) {
        // Initialize your context here
        $driver = new \Behat\Mink\Driver\Selenium2Driver($parameters["browser"], $parameters["base_url"]);
        $this->session = new \Behat\Mink\Session($driver);
		$this->session->start();
    }
	
    /**
     * @When /^I submit a search$/
     */
    public function iSubmitASearch() {
    	$page = $this->session->getPage();
		$el = $page->find("css", "#search button");
		$el->click();
    }

    /**
     * @Then /^I should be shown results$/
     */
    public function iShouldBeShownResults() {
        throw new PendingException();
    }

    /**
     * @Given /^there are matching brands$/
     */
    public function thereAreMatchingBrands() {
        // Already set up with a field with matching brands
    }

    /**
     * @Given /^there are available episodes$/
     */
    public function thereAreAvailableEpisodes() {
        // Should be available episodes
    }

    /**
     * @Then /^I should be shown the episodes$/
     */
    public function iShouldBeShownTheEpisodes() {
    	$page = $this->session->getPage();
        if($page->find("css", "#episodes li") === null) {
        	throw new Exception("No episode list items found");
        }
    }

    /**
     * @Given /^there are no matching brands$/
     */
    public function thereAreNoMatchingBrands() {
        $this->search = "xyz";
    }

    /**
     * @Then /^I should be shown a no results message$
     */
    public function iShouldBeShownANoResultsMessage()  {
    	$page = $this->session->getPage();
		if($page->find("css", "#no-episodes.show") === null) {
			throw new Exception("The no results message is not shown");
		}
    }

    /**
     * @When /^I enter text to search$/
     */
    public function iEnterTextToSearch() {
        $page = $this->session->getPage();
        $el = $page->find("css", "#search input[name=search]");
        $el->setValue($this->search);
    }

    /**
     * @Given /^stop$/
     */
    public function stop() {
        sleep(2000);
    }

    /**
     * @Then /^I should be shown these brands$/
     */
    public function iShouldBeShownTheseBrands() {
		$page = $this->session->getPage();
		if($page->find("css", "#brands li") === null) {
			throw new Exception("No brand list items found");
		}
    }

}
