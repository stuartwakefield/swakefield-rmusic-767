Feature: [RMUSIC-767] Programme Finder
	As a user
	I want to search for available episodes by brand name

	Scenario: Search for brands
		When I submit a search
		Then I should be shown results

	Scenario: Search for brands with matches
		Given there are matching brands
		And there are available episodes
		When I submit a search
		Then I should be shown the episodes

	Scenario: Search for brands without matches
		Given there are no matching brands
		When I submit a search
		Then I should be shown a no results message

	Scenario: Pause entering a search
		Given there are matching brands
		When I enter text to search
		And stop
		Then I should be shown these brands
