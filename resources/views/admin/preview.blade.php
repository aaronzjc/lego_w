<html>
    <head>
        <title>预览</title>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
        <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>

        <script src="https://cdn.bootcss.com/vue/2.5.16/vue.js"></script>

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

        <div id="app">
            <div class="container page">
                <div class="tabs is-centered">
                    <ul>
                        <li class="is-active"><a>第一集</a></li>
                        <li><a>第二集</a></li>
                        <li><a>第三集</a></li>
                    </ul>
                </div>
                
                <!-- 基本信息模块 -->
                <div class="columns">
                    <div class="column">
                        <img src="https://wx1.sinaimg.cn/large/71efa8f5ly1fwfo94gylfj20ku05m0tp.jpg" alt="">
                    </div>
                </div>
                <div class="columns">
                    <div class="column">
                        <article>猜评团未能猜出你的心声？微博酷评官给出了面具背后“最令人怀疑”的歌手人选，大胆发表你的看法，组成全网最志同道合闭眼玩家联盟</article>
                    </div>
                </div>


            </div>
        </div>
    </body>
</html>