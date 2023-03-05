import { defineStore } from "pinia"
import axiosClient from "../../axios"

export const useStockStore=defineStore('stockStore',{
    state:()=>{
        return {
            stocks:[],
            errors:[],
            stock:[]
        }
    },

    actions:{
        async getStocks(dragSearch=''){
            await axiosClient.get(`/getStocks/?dragSearch=${dragSearch}`)
            .then((response)=>{
                this.stocks=response.data.data
            })
            .catch((error)=>{
                this.errors=error.response.data.errors
            })
        },

        async show(stockId){
            await axiosClient.get(`/stocks/${stockId}`)
            .then((response)=>{
                if(response.status===200){
                    this.stock=response.data
                }
            })
            .catch((error)=>{
                this.errors=error.response.data.errors
            })
        }

    }
})
