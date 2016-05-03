var AppView = Backbone.View.extend({

    el: $(".phonebook-table"),
    loader: $('#initial-loader'),

    initialize: function(options) {
        this.eventsCommon = options.eventsCommon;
        this.bindings();
        this.fetchRecords(this.collection, {async: false});
        var self = this;
        setInterval(function() {
            self.fetchRecords(self.collection, {async: true});
        }, 10000);

        this.loader.hide();
    },

    bindings: function() {
        this.collection.bind('add', this.addOneRecord, this);
        this.collection.bind('remove', this.removeOneRecord, this);
        this.collection.bind('reset', this.addAllRecords, this);
        this.collection.bind('all', this.render, this);
    },

    fetchRecords: function(collection, options) {
        //@todo сделать нормальную обработку ошибок
        collection.fetch(options).success(function(result){
            if (result.error){
                alert("Не смог загрузить записи справочника");
            }
        }).error(function(){
            alert("Не смог загрузить записи справочника");
        });
        console.log(collection);
    },

    addOneRecord: function(record) {
        var view = new RecordView({model: record});
        this.$el.append(view.render().el);
    },

    removeOneRecord: function(record) {
    },

    addAllRecords: function() {
        this.collection.each(this.addOneRecord);
    }
});
