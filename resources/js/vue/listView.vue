<template>
    <div>
        <!-- looping item by using index -->
        <div v-for="(item, index) in items" :key="index">
            <!-- passing each item in item -->
            <list-item
                :item="item"
                class="item"
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
    .item{
        background: #e6e6e6;
        padding: 5px;
        margin-top: 5px;
    }

</style>