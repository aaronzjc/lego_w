@extends("admin.tpl.main")

@section("content")
    @verbatim
        <div class="columns main-content" id="app">
            <div class="column is-one-fifth">
                <div style="text-align: center;margin-bottom: 10px;">
                    <button class="button is-white" @click="addTab">添加页签</button>
                </div>
                <v-tabs :items="page_data" :active="page_state.active"></v-tabs>
            </div>
            <div class="column is-four-fifths">
                <v-act :actions="page_action"></v-act>
                <h4 class="subtitle is-5">页签信息</h4>
                <v-tab-info :info="page_data[page_state.active]"></v-tab-info>
                <h4 class="subtitle is-5">模块列表</h4>
                <draggable v-model="page_data[page_state.active].modules" :options="{animation:150,handle:'.dragger'}" :no-transition-on-drag="true" @start="drag=true" @end="drag=false">
                    <component :info="module" :idx="index" v-for="(module, index) in page_data[page_state.active].modules" :is="module.module_type" :key="module.key">
                    </component>
                </draggable>
            </div>
        </div>
    @endverbatim
@endsection

@section("body")
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
@endsection