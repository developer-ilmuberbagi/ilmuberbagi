var AppRouter = Backbone.Router.extend({

    routes: {
        ""                  							: "list",
        "devs/page/:page"	: "list",
        "about"             					: "about"
    },

    initialize: function () {
        this.headerView = new HeaderView();
        $('.header').html(this.headerView.el);
    },

	list: function(page) {
        var p = page ? parseInt(page, 10) : 1;
        var devlList = new devlCollection();
        devlList.fetch({success: function(){
            $("#content").html(new ListView({model: devlList, page: p}).el);
        }});
        this.headerView.selectMenuItem('home-menu');
    },

    about: function () {
        if (!this.aboutView) {
            this.aboutView = new AboutView();
        }
        $('#content').html(this.aboutView.el);
        this.headerView.selectMenuItem('about-menu');
    }

});

utils.loadTemplate(['HeaderView', 'ListItemView', 'AboutView'], function() {
    app = new AppRouter();
    Backbone.history.start();
});