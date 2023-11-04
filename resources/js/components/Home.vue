<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 d-none d-lg-block">&nbsp;</div>
            <div class="col-lg-6">
                <form @submit.prevent="getHolidays">

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="holiday-input mb-3">
                                <label for="countries">Country:</label> <br>
                                <select id="countries" class="w-100 px-3 py-1 border-primary border-1 rounded-2 bg-white"
                                        v-model="holidayForm.country" autocomplete="on">
                                    <option value="" selected>Select a Country</option>
                                    <option v-for="(country,x) in supportedCountriesData" :value="country.countryCode" :key="x">
                                        {{ country.fullName }}
                                    </option>
                                </select>
                                <small v-if="holidayFormErrorState.country" class="text-danger"><i>{{ holidayFormErrorState.country }}</i></small>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="holiday-input mb-3">
                                <label for="countries">Year:</label> <br>
                                <select id="countries" class="w-100 px-3 py-1 border-primary border-1 rounded-2 bg-white"
                                        v-model="holidayForm.year" autocomplete="on">
                                    <option value="" selected>Select a Year</option>
                                    <option v-for="(year,y) in years" :value="year.value" :key="y">
                                        {{ year.value }}
                                    </option>
                                </select>
                                <small v-if="holidayFormErrorState.year" class="text-danger"><i>{{ holidayFormErrorState.year }}</i></small>
                            </div>
                        </div>
                    </div>




                    <button type="submit">Submit</button>
                </form>
            </div>
            <div class="col-lg-3 d-none d-lg-block">&nbsp;</div>
        </div>

    </div>
</template>

<script setup>
import axios from 'axios'
import {onMounted, reactive, ref} from "vue"
import {useEnums} from "../composables/useEnums.js";

let supportedCountriesData = ref([])

const holidayFormErrorState = reactive({
    year: '',
    country: '',
    holiday_type: '',
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
            // console.log(supportedCountriesData)
        }
    } catch (error) {
        console.log(error)
    }
}

onMounted(() => {
    getCountries()
})

const {years} = useEnums()


const getHolidays = () => {

    holidayFormErrorState.year = ""
    holidayFormErrorState.country= ""
    holidayFormErrorState.holiday_type = ""


    if(!holidayForm.country){
        holidayFormErrorState.country='Please select country'

    }
    if(!holidayForm.year){
        holidayFormErrorState.year='Please select year'
    }



    console.log("country:", holidayForm.country)
    console.log("year:", holidayForm.year)
}

</script>

<style scoped>

</style>
