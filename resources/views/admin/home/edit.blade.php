@extends("admin.tpl.main")

@section("content")
    @verbatim
    <div class="columns">
        <div id="app" style="width: 50%">
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
    </div>
    @endverbatim
@endsection


@section("body")
    <script type="text/javascript">
        var store = @json($data);

        new Vue({
            el: "#app",
            data: {
                store: store,

                submit: false
            },
            methods: {
                save: function () {
                    this.submit = true;
                    var that = this;
                    this.store.submit = true;
                    axios.post('/modules/edit', this.store).then(function (resp) {
                        console.log(resp);
                        that.submit = false;
                    }).catch(function (exp) {
                        console.log(exp);
                        that.submit = false;
                    });
                }
            }
        });
    </script>
@endsection