import {defineStore} from 'pinia'
import axiosClient from "../../axios"
export const useSellStore=defineStore("sellStore",{
    state:()=>{
        return{
            sells:[],
            errors:[]
        }
    },actions:{
        async getSells(searchPram=''){
            await axiosClient.get(`/getSells/?searchPram=${searchPram}`)
            .then((response)=>{
                if(response.status===200){
                    this.sells=response.data.data
                }
            })
            .catch((error)=>{
                this.errors=error.response.data.errors
            })
        },
        async store(data){
            await axiosClient.post(`/sells`,{'sells':data})
            .then((response)=>{
                if(response.status===200){
                    this.errors=[]
                }
            })
            .catch((error)=>{
                this.errors=error.data.response.errors
            })
        }
    }
})
