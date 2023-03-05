<template>

    <main class="main" id="main">
        <div class="pagetitle" style="overflow: hidden">
            <button class="float-right btn btn-outline-primary" @click="closeModal('add')">adding new category</button>
        </div><!-- End Page Title -->
        <div v-if="show">
            <!-- modal -->
            <Modal @closeModal="closeModal('add')">
                <div class="card">
                    <div class="card-header">adding new category</div>
                    <div class="card-body ">
                        <form @submit.prevent="addCategory" id="categoryForm">
                            <label for="">category name</label>
                            <input type="text" name="category_name" id="category_name" class="form-control mb-2">
                            <!-- {{ categoryStore.errors.category_name[0] }} -->
                            <label for="">image</label>
                            <input type="file" @change="selectedImage" id="image" class="form-control mb-2">
                            <p class="text-danger m-2" v-if="Object.keys(categoryStore.errors).length"> {{
                                categoryStore.errors.category_name[0]
                            }}</p>
                            <img :src="image" v-if="image !== null" alt="" class="h400">
                            <button class="btn btn-sm btn-primary mb-2 mt-2">add new category</button>

                        </form>
                    </div>
                </div>
            </Modal>

        </div>

        <div v-if="editModal">
            <!-- modal -->
            <Modal @closeModal="closeModal('edit')">
                <div class="card" v-if="Object.keys(categoryStore.category).length">
                    <div class="card-header">adding new category</div>
                    <div class="card-body ">
                        <form @submit.prevent="updateCategory(categoryStore.category.id)" id="categoryEditForm">
                            <label for="">category name</label>
                            <input type="text" :value="categoryStore.category.category_name" name="category_name"
                                id="category_name" class="form-control mb-2">
                            <label for="">image</label>
                            <input type="file" @change="selectedImage" id="image" class="form-control mb-2">
                            <button class="btn btn-sm btn-primary mb-2">add new category</button>
                            <img :src="image ?? categoryStore.category.image"
                                v-if="categoryStore.category.image !== null" alt="" class="h400">

                        </form>
                    </div>
                </div>
            </Modal>

        </div>

        <section class="section">
            <div class="card ">
                <div class="card-header">
                    <h3>All Categories</h3>
                </div>
                <div class="card-body bg-gray p-2 ">

                    <div class="row" v-if="Object.keys(categoryStore.categories).length">
                        <div class="col-md-3 " v-for="category in categoryStore.categories" :key="category.id">
                            <div class="card shadow ">
                                <img :src="category.image" alt="" class="h200">
                                <div class="card-body">
                                    <h4>{{ category.category_name }}</h4>
                                </div>
                                <div class="filter text-center">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>actions</h6>
                                        </li>

                                        <li class=" ">
                                            <button class=" dropdown-item"
                                                @click="editCategory(category.id)">Edit</button>
                                        </li>
                                        <li><button @click="deleteCategory(category.id)" class="dropdown-item">Delete</button></li>
                                        <li><a class="dropdown-item" href="#">info</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>

<script setup>
import Modal from '../../components/modal/Modal.vue'
import { ref } from 'vue'
import { useCategorStore } from '../../../src/stores/category'
import swal from 'sweetalert'
const categoryStore = useCategorStore()
categoryStore.getCategories()
let show = ref(false)
let editModal = ref(false)
let deleteModal = ref(false)
const closeModal = (type) => {
    if (type === "add") {
        show.value = !show.value
    }
    else if (type === "edit") {
        editModal.value = !editModal.value
    }

    else if (type === "delete") {
        deleteModal.value = true
    }
    image.value = null
}
let image = ref(null)
const selectedImageCategory = ref('');
const selectedImage = (event) => {
    let file = event.target.files[0]
    selectedImageCategory.value = file
    let reader = new FileReader()
    reader.onloadend = () => {
        image.value = reader.result
    }

    reader.readAsDataURL(file)
}

const addCategory = async () => {
    const form = document.getElementById("categoryForm")
    let formData = new FormData(form)
    formData.append("image", selectedImageCategory.value)
    await categoryStore.store(formData)
    if (categoryStore.errors.length === 0) {
        show.value = false
        swal("", "new category added successfuly", "success")
    }
}


const editCategory = async (category) => {
    closeModal("edit")
    await categoryStore.edit(category)
}

const updateCategory = async (category) => {

    const form = document.getElementById("categoryEditForm")
    let formData = new FormData(form)
    formData.append("_method", "PUT")
    formData.append("image", selectedImageCategory.value)
    await categoryStore.update(category, formData)
    if (categoryStore.errors.length === 0) {
        await categoryStore.getCategories()
        closeModal("edit")
        swal("", "update category done successfuly", "success")
    }
}
const deleteCategory=async(category)=>{
    await categoryStore.delete(category)
    if(categoryStore.errors.length===0){
        swal("", "delete category done successfuly", "warning")
    }
}

</script>