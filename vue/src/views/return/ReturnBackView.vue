<template>
    <main class="main" id="main">
        <div class="pagetitle" style="overflow: hidden">
            <button class="float-right btn btn-outline-primary" @click="loadSuppliers">adding new doog(s)</button>
        </div><!-- End Page Title -->


        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="d-flex justify-content-between p-2">
                                <h3 class="float-left">Goods</h3>
                                <input type="text" class="rounded" placeholder="search" v-model="searchGood">
                            </div>
                            <!-- Default Table -->
                            <div class="row" v-if="Object.keys(reeturnedStore.goods).length">
                                <div :class="[returnList.length ? 'col-md-9' : 'col-md-12']">
                                    <!-- {{ reeturnedStore.goods }} -->
                                    <table>
                                        <tr>
                                            <td>id <input type="checkbox" v-model="tableColumns[0].id"  :checked="tableColumns[0].id" class="m-2" id=""></td>
                                            <td>item <input type="checkbox" v-model="tableColumns[0].item"  :checked="tableColumns[0].item"  class="m-2" id=""></td>
                                            <td>qty <input type="checkbox" v-model="tableColumns[0].qty"  :checked="tableColumns[0].qty"   class="m-2" id=""></td>
                                            <td>date <input type="checkbox" v-model="tableColumns[0].date"  :checked="tableColumns[0].date"  class="m-2" id=""></td>
                                            <td>rate <input type="checkbox" v-model="tableColumns[0].rate"  :checked="tableColumns[0].rate"   class="m-2" id=""></td>
                                            <td>price <input type="checkbox" v-model="tableColumns[0].price"  :checked="tableColumns[0].price" class="m-2" id=""></td>
                                            <td>category <input type="checkbox" v-model="tableColumns[0].category"  :checked="tableColumns[0].category"   class="m-2" id=""> </td>
                                            <td>md <input type="checkbox" v-model="tableColumns[0].md"  :checked="tableColumns[0].md" class="m-2" id=""></td>
                                            <td>ex <input type="checkbox" v-model="tableColumns[0].ex"  :checked="tableColumns[0].ex" class="m-2" id=""></td>
                                            <td>boughtDate <input type="checkbox" v-model="tableColumns[0].boughtDate"  :checked="tableColumns[0].boughtDate" class="m-2" id=""></td>
                                        </tr>
                                    </table>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <td scope="col" v-show="tableColumns[0].id">#</td>
                                                <td scope="col" v-show="tableColumns[0].item">item</td>
                                                <td scope="col" v-show="tableColumns[0].qty">qty</td>
                                                <td scope="col" v-show="tableColumns[0].date">date</td>
                                                <td scope="col" v-show="tableColumns[0].rate">rate</td>
                                                <td scope="col" v-show="tableColumns[0].price"> price</td>
                                                <td scope="col" v-show="tableColumns[0].category">category</td>

                                                <td scope="" v-show="tableColumns[0].md">md</td>
                                                <td scope="" v-show="tableColumns[0].ex">ex</td>
                                                <td scope="" v-show="tableColumns[0].boughtDate">boughtDate</td>
                                                <td scope="col">actions</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="good in reeturnedStore.goods" :key="good.id">
                                                <th v-show="tableColumns[0].id">{{ good.id }}</th>
                                                <td v-show="tableColumns[0].item">{{ good.drag_name }}</td>
                                                <td v-show="tableColumns[0].qty">{{ good.quantity }}</td>
                                                <td v-show="tableColumns[0].date">{{ good.boughtDate }}</td>
                                                <td v-show="tableColumns[0].rate">{{ good.rate }}</td>
                                                <td v-show="tableColumns[0].price">{{ good.total_price }}</td>
                                                <td v-show="tableColumns[0].category">{{ good.category.category_name }}</td>
                                                <td v-show="tableColumns[0].md">{{ good.dragRate.made_date }}</td>
                                                <td v-show="tableColumns[0].ex">{{ good.dragRate.expired_date }}</td>
                                                <td v-show="tableColumns[0].boughtDate">{{ good.boughtDate }}</td>
                                                <td>
                                                    <a :href="'/goods/' + good.id" class="btn btn-info btn-sm mx-1">
                                                        <i class="bx bx-info-circle"></i>
                                                    </a>
                                                    <input type="number" :id="'stock_good' + good.id"
                                                        placeholder="write qty" class="qtySize">
                                                    <button class="btn btn-danger btn-sm "
                                                        @click="addToReturnList(good.id, good.drag_name, good.quantity)"
                                                        title="add to return section">
                                                        <i class="bx bx-refresh"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>


                                    </table>

                                    <nav v-if="reeturnedStore.paginate.last_page !== 1">
                                        <ul class="pagination mt-2">
                                            <li class="page-item" v-for="(link, index) in reeturnedStore.paginate.links"
                                                :key="index" :class="[!link.url ? 'disabled' : '']">
                                                <a class="page-link" v-html="link.label" href="#" @click="goForPage(link)"
                                                    :class="[link.active ? 'active' : '']"></a>
                                            </li>

                                        </ul>

                                    </nav>
                                </div>
                                <div class="col-md-3">
                                    <div class="card mt-4" v-if="returnList.length">
                                        <div class="card-body">
                                            <h5 class="card-title">With badges</h5>

                                            <!-- List group With badges -->
                                            <ul class="list-group">
                                                <li class="list-group-item" v-for="list in returnList" :key="list.good_id">

                                                <li class=" d-flex justify-content-between align-items-center">
                                                    {{ list.drag_name }}

                                                    <span class="badge bg-primary rounded-pill"> {{ list.qunatity }}</span>
                                                </li>
                                                <div>
                                                    <span @click="removeFromList(list.good_id)"
                                                        class="btn btn-sm btn-primary badge bg-primary rounded-pill">-</span>
                                                </div>
                                                </li>

                                            </ul><!-- End List With badges -->
                                            <button class="btn btn-sm btn-primary mt-2" @click="returnGoods">return
                                                back</button>
                                            <button class="btn btn-sm btn-success mt-2 mx-2" @click="resetList">clear
                                                list</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <NotFound v-else />


                            <!-- End Default Table Example -->
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue'
import { useReturned } from '../../stores/returnBack';
import { debounce } from 'lodash'
import swal from 'sweetalert'
import NotFound from '../../components/pageNotFound/NotFound.vue';

