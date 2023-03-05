<template>
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4 class="float-left">solid goods and boguth goods statistic</h4>
                            <button class="btn btn-outline-primary mx-5" :class="[tableShow ? 'active' : '']"
                                @click="tableReport">table report</button>
                            <button class="btn btn-outline-success" :class="[chartShow ? 'active' : '']"
                                @click="chartReport">chart report</button>
                        </div>
                        <div class="card-body ">
                            <table class="table" v-if="tableShow">
                                <thead>
                                    <tr>

                                        <th scope="col">#</th>
                                        <th scope="col">month</th>
                                        <th scope="col">solid</th>
                                        <th scope="col">bougth</th>
                                        <th scope="col">result</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(data, index) in profitMonthly.byMonths" :key="index">
                                        <td>{{ ++index }}</td>
                                        <td>{{ data.monthName }}</td>
                                        <td>
                                            <span class="badge badge-success bg-primary">
                                                {{ data.totalSell }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-primary bg-warning">
                                                {{ data.totalGood }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-primary bg-success">
                                                {{ data.totalSell - data.totalGood }}
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>

                            </table>

                            <MonthlyIncomeChart :data="profitMonthly.byMonths" v-if="chartShow" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>

<script setup>


import { useProfitMonthly } from '../../stores/monthlyIncome';
import { ref } from 'vue'
import MonthlyIncomeChart from '../../components/income/MonthlyIncomeChart.vue';
const tableShow = ref(false)
const chartShow = ref(false)
const profitMonthly = useProfitMonthly()
const tableReport = () => {
    tableShow.value = true
    chartShow.value = false
}
const chartReport = () => {
    tableShow.value = false
    chartShow.value = true
}
profitMonthly.monthly()
</script>