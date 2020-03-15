<template>
    <div class="row">
        <div class="col-12">
            <input ref="cardHolderName" type="text">

            <!-- Stripe Elements Placeholder -->
            <div ref="cardElement"></div>

            <button ref="cardButton">
                Update Payment Method
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        stripeKey: {},
        clientSecret: {}
    },
    data() {
        return {
            stripe: null,
        }
    }, 
    methods: {
        createCardElements() {
            const elements = this.stripe.elements();
            const cardElement = elements.create('card');
            cardElement.mount(this.$refs.cardElement);
            const cardHolderName = this.$refs.cardHolderName;
            
            const cardButton = this.$refs.cardButton;

            cardButton.addEventListener('click', async (e) => {
                swal.fire({
                    title: 'Loading',
                    allowOutsideClick: false,
                    onBeforeOpen: () => {
                        swal.showLoading();
                    }
                });
                const { setupIntent, error } = await this.stripe.confirmCardSetup(
                    this.clientSecret, {
                        payment_method: {
                            card: cardElement,
                            billing_details: { name: cardHolderName.value }
                        }
                    }
                );

                if (error) {
                    // Display "error.message" to the user...
                    swal.close();
                } else {
                    // The card has been verified successfully...
                    this.storePaymentMethod(setupIntent.payment_method);
                }
            });
        },
        storePaymentMethod(paymentMethodToken) {
            axios.post('update-payment-methods', {
                payment_method_token: paymentMethodToken
            })
            .then(response => 
            {
                window.location.reload();
            })
            .catch(error => 
            {
                console.log(error);
            })
        }
    },
    beforeMount() {
        this.stripe = Stripe(this.stripeKey);
    },
    mounted() {
        this.createCardElements();
    }
}
</script>