const reeturnedStore = useReturned()
onMounted(() => {
    reeturnedStore.getGoods()
})

const goForPage = async (link) => {
    if (!link.url || link.active) {
        return
    }
    await reeturnedStore.getGoods(link.url)
}
const tableColumns = ref([
    {
        'all': true,
        'id': true,
        'item': true,
        'qty': true,
        'date': true,
        'rate': true,
        'price': true,
        'category': true,
        'md': true,
        'ex': true,
        'boughtDate': true,
    }
])
const searchGood = ref(null)
watch(searchGood, debounce(() => {
    reeturnedStore.getGoods(null, searchGood.value)

}, 300))
const returnList = ref([])
const slideSideBar = ref(false)
const addToReturnList = (good_id, drag_name, quantity) => {
    if (!slideSideBar.value) {
        document.querySelector('body').classList.add('toggle-sidebar')
    }
    slideSideBar.value = true
    let writenQty = document.getElementById(`stock_good${good_id}`).value

    if (writenQty !== '') {
        quantity = writenQty
    }
    returnList.value.push({ 'good_id': good_id, 'drag_name': drag_name, 'qunatity': quantity })
}

const removeFromList = (good_id) => {

    const search = returnList.value.findIndex((list) => list.good_id === good_id);
    returnList.value.splice(search, 1)
}

const returnGoods = async () => {
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this imaginary file!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then(async (willDelete) => {
            await reeturnedStore.returnGood({ ...returnList.value })

            if (willDelete) {
                if (Object.keys(reeturnedStore.errors).length) {
                    swal(`OOPS! ${reeturnedStore.errors}`, {
                        icon: "warning",
                    });
                } else {

                    swal("Poof! Your imaginary file has been deleted!", {
                        icon: "success",
                    });
                }
                resetList()
            }
        });
}

const resetList = () => {
    document.querySelector('body').classList.remove('toggle-sidebar')
    slideSideBar.value = false
    returnList.value.splice(0, returnList.value.length)
}

</script>

<style>
.qtySize {
    width: 90px;
    outline: none;

    border: 0px;
}
</style>
