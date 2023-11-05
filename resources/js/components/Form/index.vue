<template>
    <form @submit.prevent="getHolidays">
        <div class="row">
            <div class="col-lg-5">
                <div class="holiday-input mb-3">
                    <label for="countries">Country:</label> <br>
                    <select id="countries" class="w-100 px-3 py-2 border-primary border-1 rounded-2 bg-white"
                            v-model="holidayForm.country" autocomplete="on">
                        <option value="" selected>Select a Country</option>
                        <option v-for="(country,x) in supportedCountriesData" :value="country.countryCode" :key="x">
                            {{ country.fullName }}
                        </option>
                    </select>
                    <small v-if="holidayFormState.country" class="text-danger"><i>{{
                            holidayFormState.country
                        }}</i></small>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="holiday-input mb-3">
                    <label for="countries">Year:</label> <br>
                    <select id="countries" class="w-100 px-3 py-2 border-primary border-1 rounded-2 bg-white"
                            v-model="holidayForm.year" autocomplete="on">
                        <option value="" selected>Select a Year</option>
                        <option v-for="(year,y) in years" :value="year.value" :key="y">
                            {{ year.value }}
                        </option>
                    </select>
                    <small v-if="holidayFormState.year" class="text-danger"><i>{{ holidayFormState.year }}</i></small>
                </div>
            </div>
            <div class="col-lg-2 pt-lg-4">
                <button type="submit" class="btn btn-primary w-100">search</button>
            </div>
            <div class="col-lg-12 py-4">
                <data-display v-if="holidayData.length > 0" :data="holidayData"/>
                <div class="alert alert-danger alert-dismissible text-center" role="alert" v-if="holidayData.error">
                    <i>No holidays were found for this country in the year <span class="fw-bold">{{
                            holidayForm.year
                        }}</span> <br> Consider selecting more
                        recent years </i>
                </div>
                <div class="text-primary text-center" v-if="holidayFormState.is_loading"><i>Loading...</i></div>
            </div>

        </div>
    </form>
</template>

<script setup>
import axios from 'axios'
import {onMounted, reactive, ref} from "vue"
import {useEnums} from "@/composables/useEnums.js";
import DataDisplay from '../DataDisplay/index.vue'

const holidayData = ref([])

let supportedCountriesData = ref([])

const holidayFormState = reactive({
    year: '',
    country: '',
    is_valid: false,
    is_loading: false,
})

const holidayForm = reactive({
    year: '',
    country: '',
    holiday_type: '',
})

const getCountries = async () => {
    try {
        let response = await axios.get('/api/countries')

        if (response.status === 200) {
            supportedCountriesData.value = response.data
        }
    } catch (error) {
        console.log(error)
    }
}

onMounted(() => {
    getCountries()
})

const getHolidays = async () => {

    holidayFormState.is_valid = validateFields(holidayForm.country, holidayForm.year)

    if (holidayFormState.is_valid) {

        holidayFormState.is_loading = true

        const url = '/api/holidays'
        const params = {
            country: holidayForm.country,
            year: holidayForm.year
        }

        await axios.get(url, {params})
            .then(response => {

                if (response.status === 200) {
                    holidayData.value = response.data
                    holidayFormState.is_loading = false
                    console.log(holidayData.value)
                }
            })
            .catch(error => {
                console.log("error", error)
                holidayFormState.is_loading = false
            })
    }
}

const validateFields = (field1, field2) => {
    holidayData.value = []

    let isValid = false

    holidayFormState.year = ""
    holidayFormState.country = ""


    if (!field1) {
        holidayFormState.country = 'Please select country'
    }
    if (!field2) {
        holidayFormState.year = 'Please select year'
    }

    if (holidayForm.country !== '' && holidayForm.year !== '') {
        isValid = true
    }

    return isValid
}

const {years} = useEnums()

</script>

<style scoped>

</style>
