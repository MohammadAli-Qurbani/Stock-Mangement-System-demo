import { defineStore } from "pinia";
import axiosClient from '../../axios/index'
import NProgress from "nprogress";

export const useCategorStore = defineStore("categoryStore", {
    state: () => {
        return {
            categories: [],
            category: [],
            errors: []
        }
    },
    actions: {
        async store(data) {
            await axiosClient.post(`/categories`, data)
                .then((response) => {
                    if (response.status === 200) {
                        this.getCategories()
                    }
                })
                .catch((error) => {
                    this.errors = error.response.data.errors
                })
        },
        async getCategories() {
            await axiosClient.get(`/getCategories`)
                .then((response) => {
                    if (response.status === 200) {
                        this.categories = response.data.data
                    }
                })
                .catch((error) => {
                    this.errors = error.response.data.errors
                })
        },
        async edit(category) {
            await axiosClient.get(`/categories/${category}/edit`)
                .then((response) => {
                    this.category = response.data.data
                })
                .catch((error) => {
                    NProgress.done()
                    this.errors = error.response.data.errors
                })
        },
        async update(category,data){
            await axiosClient.post(`/categories/${category}`,data).
            then((response)=>{

            })
            .catch((error)=>{
                this.errors=error.response.data.errors
            })
        },
        async delete(category){
            await axiosClient.delete(`/categories/${category}`)
            .then((response)=>{
                console.log(response);
            })
            .catch((error)=>{
                this.errors=error.response.data
            })
        }
    }
})
