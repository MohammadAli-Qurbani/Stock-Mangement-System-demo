<template>
    <main id="main" class="main">
        <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="float-left">{{ reportText }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="bg-light mb-2 p-2 mt-2">
                            <button class="btn btn-outline-primary mx-2"
                            @click="dailylyReport"
                            :class="[showDaily?'active':'']"
                            >To Day's Report</button>
                            <button class="btn btn-outline-info" @click="monthlyReport"
                                :class="[showMonthly?'active':'']">Monthly Report</button>
                            <button class="btn btn-outline-success mx-2"
                            @click="yearlyReport"
                            :class="[showYearly?'active':'']"
                            >Yearly Report</button>
                        </div>
                        <!-- Default Table -->
                        <div v-if="showMonthly">
                            <table class="table" v-if="Object.keys(sellReport.monthlyTableReport).length">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th scope="col">month name </th>
                                        <th scope="col">total price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="( data, index) in sellReport.monthNames" :key="index">
                                        <td>{{ 1+index }}</td>
                                        <td>{{ data.monthName }}</td>
                                        <td>{{ data.total_sell }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <h1 v-else>
                                loading ...
                            </h1>
                            <h2 class="alert alert-success">{{ total }}</h2>
                        </div>

                        <div v-if="showDaily">
                            <h3 class="alert alert-success" v-if="Object.keys(sellReport.dailyReport).length">
                                total to day's sell <span class=" text-primary badge badge-primary">{{ sellReport.dailyReport[0].total_sell }}</span>
                            </h3>
                            <h1 v-else>
                                loading ...
                            </h1>
                        </div>
                        <div v-if="showYearly">
                            <table class="table" v-if="Object.keys(sellReport.yearlyReport).length">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th scope="col">year  </th>
                                        <th scope="col">total price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="( data, index) in sellReport.yearlyReport" :key="index">
                                        <td>{{ 1+index }}</td>
                                        <td>{{ data.year }}</td>
                                        <td>{{ data.total_sell }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <h1 v-else>
                                loading ...
                            </h1>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    </main>
</template>

<script setup>
import {  ref,computed } from 'vue'
import { useSellReport } from '../../stores/sellReport/sellReport'
const reportText=ref('total drag sell report tables')
const showMonthly = ref(false)
const showDaily = ref(false)
const showYearly = ref(false)
const sellReport = useSellReport()


const monthlyReport = () => {
    reportText.value="total drag sell by month of year"
    sellReport.monthly()
    showDaily.value=false
    showYearly.value=false
    showMonthly.value = true
}

const dailylyReport = () => {
    reportText.value="total drag sold to day"
    sellReport.daily()
    showDaily.value=true
    showYearly.value=false
    showMonthly.value = false
}

const yearlyReport = () => {
    reportText.value="total drag sell by  year"
    sellReport.yearly()
    showDaily.value=false
    showYearly.value=true
    showMonthly.value = false
}

const total=computed(()=>{
    let sum=0;
    sellReport.monthNames.map((el)=>{
        sum+=parseFloat(el.total_sell)
    })
    return sum;
})
</script>