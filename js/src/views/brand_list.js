var BrandListView = Backbone.View.extend({
	
	events:
		{ "click li" : "selectBrand" },
	
	initialize: function() {
		
	},
	
	update: function(results) {
		var fragment = document.createDocumentFragment();
		for(var i = 0; i < results.length; ++i) {
			var $item = $("<li>" + results[i].title + "</li>");
			$item.data(results);
			fragment.appendChild($item.get(0));
		}
		this.$el.empty().append(fragment);		
	},
	
	selectBrand: function(event) {
		var $target = $(event.target);
		this.trigger("brandSelected", $target.data("id"));
	}
	
});