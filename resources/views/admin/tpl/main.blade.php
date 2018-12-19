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
    <script src="http://cdnjs.cloudflare.com/ajax/libs/Vue.Draggable/2.15.0/vuedraggable.min.js"></script>

    <script src="https://cdn.bootcss.com/axios/0.18.0/axios.js"></script>
    <script src="/assets/js/vue.toast.js"></script>

    <link rel="stylesheet" href="/assets/css/app.css">

    @yield("scripts")
</head>

<body>
{{-- 顶部导航 --}}
@include("admin.components.nav")

{{-- 页面消息Toast --}}
<div id="toast-container"></div>
<script type="text/javascript">
    Vue.use(Toast);
</script>

{{-- 左侧菜单 --}}
@inject("menu", "App\Presenter\Admin")

<section class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-2 left-aside">
                {!! $menu->renderMenu() !!}
            </div>
            <div class="column is-10 right-aside">
                @yield("content")
            </div>
        </div>
    </div>
</section>

@yield("body-content")

{{-- 底部介绍 --}}
@include("admin.components.footer")

@yield("body-footer")

</body>

</html>