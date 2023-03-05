import { defineStore } from "pinia";
import axiosClient from "../../axios";

export const useReturned=defineStore("returnedStore",{
    state:()=>{
        return {
            goods:[],
            errors:[],
            paginate:[],
            returneds:[]
        }
    },
    actions:{
        async getGoods(url=null,searchParm=''){
            let uri=url?url:`/returneds/good/?searchParm=${searchParm}`
            await axiosClient.get(uri)
            .then((response)=>{
                this.goods=response.data.data.filter(el=>el.quantity!=0);
                
                this.paginate=response.data.meta
            })
            .catch((error)=>{
                this.errors=error.response.data.errors
            })
        },

        async returnGood(data){
            await axiosClient.post(`/returneds`,{'data':data})
            .then((response)=>{
                this.getGoods()
            })
            .catch((error)=>{
                this.errors=error.response.data.errors
                console.log(this.errors);
            })
        },
        async getReturnedGoods(url=null,searchParm=''){
            let uri=url?url:`/returneds/getGoods?searchParm=${searchParm}`
            await axiosClient.get(uri)
            .then((response)=>{
                this.returneds=response.data.data
                this.paginate=response.data.meta
            })
            .catch((error)=>{
                this.errors=error.response.data.errors
            })
        }
    }
})