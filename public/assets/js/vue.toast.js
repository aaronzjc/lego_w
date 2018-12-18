// 右上角的消息提示
const Toast = {
    install: function (Vue, options) {
        Vue.prototype.$toast = function (level, msg) {
            var cls = {
                success: "notification is-success awesone-notify",
                warning: "notification is-warning awesone-notify",
                error: "notification is-danger awesone-notify"
            };
            var data = {
                level: cls[level],
                msg: msg,
                display: true
            };
            var toastTpl = Vue.extend({
                template: '<transition name="fade"><div :class="level" v-if="display"><button class="delete" @click="display=false"></button>{{ msg }}</div></transition>',
                data: function () {
                    return data;
                }
            });

            var tpl = new toastTpl().$mount().$el;

            document.getElementById("toast-container").appendChild(tpl);
            setTimeout(function () {        // 4、延迟2.5秒后移除该提示
                data.display = false
            }, 3000)
        }
    }
};