<template>
    <div class="addItem">
        <input type="text" name="" id="" v-model="item.name">

        <!-- check if name is active or not and crate class plus -->
        <font-awesome-icon 
            icon="plus-square"
            @click="addItem()"
            :class="[item.name ? 'active' : 'inactive', 'plus']" />
    </div>
</template>

<script>
import axios from 'axios';

export default{
    data: function(){
        return{
            item:{
                name: ""
            }
        }
    },
    methods:{
        addItem(){
            if(this.item.name == ""){
                return; //return nothing if input is empty
            }

            axios.post('api/item/store', {
                item: this.item
            }).then(response=> {
                if(response.status == 201){ //201 is successfully creation
                    this.item.name = "";
                    this.$emit('reloadlist');
                }
            }).catch(error=>{
                console.log(error);
            })
        }
    }
}
</script>

<style scoped>
    .addItem{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    input{
        background: #f7f7f7;
        border: 0px;
        outline: none;
        padding: 5px;
        margin-right: 10px;
        width: 100%;
    }
    .plus{
        font-size: 20px;
    }
    .active{
        color: rgb(6, 218, 6);
    }
    .inactive{
        color: gray;
    }
</style>