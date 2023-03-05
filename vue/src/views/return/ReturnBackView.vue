<template>
    <main class="main" id="main">
        <div class="pagetitle" style="overflow: hidden">
            <button class="float-right btn btn-outline-primary" @click="loadSuppliers">adding new doog(s)</button>
        </div><!-- End Page Title -->


        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card" >
                        <div class="card-body">
                            <div class="d-flex justify-content-between p-2">
                                <h3 class="float-left">Goods</h3>
                                <input type="text" class="rounded" placeholder="search" v-model="searchGood">
                            </div>
                            <!-- Default Table -->
                            <div class="row" v-if="Object.keys(reeturnedStore.goods).length">
                                <div :class="[returnList.length?'col-md-9':'col-md-12']">
                                    <!-- {{ reeturnedStore.goods }} -->
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <td scope="col">#</td>
                                                <td scope="col">item</td>
                                                <td scope="col">qty</td>
                                                <td scope="col">date</td>
                                                <td scope="col">rate</td>
                                                <td scope="col"> price</td>
                                                <td scope="col">category</td>

                                                <td scope="">md</td>
                                                <td scope="">ex</td>
                                                <td scope="">boughtDate</td>
                                                <td scope="col">actions</td>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <tr v-for="good in reeturnedStore.goods" :key="good.id">
                                                <th>{{ good.id }}</th>
                                                <td>{{ good.drag_name }}</td>
                                                <td>{{ good.quantity }}</td>
                                                <td>{{ good.boughtDate }}</td>
                                                <td>{{ good.rate }}</td>
                                                <td>{{ good.total_price }}</td>
                                                <td>{{ good.category.category_name }}</td>
                                                <td>{{ good.dragRate.made_date }}</td>
                                                <td>{{ good.dragRate.expired_date }}</td>
                                                <td>{{ good.boughtDate }}</td>
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
                            <NotFound  v-else/>


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

const searchGood = ref(null)
watch(searchGood, debounce(() => {
    reeturnedStore.getGoods(null, searchGood.value)

}, 300))
const returnList = ref([])
const slideSideBar=ref(false)
const addToReturnList = (good_id, drag_name, quantity) => {
    if(!slideSideBar.value){
        document.querySelector('body').classList.add('toggle-sidebar')
    }
    slideSideBar.value=true
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
        .then(async(willDelete) => {
            await reeturnedStore.returnGood({ ...returnList.value })

            if (willDelete) {
                if(Object.keys(reeturnedStore.errors).length){
                    swal(`OOPS! ${reeturnedStore.errors}`, {
                        icon: "warning",
                    });
                }else{

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
    slideSideBar.value=false
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
