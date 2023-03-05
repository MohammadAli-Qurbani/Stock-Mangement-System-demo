import { defineStore } from "pinia";
import axiosClient from "../../axios"
import router from "../router";
export const useLoginStore=defineStore("loginStore",{
    state:()=>{
        return {

            token:sessionStorage.getItem("token"),
            user:[],
            errors:[]
        }

    },
    actions:{
        async login(credentials){
            await axiosClient.post(`/login`,credentials)
            .then((response)=>{
                this.token=response.data.token
                this.user=response.data.user
                sessionStorage.setItem("token",response.data.token)
                if(this.token!==null){
                    router.push({name:'home'})
                }
            })
            .catch((error)=>{
                this.errors=error.response.data.errors
            })
        },
        async logOut(){
            await axiosClient.post(`/logOut`)
            .then((response)=>{
                if(response.status===200){
                    router.push('/')
                }
            })
            .catch((error)=>{
                console.log(error);
            })
        }
    }
})
