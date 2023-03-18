<template>
    <main class="main" id="main">
        <div class="pagetitle" style="overflow: hidden">
            <button class="float-right btn btn-outline-primary" @click="loadSuppliers">adding new doog(s)</button>
        </div><!-- End Page Title -->
        <div v-if="show">
            <!-- modal -->
            <Modal @closeModal="closeModal(showType)">
                <div class="card">
                    <div class="card-header">adding new doog(s)</div>
                    <div class="card-body">
                        <!-- <label for="">good description</label> -->
                        <!-- <QuillEditor theme="snow" v-model:content="editorData"  @ready="onEditorReady($event)"/> -->
                        <form @submit.prevent="addGood" v-if="Object.keys(goodStore.suppliers).length" id="addGoodForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">select supplier</label>
                                    <select name="supplier_id" class="form-control mb-2">
                                        <option value="0">select a supplier</option>
                                        <option :value="supplier.id" v-for="supplier in goodStore.suppliers"
                                            :key="supplier.id">
                                            {{ supplier.company_name }}
                                        </option>
                                    </select>
                                    <p class="text-danger mb-1" v-if="goodStore.errors.supplier_id">
                                        {{ goodStore.errors.supplier_id[0] }}
                                    </p>
                                    <label for="">select relavent category</label>
                                    <select name="category_id" id="" class="form-control mb-2">
                                        <option value="0">select a category</option>
                                        <option :value="category.id" v-for="category in categoryStore.categories"
                                            :key="category.id">
                                            {{ category.category_name }}
                                        </option>
                                    </select>
                                    <p class="text-danger mb-1" v-if="goodStore.errors.category_id">
                                        {{ goodStore.errors.category_id[0] }}
                                    </p>
                                    <label for="">drag name</label>
                                    <input type="text" class="form-control mb-2" name="drag_name">
                                    <p class="text-danger mb-1" v-if="goodStore.errors.drag_name">
                                        {{ goodStore.errors.drag_name[0] }}
                                    </p>



                                    <label for="">quantity</label>
                                    <input type="number" class="form-control mb-2" @blur="calcTotalPrice" name="quantity">
                                    <p class="text-danger mb-1" v-if="goodStore.errors.quantity">
                                        {{ goodStore.errors.quantity[0] }}
                                    </p>

                                </div>
                                <div class="col-md-6">
                                    <label for="">made_date</label>
                                    <input type="date" class="form-control mb-2" name="made_date">
                                    <p class="text-danger mb-1" v-if="goodStore.errors.made_date">
                                        {{ goodStore.errors.made_date[0] }}
                                    </p>
                                    <label for="">expired_date</label>
                                    <input type="date" class="form-control mb-2" name="expired_date">

                                    <p class="text-danger mb-1" v-if="goodStore.errors.expired_date">
                                        {{ goodStore.errors.expired_date[0] }}
                                    </p>

                                    <label for="">rate</label>
                                    <input type="text" class="form-control mb-2" id="rate" name="rate">
                                    <p class="text-danger mb-1" v-if="goodStore.errors.rate">
                                        {{ goodStore.errors.rate[0] }}
                                    </p>


                                    <label for="">total price</label>
                                    <input type="text" readonly class="form-control mb-2" name="total_price"
                                        id="total_price">
                                    <p class="text-danger mb-1" v-if="goodStore.errors.total_price">
                                        {{ goodStore.errors.total_price[0] }}
                                    </p>
                                </div>
                            </div>

                            <label for="">description</label>
                            <textarea name="description" id="" cols="3" rows="4" class="form-control mb-2"></textarea>
                            <p class="text-danger mb-1" v-if="goodStore.errors.description">
                                {{ goodStore.errors.description[0] }}
                            </p>

                            <button class="btn btn-primary" type="submit">save drag info</button>
                        </form>
                        <h1 v-else>
                            loading suppliers ...
                        </h1>
                    </div>
                </div>
            </Modal>

        </div>
        <div v-if="editModal">
            <!-- modal -->
            <Modal @closeModal="closeModal(showType)">
                <div class="card">
                    <div class="card-header">edit good</div>
                    <div class="card-body">
                        <form @submit.prevent="updateGood(goodStore.good.id)" v-if="Object.keys(goodStore.good).length"
                            id="updateGoodForm">
                            <!-- <label for="">good description</label> -->
                            <!-- <QuillEditor theme="snow" v-model:content="editorData"  @ready="onEditorReadyEdit($event)"/> -->
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">select supplier</label>
                                    <select name="supplier_id" class="form-control mb-2">
                                        <option value="0">select a supplier</option>
                                        <option :value="supplier.id" :selected="supplier.id === goodStore.good.supplier.id"
                                            v-for="supplier in goodStore.suppliers" :key="supplier.id">
                                            {{ supplier.company_name }}
                                        </option>
                                    </select>
                                    <p class="text-danger mb-1" v-if="goodStore.errors.supplier_id">
                                        {{ goodStore.errors.supplier_id[0] }}
                                    </p>
                                    <label for="">select relavent category</label>
                                    <select name="category_id" id="" class="form-control mb-2">
                                        <option value="0">select a category</option>
                                        <option :value="category.id" :selected="category.id === goodStore.good.category.id"
                                            v-for="category in categoryStore.categories" :key="category.id">
                                            {{ category.category_name }}
                                        </option>
                                    </select>
                                    <p class="text-danger mb-1" v-if="goodStore.errors.category_id">
                                        {{ goodStore.errors.category_id[0] }}
                                    </p>
                                    <label for="">drag name</label>
                                    <input type="text" class="form-control mb-2" name="drag_name"
                                        :value="goodStore.good.drag_name">
                                    <p class="text-danger mb-1" v-if="goodStore.errors.drag_name">
                                        {{ goodStore.errors.drag_name[0] }}
                                    </p>



                                    <label for="">quantity</label>
                                    <input type="number" class="form-control mb-2" @blur="calcTotalPrice" name="quantity"
                                        :value="goodStore.good.quantity">
                                    <p class="text-danger mb-1" v-if="goodStore.errors.quantity">
                                        {{ goodStore.errors.quantity[0] }}
                                    </p>

                                </div>
                                <div class="col-md-6">
                                    <label for="">made_date</label>
                                    <input type="date" class="form-control mb-2" name="made_date"
                                        :value="goodStore.good.dragRate.made_date">
                                    <p class="text-danger mb-1" v-if="goodStore.errors.made_date">
                                        {{ goodStore.errors.made_date[0] }}
                                    </p>
                                    <label for="">expired_date</label>
                                    <input type="date" class="form-control mb-2" name="expired_date"
                                        :value="goodStore.good.dragRate.expired_date">

                                    <p class="text-danger mb-1" v-if="goodStore.errors.expired_date">
                                        {{ goodStore.errors.expired_date[0] }}
                                    </p>

                                    <label for="">rate</label>
                                    <input type="text" class="form-control mb-2" id="rate" name="rate"
                                        :value="goodStore.good.rate">
                                    <p class="text-danger mb-1" v-if="goodStore.errors.rate">
                                        {{ goodStore.errors.rate[0] }}
                                    </p>


                                    <label for="">total price</label>
                                    <input type="text" readonly class="form-control mb-2" name="total_price"
                                        id="total_price" :value="goodStore.good.total_price">
                                    <p class="text-danger mb-1" v-if="goodStore.errors.total_price">
                                        {{ goodStore.errors.total_price[0] }}
                                    </p>
                                </div>
                            </div>


                            <label for="">description</label>
                            <textarea name="description" id="" cols="3" rows="4"
                                class="form-control mb-2">{{ goodStore.good.description }}</textarea>
                            <p class="text-danger mb-1" v-if="goodStore.errors.description">
                                {{ goodStore.errors.description[0] }}
                            </p>
                            <button class="btn btn-primary" type="submit">update drag info</button>
                        </form>
                        <h1 v-else>
                            loading suppliers ...
                        </h1>
                    </div>
                </div>
            </Modal>

        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow">
                        <div class="card-body" v-if="Object.keys(goodStore.goods).length">
                            <div class="d-flex justify-content-between p-2">
                                <h3 >Goods</h3>
                                <input type="text" placeholder="search" v-model="searchGood">
                            </div>
                            <!-- Default Table -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">drag name</th>
                                        <th scope="col">qauntity</th>
                                        <!-- <th scope="col">company name</th> -->
                                        <th scope="col">bougth date</th>
                                        <th scope="col">rate</th>
                                        <th scope="col">total_price</th>
                                        <th scope="col">category</th>
                                        <th scope="col">actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="good in goodStore.goods" :key="good.id">
                                        <th>{{ good.id }}</th>
                                        <td>{{ good.drag_name }}</td>
                                        <td>{{ good.quantity }}</td>
                                        <td>{{ good.boughtDate }}</td>
                                        <td>{{ good.rate }}</td>
                                        <td>{{ good.total_price }}</td>
                                        <td>{{ good.category.category_name }}</td>
                                        <td>
                                            <router-link :to="{ name: 'goodInfo', params: { id: good.id } }"
                                                class="btn btn-info btn-sm mx-1">
                                                <i class="bx bx-info-circle"></i>
                                            </router-link>
                                            <button class="btn btn-success btn-sm mx-1" @click="editGood(good.id)">
                                                <i class="bx bx-edit"></i>
                                            </button>

                                            <button class="btn btn-danger btn-sm ">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>


                            </table>
                            <nav v-if="goodStore.paginate.last_page !== 1">
                                <ul class="pagination mt-2">
                                    <li class="page-item" v-for="(link, index) in goodStore.paginate.links" :key="index"
                                        :class="[!link.url ? 'disabled' : '']">
                                        <button class="page-link" v-html="link.label" @click.prevent="goForPage(link)"
                                            :class="[link.active ? 'active' : '']"></button>
                                    </li>

                                </ul>

                            </nav>


                            <!-- End Default Table Example -->
                        </div>
                        <NotFound v-else />
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>

