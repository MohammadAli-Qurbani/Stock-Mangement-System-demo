<template>

    <main class="main" id="main">
        <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="float-left">To Day's Bougth Goods</h3>
                    </div>
                    <div class="card-body">
                        <div class="bg-light mb-2 p-2 mt-2">
                            <button @click="dailyStastic" :class="[showDaily?' active ':'']"
                                class="btn btn-outline-primary mx-2">To Day's Report</button>
                            <button @click="monthlyStastic" :class="[showMonthly ? ' active ' : '']"
                                class="btn btn-outline-info">Monthly Report</button>
                            <button @click="yearlyStastic" :class="[showYearly ? ' active ' : '']"
                                class="btn btn-outline-success mx-2">Yearly Report</button>
                        </div>
                        <!-- Default Table -->
                        <div v-if="showDaily">
                            <table class="table" v-if="Object.keys(goodDaliyStore.dailyGood).length">
                                <thead>
                                    <tr>

                                        <th scope="col">bougth date</th>
                                        <th scope="col">total price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="( report, index) in goodDaliyStore.dailyGood" :key="index">

                                        <td v-if="report.totalPrice">
                                            {{ report.created_at }}
                                        </td>
                                        <td>
                                            {{ report.totalPrice }}
                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                            <tr v-else>
                                <hr>
                                <h1>loading..</h1>
                            </tr>
                        </div>

                        <div v-if="showMonthly">
                            <table class="table" v-if="Object.keys(goodDaliyStore.monthlyGood).length">
                                <thead>
                                    <tr>
                                        <th scope="">#</th>
                                        <th scope="col">month</th>
                                        <th scope="col">total price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="( report, index) in goodDaliyStore.monthlyGood" :key="index">
                                        <td>{{ ++index }}</td>
                                        <td>
                                            {{ report.month }}
                                        </td>
                                        <td>
                                            {{ report.totalPrice }}
                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                            <tr v-else>
                                <hr>
                                <h1>loading..</h1>
                            </tr>
                        </div>
                        <div v-if="showYearly">
                            <table class="table" v-if="Object.keys(goodDaliyStore.yearlyGood).length">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">year</th>
                                        <th scope="col">total price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="( report, index) in goodDaliyStore.yearlyGood" :key="index">
                                        <td>{{ ++index }}</td>
                                        <td>
                                            {{ report.year }}
                                        </td>
                                        <td>
                                            {{ report.totalPrice }}
                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                            <tr v-else>
                                <hr>
                                <h1>loading..</h1>
                            </tr>
                        </div>
                        <!-- End Default Table Example -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    </main>
</template>
<script setup>
import { ref } from 'vue'
import { useGoodReportStore } from '../../stores/goodReport/TableReport'
const goodDaliyStore = useGoodReportStore()

let showDaily = ref(false)
let showMonthly = ref(false)
let showYearly = ref(false)

const dailyStastic = () => {
    goodDaliyStore.goodDaily()
    showDaily.value = true
    showMonthly.value = false
    showYearly.value = false
}
const monthlyStastic = () => {
    goodDaliyStore.goodMonthly()
    showDaily.value = false
    showMonthly.value = true
    showYearly.value = false
}
const yearlyStastic = () => {
    goodDaliyStore.goodYearly()
    showDaily.value = false
    showMonthly.value = false
    showYearly.value = true
}
</script>
