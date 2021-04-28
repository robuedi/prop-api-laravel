<template>
    <div v-if="show === true">

        <NotificationLabels :errors="errors"/>

        <form action="#" @submit.prevent="submit">
            <div class="mb-3" >
                <label for="job_title" class="form-label">Job title</label>
                <input type="text" v-model="form.job_title" class="form-control w-50" id="job_title" >
            </div>
            <div class="mb-3" >
                <label class="form-label">Start date</label>
                <br/>
                <date-range-picker class="w-50" ref="pickerStart" :auto-apply="true" :maxDate="endDate.endDate" :showDropdowns="true" v-model="startDate" :singleDatePicker="true" :ranges="false" >
                    <template v-slot:input="pickerStart"  >
                        {{ pickerStart.startDate | date }}
                    </template>
                </date-range-picker>
            </div>
            <div class="mb-3" >
                <label class="form-label">End date (optional)</label>
                <br/>
                <date-range-picker class="w-50" ref="pickerEnd" :auto-apply="true" :minDate="startDate.startDate" :showDropdowns="true" v-model="endDate" :singleDatePicker="true" :ranges="false" >
                    <template v-slot:input="pickerEnd"  >
                        {{ pickerEnd.startDate | date }}
                    </template>
                </date-range-picker>
                <div class="w-50" v-if="endDate.endDate">
                    <button type="button" @click="endDate.endDate = null" class="btn btn-outline-dark btn-sm float-right mt-1">Clear</button>
                </div>
            </div>

            <button class="btn btn-success">Submit</button>
        </form>
    </div>
</template>

<script>

import DateRangePicker from 'vue2-daterange-picker'
import 'vue2-daterange-picker/dist/vue2-daterange-picker.css'
import NotificationLabels from "../NotificationLabels";
import Moment from "moment";
import Employment from "../../api/models/Employment";

export default {
    props: {
        roleUserId: Number
    },
    components: {
        DateRangePicker,
        NotificationLabels
    },
    watch: {
        startDate(val){
            this.form.start_date = Moment(val.startDate).format("YYYY-MM-DD")
        },
        endDate(val){
            this.form.end_date = Moment(val.endDate).format("YYYY-MM-DD")
        }
    },
    data () {
        return {
            startDate: {
                startDate: null,
            },
            endDate: {
                endDate: null,
            },
            show: false,
            errors: [],
            form: {
                job_title: null,
                start_date: null,
                end_date: null,
            },
        }
    },
    methods: {
        async submit()
        {
            Employment.store(this.roleUserId, this.form).then((res) => {
                this.$emit('hasEmployment', res)
            }).catch((error) => {
                for (const [key, msg] of Object.entries(error.response.data.errors)) {
                    this.errors.push(msg[0]);
                }
            });
        }
    },
    mounted() {
        Employment.all(this.roleUserId).then((res) => {
            if(res.data.data.length !== 0){
                this.$emit('hasEmployment', res);
            }
            else{
                this.show = true
            }
        });
    }
}
</script>

<style scoped>

</style>