<script setup>
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import { ref, onMounted, watch } from 'vue'
import Modal from '../../components/modal/Modal.vue'
import { useGoodStore } from '../../../src/stores/good';
import { useSpplierStore } from '@/stores/supplier'
import { useCategorStore } from '@/stores/category'
import { debounce } from 'lodash'
import NotFound from '../../components/pageNotFound/NotFound.vue';
const categoryStore = useCategorStore()
const goodStore = useGoodStore()
const supplierStore = useSpplierStore()
onMounted(() => {
    goodStore.getGoods()
    categoryStore.getCategories()
})
let show = ref(false)
let editModal = ref(false)
let deleteModal = ref(false)
const showType = ref("add")
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
}
const loadSuppliers = async () => {
    await goodStore.AllSuppliers()
    show.value = true

}

const calcTotalPrice = (event) => {
    const rate = document.getElementById('rate').value
    document.getElementById("total_price").value = rate * event.target.value
}
const editorData = ref('')
const onEditorReady = (e) => {
    console.log(e);
    e.container.querySelector('.ql-blank').innerHTML = editorData.value
}

const onEditorReadyEdit = (e) => {
    const datae = JSON.parse(goodStore.good.description)
    // console.log(datae);
    editorData.value = JSON.parse(goodStore.good.description)
}
const addGood = async () => {
    showType.value = "add"
    let form = document.getElementById("addGoodForm")
    const formData = new FormData(form)
    // formData.append("description",JSON.stringify(editorData.value))
    // formData.append("category_id", categoryId.value)
    await goodStore.store(formData)
    if (goodStore.errors.length === 0) {
        closeModal(showType.value)
    }
    // console.log(editorData.value);

}

const goForPage = async (link) => {
    if (!link.url || link.active) {
        return
    }
    window.scrollTo({ top: 0, behavior: 'smooth' });
    await goodStore.getGoods(link.url)
}

const editGood = async (good) => {
    showType.value = "edit"
    await goodStore.edit(good)
    await goodStore.AllSuppliers()
    categoryStore.getCategories()
    closeModal(showType.value)
    // editorData.value= JSON.parse(goodStore.good.description)
}
const updateGood = async (good) => {
    const form = document.getElementById("updateGoodForm")
    const formData = new FormData(form)
    // formData.append("description",JSON.stringify(editorData.value))
    formData.append("_method", "PUT")
    await goodStore.update(good, formData)
}
const searchGood = ref(null)
watch(searchGood, debounce(() => {
    goodStore.getGoods(null, searchGood.value)
}, 300))
</script>
