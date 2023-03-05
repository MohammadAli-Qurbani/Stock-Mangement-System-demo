import { defineStore } from "pinia";

import axiosClient from '../../axios'
export const useExpirationStore = defineStore("expirationStore", {
    state: () => {
        return {
            toDayExpirations: [],
            nextMonthExpirations: [],
            nextYearExpirations: [],
            expirations:[],
            errors: []
        }
    },
    actions: {
        async toDay() {
            await axiosClient.get(`/expiringToDay`)
                .then((response) => {
                    if (response.status === 200) {
                        this.toDayExpirations = response.data.data
                    }
                })
                .catch((error) => {
                    this.errors = error.response.data.errors
                })
        },
        async nextMonth() {
            await axiosClient.get(`/expireAfterOnMonth`)
                .then((response) => {
                    if (response.status === 200) {
                        this.nextMonthExpirations = response.data.data
                    }
                })
                .catch((error) => {
                    this.errors = error.response.data.errors
                })
        },
        async nextYear(filterByYear= null,firstYear=null,secondYear = null) {

            await axiosClient.get(`/expiring/next/year/?filterByYear=${filterByYear}&firstYear=${firstYear}&secondYear=${secondYear}`)
            .then((response) => {
                if (response.status === 200) {
                    this.nextYearExpirations = response.data.data
                }
            })
            .catch((error) => {
                this.errors = error.response.data.errors
            })
        },

        async getExpiredGoods(){
            await axiosClient.get(`/expirations`)
            .then((response)=>{
                if(response.status===200){
                    this.expirations=response.data.data
                }
            })
            .catch((error)=>{
                this.errors=error.response.data.errors
            })
        }
    }


})