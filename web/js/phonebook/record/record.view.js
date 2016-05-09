var RecordView = Backbone.View.extend({
    tagName:  "tr",
    className: "record",
    cityCollection: {},
    template: _.template($('script#record-template').html()),
    locationView: null,
    events: {
        "click .destroy" : "clear",
        "dblclick .record-item-simple"  : "edit"
        // "blur .edit" : "close"
    },
    initialize: function(options) {
        this.cityCollection = options.cityCollection;
        this.model.on('change', this.render, this);
        this.model.on('remove', this.clearView, this);
    },

    render: function() {
        this.$el.html(this.template(this.model.toJSON()));
        return this;
    },

    clear: function() {
        this.model.clear();
    },

    clearView: function() {
        this.$el.html('');
    },

    edit: function() {
        this.$el.addClass("editing");
        this.locationView = new LocationView({
            el: '.' + this.className,
            model: this.model,
            cities: this.cityCollection
        });
        this.locationView.render();
    },

    close: function() {
        var model = {};
        this.$el.find('.edit').each(function(index) {
            model[$( this ).attr("name")] = $( this ).val();
        });
        console.log(model);
        this.model.save(model);
        this.$el.removeClass("editing");
    }
});
