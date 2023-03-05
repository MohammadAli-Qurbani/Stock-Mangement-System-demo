import { defineStore } from "pinia";
import axiosClient from '../../axios'
export const useSpplierStore=defineStore("supplierStore",{
    state:()=>{
        return {
            suppliers:[],
            errors:[],
            supplier:[],
            paginate:[],
            updateLink:null
        }
    },

    actions:{
        async AllSuppliers(url=null,searchSupplier=''){
            this.updateLink=url
            let uri=url?url:`/getSuppliers/?searchParm=${searchSupplier}`
            await axiosClient.get(uri)
            .then((response)=>{
                if(response.status===200){
                    this.suppliers=response.data.data
                    this.paginate=response.data.meta
                }

            }).catch((error)=>{
                console.log(error);
            })
        },
        async storeSupplier(data){
            this.errors=[]
            await axiosClient.post('/suppliers',data)
            .then((response)=>{
               this.AllSuppliers()
            })
            .catch((error)=>{
                this.errors=error.response.data.errors
            })
        },
        async edit(id){
            await axiosClient.get(`/suppliers/${id}`)
            .then((response)=>{
                this.supplier=response.data.data
            })
            .catch((error)=>{
                this.errors=error
                console.log(error);
            })
        },
        async update(data,id){
            this.errors=[]
            await axiosClient.post(`/suppliers/${id}`,data)
            .then((response)=>{
               this.AllSuppliers(this.updateLink)
            })
            .catch((error)=>{
                this.errors=error.response.data.errors
                // console.log(error.response.data.message)
            })
        }
    },
})
