var Record = Backbone.Model.extend({
    clear: function() {
        this.destroy();
    }
});
