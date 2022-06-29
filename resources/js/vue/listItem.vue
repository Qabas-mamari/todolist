<template>
    <div class="flex pt-2 border-b">
        <div class="flex-none w-14 h-14">
            <!-- <span>{{edit}}</span> -->
            <a @click="updateCheck()" class="cursor-pointer">
                <font-awesome-icon v-model="item.completed" :icon="item.completed ? 'check' : 'clock'"
                    class="fill-green-600" />
            </a>
        </div>
        <div v-show="!edit" class="flex-initial w-64">
            <span :class="[item.completed ? 'text-green-600 line-through items-start' : '', 'itemText']">
                {{ item.name }}
            </span>
        </div>
        
        
        <div v-show="edit" class="flex-initial w-64">
            <input type="text" @keyup.enter="updateName()" v-model="item.name"
                class="rounded-lg max-w-lg m-2 p-1 bg-slate-100">
            <font-awesome-icon icon="floppy-disk" @click="updateName()" />
        </div>

        <div v-show="!edit" class="flex-none w-14 h-14 justify-between">
            <button @click="toggleEdit()" class="mx-3">
                <font-awesome-icon icon="pen" />
            </button>
            <button @click="removeItem()" class="trashcan">
                <font-awesome-icon icon="trash" />
            </button>
        </div>
    </div>
    
</template>

<script>
import axios from 'axios'

export default {
    props: ['item'],
    data: () => {
        return {
            edit: false,
            // item: {
            //     name: ""
            // }
        }
    },
    methods: {
        updateName() {
            console.log(this.item.id);
            axios.put('api/item/' + this.item.id, {
                item: this.item
            }).then(response => {
                if (response.status == 200) { //201 is successfully creation
                    this.item.name = this.item.name;
                    this.$emit('reloadlist');
                    this.toggleEdit();
                }
            }).catch(error => {
                console.log(error);
            })
        },
        toggleEdit() {
            this.edit = !this.edit;
            console.log(this.edit);

        },
        updateCheck() {
            axios.put('api/item/' + this.item.id, {
                item: this.item
            })
                .then(response => {
                    if (response.status == 200) {
                        this.$emit('itemchanged');
                    }
                })
                .catch(error => {
                    console.log(error);
                })
        },
        removeItem() {
            axios.delete('api/item/' + this.item.id)
                .then(response => {
                    if (response.status == 200) {
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

.itemText {
    width: 100%;
    margin-left: 20px;
}

.item {
    display: flex;
    justify-content: center;
    align-items: center;
}

.trashcan {

    border: none;
    color: #ff0000;
    outline: none;
    cursor: pointer;

}

.edit {
    background: #e6e6e6;
    border: none;
    color: #3300ff;
    outline: none;
    cursor: pointer;
}
</style>