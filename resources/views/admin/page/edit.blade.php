@extends("admin.tpl.main")

@section("content")
    @verbatim
    <template id="page">
        <div style="width: 50%">
        <div class="field">
            <label class="label">名称</label>
            <div class="control">
                <input class="input" type="text" placeholder="专题名称" v-model="store.title">
            </div>
        </div>
        <div class="field is-grouped">
            <div class="control">
                <button :class="['button', 'is-info', submit ? 'is-loading' : '' ]" @click="save">保存</button>
            </div>
        </div>
        </div>
    </template>
    <div class="columns" id="app">
        <v-page :store="page_data" :submit="page_state.submit"></v-page>
    </div>
    @endverbatim
@endsection


@section("body-footer")
    <script type="text/javascript">
        var store = {
            state: {
                page_data: @json($data),
                page_state: {
                    submit: false
                }
            },
            save: function () {
                var st = this.state;
                st.page_state.submit = true;
                st.page_data.submit = true;
                axios.post('/page/edit', st.page_data).then(function (resp) {
                    st.page_state.submit = false;

                    console.log(resp);
                    if (resp.data.success) {
                        window.location.href = "/";
                    }
                }).catch(function (exp) {
                    console.log(exp);
                    st.page_state.submit = false;
                });
            }
        };

        Vue.component("v-page", {
            template: "#page",
            props: ["store", "submit"],
            methods: {
                save: function () {
                    store.save();
                }
            }
        });

        new Vue({
            el: "#app",
            data: store.state
        });
    </script>
@endsection