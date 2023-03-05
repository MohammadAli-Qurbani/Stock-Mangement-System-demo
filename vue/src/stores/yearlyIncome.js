import { defineStore } from "pinia";
import axiosClient from "../../axios";

export const useProfitYear=defineStore("profitYearly",{
    state:()=>{
        return {
            goodByYears:[],
            sellByYears:[],
            errors:[]
        }
    },
    actions:{
        async yearlyProfit(){
            await axiosClient.get(`/yearlyIncome`)
            .then((response)=>{
                if(response.status===200){
                    this.goodByYears=response.data.goods
                    this.sellByYears=response.data.selles
                }
            })
            .catch((error)=>{
                console.log(errors);
            })
        }
     
    }
})