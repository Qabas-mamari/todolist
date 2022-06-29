<template>
    <!-- container will contain header and list -->
        <div class="max-w-lg m-auto p-6 bg-white rounded-xl">
            <div class="text-lg font-bold ">
                <h2 id="title" class="text-red-700">Todo List</h2>
                <add-item-form v-on:reloadlist="getList()" />
            </div>
            <!-- to Do list -->
            <list-view :items="items" v-on:reloadlist="getList()" />
        </div>
 
</template>

<script>
import axios from "axios"
import addItemForm from "./addItemForm"
import listView from "./listView"
export default {
    components: {
        addItemForm,
        listView
    },
    data: function () {
        return {
            items: []
        }
    },
    methods: {
        getList() {
            axios.get('api/items')
                .then(response => {
                    this.items = response.data
                })
                .catch(error => {
                    console.log(error);
                })
        }
    },
    created() {
        this.getList();
    }
}
</script>

<style scoped>
.todoListContainer {
    width: 350px;
    margin: auto;
}

.heading {
    background: #e6e6e6;
    padding: 10px;
}

#title {
    text-align: center;
}
</style>
