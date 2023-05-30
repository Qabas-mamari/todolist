<template>
    <div>
        <div v-for="(item, index) in items" :key="index" c>

            <!-- The v-on:itemchanged="$emit('reloadlist')" directive listens for the custom event 'itemchanged'
                 emitted by the <list-item> component and emits the custom event 'reloadlist' from the parent component in response. -->
            <list-item
                :item="item"
                class=""
                v-on:itemchanged="$emit('reloadlist')"
            />
        </div>
    </div>
</template>

<script>
import listItem from './listItem'

export default{
    props: ['items'],
    components:{
        listItem
    }
}
</script>

<style scoped>
    /* .item{
        background: #e6e6e6;
        padding: 5px;
        margin-top: 5px;
    } */

</style>
