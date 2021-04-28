<template>
    <div v-if="show === true">
        <template v-if="show === true">
            <NotificationLabels :errors="errors"/>
            <form action="#" @submit.prevent="submit">
                <div class="mb-3" >
                    <label for="agency_name" class="form-label">Agency name</label>
                    <input type="text" v-model="form.name" class="form-control w-50" id="agency_name" >
                </div>
                <div class="form-check mb-3">
                    <input type="checkbox"  v-model="form.is_public" class="form-check-input" id="is_public">
                    <label class="form-check-label" for="is_public">Keep the agency private?</label>
                </div>
                <button class="btn btn-success">Submit</button>
            </form>
        </template>
        <p v-else>Loading..</p>
    </div>
</template>

<script>

import NotificationLabels from '../NotificationLabels'
import Agency from "../../api/models/Agency";

export default {
    components: {
        NotificationLabels
    },
    data () {
        return {
            show: false,
            errors: [],
            form: {
                name: null,
                is_public: null,
            },
        }
    },
    props: {
        roleUserId: Number
    },
    methods: {
        async submit()
        {
            Agency.store(this.roleUserId, this.form).then((res) => {
                this.$emit('hasAgencyInfo', res)
            }).catch((error) => {
                for (const [key, msg] of Object.entries(error.response.data.errors)) {
                    this.errors.push(msg[0]);
                }
            });
        }
    },
    mounted() {
        Agency.all(this.roleUserId).then((res) => {
            if(res.data.data.length !== 0)
            {
                this.$emit('hasAgencyInfo', res);
            }
            else
            {
                this.show = true
            }
        });
    }
}
</script>

<style scoped>

</style>
