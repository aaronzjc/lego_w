<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lego</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <script src="https://cdn.bootcss.com/vue/2.5.16/vue.js"></script>
    <script src="http://cdn.jsdelivr.net/npm/sortablejs@1.7.0/Sortable.min.js"></script>
    <!-- CDNJS :: Vue.Draggable (https://cdnjs.com/) -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/Vue.Draggable/2.15.0/vuedraggable.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <link rel="stylesheet" href="/assets/css/app.css">
    <script src="/assets/js/components.js"></script>
</head>

<body>
<nav class="navbar is-info" role="navigation" aria-label="main navigation">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item" href="/">
                <img src="/assets/imgs/weibo.png" width="80" height="27">
            </a>
        </div>
        <div class="navbar-end">
        </div>
    </div>
</nav>

<section class="section">
    <div class="container">
        <div style="text-align: center;padding: 8rem 4rem;">
            <h2 class="title">404 NOT FOUND</h2>
            <a class="button is-text" href="{{ $link or "#" }}">返回上一页</a>
        </div>
    </div>
</section>

<footer class="footer">
    <div class="content has-text-centered">
        <p>
            <strong>Lego</strong> by <a href="#">aaronzjc</a>
        </p>
    </div>
</footer>

</body>

</html>