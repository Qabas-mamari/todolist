<template>
    <div class="item">
        <input 
            type="checkbox"
            @change="updateCheck()"
            v-model="item.completed"
        />
        <!-- depending on complete action -->
         <span 
            :class="[item.completed? 'completed' : '', 'itemText']">
            {{item.name}}
         </span>
         <!-- edit -->
          <!-- <button @click="editItem()" class="edit">
            <font-awesome-icon icon="pen" />
         </button> -->
         <!-- delete button  -->
         <button @click="removeItem()" class="trashcan">
            <font-awesome-icon icon="trash" />
         </button>
         
    </div>
</template>

<script>
import axios from 'axios'

export default{
    props: ['item'],
    methods:{

        updateCheck(){
            axios.put('api/item/' + this.item.id, {
                item: this.item
            })
            .then(response => {
                if(response.status == 200){
                    this.$emit('itemchanged');
                }
            })
            .catch(error =>{
                console.log(error);
            })
        },
        removeItem(){
            axios.delete('api/item/' + this.item.id)
            .then(response =>{
                if(response.status == 200){
                    this.$emit('itemchanged');
                }
            })
            .catch(error => {
                console.log(error);
            })
        }
    }
}
</script>


<style scoped>
    .completed {
        text-decoration: line-through;
        color: #999999;
    }
    .itemText{
        width: 100%;
        margin-left: 20px;
    }
    .item{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .trashcan{
        background: #e6e6e6;
        border: none;
        color: #ff0000;
        outline: none;
        cursor: pointer;

    }
    .edit{
        background: #e6e6e6;
        border: none;
        color: #3300ff;
        outline: none; 
        cursor: pointer; 
    }
</style>