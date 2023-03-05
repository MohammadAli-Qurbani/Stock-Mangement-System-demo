<template>
    <main class="main" id="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h2>list of drags which are expired in stock</h2>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">drag name</th>
                                        <th scope="col">quantity</th>
                                        <th scope="col">unit price</th>
                                        <th scope="col">year</th>
                                        <th scope="col">bougth date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="expired in expirationStore.expirations" :key="expired.id">
                                        <td>
                                            {{ expired.id }}
                                        </td>

                                        <td>
                                            {{ expired.drag_name }}
                                        </td>
                                        <td>
                                            {{ expired.quantity }}
                                        </td>

                                        <td v-for="(price, index) in expired.drag_rate" :key="index">
                                            {{ price.rate }}
                                        </td>
                                        <td>
                                            {{ expired.year }}
                                        </td>
                                        <td>
                                            {{ expired.bougth_date }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button class="btn btn-sm btn-primary" @click="total">{{ see }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

</template>

<script setup>
import { ref } from 'vue';
import { useExpirationStore } from '../../stores/upCommingExpiration';
const expirationStore = useExpirationStore()
expirationStore.getExpiredGoods()
const see = ref('see total price')
const total = () => {

    const drag_rate = expirationStore.expirations.map(el => el.drag_rate)
    let allDragRate = drag_rate.reduce((accumulator, curValue) => accumulator.concat(curValue), [])
    let total = allDragRate.reduce((el, obj) => parseFloat(el.rate) + parseFloat(obj.rate))

    see.value = `total price ${expirationStore.expirations.length===1?total.rate:total}`
}

</script>
