const moduleDefine = {
    "basic_module": {
        "id": null,
        "key": null,
        "type": 20,
        "module_type": "v-module-basic",
        "title": "基础信息模块",
        "enabled": true,
        "data": {
            "url": "http://example.com"
        },
        "state": {
            "collapse": false
        }
    }
};

var store = {
    state: {
        "drag": false,

        // 页面基础信息
        "page_info": {},

        // 页面按钮状态等
        "page_state": {
            "active": 0
        },

        // 整个页面的数据结构
        "page_data": [],

        // 页面的备份数据，误操作，还原用的
        "page_bak": null,

        // 页面动作
        "page_action": {
            "open": false,
            "data": moduleDefine,
            "collapse_all": false
        }
    },

    // 初始化页面
    init: function () {
        var st = this.state;
        if (st.page_data.length === 0) {
            this.addTab();
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
        if (moduleDefine[module]) {
            var obj = JSON.parse(JSON.stringify(moduleDefine[module]));
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
        var cnf = this.state.page_data[this.state.page_state.active];
        axios.post("/page/deleteTab", {
            tab_id: cnf.id
        }).then(function (resp) {
            if (resp.data.success) {
                vm.$toast("success", "删除页签成功");
                this.state.page_data.splice(this.state.page_state.active, 1);
                this.switchTab(0)
            } else {
                vm.$toast("error", "保存失败: " + resp.data.msg);
            }
        }.bind(this)).catch(function (err) {

        });
    },

    // 保存当前页签配置
    saveConfig: function() {
        var pageId = this.state.page_info.id;

        var cnf = {};
        for (var i=0;i<this.state.page_data.length;i++) {
            cnf = this.state.page_data[i];
            cnf["sort"] = i;
            this.saveTabConfig(pageId, cnf);
        }
    },

    // 保存单个页签的信息
    saveTabConfig: function(pageId, tabCnf) {
        axios.post("/page/saveConfig", {
            page_id: pageId,
            cnf: tabCnf
        }).then(function(resp) {
            console.log(resp);
            if (resp.data.success) {
                vm.$toast("success", resp.data.msg);
            } else {
                vm.$toast("error", resp.data.msg);
            }
        }).catch(function(error) {
            vm.$toast("error", "保存异常失败");
        });
    }

};