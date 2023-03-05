import { defineStore } from "pinia";
import axiosClient from "../../axios";


export const useProfitMonthly = defineStore("profitMonthly", {
    state: () => {
        return {
            byMonths: [
                { monthName: 'January', totalGood: 0, totalSell: 0 },
                { monthName: 'February', totalGood: 0, totalSell: 0 },
                { monthName: 'March', totalGood: 0, totalSell: 0 },
                { monthName: 'April', totalGood: 0, totalSell: 0 },
                { monthName: 'May', totalGood: 0, totalSell: 0 },
                { monthName: 'June', totalGood: 0, totalSell: 0 },
                { monthName: 'July', totalGood: 0, totalSell: 0 },
                { monthName: 'August', totalGood: 0, totalSell: 0 },
                { monthName: 'September', totalGood: 0, totalSell: 0 },
                { monthName: 'October', totalGood: 0, totalSell: 0 },
                { monthName: 'November', totalGood: 0, totalSell: 0 },
                { monthName: 'December', totalGood: 0, totalSell: 0 },
            ],
            errors: []
        }
    },
    actions: {
        async monthly($year = '') {
            await axiosClient.get(`/monthlyIncome`)
                .then((response) => {
                    if (response.status === 200) {
                   
                        const sellDdata = response.data.selles
                        for (let index = 0; index < sellDdata.length; index++) {
                            if (index < sellDdata.length) {
                                const searchSellDdata = this.byMonths.findIndex((sellDataMonth) => sellDataMonth.monthName === sellDdata[index].month)
                                this.byMonths[searchSellDdata].totalSell = sellDdata[index].total_sell
                            }

                        }

                        const goodData = response.data.goods
                        for (let index = 0; index < goodData.length; index++) {
                            if (index < goodData.length) {
                                const goodDataSearch = this.byMonths.findIndex((goodDataMonth) => goodDataMonth.monthName === goodData[index].month)
                                this.byMonths[goodDataSearch].totalGood = goodData[index].totalPrice
                            }

                        }
                        console.log(this.byMonths);

                    }
                })
                .catch((error) => {
                    console.log(error);
                })
            }
        }
})