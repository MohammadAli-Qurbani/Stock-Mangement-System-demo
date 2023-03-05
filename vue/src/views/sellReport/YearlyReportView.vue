<template>
    <main class="main" id="main">
      
        <div v-show="Object.keys(sellReport.yearlyReport).length">
            <canvas id="myChart"></canvas>
        </div>
        <h1 v-if="Object.keys(sellReport.yearlyReport).length">
            no data found
        </h1>
    </main>
</template>

<script setup>
import Chart  from 'chart.js/auto'
import { onMounted } from 'vue';
import { useSellReport } from '../../stores/sellReport/sellReport'
const sellReport=useSellReport()
const populateChart=(reportData)=>{
    new Chart(document.getElementById("myChart"),{
        data:{
            labels:reportData.map((el)=>el.year),
            datasets:[
                {
                    label:'total drag sold by year',
                    data:reportData.map((el)=>el.total_sell)
                }
            ]
        },
        options:{
            responsive:true
        },
        type:'line'
    })
}
sellReport.yearly()
onMounted(() => {
    setTimeout(() => {
        populateChart(sellReport.yearlyReport)
        
    }, 1000);
})
</script>