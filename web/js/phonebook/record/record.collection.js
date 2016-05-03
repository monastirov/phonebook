var RecordCollection = Backbone.Collection.extend({
    model: Record,

    initialize: function(options) {

    },

    /**
     * получаем место по го cid
     * @param cid
     * @returns {Record}
     */
    getModelByCid: function(cid) {
        return this.find(function (record) {
            return record.cid  === cid
        });
    },

    parse: function(response, options) {
        if (response.error) return null;
        return response;
    }
});
