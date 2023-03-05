<template>

    <main class="main" id="main">
        <div class="search-bar">

            <button class="btn btn-sm btn-outline-primary mx-3" @click="lineChart"
                :class="[chartType==='line'?'active':'']">line chart</button>
            <button class="btn btn-sm btn-outline-info mx-3" @click="pieChart"
                :class="[chartType === 'pie' ? 'active' : '']">pie chart</button>
            <button class="btn btn-sm btn-outline-success mx-3" @click="barChart"
                :class="[chartType === 'bar' ? 'active' : '']">bar chart</button>
            <input type="text" v-model="filterYear" placeholder="Enter a year" title="Enter search keyword">
            <button @click="filterByYear" title="Search"><i class="bi bi-search"></i></button>

        </div><!-- End Search Bar -->

        <div v-show="Object.keys(goodDaliyStore.monthlyGood).length" class="">
            <div :class="[chartType === 'pie' ? 'w500 shadow' : '']">

                <canvas id="myChart"></canvas>
            </div>
        </div>
    </main>

</template>
<script setup>
import Chart from 'chart.js/auto'

import { useGoodReportStore } from '../../stores/goodReport/TableReport'
import { ref, onMounted } from 'vue';
const goodDaliyStore = useGoodReportStore()
goodDaliyStore.goodMonthly()
let show = ref(false)
let filterYear = ref(null)
let myChart = ref(null)
const chartType = ref("line")
const populateChart = () => {
    setTimeout(() => {
        const chartData = goodDaliyStore.monthlyGood
        if (Object.keys(goodDaliyStore.monthlyGood).length) {
            for (let index = 0; index < goodDaliyStore.monthlyGood.length; index++) {
                if (index < chartData.length) {
                    let search = goodDaliyStore.monthNames.findIndex((monthName) => monthName.monthName === chartData[index].month)
                    goodDaliyStore.monthNames[search].totalPrice = chartData[index].totalPrice
                }
            }
        }
        reportData.value = goodDaliyStore.monthNames
        console.log(goodDaliyStore.monthNames)
        show.value = true
    }, 500);
    const ctx = document.getElementById("myChart")
    setTimeout(() => {
        // if (Object.keys(goodDaliyStore.monthlyGood).length) {
        // alert(Object.keys(goodDaliyStore.monthlyGood).length)
        myChart.value = new Chart(ctx,
            {
                data: {
                    labels: goodDaliyStore.monthNames.map((el) => el.monthName),
                    datasets: [
                        {
                            label: 'total price by month',
                            data: goodDaliyStore.monthNames.map((el) => el.totalPrice),
                            borderWith: 1
                        },
                    ],
                },
                options: {
                    responsive: true
                },
                type: chartType.value
            }
        )
        // }
        // myChart.destroy()
    }, 500);
}
onMounted(() => {
    populateChart()
})
let reportData = ref(null)
const filterByYear = async () => {
    goodDaliyStore.$reset()
    myChart.value.destroy()
    alert(filterYear.value)
    await goodDaliyStore.goodMonthly(filterYear.value)
    populateChart()
}


const lineChart = () => {
    chartType.value = "line"
    myChart.value.destroy()
    populateChart()
}

const pieChart = () => {
    chartType.value = "pie"
    myChart.value.destroy()
    populateChart()
}


const barChart = () => {
    chartType.value = "bar"
    myChart.value.destroy()
    populateChart()
}
</script>

<style>
.w500 {
    width: 500px !important;
}

.w100 {
    width: 100% !important;
}
</style>