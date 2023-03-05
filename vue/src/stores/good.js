import {defineStore} from 'pinia'
import axiosClient from '../../axios/index'
export const useGoodStore=defineStore('goodStore',{
    state:()=>{
        return {
            goods:[],
            good:[],
            errors:[],
            paginate:[],
            suppliers:[]
        }
    },
    actions:{
        async AllSuppliers(){
            await axiosClient.get(`/good/getSuppliers`)
            .then((response)=>{
                if(response.status===200){
                    this.suppliers=response.data.data
                }
            })
            .catch((error)=>{
                this.errors=error.response.data.errors
            })
        },
        async getGoods(url=null,searchParm=''){
            let uri=url?url:`/getGoods/?searchParm=${searchParm}`
            await axiosClient.get(uri)
            .then((response)=>{
                this.goods=response.data.data
                this.paginate=response.data.meta
            })
            .catch((error)=>{
                this.errors=error.response.data.errors
            })
        },
        async store(data){
            await axiosClient.post(`/goods`,data)
            .then((response)=>{
                if(response.status===200){
                    this.errors=[]
                    this.getGoods()
                }
            })
            .catch((error)=>{
                this.errors=error.response.data.errors
            })
        },
        async show(good){
            await axiosClient.get(`/goods/${good}`)
            .then((response)=>{
                this.good=response.data.data
            })
            .catch((error)=>{
                console.log(error.response.data.errors);
            })
        },

        async edit(good){
            await axiosClient.get(`/goods/${good}/edit`)
            .then((response)=>{
                this.good=response.data.data
            })
            .catch((error)=>{
                this.errors=error.response.data.errors
            })
        },
        async update(good,data){

            await axiosClient.post(`/goods/${good}`,data)
            .then((response)=>{
                this.errors=[]
            })
            .catch((error)=>{
                this.errors=error.response.data.errors
            })
        }
    }
})
