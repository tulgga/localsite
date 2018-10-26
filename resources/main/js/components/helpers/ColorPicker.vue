<template>
    <div class="vc-compact">
        <div class="vc-compact">
            <ul class="vc-compact-colors">
                <li class="vc-compact-color-item" style="background: #1bbc9d;" @click="changeColor('1bbc9d')">
                    <div class="vc-compact-dot" v-show="smodel.hex === '1bbc9d'"></div>
                </li>
                <li class="vc-compact-color-item" style="background: #2fcc71;" @click="changeColor('2fcc71')">
                    <div class="vc-compact-dot" v-show="smodel.hex === '2fcc71'"></div>
                </li>
                <li class="vc-compact-color-item" style="background: #3598dc;" @click="changeColor('3598dc')">
                    <div class="vc-compact-dot" v-show="smodel.hex === '3598dc'"></div>
                </li>
                <li class="vc-compact-color-item" style="background: #ab85ff;" @click="changeColor('ab85ff')">
                    <div class="vc-compact-dot" v-show="smodel.hex === 'ab85ff'"></div>
                </li>
                <li class="vc-compact-color-item" style="background: #e884ff;" @click="changeColor('e884ff')">
                    <div class="vc-compact-dot" v-show="smodel.hex === 'e884ff'"></div>
                </li>
                <li class="vc-compact-color-item" style="background: #f1c40f;" @click="changeColor('f1c40f')">
                    <div class="vc-compact-dot" v-show="smodel.hex === 'f1c40f'"></div>
                </li>
                <li class="vc-compact-color-item" style="background: #e77e23;" @click="changeColor('e77e23')">
                    <div class="vc-compact-dot" v-show="smodel.hex === 'e77e23'"></div>
                </li>
                <li class="vc-compact-color-item" style="background: #e84c3d;" @click="changeColor('e84c3d')">
                    <div class="vc-compact-dot" v-show="smodel.hex === 'e84c3d'"></div>
                </li>
                <li class="vc-compact-color-item" style="background: #da1c5c;" @click="changeColor('da1c5c')">
                    <div class="vc-compact-dot" v-show="smodel.hex === 'da1c5c'"></div>
                </li>
                <li class="vc-compact-color-item" style="background: #34495e;" @click="changeColor('34495e')">
                    <div class="vc-compact-dot" v-show="smodel.hex === '34495e'"></div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        props:[
            'smodel',
        ],
        data(){
            return {
            }
        },
        watch: {
            smodel: {
                handler: function(newValue) {
                },
                deep: true
            },
        },
        created: function () {
        },
        computed: {
        },
        methods: {
            changeColor(hex) {
                this.smodel.hex = hex;
            }
        }
    }
</script>