import { defineStore } from 'pinia'
import axiosClient from '../../../axios'
export const useGoodReportStore = defineStore("goodGoodReport", {
    state: () => {
        return {
            dailyGood: [],
            monthlyGood: [],
            yearlyGood: [],
            error: [],
            monthNames: [
                { monthName: 'January', totalPrice: 0 },
                { monthName: 'February', totalPrice: 0 },
                { monthName: 'March', totalPrice: 0 },
                { monthName: 'April', totalPrice: 0 },
                { monthName: 'May', totalPrice: 0 },
                { monthName: 'June', totalPrice: 0 },
                { monthName: 'July', totalPrice: 0 },
                { monthName: 'August', totalPrice: 0 },
                { monthName: 'September', totalPrice: 0 },
                { monthName: 'October', totalPrice: 0 },
                { monthName: 'November', totalPrice: 0 },
                { monthName: 'December', totalPrice: 0 },
            ]
        }
    },
    actions: {
        async goodDaily() {
            await axiosClient.get(`/report/goods/daily`)
                .then((response) => {
                    if (response.status == 200) {
                        this.dailyGood = response.data.data
                        console.log(this.dailyGood);
                    }
                })
                .catch((error) => {
                    this.errors = error.response.data.errors
                })
        },
        async goodMonthly(filterYear='') {
            await axiosClient.get(`/report/goods/monthly?year=${filterYear}`)
                .then((response) => {
                    if (response.status === 200) {
                        this.monthlyGood = response.data.data
                    }
                })
                .catch((error) => {
                    this.errors = error.response.data.errors
                })
        },
        async goodYearly() {
            await axiosClient.get(`/report/goods/yearly`)
                .then((response) => {
                    if (response.status === 200) {
                        this.yearlyGood = response.data.data
                    }
                })
                .catch((error) => {
                    this.errors = error.response.data.errors
                })
        }
    }
})