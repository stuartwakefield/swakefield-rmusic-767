Feature: [RMUSIC-767] Programme Finder
	As a user
	I want to search for available episodes by brand name

	Scenario: Search for brands
		Given I am on a web page
		When I submit a search
		Then I should be shown results

	Scenario: Search for brands with matches
		Given I am on a web page
		When I submit a search
		And there are matching brands
		And there are available episodes
		Then I should be shown these episodes

	Scenario: Search for brands without matches
		Given I am on a web page
		When I submit a search
		And there are no matching brands
		Then I should be shown a no results message

	Scenario: Pause entering a search
		Given I am on a web page
		When I enter text to search
		And stop
		And there are matching brands
		Then I should be shown these brands
