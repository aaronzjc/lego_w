@verbatim
<!-- Tabs模块 -->
<template id="VTabs">
    <div class="tabs">
        <ul>
            <draggable v-model="proxy_items" :options="{animation:150}" element="li" :no-transition-on-drag="true" @end="onEnd">
                <li v-for="(item, index) in proxy_items" :class="[ {'is-active': index == active }, {'expired': !item.enabled} ]" @click="switchTab(index)">
                    <a>{{ item.title }}</a>
                </li>
            </draggable>
        </ul>
    </div>
</template>
<!-- 添加模块 -->
<template id="VAct">
    <div class="columns">
        <div class="column">
            <button class="button is-primary" @click="addTab">添加页签</button>
            <div class="dropdown" :class="{ 'is-active': actions.open }">
                <div class="dropdown-trigger">
                    <button @click="switchDropdown" class="button" aria-haspopup="true" aria-controls="dropdown-menu">
                        <span>添加模块</span>
                        <span class="icon is-small">
                                <i class="fas fa-angle-down" aria-hidden="true"></i>
                            </span>
                    </button>
                </div>
                <div class="dropdown-menu" id="dropdown-menu" role="menu">
                    <div class="dropdown-content">
                        <a class="dropdown-item" v-for="(item, key) in actions.data" @click="chooseModule(key)">{{ item.title }}</a>
                    </div>
                </div>
            </div>
            <button class="button is-info" @click="toggleAll">{{ actions.collapse_all ? "展开全部":"折叠全部" }}</button>
            <button class="button is-danger" @click="deleteTab">删除页签</button>
            <button class="button is-warning" @click="saveConfig">保存配置</button>
        </div>
    </div>
</template>

<!-- Tab详情 -->
<template id="tabInfo">
    <div class="columns">
        <div class="column is-one-fifth">
            <input class="input" type="email" v-model="info.title" placeholder="标题文案">
        </div>
        <div class="column is-one-fifth">
            <button :class="['button', info.enabled ? 'is-warning' : 'is-primary']" @click="changeTabState">{{ info.enabled ? "禁用当前页签" : "启用当前页签" }}</button>
        </div>
    </div>
</template>

<!-- 基础信息模块 -->
<template id="VModuleBasic">
    <div class="card">
        <header class="card-header" :class="{ 'expired': !info.enabled }">
            <p class="card-header-title dragger">
                图导语模块
            </p>
            <span class="card-header-icon" aria-label="more options">
                    <span class="icon" @click="info.state.collapse = !info.state.collapse" v-show="!info.state.collapse">
                        <i class="fa fa-envelope-open" aria-hidden="true"></i>
                    </span>
                <span class="icon" @click="info.state.collapse = !info.state.collapse" v-show="info.state.collapse">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                    </span>
                <span class="icon" @click="deleteModule(idx)" title="删除模块,危险">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </span>
                </span>
        </header>
        <div class="card-content" v-show="!info.state.collapse">
        <div class="columns">
                <div class="column">
                    <label class="label">Banner图地址</label>
                    <input type="text" class="input" placeholder="banner图" v-model="info.data.banner" />
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <label class="label">文案</label>
                    <textarea cols="30" rows="3" class="textarea" v-model="info.data.text"></textarea>
                </div>
            </div>
        </div>
    </div>
</template>
@endverbatim