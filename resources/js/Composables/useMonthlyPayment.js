import { computed } from "vue"


export const useMonthlyPayment = (total,interestRate,year) => {
    const monthlyPayment = computed(() => {
        const principle = total.value ?? total
        const monthlyInterest = interestRate.value / 100 / 12
        const numberOfPaymentMonths = year.value * 12;
        return parseInt(principle * monthlyInterest * (Math.pow(1 + monthlyInterest, numberOfPaymentMonths)) / (Math.pow(1 + monthlyInterest, numberOfPaymentMonths) - 1))
    })    

    return {monthlyPayment}
} 