import { createRouter, createWebHistory } from 'vue-router'

import NProgress from "nprogress";
import { useLoginStore } from '../stores/login';


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    // {
    //   path: '/',
    //   name: 'home',
    //   component: HomeView
    // },
    {
      path: '/home',
      redirect: '/dashboard',
      component: () => import('../components/Layouts/DashboardLayout.vue'),
      meta: { requireAuth: true },
      children: [
        {
          path: '/dashboard',
          name: 'home',
          meta: { transition: 'slide-left' },
          component: () => import('../views/HomeView.vue'),
        },
        {
          path: '/supplier',
          name: 'supplier',
          meta: { transition: 'slide-right' },
          // route level code-splitting
          // this generates a separate chunk (About.[hash].js) for this route
          // which is lazy-loaded when the route is visited.
          component: () => import('../views/supplier/Supplier.vue'),
          props: true,

        },
        {
          path:'/categories',
          name:'category',
          component:()=>import('../views/category/CategoryView.vue')
        },
        {
          path:'/goods',
          name:'good',
          component:()=>import('../views/good/GoodView.vue')
        },
        {
          path:'/good/:id',
          name:'goodInfo',
          component:()=>import('../views/good/ShowView.vue'),
          props:true
        },
        {
          path:'/good/report',
          name:'goodTableReport',
          component:()=>import('../views/goodReport/TableReportView.vue')
        },
        {
          path:'/good/report/chart',
          name:'goodChartReport',
          component:()=>import('../views/goodReport/ChartReportView.vue')
        },
        {
          path:'/stocks',
          name:'stock',
          component:()=>import('../views/stock/StockView.vue')
        },
        {
            path:'/stock/:id',
            name:'stock.show',
            component:()=>import('../views/stock/StockShowView.vue'),
            props:true
        },
        {
          path:'/sells',
          name:'sell',
          component:()=>import('../views/sell/SellView.vue')
        },
        {
          path:'/sellMonthlyReport',
          name:'sellMonthlyReport',
          component:()=>import('../views/sellReport/MonthlyReportView.vue')
        },
        {
          path:'/sell/yearlyReport',
          name:'SellYearlyReport',
          component:()=>import('../views/sellReport/YearlyReportView.vue')
        },
        {
          path:'/SellTableReport',
          name:'SellTableReport',
          component:()=>import('../views/sellReport/TableReportView.vue')
        },
        {
          path:'/UpCommingExpiration',
          name:'UpCommingExpiration',
          component:()=>import('../views/expiration/UpCommingExpiration.vue')
        },
        {
          path:'/good/expire/stock',
          name:'stockExpired',
          component:()=>import('../views/expiration/GoodStockExpired.vue')
        },
        {
          path:'/monthlyIncome',
          name:'monthlyIncome',
          component:()=>import('../views/income/MonthlyIncome.vue')
        },
        {
          path:'/yearlyIncome',
          name:'yearlyIncome',
          component:()=>import('../views/income/YearlyIncome.vue')
        },
        {
          path:'/returns',
          name:'return',
          component:()=>import('../views/return/ReturnBackView.vue')
        },
        {
          path:'/returneds',
          name:"returneds",
          component:()=>import('../views/return/ReturnedView.vue')
        },

      ]
    },
    {
      path:'/',
      redirect:'/',
      component:()=>import('../components/front/FrontDefaultLayout.vue'),
      children:[
        {
          path:'/',
          name:'welcome',
          component:()=>import('../views/front/WelcomeView.vue')
        },
        {
          path:'/login',
          name:'login',
          component:()=>import('../views/front/LoginView.vue')
        },
      ]
    }
  ],
  linkActiveClass: 'navactive',
  linkExactActiveClass: 'navexact-active-link',
})
router.beforeEach((to, from, next) => {
const {token}=useLoginStore()
  NProgress.start()
  if(to.meta.requireAuth && !token ){
    next({name:'login'})
  }else {
      next()
  }
})
router.afterEach((to, from) => {
  NProgress.done()

})
export default router
