<template>
    <form @submit.prevent="getHolidays">
        <div class="row">
            <div class="col-lg-12 text-center pt-3">
                <h5 class="text-primary">Choose a country and a year to view a list of holidays specific to that
                    country:</h5>
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
import {onMounted} from "vue"
import DataDisplay from '../DataDisplay/index.vue'
import SearchButton from '../Form/SearchButton/index.vue'
import DropDownSelect from '../Form/DropDownSelect/index.vue'
import {useForm} from "@/composables/form.js";

const {
    holidayData,
    supportedCountriesData,
    holidayFormState,
    holidayForm,
    getCountries,
    generateYears,
    getHolidays,
    years
} = useForm


onMounted(() => {
    getCountries()
    generateYears()
})

</script>

<style scoped>

</style>
