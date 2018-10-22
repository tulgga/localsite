<template>
    <div>
        <div class="tree-menu">
            <div v-if="data.name" class="tree-menu-content" :style="indent">
                <label  class="checkbox" :for="data.id">
                    <input type="checkbox" :id="data.id"  :value="data.id"  @change="data.checked"> {{ data.name }}
                </label>
            </div>
                <select-tree
                        v-for="child in data.children"
                        :data="child"
                        :depth="depth + 1">
                </select-tree>
        </div>
    </div>



</template>
<script>
    export default {
        name: 'SelectTree', // as a recursive component
        props: ['data', 'depth', 'catId'],
        computed: {
            indent() {
                return { 'padding-left': `${this.depth * 15}px` }
            }
        }
    }
</script>
<style>
    .tree-menu-content {
        padding:0.2em;
    }

</style>