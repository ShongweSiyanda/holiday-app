<template>
    <form @submit.prevent="getHolidays">
        <div class="row">
            <div class="col-lg-12 text-center pt-3">
                <h5 class="text-primary">Choose a country and a year to view a list of holidays specific to that country:</h5>
            </div>
            <div class="col-lg-5">
                <drop-down-select
                    label="Country"
                    v-model="holidayForm.country"
                    :error="holidayFormState.country"
                    :options="supportedCountriesData"
                    displayKey="fullName"
                    valueKey="countryCode"
                />
            </div>
            <div class="col-lg-5">
                <div class="holiday-input mb-3">
                    <drop-down-select
                        label="Year"
                        v-model="holidayForm.year"
                        :error="holidayFormState.year"
                        :options="years"
                        displayKey="value"
                        valueKey="value"
                    />
                </div>
            </div>
            <div class="col-lg-2 pt-lg-4">
                <search-button
                    label="search"
                    v-if="!holidayFormState.is_loading"
                    :disabled="false"
                />
                <search-button
                    label="loading..."
                    v-else
                    :disabled="true"
                />
            </div>
            <div class="col-lg-12 pt-3 pb-0">
                <data-display v-if="holidayData.length > 0" :data="holidayData"/>
                <div class="alert border-primary border-1 text-primary alert-dismissible mb-0 text-center" role="alert"
                     v-if="holidayData.error || holidayFormState.is_empty">
                    <i>No holidays were found for this country in the year <span class="fw-bold">{{
                            holidayForm.year
                        }}.</span> <br> Consider selecting more
                        recent years.</i>
                </div>
                <div class="text-primary text-center" v-if="holidayFormState.is_loading"><i>Loading...</i></div>
            </div>

        </div>
    </form>
</template>

<script setup>
import axios from 'axios'
import {onMounted, reactive, ref} from "vue"
import {useEnums} from "@/composables/useEnums.js"
import DataDisplay from '../DataDisplay/index.vue'
import SearchButton from '../Form/SearchButton/index.vue'
import DropDownSelect from '../Form/DropDownSelect/index.vue'

let holidayData = ref([])

let supportedCountriesData = ref([])

const holidayFormState = reactive({
    year: '',
    country: '',
    is_valid: false,
    is_loading: false,
    is_empty: false,
})

const holidayForm = reactive({
    year: '',
    country: '',
    holiday_type: '',
})

const getCountries = async () => {
    try {
        const url = 'api/countries'
        let response = await axios.get(url)

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

                    //if response is an empty array - display a friendly message to the user
                    holidayFormState.is_empty = holidayData.value.length === 0;
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
