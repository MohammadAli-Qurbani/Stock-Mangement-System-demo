import axios from "axios";
import NProgress from "nprogress";
import { useLoginStore } from "../src/stores/login";

const axiosClient=axios.create({
    baseURL:`http://127.0.0.1:8000/api`,
    withCredentials:true,
    headers:{
        Accept:'Application/json',
        'Content-Type':'Application/json'
    }
})

axiosClient.interceptors.request.use(config=>{
    const {token}=useLoginStore()
    config.headers.Authorization=`Bearer ${token}`
    NProgress.start()
    return config
})

axiosClient.interceptors.response.use(response=>{

    NProgress.done()
    return response
})

export default axiosClient
