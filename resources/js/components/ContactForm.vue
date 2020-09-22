<template>
    <form>
        <div class="alert alert-success my-2" v-if="isSuccess">
            Email successfully sent
        </div>

        <div class="form-group">
            <label for="name">Name*</label>
            <input
                type="text"
                class="form-control"
                id="name"
                v-model="data.name"
                :class="{ 'is-invalid': errors.hasOwnProperty('name') }"
            >
            <div class="alert alert-danger" v-if="errors.hasOwnProperty('name')">
                {{ errors.name[0] }}
            </div>
        </div>
        <div class="form-group">
            <label for="email">Email address*</label>
            <input
                type="email"
                class="form-control"
                id="email"
                v-model="data.email"
                :class="{ 'is-invalid': errors.hasOwnProperty('email') }"
            >
            <div class="alert alert-danger" v-if="errors.hasOwnProperty('email')">
                {{ errors.email[0] }}
            </div>
        </div>

        <div class="form-group">
            <label for="question">Question*</label>
            <textarea
                class="form-control"
                :class="{ 'is-invalid': errors.hasOwnProperty('question') }"
                id="question"
                v-model="data.question"
            ></textarea>
            <div class="alert alert-danger" v-if="errors.hasOwnProperty('question')">
                {{ errors.question[0] }}
            </div>
        </div>

        <button type="button" class="btn btn-primary" @click.prevent="submitForm">Send</button>
    </form>
</template>

<script>

export default {
    data () {
        return {
            isSuccess: false,
            data: {
                name: '',
                email: '',
                question: '',
            },
            errors: {}
        }
    },
    methods: {
        submitForm () {
            this.errors = {};
            this.isSuccess = false;
            axios.post('/submit', this.data)
                .then(() => {
                    this.isSuccess = true
                    this.data.name = ''
                    this.data.email = ''
                    this.data.question = ''
                })
                .catch(({response}) => {
                    if (response.status === 422) {
                        this.errors = response.data.errors;
                    }
                });
        }
    }
}
</script>
