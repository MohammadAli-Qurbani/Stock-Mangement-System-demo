<template>
    <div v-show="loadChart">
        <div class="mt-2">
            <span class="btn btn-sm btn-success float-left mt-1" @click="collpase=!collpase">
                <i class="bx " :class="[collpase?'bx-minus':'bx-plus']"></i>
            </span>
            <div v-show="collpase" >

                <button class="btn btn-outline-primary mx-3" :class="[chartType==='line'?'active':'']" @click="lineChart">line chart</button>
                <button class="btn btn-outline-info mx-3" :class="[chartType==='pie'?'active':'']" @click="pieChart">pie chart</button>
                <button class="btn btn-outline-success mx-3" :class="[chartType==='bar'?'active':'']" @click="barChart">bar chart</button>
                <input class="" type="text" placeholder="write a year to filter" v-model="filerYear">
                <button title="Search"><i class="bi bi-search"></i></button>
            </div>
        </div>
        <canvas id="myChart" :class="[chartType==='pie'?'chartPieSize':'']"></canvas>
    </div>

    <h1 v-if="!loadChart">loading chart ...</h1>
</template>
<script setup>
import Chart  from 'chart.js/auto'
import { ref, onMounted } from 'vue'
const props = defineProps({ data: { required: true } })

const charInstaince = ref(null)
const loadChart = ref(false)
const chartType=ref("bar");
const populateChart = (recivedData) => {
    charInstaince.value = new Chart(document.getElementById("myChart"), {
        data: {
            labels: recivedData.map((el) => el.monthName),
            datasets: [
                {
                    label: 'solid',
                    data: recivedData.map((el) => el.totalSell)
                },
                {
                    label: 'bougth',
                    data: recivedData.map((el) => el.totalGood)
                },
                       
            ],
        },
        options: {
            responsive: true
        },
        type: chartType.value
    })
}

onMounted(() => {
    setTimeout(() => {
        populateChart(props.data)
        loadChart.value = true
    }, 1000);
})
const filerYear = ref(null)
const collpase=ref(true)

const pieChart=()=>{
    charInstaince.value.destroy()
    chartType.value='pie'
    populateChart(props.data)
}


const lineChart=()=>{
    charInstaince.value.destroy()
    chartType.value='line'
    populateChart(props.data)
}

const barChart=()=>{
    charInstaince.value.destroy()
    chartType.value='bar'
    populateChart(props.data)
}
</script>

<style>
    .chartPieSize{
        width: 500px !important; 
        height: 500px !important;
    }
</style>