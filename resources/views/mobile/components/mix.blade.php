@verbatim
<!-- Tab模块 -->
<template id="MTab">
<div class="tabs is-centered">
    <ul>
        <li @click="choose(index)" :class="{ 'is-active' : (index == active)}" v-for="tab, index in tabs"><a>{{ tab.title  }}</a></li>
    </ul>
</div>
</template>
<!-- 基础信息模块 -->
<template id="MBasic">
<div class="card">
    <div class="columns">
        <div class="column">
            <img :src="card.data.banner" alt="">
        </div>
    </div>
    <div class="columns">
        <div class="column">
            <article>{{ card.data.text }}</article>
        </div>
    </div>
</div>
</template>
@endverbatim