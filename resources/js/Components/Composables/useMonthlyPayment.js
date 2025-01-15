import { computed, isRef } from 'vue'

/*
  Composable
  在Vue应用中，它是一个将使用Vue组合API的函数
  它将封装一些可重用的有状态的逻辑

  它们通常可以在任何普通的JavaScript函数中使用，因为它们只是普通的JavaScript函数
  Composable的工作原理是，可以从它们中返回一些内容
 */
export const useMonthlyPayment = (total, interestRate, duration) => {
  const monthlyPayment = computed(() => {
    const principle = isRef(total) ? total.value : total
    const monthlyInterest =
      (isRef(interestRate) ? interestRate.value : interestRate) / 100 / 12
    const numberOfPaymentMonths =
      (isRef(duration) ? duration.value : duration) * 12

    return (
      (principle *
        monthlyInterest *
        Math.pow(1 + monthlyInterest, numberOfPaymentMonths)) /
      (Math.pow(1 + monthlyInterest, numberOfPaymentMonths) - 1)
    )
  })

  const totalPaid = computed(() => {
    return (
      (isRef(duration) ? duration.value : duration) * 12 * monthlyPayment.value
    )
  })

  const totalInterest = computed(() => {
    return totalPaid.value - (isRef(total) ? total.value : total)
  })

  // 通常返回一个带有某些数据属性或其他函数的对象
  return { monthlyPayment, totalPaid, totalInterest }
}
