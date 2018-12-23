const MBASIC = 20;

const map = {
    "20": "m-basic"
};

Vue.component("m-tab", {
    template: "#MTab",
    props: ["tabs", "active"],
    methods: {
        choose: function (index) {
            if (index === this.active) {
                return false;
            }

            store.switchTab(index);
        }
    }
});

Vue.component(map[MBASIC], {
    template: "#MBasic",
    props: ["card"]
});