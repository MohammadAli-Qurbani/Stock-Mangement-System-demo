<template>
    <main class="main" id="main">
        <div>

            <span class="btn btn-sm btn-success mx-3" @click="lineChart">line chart</span>
            <span class="btn btn-sm btn-primary mx-3" @click="pieChart">pie chart</span>
            <span class="btn btn-sm btn-info mx-3" @click="barChart">bar chart</span>
            <input class="" type="text" placeholder="write a year to filter" v-model="filerYear">
            <button @click="filterByYear" title="Search"><i class="bi bi-search"></i></button>
            <div v-show="sellReport.reportMonth !== null" :class="[charTtype == 'pie' ? 'chartPieSize' : '']">

                <canvas id="myChart"></canvas>
            </div>
        </div>
    </main>
</template>
<script setup>
import  Chart  from 'chart.js/auto';
import { ref, onMounted } from 'vue';
import { useSellReport } from '../../stores/sellReport/sellReport'
const sellReport = useSellReport()

let charInstaince = ref(null)
let charTtype = ref("line")

const lineChart = () => {
    charTtype.value = "line"
    charInstaince.value.destroy()

    puploatChart(sellReport.reportMonth)
}
const pieChart = () => {
    charTtype.value = "pie"
    charInstaince.value.destroy()
    puploatChart(sellReport.reportMonth)
}
const barChart = () => {
    charTtype.value = "bar"
    charInstaince.value.destroy()
    puploatChart(sellReport.reportMonth)
}
const puploatChart = (recivedData) => {
    charInstaince.value = new Chart(document.getElementById("myChart"), {
        data: {
            labels: recivedData.map((el) => el.monthName),
            datasets: [
                {
                    label: 'total sell by month of a year or current year',
                    data: recivedData.map((el) => el.total_sell),
                    borderWidth: 2
                }
            ]
        },
        options: {
            responsive: true
        },
        type: charTtype.value
    })
}
onMounted(() => {
    sellReport.monthly()
    setTimeout(() => {
        puploatChart(sellReport.reportMonth)
    }, 1000);
})
const filerYear = ref(null)
const filterByYear = async () => {
    sellReport.$reset()
    charInstaince.value.destroy()
    await sellReport.monthly(filerYear.value)
    puploatChart(sellReport.reportMonth)
}
</script>

<style>
.chartPieSize {
    width: 500px !important;
}
</style>