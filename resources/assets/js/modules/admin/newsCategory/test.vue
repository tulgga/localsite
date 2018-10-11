<template>
    <tree-node :data="treeData" >
        <template  slot-scope="props">
            <div class="tree-content">
                <div class="columns">
                    <div class="column is-9">
                        {{props.row.label}}
                    </div>
                    <div class="column is-3 has-text-right">
                        <a @click="">delete</a>
                    </div>
                </div>
            </div>
        </template>
    </tree-node>
</template>
<script>
    import TreeNode from '../../../components/helpers/tree'
    export default {
        components: { TreeNode },
        data: () => ({
            treeData: {
                label: 'Company',
                id:-1,
                children: [
                    { label: 'Ken',
                        children: [
                            { label: 'Ben' },
                            { label: 'Karen',
                                children: [
                                    { label: 'Amy' }
                                ]
                            },
                            { label: 'John' },
                            { label: 'Mike',
                                children: [
                                    { label: 'Mary',
                                        children: [
                                            { label: 'James',
                                                children: [
                                                    { label: 'Susan' }
                                                ]
                                            }
                                        ]
                                    },
                                    { label: 'Lisa' }
                                ]
                            }
                        ]
                    },
                    {
                        label: 'Jason',
                        children: [
                            { label: 'Rose' }
                        ]
                    }
                ]
            },

        })
    }
</script>