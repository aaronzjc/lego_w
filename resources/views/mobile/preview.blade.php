<html>
    <head>
        <title>预览</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
        <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>

        <script src="https://cdn.bootcss.com/vue/2.5.16/vue.js"></script>

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
                <m-tab :tabs="page.tab_list" :active="active"></m-tab>

                <component :card="card" v-for="(card, index) in page.tab_list[active].card_list" :is="map[card.card_type]" :key="index"></component>
            </div>
        </div>
        @endverbatim

        <script>
            new Vue({
                "el": "#app",
                "data": {
                    "map": map,
                    "active": 0,
                    "page": @json($page)
                }
            })
        </script>
    </body>
</html>