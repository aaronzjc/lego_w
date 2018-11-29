Vue.component("v-tabs", {
    template: "#VTabs",
    props: ["items", "active"],
    data: function() {
        return {
            "proxy_items": this.items
        }
    },
    methods: {
        switchTab: function(idx) {
            store.switchTab(idx);
        },
        onEnd: function(evt) {
            if (this.active == evt.oldIndex) {
                store.switchTab(evt.newIndex);
            }

            store.sortPage(this.items, this.proxy_items);
        }
    }
});

Vue.component("v-tab-info", {
    template: "#tabInfo",
    props: ["info"],
    methods: {
        changeTabState: function() {
            store.changeTabState();
        }
    }
})

Vue.component("v-act", {
    template: "#VAct",
    props: ["actions"],
    methods: {
        switchDropdown: function() {
            store.switchDropdown(!this.actions.open);
        },
        chooseModule: function(module) {
            console.log(module);
            store.switchDropdown(false);
            store.addModule(module);

        },
        toggleAll: function() {
            store.toggleAll();
        },
        deleteTab: function() {
            if (confirm("删除页签，会删除此页签的所有配置。确定继续？")) {
                store.deleteTab();
            }
        },
        saveConfig: function() {
            store.saveConfig();
        }
    }
});

Vue.component("v-module-basic", {
    template: "#VModuleBasic",
    props: ["info", "idx"],
    methods: {
        deleteModule: function(idx) {
            if (confirm("确定删除该模块吗？")) {
                store.deleteModule(idx)
            }
        }
    }
});