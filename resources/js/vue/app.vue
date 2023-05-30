<template>
    <!-- container will contain header and list -->
        <div class="max-w-lg m-auto p-6 bg-white rounded-xl">
            <div class="text-lg font-bold ">
                <h2 id="title" class="text-red-700">Todo List</h2>

                <!-- The v-on:reloadlist="getList()" directive listens for the custom event 'reloadlist' emitted
                    by the <add-item-form> component and calls the getList() method in response. -->
                <add-item-form v-on:reloadlist="getList()" />
            </div>

            <!-- The :items="items" syntax binds the items property from the parent component's data to the items
                 prop of the <list-view> component. This allows passing data from the parent component to the <list-view> componen -->
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
            //1. makes an HTTP GET request to the 'api/items' endpoint using the axios library.
            axios.get('api/items')
                .then(response => {
                    //2. The code assumes that the response contains the desired data in the data property.
                    //2.1 It assigns the data from the response (response.data) to the this.items property.
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
