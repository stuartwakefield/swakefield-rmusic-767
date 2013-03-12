var BrandListView = Backbone.View.extend({
	
	events:
		{ "click li" : "selectBrand" },

	update: function(results) {
		if(!results.length) return;
		var fragment = document.createDocumentFragment();
		for(var i = 0; i < results.length; ++i) {
			var $item = $("<li>" + results[i].title + "</li>");
			$item.data(results[i]);
			fragment.appendChild($item.get(0));
		}
		this.$el.empty().append(fragment);
		this.show();
	},
	
	clear: function() {
		this.hide();
	},
	
	show: function() {
		this.$el.stop(true, true).addClass("shown").fadeIn();
	},
	
	hide: function() {
		this.$el.stop(true, true).removeClass("shown").fadeOut();
	},
	
	selectBrand: function(event) {
		var $target = $(event.target);
		this.trigger("brand-selected", $target.data("id"));
	},
	
	displayError: function() {
		console.log("Brand error");
	}
	
});