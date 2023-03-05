import {defineStore} from 'pinia'
import axiosClient from '../../../axios/index'
export const useSellReport=defineStore("sellReport",{
    state:()=>{
        return {
            monthlyReport:null,
            monthlyTableReport:[],
            monthNames: [
                { monthName: 'January', total_sell: 0 },
                { monthName: 'February', total_sell: 0 },
                { monthName: 'March', total_sell: 0 },
                { monthName: 'April', total_sell: 0 },
                { monthName: 'May', total_sell: 0 },
                { monthName: 'June', total_sell: 0 },
                { monthName: 'July', total_sell: 0 },
                { monthName: 'August', total_sell: 0 },
                { monthName: 'September', total_sell: 0 },
                { monthName: 'October', total_sell: 0 },
                { monthName: 'November', total_sell: 0 },
                { monthName: 'December', total_sell: 0 },
            ],
            errors:[],
            yearlyReport:[],
            dailyReport:[]
        }
    },
    actions:{
        async monthly(filerYear=''){
            await axiosClient(`/reports/selles/charts?year=${filerYear}`)
            .then((response)=>{
                if(response.status===200){
                    const data=response.data.data
                    for (let index = 0; index <data.length; index++) {
                        if(index<data.length){
                            const search=this.monthNames.findIndex((reportMonth)=>reportMonth.monthName===data[index].month)
                            this.monthNames[search].total_sell=data[index].total_sell
                        }
                    }
                    this.reportMonth=this.monthNames
                    this.monthlyTableReport=this.monthNames
                    console.log(this.reportMonth)
                }
            })
            .catch((error)=>{
                this.errors=error.response.data.errors
            })
        },
        async yearly(){
            await axiosClient.get(`/reports/selles/charts/yearly`)
            .then((response)=>{
                if(response.status===200){
                    this.yearlyReport=response.data.data
                }
            })
            .catch((error)=>{
                this.errors=error.response.data.errors
            })
        },
        async daily(){
            await axiosClient.get(`/report/selles/daily`)
            .then((response)=>{
                if(response.status===200){
                    this.dailyReport=response.data.data
                }
            })
            .catch((error)=>{
                this.errors=error.response.data.errors
            })
        }
    }
})