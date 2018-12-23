<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>预览</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
        <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>

        <script src="https://cdn.bootcss.com/vue/2.5.16/vue.js"></script>
        <script src="https://cdn.bootcss.com/axios/0.18.0/axios.js"></script>

        <script src="/assets/js/mobile/components.js"></script>
        <style>
            html,body {
                background: #f2f2f2;
            }
            .page {
                background: #fff;
                margin: 2rem auto;
                width: 33%;
            }
            .page .tabs, #app .columns, #app .column {
                margin: 0px 0px;
                padding: 0px 0px;
            }
            .page .tabs ul {
                border-bottom-width: 0px;;
            }
            article {
                font-family: Helvetica Neue,Helvetica,Arial,sans-serif;
                padding: 0.5rem;
                line-height: 1.2rem;
            }
        </style>
    </head>

    <body>
        @include("mobile.components.mix")

        @verbatim
        <div id="app">
            <div class="container page">
                <m-tab :tabs="tab_list" :active="active"></m-tab>

                <component :card="card" v-for="(card, index) in card_list" :is="map[card.card_type]" :key="index"></component>
            </div>
        </div>
        @endverbatim

        <script>
            var page = @json($page);
            var store = {
                state: {
                    "map": map,
                    "id": page.id,
                    "active": page.active,
                    "tab_list": page.tab_list,
                    "card_list": page.card_list
                },
                initPage: function (page) {
                    this.state.id = page.id;
                    this.state.active = page.active;
                    this.state.tab_list = page.tab_list;
                    this.state.card_list = page.card_list;
                },
                switchTab: function (index) {
                    this.state.active = index;
                    var pageId = this.state.id;
                    var tabId = this.state.tab_list[this.state.active]["id"];
                    axios.get("/preview", {
                        "params": {"id": pageId, "tab_id": tabId, "json": 1}
                        }).then(function (resp) {
                        if (resp.data) {
                            this.initPage(resp.data);
                        }
                    }.bind(this)).catch(function (resp) {

                    });
                }
            };

            new Vue({
                "el": "#app",
                "data": store.state,
                created: function () {
                    store.switchTab(0);
                }
            })
        </script>
    </body>
</html>