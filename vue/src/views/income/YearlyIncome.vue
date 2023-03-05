<template>
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4 class="float-left">solid goods and boguth goods statistic</h4>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">year</th>
                                                <th scope="col">solid</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(data, index) in profitYear.sellByYears" :key="index">

                                                <td>{{ ++index }}</td>
                                                <td>{{ data.year }}</td>
                                                <td>
                                                    <span class="badge badge-success bg-success">{{
                                                        data.total_sell
                                                    }}</span>
                                                </td>
                                                <input type="hidden" :value="data.total_sell" id="total_sell">
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table">
                                        <thead>
                                            <tr>


                                                <th scope="col">year</th>
                                                <th scope="col">bougth</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(data, index) in profitYear.goodByYears" :key="index">


                                                <td>{{ data.year }}</td>
                                                <td>
                                                    <span class="badge badge-warning bg-warning">{{
                                                        data.totalPrice
                                                    }}</span>
                                                </td>
                                                <input type="hidden" id="totalPrice" :value="data.totalPrice">
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <button class="btn btn-primary" @click="totalResult">{{ result }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

</template>
<script setup>
import { useProfitYear } from '../../stores/yearlyIncome';
import { ref } from 'vue'
const profitYear = useProfitYear()
profitYear.yearlyProfit()
const result = ref('see total result')

const totalResult = () => {
    let total_sell = parseFloat(document.getElementById('total_sell').value)
    let totalPrice = parseFloat(document.getElementById('totalPrice').value)
    result.value = ` total result  is ${total_sell - totalPrice}`
}

</script>
