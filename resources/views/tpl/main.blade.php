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
            <a class="navbar-item" href="#">
                <img src="https://bulma.io/images/bulma-logo-white.png" width="112" height="28">
            </a>
        </div>
        <div class="navbar-end">
        </div>
    </div>
</nav>

@include("components.mix")

@inject("menu", "App\Presenter\Admin")

<section class="section">
    <div class="container">
        <div class="columns">
            <div class="column is-2 left-aside">
                {!! $menu->renderMenu() !!}
            </div>
            <div class="column is-10 right-aside">

                <div class="columns main-content" id="app">
                    @yield("content")
                </div>

            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
    var store = {
        state: {
            "drag": false,

            // 页面基础信息
            "page_info": {},

            // 页面按钮状态等
            "page_state": {
                "active": 0,
            },

            // 整个页面的数据结构
            "page_data": [{
                "id": 1,
                "title": "第一集",
                "enabled": true,
                "modules": [{
                    "id": 1,
                    "key": 1,
                    "module_type": "v-module-basic",
                    "enabled": false,
                    "data": {
                        "title": "基础模块",
                        "url": "http://www.baidu.com",
                    },
                    "state": {
                        "collapse": false
                    }
                }]
            },
                {
                    "id": 2,
                    "title": "第二集",
                    "enabled": true,
                    "modules": []
                },
                {
                    "id": 3,
                    "title": "第三集",
                    "enabled": true,
                    "modules": []
                },
                {
                    "id": 4,
                    "title": "第四集",
                    "enabled": false,
                    "modules": []
                },
                {
                    "id": 5,
                    "title": "第五集",
                    "enabled": true,
                    "modules": []
                },
                {
                    "id": 6,
                    "title": "第六集",
                    "enabled": true,
                    "modules": []
                },
                {
                    "id": 7,
                    "title": "第七集",
                    "enabled": true,
                    "modules": []
                },
                {
                    "id": 8,
                    "title": "第八集",
                    "enabled": true,
                    "modules": []
                },
                {
                    "id": 9,
                    "title": "第九集",
                    "enabled": true,
                    "modules": []
                }
            ],

            // 页面的备份数据，误操作，还原用的
            "page_bak": null,

            // 页面动作
            "page_action": {
                "open": false,
                "data": {
                    "basic_module": {
                        "id": null,
                        "key": null,
                        "module_type": "v-module-basic",
                        "desc": "基础信息模块",
                        "enabled": true,
                        "data": {
                            "title": "基础模块",
                            "url": "http://www.baidu.com",
                        },
                        "state": {
                            "collapse": false
                        }
                    }
                },
                "collapse_all": false
            }
        },

        // 切换Tab展示
        switchTab: function(idx) {
            this.state.page_state.active = idx;
        },

        // 下拉菜单的展示
        switchDropdown: function(st) {
            this.state.page_action.open = st;
        },

        // 展开/折叠全部
        toggleAll: function() {
            var i = 0;
            var st = this.state;
            st.page_action.collapse_all = !st.page_action.collapse_all;
            for (; i < st.page_data[st.page_state.active].modules.length; i++) {
                st.page_data[st.page_state.active].modules[i].state.collapse = st.page_action.collapse_all;
            }
        },

        // 添加Tab页
        addTab: function() {
            this.state.page_data.unshift({
                "id": null,
                "title": "默认文案",
                "enabled": false,
                "modules": []
            });
            this.switchTab(0);
        },

        // 添加一个模块
        addModule: function(module) {
            var st = this.state;
            if (st.page_action["data"][module]) {
                var obj = JSON.parse(JSON.stringify(st.page_action["data"][module]));
                obj["key"] = st.page_data[st.page_state.active].modules.length + 1;
                st.page_data[st.page_state.active].modules.push(obj);
            }
            st.drag = false;
        },

        // 删除一个模块
        deleteModule: function(idx) {
            this.state.page_data[this.state.page_state.active].modules.splice(idx, 1);
        },

        // 重新排序Tab顺序
        sortPage: function(oldPage, newPage) {
            this.state.page_data = newPage;
            this.state.page_bak = oldPage;
        },

        // 切换Tab的状态
        changeTabState: function() {
            var oldSt = this.state.page_data[this.state.page_state.active].enabled;
            this.state.page_data[this.state.page_state.active].enabled = !oldSt;
        },

        // 删除Tab
        deleteTab: function() {
            this.state.page_data.splice(this.state.page_state.active, 1);
            this.switchTab(0)
        },

        // 保存当前页签配置
        saveConfig: function() {
            var cnf = this.state.page_data[this.state.page_state.active];
            axios.post("/module/" + cnf.id, {
                config: cnf
            }).then(function(response) {
                console.log(response)
            }).catch(function(error) {

            });
        }

    };

    var vm = new Vue({
        el: "#app",
        data: store.state,
        methods: {
            addTab: function() {
                store.addTab();
            }
        }
    });
</script>
</body>

</html>