    <template>
    <div class="flex pt-2 border-b">
        <!-- update check icon start -->
        <div class="flex-none w-14 h-14">
            <a @click="updateCheck()" class="cursor-pointer">
                <!--  that changes to item.completed will be reflected in the icon's appearance, and vice versa. -->
                <!--  If item.completed is true, it uses the "check" icon; otherwise, it uses the "clock" icon. -->
                <font-awesome-icon v-model="item.completed" :icon="item.completed ? 'check' : 'clock'"
                    class="" />
            </a>
        </div>
        <!-- update check icon end -->

        <!-- updated text style start -->
        <div v-show="!edit" class="flex-initial w-64">
            <span :class="[item.completed ? 'text-gray-400 line-through items-start' : '', 'itemText']">
                {{ item.name }}
            </span>
        </div>
        <!-- updated text style end -->

        <!-- update text start -->
        <div v-show="edit" class="flex-initial w-64">
            <input type="text" @keyup.enter="updateName()" v-model="item.name"
                class="rounded-lg max-w-lg m-2 p-1 bg-slate-100">
            <font-awesome-icon icon="floppy-disk" @click="updateName()" />
        </div>
        <!-- update text end -->


        <div v-show="!edit" class="flex-none w-14 h-14 justify-between">
            <!-- edit icon -->
            <button @click="toggleEdit()" class="mx-3">
                <font-awesome-icon icon="pen" />
            </button>
            <!-- remove icon -->
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
        }
    },
    methods: {
        updateName() {
            console.log(this.item.id);
            //1. makes an HTTP PUT request to the 'api/item/' + this.item.id endpoint using the axios library.
            axios.put('api/item/' + this.item.id, {
                //1.1 The request payload includes an object with a key 'item' and the value of this.item.
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
            //1. makes an HTTP PUT request to the 'api/item/' + this.item.id endpoint using the axios library.
            axios.put('api/item/' + this.item.id, {
                //1.1 The request payload includes an object with a key 'item' and the value of this.item.
                item: this.item
            }).then(response => {
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
