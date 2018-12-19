@extends("admin.tpl.main")

@section("scripts")
<script src="/assets/js/components.js"></script>
<script src="/assets/js/store.js"></script>
@endsection

@section("body-content")
    @include("admin.components.mix")
@endsection

@section("content")
    @verbatim
        <div class="columns main-content" id="app">
            <div class="column">
                <v-act :actions="page_action"></v-act>
                <div class="columns">
                    <div class="column is-one-fifth">
                        <v-tabs :items="page_data" :active="page_state.active"></v-tabs>
                    </div>
                    <div class="column is-four-fifths">
                        <h4 class="subtitle is-5">页签信息</h4>
                        <v-tab-info :info="page_data[page_state.active]"></v-tab-info>
                        <h4 class="subtitle is-5">模块列表</h4>
                        <draggable v-model="page_data[page_state.active].modules" :options="{animation:150,handle:'.dragger'}" :no-transition-on-drag="true" @start="drag=true" @end="drag=false">
                            <component :info="module" :idx="index" v-for="(module, index) in page_data[page_state.active].modules" :is="page_action['data'][module.type]['module_type']" :key="module.key">
                            </component>
                        </draggable>
                    </div>
                </div>
            </div>
        </div>
    @endverbatim
@endsection

@section("body-footer")
    <script type="text/javascript">
        store.state.page_data = @json($page_modules);
        store.state.page_info = @json($page_info);

        var vm = new Vue({
            el: "#app",
            data: store.state,
            created: function () {
                store.init();
            }
        });
    </script>
@endsection