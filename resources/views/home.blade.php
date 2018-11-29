@extends("tpl.main")

@section("content")
    @verbatim
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
    @endverbatim
@endsection