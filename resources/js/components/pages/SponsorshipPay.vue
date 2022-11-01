<template>
  <div class="flex flex-col mx-auto  max-w-lg p-10 justify-middle">
    <div class="text-2xl">
      Stai acquistando il prodotto con id: {{ $route.params.id }}
    </div>
    {{ form }}
    <v-braintree
      ref="paymentRef"
      :authorization="tokenApi"
      @loading="handleLoading"
      @onSuccess="paymentOnSuccess"
      @onError="paymentOnError"
      locale="it_IT"
    >
      <template #button="slotProps">
        <v-btn ref="paymentBtnRef" @click="slotProps.submit" />
      </template>
    </v-braintree>
    <div>
      <p v-if="error" class="text-red-500 mb-4">
        {{ error }}
      </p>
    </div>
    <button
      v-if="!disableBuyButton"
      class="w-full text-center px-4 py-3 bg-green-500 rounded-md shadow-md text-white font-semibold"
      @click.prevent="beforeBuy"
    >
      Procedi con l'acquisto 🎉
    </button>
    <button
      v-else
      class="w-full text-center px-4 py-3 bg-green-300 rounded-md shadow-md text-white font-semibold cursor-not-allowed"
    >
      {{
        loadingPayment ? 'Loading...' : 'Procedi con l\'acquisto 🎉'
      }}
    </button>
  </div>
</template>

<script>
export default {
  authorization: {
    required: true,
  },
  async asyncData() {
    let tokenApi = null
    const response = await axios.$get('/api/orders/generate')
    tokenApi = response.token
    return {
      tokenApi,
      loadingPayment: false
    }
  },
  data () {
    return {
      tokenApi: '',
      disableBuyButton: true,
      loadingPayment: true,
      error: '',
      form: {
        token: '',
        product: ''
      }
    }
  },
  mounted () {
    this.form.product = this.$route.params.id
  },
  methods: {
    handleLoading () {
      this.disableBuyButton = false
    },
    paymentOnSuccess (nonce) {
      // alert(nonce);
      this.form.token = nonce
      this.buy()
    },
    // eslint-disable-next-line node/handle-callback-err
    paymentOnError (error) {
    },
    beforeBuy () {
      this.$refs.paymentRef.$refs.paymentBtnRef.click()
    },
    async buy () {
      this.disableBuyButton = true
      this.loadingPayment = true
      try {
        await this.$axios.$post('/api/orders/make/payment', { ...this.form })
        // const message = response.message
        // alert(message)
        this.$router.push({ path: '/checkout/thankyou' })
      } catch (error) {
        this.disableBuyButton = false
        this.loadingPayment = false
      }
    },
    onLoad () {
      this.$emit('loading')
    },
    onSuccess (payload) {
      const token = payload.nonce
      this.$emit('onSuccess', token)
      // const nonce = payload.nonce
      // Do something great with the nonce...
    },
    // eslint-disable-next-line node/handle-callback-err
    onError (error) {
      const message = error.message
      if (message === 'No payment method is available.') {
        this.error = 'Seleziona un metodo di Pagamento'
      } else {
        this.error = message
      }
      this.$emit('onError', message)
    }

  }
}
</script>
