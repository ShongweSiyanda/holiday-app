import {reactive, ref} from "vue";
import axios from "axios";

export const useForm = () => {
    const holidayData = ref([])
    const supportedCountriesData = ref([])
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
        const url = 'api/countries'
        let response = await axios.get(url)


        await axios.get(url)
            .then(response => {
                if (response.status === 200) {
                    supportedCountriesData.value = response.data
                }
            }).catch(error => {
                console.log(error)
            })
    }

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
                        //if response is an empty array - display a friendly message to the user
                        holidayFormState.is_empty = holidayData.value.length === 0;
                    }
                })
                .catch(error => {
                    console.log("error", error)
                })
                .finally(() => {
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

    const years = ref([])

    const generateYears = () => {

        const date = new Date()

        const current_year = date.getFullYear()

        const start_year = current_year - 10

        for (let i = 0; i <= 11; i++) {
            years.value.push({'value': start_year + i})
        }

    }

    return {
        holidayData,
        supportedCountriesData,
        holidayFormState,
        holidayForm,
        getCountries,
        generateYears,
        getHolidays,
        years
    }

}
