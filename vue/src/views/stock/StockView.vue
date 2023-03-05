<template>
    <main class="main" id="main">
        <section class="section">

            <div class="row">
                <div :class="[card.length ? 'col-lg-8' : 'col-lg-12']">
                    <div class="card shadow-lg">
                        <div class="card-body">
                           <div class="card-header d-flex justify-content-between">
                            <h3 >List of goods in stock</h3>
                            <input type="text"  v-model="dragSearch"
                                placeholder="search darg name">
                           </div>
                            <!-- Default Table -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">id</th>
                                        <th scope="col">drag name</th>
                                        <th scope="col">quantity</th>
                                        <th scope="col">unit price</th>
                                        <th scope="col">category</th>
                                        <th>info</th>
                                        <th>prepare to sell</th>
                                    </tr>
                                </thead>
                                <tbody v-if="Object.keys(stockStore.stocks).length">
                                    <tr v-for="stock in stockStore.stocks" :key="stock.id">
                                        <th>{{ stock.id }}</th>
                                        <td>
                                            <p>{{ stock.drag_name }}</p>
                                        </td>
                                        <td>{{ stock.quantity }}</td>
                                        <td v-for="price in stock.drag_rate">{{ price.rate }}
                                            <input type="hidden" :id="'price' + stock.id" :value="price.rate">
                                        </td>
                                        <td>{{ stock.category.category_name }}</td>
                                        <td>
                                            <router-link :to="{name:'stock.show',params:{id:stock.id}}" class="btn btn-info mx-1 btn-sm">
                                                <i class="bx bx-info-circle"></i>
                                            </router-link>
                                        </td>

                                        <td>
                                            <input type="number" @blur="prepareQty" class="inputSize"
                                                placeholder="write quantity">
                                            <button class="btn btn-sm btn-success"
                                                @click="addToDragCard(stock.drag_name, stock.id)"> <i
                                                    class="bx bx-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                                <h1 v-else>
                                    loading...
                                </h1>
                            </table>
                            <!-- End Default Table Example -->
                        </div>
                    </div>
                </div>
                <div class="col-md-4" v-if="card.length">
                    <div class="card">
                        <div class="card-header">drag lists that ordered</div>
                        <div class="card-body">


                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>drag </th>
                                        <th>quantity</th>
                                        <th>price</th>
                                        <th>sum</th>
                                        <th>reduce</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="( drag, index) in card" :key="index">
                                        <td>{{ drag.drag_name }}</td>
                                        <td>{{ drag.quantity }}</td>
                                        <td>{{ drag.rate }}</td>
                                        <td>{{ drag.total_rate }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-info" @click="reduceQuantity(drag.stock_id)">
                                                <i class="bx bx-minus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <p>
                                fintal total => {{ cardFinalTotalPrice }}
                            </p>
                            <button class="btn btn-sm btn-warning" @click="resetCard">reset all current order</button>
                            <button class="btn btn-sm btn-success mx-5" @click="placeOrder">place order(s)</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>

<script setup>
import { ref, reactive, computed, watch } from 'vue';
import { useStockStore } from '../../stores/stock'
import { useSellStore } from '../../stores/sell'
import Modal from '../../components/modal/Modal.vue';
import swal from 'sweetalert'
const stockStore = useStockStore()
const sellStore = useSellStore()
stockStore.getStocks()
let card = reactive([])
let displayModel = ref(false)

const closeModal = (type) => {
    displayModel.value = !displayModel.value
    stockStore.errors = []
}

const dragInfo = async (id) => {
    if (stockStore.errors.length === 0) {
        await stockStore.show(id)
        displayModel.value = true
    }
}
let qty = ref(0)
const prepareQty = (event) => {
    qty.value = event.target.value
}
const toggleSidebar=ref(false)

const addToDragCard = (drag_name, stockId) => {
    if(!toggleSidebar.value){
        document.querySelector('body').classList.add('toggle-sidebar')
    }
    toggleSidebar.value=true
    const price = document.getElementById(`price${stockId}`).value
    card.push({ 'stock_id': stockId, 'drag_name': drag_name, 'quantity': qty.value, 'rate': price, 'total_rate': price * qty.value })
    // alert(card.length)
}
const resetCard = () => {

    card.splice(0, card.length)
    toggleSidebar.value=false
    document.querySelector('body').classList.remove('toggle-sidebar')

}

let cardFinalTotalPrice = computed(() => {
    let sum = card.reduce((data, result) => {
        return data + result.total_rate
    }, 0)
    return sum
})

const reduceQuantity = (stockId) => {
    let search = card.findIndex((drag) => drag.stock_id === stockId)
    if (search !== -1 && card[search].stock_id !== null) {
        if (card[search].quantity === 1) {
            if (confirm('are you sure you want to exclude selected drag with quantity 1')) {
                card.splice(search, 1)
            }
        } else {

            card[search].quantity = card[search].quantity - 1
            card[search].total_rate = card[search].total_rate - card[search].rate
        }
    }
}

const placeOrder = async () => {
    await sellStore.store({ ...card })
    if (sellStore.errors.length === 0) {
        swal("", "Orders placed succesfuly ", "success");
        // swal({
        //     title: "Are you sure?",
        //     text: "Once deleted, you will not be able to recover this imaginary file!",
        //     icon: "warning",
        //     buttons: true,
        //     dangerMode: true,
        // })
        //     .then((willDelete) => {
        //         if (willDelete) {
        //             swal("Poof! Your imaginary file has been deleted!", {
        //                 icon: "success",
        //             });
        //         } else {
        //             swal("Your imaginary file is safe!");
        //         }
        //     });
        // stockStore.getStocks()
        resetCard()
       await stockStore.getStocks()

    }
}

const dragSearch = ref(null)
watch(dragSearch, () => {
    stockStore.getStocks(dragSearch.value)
})
</script>

<style scoped>
.inputSize {
    width: 125px;
}
</style>
