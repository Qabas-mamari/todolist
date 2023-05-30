<template>
    <div class="addItem">
        <!-- v-model: any changes made to the input field will automatically update the value of item.name. -->
        <!-- @keyup.enter: attribute listens for the "keyup" event on the input field and specifically triggers the addItem() method when the "Enter" key is pressed. -->
        <input type="text" v-model="item.name" class="rounded-lg" @keyup.enter="addItem()">
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
            //1. It checks if the item.name property is empty
            if(this.item.name == ""){
                return; //1.1 return nothing if input is empty
            }

            //2. If item.name is not empty.
            //2.1 It makes an HTTP POST request to the 'api/item/store' endpoint using the axios library.
            axios.post('api/item/store', {
                //2.2 The request payload includes an object with a key 'item' and the value of this.item.
                item: this.item
            }).then(response=> {
                //2.3 If the request is successful
                if(response.status == 201){
                    //2.4 Clears the item.name property by setting it to an empty string ("").
                    this.item.name = "";
                    //2.5 emits a custom event called 'reloadlist'. This event can be captured by the parent component to trigger a list reload or perform any necessary action.
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
