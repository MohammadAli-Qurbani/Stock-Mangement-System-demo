<template>
    <main class="main" id="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>{{ !byAYear?filterText:expiringByAYearText }}</h3>
                            <div v-if="showNextYear">
                                <div class="search-bar float-left">
                                    <form class="search-form d-flex align-items-center">



                                        <select name="" id="" @change="showFiltering">
                                            <option value="">filter by</option>
                                            <option value="0">filter by a year</option>
                                            <option value="1">filter between two dates</option>
                                        </select>
                                    </form>
                                </div>

                                <div class="search-bar float-right">
                                    <form class="search-form d-flex align-items-center" v-if="byAYear">
                                        <input type="text" name="query" placeholder="filter by a year"
                                            title="filter by year" v-model="filterByYear">
                                        <button @click.prevent="filterByAYear" title="Search"><i
                                                class="bi bi-search"></i></button>
                                    </form>
                                    <form class="search-form d-flex align-items-center" v-if="betweenTwoYear">
                                        <input class="mx-1" type="date" v-model="firstYear" placeholder="first year"
                                            title="filter by year">
                                        <input type="date" v-model="secondYear" placeholder="second year"
                                            title="filter by year">
                                        <button @click.prevent="filterBetweenTwoYear" title="Search"><i
                                                class="bi bi-search"></i></button>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="bg-light mb-2 p-2 mt-2">
                                <button class="btn btn-outline-info" :class="[showToDay ? 'active' : '']"
                                    @click="expireToDay">expiring today
                                    <span class="badge badge-danger bg-danger">{{
                                        Object.keys(expirationStore.toDayExpirations).length
                                    }}</span>
                                </button>
                                <button class="btn btn-outline-primary mx-2" :class="[showNextMonth ? 'active' : '']"
                                    @click="expireNextMonth">expire next month

                                    <span class="badge badge-danger bg-danger">{{
                                        Object.keys(expirationStore.nextMonthExpirations).length
                                    }}</span>
                                </button>
                                <button class="btn btn-outline-success" :class="[showNextYear ? 'active' : '']"
                                    @click="expireNextYear">{{ !byAYear?'expire next year':expiringByAYearText }}
                                    <span class="badge badge-danger bg-danger">{{
                                        Object.keys(expirationStore.nextYearExpirations).length
                                    }}</span>
                                </button>
                            </div>

                            <div v-if="showNextMonth">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">drag name</th>
                                            <th scope="col">quantity</th>
                                            <th scope="col">unit price</th>
                                            <th scope="col">day(s)</th>
                                            <th scope="col">bougth date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(nextMonth, index) in expirationStore.nextMonthExpirations"
                                            :key="index">
                                            <td>{{ 1+index }}</td>
                                            <td>{{ nextMonth.drag_name }}</td>
                                            <td>{{ nextMonth.quantity }}</td>
                                            <td v-for="price in nextMonth.drag_rate">
                                                {{ price.rate }}
                                            </td>
                                            <td>{{ nextMonth.submitDate }}</td>
                                            <td>{{ nextMonth.date }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div v-if="showNextYear">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">drag name</th>
                                            <th scope="col">quantity</th>
                                            <th scope="col">unit price</th>
                                            <th scope="col">day(s)</th>
                                            <th scope="col">bougth date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(nextYear, index) in expirationStore.nextYearExpirations"
                                            :key="index">
                                            <td>{{ 1+index }}</td>
                                            <td>{{ nextYear.drag_name }}</td>
                                            <td>{{ nextYear.quantity }}</td>
                                            <td v-for="price in nextYear.drag_rate">
                                                {{ price.rate }}
                                            </td>
                                            <td>{{ nextYear.submitDate }}</td>
                                            <td>{{ nextYear.date }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div v-if="showToDay">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">drag name</th>
                                            <th scope="col">quantity</th>
                                            <th scope="col">unit price</th>
                                            <th scope="col">day(s)</th>
                                            <th scope="col">bougth date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(today, index) in expirationStore.toDayExpirations" :key="index">
                                            <td>{{ 1+index }}</td>
                                            <td>{{ today.drag_name }}</td>
                                            <td>{{ today.quantity }}</td>
                                            <td v-for="price in today.drag_rate">
                                                {{ price.rate }}
                                            </td>
                                            <td>{{ today.submitDate }}</td>
                                            <td>{{ today.date }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>

<script setup>
import { ref } from 'vue';
import { useExpirationStore } from '../../stores/upCommingExpiration'
const expirationStore = useExpirationStore()

const showNextMonth = ref(false)

const showNextYear = ref(false)

const showToDay = ref(false)

const filterText = ref('drag expiring info')

const filterByYear = ref(null)

const firstYear = ref(null)

const secondYear = ref(null)
const byAYear = ref(false)
const betweenTwoYear = ref(false)
const expiringByAYearText =ref(null)
const showFiltering = (event) => {
    if (event.target.value == 1) {
        betweenTwoYear.value = true
        byAYear.value = false
    } else if (event.target.value == 0) {
        betweenTwoYear.value = false
        byAYear.value = true

    }


}
const expireNextMonth = () => {
    showNextMonth.value = true
    showNextYear.value = false
    showToDay.value = false
    filterText.value = "list of drag which are expiring next month"
}
expirationStore.nextMonth()
expirationStore.nextYear()
expirationStore.toDay()
const expireNextYear = () => {
    showNextMonth.value = false
    showNextYear.value = true
    showToDay.value = false
    filterText.value = "list of drag which are expiring next year"

}
const expireToDay = () => {
    filterText.value = "list of drag which are expiring to day"
    showNextMonth.value = false
    showNextYear.value = false
    showToDay.value = true
}


const filterByAYear = async () => {
    if (filterByYear.value !== null) {
        firstYear.value = null
        secondYear.value = null
        expiringByAYearText.value=`list of drag(s) expiring at ${filterByYear.value}`
        await expirationStore.nextYear(filterByYear.value, null, null)
    } else {
        alert('please fill out the year input')
    }
}

const filterBetweenTwoYear = async () => {
    if (firstYear.value !== null && secondYear.value !== null) {
        filterByYear.value = null
        await expirationStore.nextYear(null, firstYear.value, secondYear.value)
    } else {
        alert('please fill out first year input and second year input')
    }
}
</script>
